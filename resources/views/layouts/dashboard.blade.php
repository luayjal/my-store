<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <title>Document</title>
</head>

<body>
    <header class="py-2 bg-dark text-white mb-4">
        <div class="container">
            <h1 class="h3">{{ config('app.name') }}</h1>
            @auth
            <div class="ms-auto">
            Hi, {{Auth::user()->name}}
            </div>
            @endauth
        </div>
       
    </header>
    <div class="container">
        <div class="row">
            <aside class="col-md-3">
                <h4>Navigation Menu</h4>
                <nav>
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item"><a href="" class="nav-link">Dashboard</a></li>
                        <li class="nav-item"><a href="{{route('admin.categories.index')}}" class="nav-link active">Categories</a></li>
                        <li class="nav-item"><a href="{{route('admin.products.index')}}" class="nav-link">Products</a></li>
                    </ul>
                </nav>
            </aside>
            <main class="col-md-9">
                <h2 class="text-center mb-4 mt-4">{{$title}}</h2>
                {{$slot}}
            </main>
        </div>
    </div>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>