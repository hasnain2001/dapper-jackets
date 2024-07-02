@extends('admin.datatable_master')
@section('title')
    Update
@endsection
@section('main-content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Product</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissable">
                    <i class="fa fa-ban"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <b>{{ session('success') }}</b>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form name="UpdateStore" id="UpdateStore" method="POST" enctype="multipart/form-data" action="{{ route('admin.product.update', $product->id) }}">
                @csrf
                @method('POST')
                <div class="row">
                    <!-- Section 1: Basic Information -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Product Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug:</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $product->slug) }}" required>
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" required>
                            @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sizes">Sizes:</label>
                            <input type="text" class="form-control" id="sizes" name="sizes" value="{{ old('sizes', $product->sizes) }}">
                            @error('sizes')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
            
                    <!-- Section 2: Category and Meta Information -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category">Category <span class="text-danger">*</span></label>
                            <select name="categories" id="category" class="form-control" required>
                                <option value="" disabled selected>--Select Category--</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->slug }}" {{ old('categories', $product->categories) == $category->slug ? 'selected' : '' }}>{{ $category->slug }}</option>
                                @endforeach
                            </select>
                            @error('categories')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Meta Title:</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $product->title) }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="meta_tag">Meta Tag:</label>
                            <input type="text" class="form-control" id="meta_tag" name="meta_tag" value="{{ old('meta_tag', $product->meta_tag) }}">
                            @error('meta_tag')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="meta_keyword">Meta Keyword:</label>
                            <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ old('meta_keyword', $product->meta_keyword) }}">
                            @error('meta_keyword')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="meta_description">Meta Description:</label>
                            <textarea class="form-control" id="meta_description" name="meta_description">{{ old('meta_description', $product->meta_description) }}</textarea>
                            @error('meta_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
            
                    <!-- Section 3: Status and Images -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label><br>
                            <input type="radio" name="status" id="enable" {{ $product->status == 'enable' ? 'checked' : '' }} value="enable">&nbsp;<label for="enable">Enable</label>
                            <input type="radio" name="status" id="disable" {{ $product->status == 'disable' ? 'checked' : '' }} value="disable">&nbsp;<label for="disable">Disable</label>

                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="authentication">Authentication</label><br>
                            <input type="checkbox" name="authentication" id="authentication" {{ $product->authentication == 'top_stores' ? 'checked' : '' }} value="top_stores">&nbsp;<label for="authentication">Top Store</label>
                            
                            @error('authentication')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="productimage">Product Images:</label>
                            <input type="file" class="form-control" id="productimage" name="productimage[]" multiple onchange="previewImages(event)">
                            <div id="imagePreviews" style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 10px;">
                                @if($product->productimage)
                                    @foreach (json_decode($product->productimage) as $image)
                                        <div style="position: relative;">
                                            <img src="{{ asset($image) }}" alt="Product Image" style="max-width: 60px;">
                                            <input type="hidden" name="current_productimage[]" value="{{ $image }}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            @error('productimage')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
            
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.product') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
                    </div>
    </section>
</div>
@endsection
