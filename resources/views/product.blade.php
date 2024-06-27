<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .card-header {
            text-align: center;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .card-text {
            margin-bottom: 0.5rem;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
    
</head>
<body>
    <p class="h5 m-0">Total stores: <span class="fw-bold">{{ $products->total() }}</span></p>
    <div class="container">
        <div class="row">
            @foreach ($products as $product)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        @php
                        $images = json_decode($product->product_image);
                    @endphp
                    
                    @if(is_array($images) && !empty($images))
                        <img src="{{ asset($images[0]) }}" alt="Product Image" style="max-width: 80px;" class="stores shadow ">
                    @else
                        <img src="{{ asset('front/assets/images/no-image-found.jpg') }}" alt="No Image" style="max-width: 600px;" class="stores shadow rounded-circle">
                    @endif
                    
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                   
                        <p class="card-text"><strong>Price:</strong> ${{ $product->price }}</p>
                        <p class="card-text"><strong>Quantity:</strong> {{ $product->quantity }}</p>
                        <a href="#" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="container bg-light mt-3">
        <div class="row mt-3 justify-content-end">
          <div class="col-12">
            {{ $products->links('pagination::bootstrap-4') }} </div>
        </div>
      </div>
</body>
</html>