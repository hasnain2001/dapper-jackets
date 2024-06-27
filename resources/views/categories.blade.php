<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <main>
        <br>
                <h1 class="text-center">Categories</h1>
          
         
                <main class="main_content">
                    <div class="container">
                        <div class="row">
                            @foreach ($categories as $category)
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <div class="card shadow p-3 category-card">
                                    <div class="card-body">
                                        <a href="{{ route('related_category', ['title' => Str::slug($category->title)]) }}" class="text-decoration-none">
                                            @if ($category->category_image)
                                            <img class="rounded-circle" src="{{ asset('uploads/categories/' . $category->category_image) }}" alt="{{ $category->title }} Image">
                                            @else
                                            <p>No image available</p>
                                            @endif
                                            <p class="card-title mt-3 mx-2">{{ $category->slug }}</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </main>
        
</body>
</html>