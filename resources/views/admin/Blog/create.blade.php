@extends('admin.datatable_master')
@section('title')
  Create Blog
@endsection
@section('main-content')
   
    <div class="content-wrapper">
    <div class="container justify-content">
        <!-- Blog Form -->
        <form method="POST" action="{{ route('admin.blog.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
           @if (session()->has('success'))
    <div class="alert alert-primary d-flex align-items-center" role="alert">
      
        <div>
            blog created successfully
        </div>
    </div>
@endif


                        <!-- Display validation errors here -->
                        @if ($errors->any())
                        <div  class="alert alert-danger" >
                            <strong>Validation error(s):</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" />
                        </div>
                        
                        <div class="form-group">
                            <label for="title">slug</label>
                            <input type="text" class="form-control" name="slug" id="slug" />
                        </div>
                        <div class="form-group">
                            <label for="category_image">Blog Image</label>
                            <input type="file" class="form-control" name="category_image" id="category_image" />
                        </div>
                        <div class="form-group">
                            <label for="category_image">Main Content</label>
                            <textarea id="editor" name="content"></textarea>
                        </div>
                      
                    </div>
                    
                </div>
                     <div class="form-group">
                                    <label for="name">Meta Title<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="meta_title" id="meta_title" >
                                </div>
                                {{-- <div class="form-group">
                                    <label for="meta_tag">Meta Tag <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="meta_tag" id="meta_tag">
                                </div> --}}
                                <div class="form-group">
                                    <label for="meta_keyword">Meta Keyword <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="meta_keyword" id="meta_keyword">
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" class="form-control" cols="30" rows="5" style="resize: none;"></textarea>
                                </div>  
                                <button type="submit" class="btn btn-dark btn-lg btn-block">Submit</button>
                            </div>
                        </div>
            </div>    </div>    </div>
        </form>
    </div>
</div>

     
@endsection