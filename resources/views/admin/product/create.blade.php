@extends('admin.datatable_master')
@section('title')
    Create
@endsection
<style>
   
</style>
@section('main-content')
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
            <form name="CreateStore" id="CreateStore" method="POST" enctype="multipart/form-data" action="{{ route('admin.store.store') }}">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name"> Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="slug" id="name" required>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control"></textarea>
                                </div> --}}
                              
                                <div class="form-group">
                                    <label form="price">Price   <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="price"  step="0.01" required>
                                </div>
                               
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control" name="quantity" value="{{ old('quantity', $product->quantity ?? '') }}">
                                </div>
                                <div class="form-group">
                                    <label>Color</label>
                                    <input type="color"  class="form-control" name="color[]" value="{{ old('color', $product->color ?? '') }}" placeholder="#000000">
                                </div>
                             
                                <div class="form-group">
                                   
                                   <div class="form-group">
    <label for="category">Category <span class="text-danger">*</span></label>
    <select name="categories" id="category" class="form-control">
        <option value="" disabled selected>--Select Category--</option>
        @foreach($categories as $category) 
            <option value="{{ $category->slug }}">{{ $category->slug }}</option>
        @endforeach
    </select>
</div>

                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                           <div class="form-group">
    <label for="status">Status <span class="text-danger">*</span></label><br>
    <input type="radio" name="status" id="enable" value="enable" required>&nbsp;<label for="enable">Enable</label>
    <input type="radio" name="status" id="disable" value="disable">&nbsp;<label for="disable">Disable</label>
</div>

                          
                          
<div class="form-group">
    <label for="productimage">Product Images:</label>
    <input type="file" class="form-control-file" id="productimage" name="productimage[]" multiple>
</div>

                                <div class="form-group">
                                    <label for="name">Meta Title<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="name" >
                                </div>
                                <div class="form-group">
                                    <label for="meta_tag">Meta Tag <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="meta_tag" id="meta_tag">
                                </div>
                                <div class="form-group">
                                    <label for="meta_keyword">Meta Keyword <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="meta_keyword" id="meta_keyword">
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" class="form-control" cols="50" rows="2" style="resize: none;"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg">Save</button>
                                    <a href="{{ route('admin.product') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
             
                </div>
            </form>
        </div>
    </section>
</div>
@endsection