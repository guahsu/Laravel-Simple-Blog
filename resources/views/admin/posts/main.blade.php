@extends('layouts.admin')
@section('metaImg','imgLink')
@section('metaDesc','descText')
@section('pageTitle',' - Posts')

@section('breadcrumbs')
<!-- breadcrumbs -->
<li>Posts</li>
@stop

@section('containerHeader')
<!-- container header -->
<h1 class="title">Posts</h1>
<a class="btn-success add" href="{{ asset('admin/posts/create') }}">Add New</a>
<div class="search">
  <div class="data-range">
    <label>Show
      <select>#(name="")  </select>entries
    </label>
  </div>
  <div class="data-filter">
    <label>Search
      <input type="text"/>
    </label>
  </div>
</div>
@stop

@section('containerContent')
<!-- container content -->
<div class="table-box">
  <div class="data-table">

    <div class="data-header">
      <div class="data-cell">title</div>
      <div class="data-cell">image</div>
      <div class="data-cell">status</div>
      <div class="data-cell">create_time</div>
      <div class="data-cell">action</div>
    </div>

    @foreach($posts as $post)
    <div class="data-row">
      <div class="data-cell">{{ $post->title }}</div>
      <div class="data-cell">@if(isset($post->image))<img src="/img/{{ $post->image }}" class="data-cell-image" />@endif</div>
      <div class="data-cell">{{ $post->status }}</div>
      <div class="data-cell data-cell-time">{{ $post->created_at }}</div>
      <div class="data-cell data-cell-action">
        <a class="btn" href="{{ asset('admin/posts/create') }}">View</a>
        <a class="btn-primary" href="{{ asset('admin/posts/edit/' . $post->id) }}">Edit</a>
        <a class="btn-danger" href="{{ asset('admin/posts/delete/' . $post->id) }}">Delete</a>
      </div>
    </div>
    @endforeach

  </div>
</div>
<!-- Pagination -->
<div class="pagebox">
  {{ $posts->render() }}
</div>
@stop