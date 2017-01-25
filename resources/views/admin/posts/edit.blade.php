@extends('layouts.admin')
@section('metaImg','imgLink')
@section('metaDesc','descText')
@section('pageTitle',' - Posts')

@section('pageCss')
<!-- Page Css -->
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
{!! editor_css() !!}
@stop

@section('breadcrumbs')
<!-- breadcrumbs -->
<li><a href="{{ asset('/admin/posts') }}">Posts</a></li>
<li>@if(isset($post->id)){{ 'Edit' }}@else{{ 'Create' }}@endif</li>
@stop

@section('containerHeader')
<!-- container header -->
<h1 class="title">New Post</h1>
@stop

@section('containerContent')
<form role="form" action="{{asset('/admin/posts/store')}}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="@if(isset($post->id)){{ $post->id }}@endif">
    <input type="hidden" name="storeType" id="storeType" value="@if(isset($post->id)){{'edit'}}@else{{'create'}}@endif">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <!-- container content -->
    <div class="post-left">
        <!-- Post Title -->
        <div class="panel">
            <div class="panel-head">
                <h3 class="panel-titel">Post Title</h3>
                <span class="panel-desc">input your title</span>
            </div>
            <div class="panel-body">
                <input name="postTitle" placeholder="Title" value="{{ old('postTitle', $post->title) }}" autofocus="autofocus" required="required" />
            </div>
        </div>
        <!-- Post Content -->
        <div class="panel">
            <div class="panel-head">
                <h3 class="panel-titel">Post Content</h3>
            </div>
            <div id="mdeditor">
                <textarea>{{ old('postContent', $post->content_text) }}</textarea>
            </div>
        </div>
        <!-- Post Excerpt -->
        <div class="panel">
            <div class="panel-head">
                <h3 class="panel-titel">Post Excerpt</h3>
                <span class="panel-desc">Small description of this post</span>
            </div>
            <div class="panel-body">
                <textarea name="postExcerpt" required="required">{{ old('postExcerpt', $post->excerpt) }}</textarea>
            </div>
        </div>
    </div>
    <div class="post-right">
        <!-- Post Details -->
        <div class="panel">
            <div class="panel-head">
                <h3 class="panel-titel">Post Details</h3>
            </div>
            <div class="panel-body">
                <label>URL slug</label>
                <input name="postSlug" placeholder="slug" value="{{ old('postSlug', $post->slug) }}" />
                <label>Post Status</label>
                <select name="postStatus">
                    <option></option>
                    <option value="PUBLISHED"@if(old('postStatus', $post->status) == 'PUBLISHED'){!! 'selected="selected"' !!}@endif>PUBLISHED</option>
                    <option value="DRAFT"@if(old('postStatus', $post->status) == 'DRAFT'){!! 'selected="selected"' !!}@endif>DRAFT</option>
                    <option value="PENDING"@if(old('postStatus', $post->status) == 'PENDING'){!! 'selected="selected"' !!}@endif>PENDING</option>
                </select>
                <label>Post Category</label>
                <select name="postCategory" class="js-example-placeholder-single" style="width: 100%">
                    <option></option>
                    @foreach($categories as $id => $name)
                    <option value="{{ $id }}"@if($id == old('postCategory', $post->category)){!! 'selected="selected"' !!}@endif>{{ $name }}</option>
                    @endforeach
                </select>
                <label>Post Tag</label>
                <select id="postTag" name="postTag[]" class="js-example-tags" multiple="multiple" style="width: 100%">
                    <option></option>
                    @foreach($tags as $id => $name)
                    <option value="{{ $id }}"@if(in_array($id, old('postTag', $post_tag))){!! 'selected="selected"' !!}@endif>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- Post Image -->
        <div class="panel">
            <div class="panel-head">
                <h3 class="panel-titel">Post Image</h3>
            </div>
            <div class="panel-body">
                @if(isset($post->image))
                <img src="/img/{{ $post->image }}" width="100%">
                <input type="file" name="postImage" />
                @else
                <input type="file" name="postImage" />
                @endif
            </div>
        </div>
        <!-- Post SEO Content -->
        <div class="panel">
            <div class="panel-head">
                <h3 class="panel-titel">SEO Content</h3>
            </div>
            <div class="panel-body">
                <label>SEO title</label>
                <input name="seoTitle" placeholder="SEO Title" value="{{ old('seoTitle', $post->seo_title) }}" />
                <label>Meta Description</label>
                <textarea name="seoDesc">{{ old('seoDesc', $post->seo_description) }}</textarea>
                <label>Meta Keywords</label>
                <textarea name="seoKeywords">{{ old('seoKeywords', $post->seo_keywords) }}</textarea>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
    <!-- Alert Message -->
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- Save Button -->
    <button type="submit" id="save" class="btn full-width">SAVE</button>
</form>

@stop

@section('pageJs')
<!-- Page JS -->
{!! editor_js() !!}
{!! editor_config('mdeditor') !!}
<script language="javascript" type="text/javascript" src="{{ asset('js/select2.full.min.js') }}"></script>
<script type="text/javascript">
//Select
$(".js-example-tags").select2({
    placeholder: 'Select tags',
    tags: true
});

$(".js-example-placeholder-single").select2({
    placeholder: "Select state",
    allowClear: true
});
</script>
@stop
