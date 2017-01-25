@extends('layouts.blog')
@section('metaImg','imgLink')
@section('metaDesc','不懂就學，背不起來的就寫下來')

@section('containerContent')
	@foreach($posts as $post)
	<article class="article">
	  <div class="art-header">
	  	@if(isset($post->image))
	  	<img class="art-img" src="/img/{{ $post->image }}"/>
	  	@endif
	  	<div class="art-infos"><span>{{ $post->created_at }} | {{ $post->seo_keywords }}</div>
	    <h2>{{ $post->title }}</h2>
	  </div>
	  <div class="art-summary">
	    <p>{{ $post->excerpt }}</p><a href="{{ asset('post/' . $post->slug) }}"><span class="art-read-btn">Continue reading ...</span></a>
	  </div>
	</article>
	@endforeach
	<div class="pagebox">
		{{ $posts->render() }}
	</div>
@stop