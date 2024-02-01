<?php

namespace App\Http\Controllers;

use App\Http\Resources\StadiumCategoryCollection;
use App\Http\Resources\StadiumCategoryResource;
use App\Models\StadiumCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StadiumCategoryController extends Controller
{
    use Helper;

    private function findCategoryById($id)
    {
        $category = StadiumCategory::find($id);

        if (!$category) {
            return $this->basic_response(null, 'Not found', 404);
        }

        return $category;
    }

    public function index()
    {
        $categories = StadiumCategory::all();
        return $this->basic_response(
             new StadiumCategoryCollection($categories),
            'Success get all categories',
             200,
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request['logo']->store('images', 'public');
        $fullLogoUrl = url('storage/' . $path);

        StadiumCategory::create([
            'name' => $request['name'],
            'logo' => $fullLogoUrl,
        ]);

        return $this->basic_response(
             null,
            'Category created successfully',
             201,
        );
    }

    public function show($id)
    {
        $category = $this->findCategoryById($id);

        if ($category instanceof \Illuminate\Http\Response) {
            return $category;
        }

        return $this->basic_response(
             new StadiumCategoryResource($category),
            'Success get category',
             200,
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = $this->findCategoryById($id);

        if ($category instanceof \Illuminate\Http\Response) {
            return $category;
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $fullLogoUrl = url('storage/' . $path);

            $category->update(['logo' => $fullLogoUrl]);
        }

        $category->update(['name' => $request['name']]);

        return $this->basic_response(
            null,
            'Category updated successfully',
           200,
        );
    }

    public function destroy($id)
    {
        $category = $this->findCategoryById($id);

        if ($category instanceof \Illuminate\Http\Response) {
            return $category;
        }

        $category->delete();

        return $this->basic_response(
             null,
            'Category deleted successfully',
           200,
        );
    }
}
