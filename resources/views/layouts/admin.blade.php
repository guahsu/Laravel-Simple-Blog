<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="utf-8">
    <meta name="author" content="GuaHsu">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:image" content="@yield('metaImg')" />
    <meta property="og:description" content="@yield('metaDesc')">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title>{{ App\AppFunctions::data('Setting', 'admin_title') }}@yield('pageTitle')</title>
    <!--CSS-->
    <link rel="stylesheet" href="{{ asset('css/w3.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
    {!! editor_css() !!}
    @yield('pageCss')
    <!--JS-->
    <script language="javascript" type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <!--
<script language="javascript" type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('js/analyticstracking.js') }}"></script>
-->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="left-nav">
        <div class="logo"></div>
        <ul>
            <li><a href="{{ asset('/admin/posts') }}" class="btn full-width">Posts</a></li>
            <li><a href="{{ asset('/admin/media') }}" class="btn full-width">Media</a></li>
            <li><a href="{{ asset('/admin/menus') }}" class="btn full-width">Menus</a></li>
            <li><a href="{{ asset('/admin/categories') }}" class="btn full-width">Categories</a></li>
            <li><a href="{{ asset('/admin/settings') }}" class="btn full-width">Settings</a></li>
        </ul>
    </div>
    <main class="main">
        <div class="top-nav">
            <ul class="breadcrumbs">
                <li><a href="{{ asset('/admin') }}">Home</a></li>
                @yield('breadcrumbs')
            </ul>
            <div class="user">
                <div class="name"><a href="#">{{ Auth::user()->name }}</a></div>
                <div class="logout"><a href="{{ asset('/admin/logout') }}">Logout</a></div>
            </div>
        </div>
        <div class="container">
            <div class="header">
                @yield('containerHeader')
            </div>
            <div class="content">
                @yield('containerContent')
            </div>
        </div>
    </main>
    @yield('pageJs')
</body>

</html>
