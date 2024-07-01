<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::controller(HomeController::class)->group(function () {
    // Route::get('/', 'index');
    Route::get('/stores', 'stores')->name('stores');
    Route::get('/stores/{slug}', 'StoreDetails')->name('store_details');
    Route::get('/categories', 'categories')->name('categories');
    Route::get('/categories/{title}', 'viewcategory')->name('related_category');
    Route::get('/products', 'product')->name('product.home');
    Route::get('/blogs',  'blog_home')->name('blog');
Route::get('/blogs/{slug}',  'blog_show')->name('blog-details');
  
  
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::controller(ProductController::class)->prefix('dashboard')->group(function () {
    Route::get('/product', 'index')->name('admin.product');
    Route::get('/product/create', 'create')->name('admin.product.create');
    Route::post('/product/store', 'store')->name('admin.product.store');
    Route::get('/product/edit/{id}', 'edit')->name('admin.product.edit');
    Route::post('/product/update/{id}', 'update')->name('admin.product.update');
    Route::get('/product/delete/{id}', 'destroy')->name('admin.product.delete');
     Route::post('/product/deleteSelected', 'deleteSelected')->name('admin.product.deleteSelected');
});

// Categories Routes Begin
Route::controller(CategoriesController::class)->prefix('admin')->group(function () {
    Route::get('/category', 'category')->name('admin.category');
    Route::get('/category/create', 'create_category')->name('admin.category.create');
    Route::post('/category/store', 'store_category')->name('admin.category.store');
    Route::get('/category/edit/{id}', 'edit_category')->name('admin.category.edit');
    Route::post('/category/update/{id}', 'update_category')->name('admin.category.update');
    Route::get('/category/delete/{id}', 'delete_category')->name('admin.category.delete');
     Route::post('/category/deleteSelected', 'deleteSelected')->name('admin.category.deleteSelected');
});

Route::controller(BlogController::class)->prefix('dashboard')->group(function () {
  
   Route::get('/Blog', 'blogs')->name('admin.blog');
   Route::get('/Blog/create', 'create')->name('admin.blog.create');
   Route::post('/Blog/store', 'store')->name('admin.blog.store');
   Route::get('/Blog/{id}/edit',  'edit')->name('admin.blog.edit');
   Route::post('/admin/Blog/update/{id}', 'update')->name('admin.Blog.update');
   Route::delete('/admin/Blog/{id}',  'destroy')->name('admin.blog.delete');
   Route::post('/blog/deleteSelected',  'deleteSelected')->name('admin.blog.deleteSelected');
   Route::delete('/blog/bulk-delete',  'deleteSelected')->name('admin.blog.bulkDelete');
   Route::delete('/blog/bulk-delete', 'deleteSelected')->name('admin.blog.bulkDelete');

   // Route for blog page



});


require __DIR__.'/auth.php';
