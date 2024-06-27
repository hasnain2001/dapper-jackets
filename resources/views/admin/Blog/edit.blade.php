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
                    <h1>Update Blog</h1>
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
            <form name="UpdateCategory" id="UpdateCategory" method="POST" enctype="multipart/form-data" action="{{ route('admin.Blog.update', $blog->id) }}">
                @csrf
            
                                <div class="form-group">
                                    <label for="title">Category Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title', $blog->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ old('slug', $blog->slug) }}" required>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category_image">Category Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control @error('category_image') is-invalid @enderror" name="category_image" id="category_image" value="{{ old('slug', $blog->category_image) }}">
                                    @error('category_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="content">Main Content <span class="text-danger">*</span></label>
                                    <textarea id="editor" name="content" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $blog->content) }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="meta_title">Meta Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" id="meta_title"  value="{{ $blog->meta_title }}">
                                @error('meta_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label for="meta_tag">Meta Tag <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('meta_tag') is-invalid @enderror" name="meta_tag" id="meta_tag" value="{{ old('meta_tag') }}">
                                @error('meta_tag')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}
                            <div class="form-group">
                                <label for="meta_keyword">Meta Keyword <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('meta_keyword') is-invalid @enderror" name="meta_keyword" id="meta_keyword"  value="{{ $blog->meta_keyword }}">
                                @error('meta_keyword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea name="meta_description" id="meta_description" class="form-control @error('meta_description') is-invalid @enderror" cols="30" rows="5" style="resize: none;">
                            {{ $blog->meta_description }}</textarea>
                                @error('meta_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-dark btn-lg btn-block">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <a href="{{ route('admin.blog') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            
        </div>
    </section>
</div>



@endsection