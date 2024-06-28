<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
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