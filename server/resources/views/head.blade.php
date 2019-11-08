@section('head')
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="@yield('description')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/login.css">
    <link href="/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"><!-- Loading Bootstrap -->
    <link href="/dist/css/flat-ui.min.css" rel="stylesheet"><!-- Loading Flat UI -->
    <link rel="shortcut icon" href="/dist/img/favicon.ico">
    <!------ Include the above in your HEAD tag ---------->

    <!-- All the files that are required -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<!--     <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'> -->
    <title>@yield('title')</title>
@endsection