<!DOCTYPE html>
<html>
    <head>
        @yield('head')
    </head>
    <body>
        <header>
            @yield('header')
        </header>
        <div id="wrapper" class="row min-vh-100">
            @yield('sidebar')
            @yield('content')
        </div>
        <footer>
            <!-- 省略 -->
        </footer>
            @yield('script')
    </body>
</html>