@extends('layouts.blog')
@section('metaImg','imgLink')
@section('metaDesc','descText')

@section('containerContent')
	@foreach($posts as $post)
	<article class="article">
	  <div class="art-header">
	  	@if(isset($post->image))
	  	<img class="art-img" src="/img/{{ $post->image }}"/>
	  	@endif
	    <h2 class="art-title">{{ $post->title }}</h2>
	    <div class="art-infos"><span class="art-time">{{ $post->created_at }}</span><span class="art-author">GuaHsu</span></div>
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