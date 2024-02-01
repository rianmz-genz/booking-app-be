<?php

namespace App\Http\Controllers;

use App\Http\Requests\StadiumCreateRequest;
use App\Http\Requests\StadiumUpdateRequest;
use App\Http\Resources\StadiumCollection;
use App\Http\Resources\StadiumResource;
use App\Models\Stadium;
use App\Models\StadiumCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StadiumController extends Controller
{
    use Helper;

    private function findById($id)
    {
        $stadium = Stadium::find($id);

        if (!$stadium) {
            return $this->basic_response(null, 'Not found', 404);
        }

        return $stadium;
    }

    public function create(StadiumCreateRequest $request)
    {
        $data = $request->validated();
        $uploadedImages = [];
        $stadiumCount = Stadium::where('name', $data['name'])->count();
        $stadiumCategoryCount = StadiumCategory::where('id', $data['stadium_category_id'])->count();
        if ($stadiumCategoryCount == 0) {
            return $this->basic_response(null, 'Stadium category notfound or name duplicate', 404, false);
        }
        if ($stadiumCount == 1) {
            return $this->basic_response(null, 'Stadium duplicate', 400, false);
        }
        foreach ($request->file('images') as $image) {
            $path = $image->store('images/stadiums', 'public');
            $uploadedImages[] = url('storage/' . $path);
        }
        $data['images'] = $uploadedImages;
        $stadium = Stadium::create($data);
        return $this->basic_response(new StadiumResource($stadium), 'Success create stadium', 201);
    }

    public function getAll(Request $request)
    {
        $name = $request->input('name');
    
        $stadiums = Stadium::with('category')
            ->when($name, function ($q) use ($name) {
                $q->where('name', 'like', '%' . $name . '%');
            })
            ->get();
    
        return $this->basic_response(new StadiumCollection($stadiums), 'Success get all stadium');
    }

    public function update(StadiumUpdateRequest $request, $id) 
    {
        $data = $request->validated();
        $uploadedImages = [];

        $stadium = $this->findById($id);

        // You may want to check for duplicate names excluding the current stadium
        $stadiumCount = Stadium::where('name', $data['name'])->where('id', '!=', $id)->count();
        if ($stadiumCount > 0) {
            return $this->basic_response(null, 'Stadium name is duplicate', 400, false);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images/stadiums', 'public');
                $uploadedImages[] = url('storage/' . $path);
            }
        }

        // Update the existing stadium with the new data
        $stadium->update($data);

        // If images were uploaded, update the images attribute
        if (!empty($uploadedImages)) {
            $stadium->images = $uploadedImages;
            $stadium->save();
        }

        return $this->basic_response(new StadiumResource($stadium), 'Stadium updated successfully', 200);
    }

    public function delete($id) 
    {
        $stadium = $this->findById($id);
        $stadium->delete();
        return $this->basic_response(null, 'Stadium deleted successfully', 200);
    }



}
