<?php

namespace App\Http\Controllers;

use App\Http\Requests\StadiumCreateRequest;
use App\Http\Resources\StadiumCollection;
use App\Http\Resources\StadiumResource;
use App\Models\Stadium;
use App\Models\StadiumCategory;

class StadiumController extends Controller
{
    use Helper;

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

    public function getAll()
    {
        $stadiums = Stadium::all();
        return $this->basic_response(new StadiumCollection($stadiums), 'Success get all stadium');
    }
}
