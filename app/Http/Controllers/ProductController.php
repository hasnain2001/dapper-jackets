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
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'required|string|max:10000',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
           
             'sizes' => 'required|string|max:255',
            'categories' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'meta_tag' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'productimage.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        $images = [];
        if ($files = $request->file('productimage')) {
            foreach ($files as $file) {
                $image_name = md5(rand(1000, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $upload_path = 'uploads/product/';
                $image_url = $upload_path . $image_full_name;
                $file->move($upload_path, $image_full_name);
                $images[] = $image_url;
            }
        }
    
        Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'sizes' => $request->sizes,
            'categories' => $request->categories,
            'title' => $request->title,
            'meta_tag' => $request->meta_tag,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'status' => $request->status,
            'authentication' => $request->authentication ?? "No Auth",
            'productimage' => json_encode($images),
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
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $id,
            'description' => 'required|string|max:10000',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'sizes' => 'required|string|max:255',
            'categories' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'meta_tag' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'productimage.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        $product = Product::findOrFail($id);
    
        // Handle product image updates
        $images = json_decode($product->productimage, true) ?: [];
    
        if ($files = $request->file('productimage')) {
            foreach ($files as $file) {
                $image_name = md5(rand(1000, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $upload_path = 'uploads/product/';
                $image_url = $upload_path . $image_full_name;
                $file->move($upload_path, $image_full_name);
                $images[] = $image_url;
            }
        }
    
        // Update product details
        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'sizes' => $request->sizes,
            'categories' => $request->categories,
            'title' => $request->title,
            'meta_tag' => $request->meta_tag,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'status' => $request->status,
            'authentication' => $request->authentication ?? "No Auth",
            'productimage' => json_encode($images),
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
            // Debug: Check the product IDs to be deleted
            dd($productIds);
    
            // Delete only the products
            Product::whereIn('id', $productIds)->delete();
    
            return redirect()->back()->with('success', 'Selected products deleted successfully');
        } else {
            return redirect()->back()->with('error', 'No products selected for deletion');
        }
    }
    
    

}
