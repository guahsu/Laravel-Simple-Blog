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
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-84594235-3', 'auto');
  ga('send', 'pageview');
</script>
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
  <a href="/"><img class="web-img" src="{{ asset(App\AppFunctions::data('Setting', 'logo')) }}"/></a>
  <h1 class="web-title"><a href="/">{{ App\AppFunctions::data('Setting', 'title') }}</a></h1>
  <h3 class="web-desc">{{ App\AppFunctions::data('Setting', 'description') }}</h3>
</header>
<nav class="nav">
  <label class="nav-item menu-btn">- MENU - </label>
  <a class="nav-item" href="/">Blog</a>
  <a class="nav-item" href="https://demo.guastudio.com" target="_blank">Portfolio</a>
</nav>
<main class="main">
 <div class="main-left">
 @yield('containerContent')
 </div>
 <div class="main-right">
  <aside class="aside">
    <div class="author">
     <img class="author-img" src="{{ asset(App\AppFunctions::data('Setting', 'author_pic')) }}"/>
      <div class="author-info">
        <h3 class="name">{{ App\AppFunctions::data('Setting', 'author_name') }}</h3>
        <span class="desc">{{ App\AppFunctions::data('Setting', 'author_desc') }}</span>
      </div>
    </div>

    <h3>Categories</h3>
    @foreach(App\AppFunctions::data('Category', '') as $category)
    <li class="cat">
      <a href="{{ asset('search/category/'.$category->name) }}">{{ $category->name }}
      <span>({{ $category->cate_cnt }})</span>
      </a>
    </li>
    @endforeach

    <h3>Tags</h3>
    @foreach(App\AppFunctions::data('Tag', '') as $tag)
    <a class="tag" href="{{ asset('search/tag/'.$tag->name) }}">
    {{ $tag->name }}<span>({{ $tag->tag_cnt }})</span></a>
    @endforeach
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
