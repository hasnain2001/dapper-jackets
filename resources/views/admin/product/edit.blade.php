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
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name"> Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $product->name) }}" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <textarea name="slug" id="slug" class="form-control" style="resize: none;" required>{{ old('slug', $product->slug) }}</textarea>
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                   
                             <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
                             @error('description')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price">Price <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="price" value="{{ old('price', $product->price) }}" step="0.01" required>
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control" name="quantity" value="{{ old('quantity', $product->quantity) }}">
                                    @error('quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="color">Color</label>
                                    <input type="color" class="form-control" name="color" value="{{ old('color', $product->color) }}">
                                    @error('color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category">Category <span class="text-danger">*</span></label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="" disabled selected>{{ $product->category }}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->slug }}" {{ old('category', $product->category) == $category->slug ? 'selected' : '' }}>{{ $category->slug }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="title">Meta Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $product->title) }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="meta_tag">Meta Tag <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="meta_tag" id="meta_tag" value="{{ old('meta_tag', $product->meta_tag) }}">
                                    @error('meta_tag')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="meta_keyword">Meta Keyword <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" value="{{ old('meta_keyword', $product->meta_keyword) }}">
                                    @error('meta_keyword')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" class="form-control" cols="10" rows="2" style="resize: none;">{{ old('meta_description', $product->meta_description) }}</textarea>
                                    @error('meta_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label><br>
                                    <input type="checkbox" name="status" id="status" value="1" {{ old('status', $product->status) ? 'checked' : '' }}>
                                    <label for="status">Enable</label>
                                    <br>
                                    <input type="hidden" name="status" value="0"> <!-- Ensure there's a hidden input with value 0 for unchecked state -->
                                    <label for="status">Disable</label>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="product_image">Product Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="productimage[]" id="product_image" multiple>
                                
                                    @if($product->product_image)
                                        @foreach ($product as $image)
                                            <input type="hidden" name="current_product_image[]" value="{{ $image }}">
                                            <img src="{{ asset($image) }}" alt="Product Image" style="max-width: 60px;" class="stores shadow rounded-circle">
                                        @endforeach
                                    @else
                                        <img src="{{ asset('front/assets/images/no-image-found.jpg') }}" alt="No Image" style="max-width: 60px;" class="stores shadow rounded-circle">
                                        <input type="hidden" name="current_product_image[]" value="">
                                    @endif
                                
                                    @error('product_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('admin.product') }}" class="btn btn-secondary">Cancel</a>
                        <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Add New</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
