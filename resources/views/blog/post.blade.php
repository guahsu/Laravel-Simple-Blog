@extends('layouts.blog')
@section('metaImg') @if(isset($post->image)){{ asset('/img/' . $post->image) }}@endif @stop
@section('metaDesc', $post->seo_description)
@section('pageTitle', '-'.$post->title)
@section('containerContent')
  <article class="article">
    <div class="art-header">
      @if(isset($post->image))
      	<img class="art-img" src="/img/{{ $post->image }}"/>
      @endif
      <div class="art-infos"><span class="art-time">{{ $post->created_at }}</span></div>
      <h2 class="art-title">{{ $post->title }}</h2>
    </div>
    <div class="art-content">
      {!! $post->content_html !!}
      <div class="art-tags">
        <h4>CATEGORY: <a class="cat" href="{{ asset('search/category/'.$category) }}">{{ $category }}</a></h4>
        <h4>TAGS:
        @foreach($tags as $id => $name)
        @if(in_array($id, old('postTag', $post_tag)))<a class="tag" href="{{ asset('search/tag/'.$name) }}">{{ $name }}</a>@endif
        @endforeach
        </h4>
      </div>
    </div>
  </article>
  <div class="other-art">
  @if($prevPost != 'empty')<a class="art-prev" href="{{ asset('post/' . $prevPost->slug) }}" title="{{ $prevPost->title }}">PREV POST: {{ $prevPost->title }}</a>@endif
  @if($nextPost != 'empty')<a class="art-next" href="{{ asset('post/' . $nextPost->slug) }}" title="{{ $nextPost->title }}">NEXT POST: {{ $nextPost->title }}</a>@endif
  </div>
@stop