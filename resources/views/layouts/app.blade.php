<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>    
        <link href="/css/app.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),]); ?>
        </script>
        @yield('style')
    </head>
    <body>
        <div class='container' id="app">
            <nav class="nav nav-justified navbar  navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">                       
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>                            
                    </div>
                    <div class="collapse navbar-collapse row" id="app-navbar-collapse">
                        <div class='col-sm-7'>
                            <div class="navbar-brand">ART PHOTO BLOG</div>
                        </div>
                        <div class='col-sm-5'>                        
                            <ul class="nav navbar-nav">
                                &nbsp;
                            </ul>                        
                            <ul class="nav  navbar-nav">                           
                                @if (Auth::guest())
                                    <li><a href="{{ url('/login') }}">Login</a></li>
                                    <li><a href="{{ url('/register') }}">Register</a></li>
                                @else
                                    <li><a href="{{ url('/posts') }}">Posts</a></li>
                                    <li><a href="{{ url('/create') }}">Create Post</a></li>
                                    <li><a href="{{ url(('/posts/{id}')) }}">My Posts</a></li>                                    
                                    <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ url('/logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>
                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                    </li>
                                </div>
                                
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            @yield('content')
        </div>
        
        <script src="/js/app.js"></script>
         
    </body>
</html>
