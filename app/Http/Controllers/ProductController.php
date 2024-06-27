<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product_blog() {
        
        $productsByCategory = Product::select('category', Product::raw('count(*) as total'))
            ->groupBy('category')
            ->get();

        return view('blog', compact('productsByCategory'));
    }

    public function index() {
        $products = Product::all();

        return view('admin.product.index', compact('products'));
    }
    public function product_home() {
        $products = Product::all();

        return view('product', compact('products'));
    }

    public function create() {
        $categories = Categories::all();
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
    
  
       
        $productImages = [];
        
        if($request->hasFile('images')) {
            foreach($request->file('images') as $file) {
                $image_name = md5(rand(1000, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $upload_path = 'uploads/product/';
                $file->move($upload_path, $image_full_name);
                $productImages[] = $upload_path . $image_full_name;
            }
        }
    
        Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'color' => $request->color,
            'categories' => $request->categories,
              'size' => $request->size,
            'title' => $request->title,
            'meta_tag' => $request->meta_tag,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'status' => $request->status,
            'authentication' => $request->authentication ?? "No Auth",
            'product_image' => json_encode($productImages) ?? json_encode(["No Product Image"]),
        ]);
    
        return redirect()->back()->with('success', 'Product Created Successfully');
    }
    
    
    public function edit($id) {
        $product = Product::find($id);
        $categories = Categories::all();

        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'color' => 'required|string',
            'categories' => 'nullable|string',
            'size' => 'nullable|string',
            'title' => 'nullable|string|max:255',
            'meta_tag' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'status' => 'nullable|boolean',
            'authentication' => 'nullable|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $product = Product::find($id);
    
        $productImages = json_decode($product->product_image, true) ?? [];
    
if ($request->hasFile('images')) {
    foreach ($request->file('images') as $file) {
        $image_name = md5(rand(1000, 10000));
        $ext = strtolower($file->getClientOriginalExtension());
        $image_full_name = $image_name . '.' . $ext;
        $upload_path = 'uploads/product/';
        $file->move($upload_path, $image_full_name);
        $productImages[] = $upload_path . $image_full_name;
    }
}
    
        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'color' => $request->color,
            'categories' => $request->categories,
            'size' => $request->size,
            'title' => $request->title,
            'meta_tag' => $request->meta_tag,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'status' => $request->status,
            'authentication' => $request->authentication ?? "No Auth",
            'product_image' => json_encode($productImages),
        ]);
    
        return redirect()->back()->with('success', 'Product Updated Successfully');
    }
    
    public function destroy($id) {
        Product::find($id)->delete();
        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }

    public function deleteSelected(Request $request) {
        $productIds = $request->input('selected_products');

        if ($productIds) {
            // Delete only the products
            Product::whereIn('id', $productIds)->delete();

            return redirect()->back()->with('success', 'Selected products deleted successfully');
        } else {
            return redirect()->back()->with('error', 'No products selected for deletion');
        }
    }

}
