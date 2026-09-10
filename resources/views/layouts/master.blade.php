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
    </body>

</html>