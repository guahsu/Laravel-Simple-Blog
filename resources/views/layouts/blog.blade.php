<!DOCTYPE html>
<html lang="zh-TW">
<head>
<meta charset="utf-8">
<meta name="author" content="GuaHsu">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:image" content="@yield('metaImg')"/>
<meta property="og:description" content="@yield('metaDesc')">
<meta name="csrf_token" content="{{ csrf_token() }}" />
<title>{{ App\AppFunctions::data('Setting', 'title') }}@yield('pageTitle')</title>
<!--CSS-->
<link rel="stylesheet" href="{{ asset('css/blog.css') }}">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Serif">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/styles/atom-one-light.min.css">

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

<header class="header">
  <div class="logo-box">
    <div class="logo">
      <a href="/">
        <img class="art-img" src="/img/{{ App\AppFunctions::data('Setting', 'logo') }}"/>
      </a>
    </div>
  </div>
  <h1 class="web-title">{{ App\AppFunctions::data('Setting', 'title') }}</h1>
  <h3 class="web-desc">{{ App\AppFunctions::data('Setting', 'description') }}</h3>
</header>
<nav class="nav">
  <label class="nav-item menu-btn">- MENU - </label>
  <a class="nav-item" href="/">BLOG</a>
  <a class="nav-item" href="#" target="_blank">Portfolio</a>
</nav>
<main class="main">
 <div class="main-left">
 @yield('containerContent')
 </div>
 <div class="main-right">
  <aside class="aside">
    <div class="author">
      <div class="author-img"><img src="/img/{{ App\AppFunctions::data('Setting', 'author_pic') }}"/></div>
      <div class="author-info">
        <h3 class="name">{{ App\AppFunctions::data('Setting', 'author_name') }}</h3>
        <span class="desc">{{ App\AppFunctions::data('Setting', 'author_desc') }}</span>
      </div>
    </div>
    <h3>Categories</h3>
    @foreach(App\AppFunctions::data('Category', '') as $id => $category)
    <li class="cat"><a href="{{ asset('search/category/'.$category) }}">{{ $category }}</a></li>
    @endforeach

    <h3>TAGS</h3>
    @foreach(App\AppFunctions::data('Tag', '') as $tag)
    <a class="tag" href="{{ asset('search/tag/'.$tag) }}">{{ $tag }}</a>
    @endforeach
    <h3>TIME</h3>
    <li class="time"><a href="#">2016-11 (5)</a></li>
    <li class="time"><a href="#">2016-10 (1)</a></li>
    <li class="time"><a href="#">2016-09 (2)</a></li>
  </aside>
</div>
</main>
<footer class="footer"><span class="copyright">{{ App\AppFunctions::data('Setting', 'footer') }}</span></footer>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
<script src="{{ asset('js/menu.js') }}"></script>
</body>
</html>
