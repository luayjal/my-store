<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    @stack('css')
    <title>{{ config('app.name')}}</title>
</head>

<body>
    <header class="py-2 bg-dark text-white mb-4">
        <div class="container">
            <div class="d-flex">
                <h1 class="h3">{{ config('app.name') }}</h1>
                @auth
                <div class="ms-auto">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            Hi, {{Auth::user()->name}}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <button  class="dropdown-item" onclick="document.getElementById('logout').submit()">Logout</button>
                                <form id="logout" class="d-none" action="{{ route('logout') }}" method="post">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>

                </div>
                @endauth
            </div>

        </div>

    </header>
    <div class="container">
        <div class="row">
            <aside class="col-md-3">
                <h4>Navigation Menu</h4>
                <nav>
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item"><a href="{{route('dashboard')}}" class="nav-link">Dashboard</a></li>
                        <li class="nav-item"><a href="{{route('admin.categories.index')}}" class="nav-link @if(URL::current() == route('admin.categories.index')) active @endif">Categories</a></li>
                        <li class="nav-item"><a href="{{route('admin.products.index')}}" class="nav-link @if(URL::current()== route('admin.products.index')) active @endif">Products</a></li>

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
    @stack('js')

</body>

</html>