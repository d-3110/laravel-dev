@section('head')
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="@yield('description')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- Loading Bootstrap -->
    @yield('page_style')
    <!-- Loading Flat UI -->
    <link href="/dist/css/flat-ui.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="/dist/img/favicon.ico">

    <!-- All the files that are required -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>@yield('title')</title>
@endsection