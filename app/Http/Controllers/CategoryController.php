<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'image' => 'file|mimes:png,jpg,jpeg',
        ]);

        $data = [
            'name' => $request->name,
            'image' => $request->image,
            'slug' => Str::random()
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = date('Y-m-d H:i') . $file->getClientOriginalName();

            if ($file->move(public_path('/uploads/images/'), $fileName)) {

                $data['image'] = ('/uploads/images/' . $fileName);
            } else {

                return 'Something wrond with image storing';
            }
        }
        // dd($data);

        if (Category::create($data)) {

            return response()->json(['msg' => 'Category created successfully.', 'success' => true], 201);
        } else {

            return response()->json(['msg' => 'Something went wrong.', 'success' => false]);
        }
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'image' => 'string',
        ]);
        // dd($request->all());
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = date('Y-m-d H:i') . $file->getClientOriginalName();

            if ($file->move(public_path('/uploads/images/'), $fileName)) {

                $data['image'] = public_path('/uploads/images/' . $fileName);
            } else {

                return 'Something wrond with image storing';
            }
        }

        $category = Category::where('slug', $request->slug)->first();

        if ($category->update($request->all())) {

            return response()->json(['msg' => 'Category updated successfully.', 'success' => true], 200);
        } else {

            return response()->json(['msg' => 'Something went wrong.', 'success' => false]);
        }
    }
}
