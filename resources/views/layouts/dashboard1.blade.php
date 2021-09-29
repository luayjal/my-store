<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
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
                   <div class="d-flex">
                    <div class="dropdown mx-2">
                        <a class="btn btn-notification" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            @if (isset($unreadnotifications))
                            <p class="unreadnumber">{{$unreadnotifications}}</p>
                            @endif
                        </a>
                      
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <div class="menu-notification">
                          <li id="dropdownItem"></li>
                          @foreach($notifications as $notification)
                         
                          <li>
                              <div class="container-notfiy">
                                <a class="dropdown-item @if(empty($notification->read_at)) unread @endif"  href='#'>{{$notification->data['title']}}
                                    <p class="dropdown-item @if(empty($notification->read_at)) unread @endif">{{Str::limit($notification->data['body'],20, '...')}}</p>
                                </a>
                                @if(empty($notification->read_at))
                                <form class="markread " action="{{route('admin.mark.read')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$notification->id}}">
                                    <button class="btn btn-mark-read" type="submit"><i class="fas fa-check-double"></i></button>
                                </form>
                                @endif
                                @if(!empty($notification->read_at))
                                <div class="mark-read">
                                    <i class="fas fa-check-double"></i>
                                </div>
                                
                                @endif
                            </div>
                            <hr>
                              
                            </li>
                          @endforeach
                        </div>
                          <div class="see-all">
                            <a class='dropdown-item' id="dropdownItem" href=''>see all notifications</a>
                          </div>
                           
 
                              
                           
                        </ul>
                      </div>

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
                            <li>
                               
                            </li>
                        </ul>
                    </div>
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
    <script src="{{asset('js/all.min.js')}}"></script>
    @stack('js')
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
  
      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;
  
      var pusher = new Pusher('21b03d1027d80d4a8663', {
        cluster: 'ap2',
        authEndpoint: '/broadcasting/auth',
      });
  
      var channel = pusher.subscribe('private-App.Models.User.{{Auth::id()}}');
      channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
        var x= 1;
        //  var notify =  document.getElementById("dropdownItem");
         /* document.getElementById("dropdownItem").innerHTML =(data.title); 
         document.getElementById("dropdownItem").href=(data.action); 
          */
     
         let menu =  document.getElementById("dropdownItem");

        // create new li element
        let a = document.createElement('a');
        a.className = "dropdown-item unread";
        a.textContent = (data.title);
        a.href=(data.action)
        // add it to the ul element
        menu.appendChild(li);

        console.log(menu.innerHTML);
        /* document.getElementById("dropdownItem").insertAdjacentHTML("beforeend","<a class='dropdown-item'  href='data.link'>data.title</a>") ; */
        
       /*  alert(data.title); */
        /* #vdfbj.innerHtml(data.title); */
      });
    </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</body>

</html>