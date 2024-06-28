@extends('admin.datatable_master')
@section('datatable-title')
    Categories
@endsection
@section('main-content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Categories</h1>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Add New</a>
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <table id="datatable-buttons" class="table table-striped dt-responsive  w-100">
                                    <thead>
                                        <tr> <th scope="col">#</th>
                                            <th>Category Name</th>
                                            <th>Category Image</th>
                                            <th>Top Category</th>
                                            <th>Status</th>
                                            <th>Added</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr> <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $category->title }}</td>
                                                <td><img class="btn-circle"  src="{{ asset('uploads/categories/' . $category->category_image) }}"  style="max-width: 50px;"></td>
                                                <td>
                                                    @if ($category->authentication == "No Auth")
                                                        <i class="fa fa-fw fa-times-circle"></i>
                                                    @else
                                                        <i class="fa fa-fw fa-check-circle"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($category->status == "disable")
                                                        <i class="fa fa-fw fa-times-circle"></i>
                                                    @else
                                                        <i class="fa fa-fw fa-check-circle"></i>
                                                    @endif
                                                </td>
                                                <td>{{ $category->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-info btn-sm">Edit</a>
                                                    <a href="{{ route('admin.category.delete', $category->id) }}" onclick="return confirm('Are you sure you want to delete this!')" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th scope="col">#</th>
                                            <th>Category Name</th>
                                            <th>Category Image</th>
                                            <th>Top Category</th>
                                            <th>Status</th>
                                            <th>Added</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </section>

    </div>
@endsection
