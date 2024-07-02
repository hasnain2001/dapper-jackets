<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('cssfile/productdetail.css') }}">
    <style>
    
    </style>
    
</head>
<body>
    <x-navbar/>
<!-- Product Section -->
<div class="container mt-4">
    @if ($product)
        <div class="wrapper">
            <div class="product-box">
                <div class="all-images">
                    <div class="small-images">
                        @php
                        $images = json_decode($product->productimage, true);
                        @endphp
                        @if (is_array($images) && count($images) > 0)
                            @foreach ($images as $image)
                                <img src="{{ asset($image) }}" onclick="clickimg(this)" width="300px">
                            @endforeach
                        @else
                            <p class="no-images">No images available.</p>
                        @endif
                    </div>
                    <div class="main-images">
                        @if (is_array($images) && count($images) > 0)
                            <img src="{{ asset($images[0]) }}" alt="{{ $product->name }}" width="300px" id="imagebox">
                        @else
                            <img src="default-image.jpg" alt="No Image" width="300px" id="imagebox">
                        @endif
                    </div>
                </div>
            </div>

            <div class="text">
                <div class="content">
                    <span class="brand">{{ $product->brand ?? 'Brand Name' }}</span>
                    <h2>{{ $product->name }}</h2>
                    <div class="review"></div>
                    <span>{{ $product->description }}</span>
                </div>
                <div class="price-box">
                    <p class="price">${{ $product->price }}</p>
                  
                </div>
            <p>Size:{{ $product->sizes }}</p>
             
            <p>
                Quantity Left:
                @if ($product->quantity < 10)
                    <span class="low-stock">{{ $product->quantity }} (Low Stock)</span>
                @else
                    {{ $product->quantity }}
                @endif
            </p>
                <button><span class="fa fa-shopping-cart"></span> Add to Cart</button>
                <button class="buy"><span class="fa fa-shopping-cart"></span> Buy Now</button>
            </div>
        </div>
    @else
        <p class="text-center mt-4">No product found.</p>
    @endif

</div>

<script>
    function clickimg(smallimg){
        var fullimg=document.getElementById("imagebox")
        fullimg. src = smallimg.src
    }

</script>
</body>
</html>