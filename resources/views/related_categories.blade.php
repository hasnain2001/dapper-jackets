
<?php
header("X-Robots-Tag:index, follow");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
       
       @foreach($categories as $category)
       <title>{!! $category->title !!}</title>
       <link rel="canonical" href="https://budgetheaven.com/related_category/{{ Str::slug($category->title) }}">
   
       <!-- Your custom meta tags go here -->
       <meta name="description" content="{!! $category->meta_description !!}">
       <meta name="keywords" content="{!! $category->meta_keyword !!}">
   @endforeach

  <meta name="author" content="John Doe">
 <meta name="robots" content="index, follow">
 <link rel="icon" href="{{ asset('images/icons.png') }}" type="image/x-icon">
<link rel="canonical" href="https://deals69.com/categories">
<link rel="stylesheet" href="{{ asset('bootstrap-4.6.2-dist/css/bootstrap.min.css') }}">
<style>
    .body{
background-color:#fff;
}
.container {
max-width: 1200px;
margin: auto;
padding: 20px;
}

.bg-light {
background-color: #f8f9fa;
}

.card-list {
display: flex;
flex-wrap: wrap;
justify-content: space-around;
align-items: center;
}

.card-list a {
text-decoration: none;
color: inherit;
width: 100%;
max-width: 200px;
margin-bottom: 20px;
padding: 10px;
border-radius: 5px;

transition: all 0.3s ease;
}

.card-list a:hover {
box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.stores {
width: 100%;
height: auto;
border-radius: 10%;
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
transition: transform 0.3s ease;
}
.stores:hover {
transform: scale(1.05);
}
.card-title {
text-align: center;
margin-top: 10px;
font-size: 1.2rem;
font-weight: bold;
}

@media (min-width: 768px) {
.card-list {
    justify-content: flex-start;
}

.card-list a {
    width: calc(25% - 20px);
    margin-right: 20px;
    margin-bottom: 20px;
}

.card-list a:nth-child(4n) {
    margin-right: 0;
}
}</style>
</head>
<body>

  
    <div class="container">
        <h1 class="text-center">{{ $name }}</h1>
    
    </div>
     
    
    
        <div class="container">
            <div class="card-list ">
                @foreach ($product as $store)
    
                <a href="{{ route('product_details', ['slug' => Str::slug($store->slug)]) }}" class="text-decoration-none">
                    @php
                    $images = json_decode($store->productimage);
                @endphp
                @if(is_array($images) && !empty($images))
                    <img src="{{ asset($images[0]) }}" alt="Product Image" class="stores shadow">
                @else
                    <img src="{{ asset('front/assets/images/no-image-found.jpg') }}" alt="No Image" style="max-width: 100%;" class="stores shadow rounded-circle">
                @endif
                  
                        <h5 class="card-title mt-3 mx-2">{{ $store->name ?: "Title not found" }}</h5>
                 
                </a>
                @endforeach
            </div>
        </div>
       
    
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

     
</body>
</html>