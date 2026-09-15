<!DOCTYPE html>
<html>

    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8">
    </head>

    <body>
        @auth
            {{ auth()->user()->name }}
            <form method="POST" action="{{url('/logout')}}">
                {{ csrf_field() }}
                <input type="submit" value="Logout">
            </form>
        @else
            <a href="{{url('/login')}}">Login</a>
            <a href="{{url('/register')}}">Register</a>
        @endauth

        @yield('content')
        <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </body>

</html>