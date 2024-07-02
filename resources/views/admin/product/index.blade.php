@extends('admin.datatable_master')
@section('datatable-title')
    create
@endsection
@section('main-content')

                <div class="content-wrapper">

                    <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1>product</h1>
                                </div>
                                <div class="col-sm-6 d-flex justify-content-end">
                                    <a href="{{ route('admin.product.create') }}" class="btn btn-primary"> Add New </a>
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
                      <form id="bulk-delete-form" action="{{ route('admin.product.deleteSelected') }}" method="POST">
    @csrf
    <div class="table-responsive">
       
        <table id="datatable-buttons" class="table table-centered mb-0">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th scope="col">#</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>category</th>
                    <th>Status</th>
                    
                    <th>Sizes</th>

                    <th>Added</th>
                    <th>updated</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($products) > 0)
                    @foreach ($products as $product)
                        <tr class="product-row">  <td>
                                <input type="checkbox" name="selected_stores[]" value="{{ $product->id }}" class="product-checkbox">  </td>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td class="product-name">
                                {{ $product->name }}
                            </td>
                            <td class="product-images">
                                @php
                                    $images = json_decode($product->productimage, true);
                                @endphp
                                @if (is_array($images))
                                    @foreach ($images as $image)
                                        <img src="{{ asset($image) }}" alt="{{ $product->name }}" class="product-image" style="width: 100px; height: auto;">
                                    @endforeach
                                @else
                                    <p class="no-images">No images available.</p>
                                @endif
                            </td>
                            <td class="product-categories">
                                {{ $product->categories }}
                            </td>
                            <td class="product-status">
                                @if ($product->status == "disable")
                                    <i class="fas fa-times-circle text-danger"></i>
                                @else
                                    <i class="fas fa-check-circle text-success"></i>
                                @endif
                            </td>
                        
                            
                            
                            <td class="product-sizes">
                        {{  $product->sizes }}
                            </td>
                            
                            <td class="product-created-at">
                                {{ $product->created_at }}
                            </td>
                            <td class="product-updated-at">
                                {{ $product->updated_at }}
                            </td>
                            <td class="product-actions">
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-info btn-sm product-edit-btn">Edit</a>  <a href="{{ route('admin.product.delete', $product->id) }}" onclick="return confirm('Are you sure you want to delete this!')" class="btn btn-danger btn-sm product-delete-btn">Delete</a> </td>
                        </tr>
                    @endforeach
                @else
                    <p class="no-products">No products available.</p>
                @endif
            </tbody>
            
            
            <tfoot>
                <tr>
                    <th scope="col">#</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>category</th>
                    <th>Status</th>
                 
                    <th>Sizes</th>
                    <th>Added</th>
                    <th>updated</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete the selected stores and their coupons?')">Delete Selected</button>
</form>


                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </section>

    </div>
    
    
<script>
    // JavaScript to handle the select all functionality
    document.getElementById('select-all').addEventListener('click', function(event) {
        let checkboxes = document.querySelectorAll('input[name="selected_stores[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = event.target.checked;
        });
    });

    document.getElementById('select-all-footer').addEventListener('click', function(event) {
        let checkboxes = document.querySelectorAll('input[name="selected_stores[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = event.target.checked;
        });
    });
</script>
@endsection