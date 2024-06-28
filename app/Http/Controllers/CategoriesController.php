<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Product;

class CategoriesController extends Controller
{
    public function category() {
        $categories = Categories::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create_category() {
        return view('admin.categories.create');
    }

    public function store_category(Request $request) {
        if (request()->File('category_image'))
        {
            $file = request()->File('category_image');
            $CategoryImage = md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $file->move('./uploads/categories', $CategoryImage);
        }

        Categories::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'meta_tag' => $request->meta_tag,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'status' => $request->status,
            'authentication' => isset($request->authentication) ? $request->authentication : "No Auth",
            'category_image' => isset($CategoryImage) ? $CategoryImage : "No Category Image",
        ]);

        return redirect()->back()->with('success', 'Category Created Successfully');
    }
    
    public function edit_category($id) {
        $categories = Categories::find($id);
        return view('admin.categories.edit', compact('categories'));
    }

    public function update_category(Request $request, $id) {
        $categories = Categories::find($id);

        if (request()->File('category_image'))
        {
            $file = request()->File('category_image');
            $CategoryImage = md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $file->move('./uploads/categories', $CategoryImage);
        }

        $categories->update([
            'title' => $request->title,
            'slug'=> $request->slug,
            'meta_tag' => $request->meta_tag,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'status' => $request->status,
            'authentication' => isset($request->authentication) ? $request->authentication : "No Auth",
            'category_image' => isset($CategoryImage) ? $CategoryImage : "No Category Image",
        ]);

        return redirect()->back()->with('success', 'Category Updated Successfully');
    }

    public function delete_category($id) {
        Categories::find($id)->delete();
        return redirect()->back()->with('success', 'Category Deleted Successfully');
    }
    
    
public function deleteSelected(Request $request)
{
    $categoryIds = $request->input('selected_categories');

    if ($categoryIds) {
        Categories::whereIn('id', $categoryIds)->delete();
        return redirect()->back()->with('success', 'Selected categories deleted successfully');
    } else {
        return redirect()->back()->with('error', 'No categories selected for deletion');
    }
}



}
