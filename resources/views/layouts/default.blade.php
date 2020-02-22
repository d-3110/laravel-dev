<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"><!-- Loading Bootstrap -->
    <link href="dist/css/flat-ui.min.css" rel="stylesheet"><!-- Loading Flat UI -->
    <link rel="shortcut icon" href="/dist/img/favicon.ico">
    @yield('specific_styles')
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}/crud">CRUD DEMO</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php if(preg_match("/index|store|page/",$_SERVER["REQUEST_URI"])){ echo "<li class='active'>"; }else{ echo "<li>"; } ?><a href="{{ url('/') }}/crud">一覧表示</a></li>
                <?php if(preg_match("/create/",$_SERVER["REQUEST_URI"])){ echo "<li class='active'>"; }else{ echo "<li>"; } ?><a href="{{ url('/') }}/crud/create">新規作成</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
 
<div class="container">
    @yield('content')
</div><!-- /.container -->
 
<!-- footer -->
<footer class="footer">
    <div class="container">
        <p class="text-muted">CRUD DEMO using laravel.</p>
    </div>
</footer>
 
<script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<!-- <script src="node_modules/caniuse-lite/data/features/video.js"></script> -->
<script src="dist/scripts/flat-ui.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
 
<script src="assets/js/prettify.js"></script>
<script src="assets/js/application.js"></script>
 
<!-- <script>
    videojs.options.flash.swf = "{{ url('/') }}/dist/js/vendors/video-js.swf"
</script> -->
</body>
</html>