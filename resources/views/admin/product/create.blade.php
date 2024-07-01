@extends('admin.datatable_master')
@section('title')
    Create Product
@endsection
<style>
    .form-group {
        margin-bottom: 1rem;
    }
</style>
@section('main-content')
<div class="container">
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Create Product</h5>
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
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Section 1: Basic Information -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Product Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug:</label>
                            <input type="text" class="form-control" id="slug" name="slug" required>
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                            @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Category <span class="text-danger">*</span></label>
                            <select name="categories" id="category" class="form-control">
                                <option value="" disabled selected>--Select Category--</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->slug }}">{{ $category->slug }}</option>
                                @endforeach
                            </select>
                            @error('categories')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                       
                  
                    </div>
            
                    
                    <div class="col-md-4">
                  
                        <div class="form-group">
                            <label for="sizes">Sizes:</label>
                            <input type="text" class="form-control" id="sizes" name="sizes[]" placeholder="Enter size">
                            <input type="text" class="form-control mt-2" name="sizes[]" placeholder="Enter size">
                            <input type="text" class="form-control mt-2" name="sizes[]" placeholder="Enter size">
                            @error('sizes')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Meta Title:</label>
                            <input type="text" class="form-control" id="title" name="title">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="meta_tag">Meta Tag:</label>
                            <input type="text" class="form-control" id="meta_tag" name="meta_tag">
                            @error('meta_tag')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="meta_keyword">Meta Keyword:</label>
                            <input type="text" class="form-control" id="meta_keyword" name="meta_keyword">
                            @error('meta_keyword')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="meta_description">Meta Description:</label>
                            <textarea class="form-control" id="meta_description" name="meta_description"></textarea>
                            @error('meta_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label><br>
                            <input type="radio" name="status" id="enable" value="enable" required>&nbsp;<label for="enable">Enable</label>
                            <input type="radio" name="status" id="disable" value="disable">&nbsp;<label for="disable">Disable</label>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    
                     
                    </div>
            
                    <!-- Section 3: Status and Images -->
                    <div class="col-md-4">

                        <div class="form-group">
                            <label for="authentication">Authentication</label><br>
                            <input type="checkbox" name="authentication" id="authentication" value="top_stores">&nbsp;<label for="authentication">Top Store</label>
                        </div>
                        <div class="form-group">
                            <label for="colors">Colors:</label>
                            <input type="color" class="form-control" id="colors" name="color[]" placeholder="Enter color">
                            <input type="color" class="form-control mt-2" name="color[]" placeholder="Enter color">
                            <input type="color" class="form-control mt-2" name="color[]" placeholder="Enter color">
                            @error('colors')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="productimage">Product Images:</label>
                            <input type="file" class="form-control" id="productimage" name="productimage[]" multiple required onchange="previewImages(event)">
                            <div id="imagePreviews" style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 10px;"></div>
                        </div>
                        
                        <script>
                            function previewImages(event) {
                                const files = event.target.files;
                                const previewsContainer = document.getElementById('imagePreviews');
                                previewsContainer.innerHTML = ''; // Clear previous previews
                        
                                Array.from(files).forEach(file => {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        const img = document.createElement('img');
                                        img.src = e.target.result;
                                        img.style.maxWidth = '100px';
                                        img.style.marginTop = '10px';
                                        previewsContainer.appendChild(img);
                                    };
                                    reader.readAsDataURL(file);
                                });
                            }
                        </script>
                        
                    
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('admin.product') }}" class="btn btn-secondary">
                               Cancel</a>

                        </form>
            
            
        </div>
    </section>


</div></div>


@endsection
