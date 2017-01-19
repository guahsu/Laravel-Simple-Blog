@extends('layouts.admin')
@section('metaImg','imgLink')
@section('metaDesc','descText')
@section('pageTitle',' - Categories')

@section('breadcrumbs')
<!-- breadcrumbs -->
<li>Categories</li>
@stop

@section('containerHeader')
<!-- container header -->
<h1 class="title">Categories</h1>
<a id="create" class="btn-success add" data-link="{{ asset('admin/category/create') }}">Add New</a>
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
      <div class="data-cell">name</div>
      <div class="data-cell">slug</div>
      <div class="data-cell">action</div>
    </div>

    @foreach($categories as $category)
    <div class="data-row" data-id="{{ $category->id }}">
      <div class="data-cell" data-name="name">{{ $category->name }}</div>
      <div class="data-cell">{{ $category->slug }}</div>
      <div class="data-cell data-cell-action">
        <a id="edit" class="btn-primary" data-link="{{ asset('admin/category/edit/' . $category->id) }}">Edit</a>
        <a id="delete" class="btn-danger" data-link="{{ asset('admin/category/delete/' . $category->id) }}">Delete</a>
      </div>
    </div>
    @endforeach

<!--create-->
<div id="modal-create" class="modal-area">
  <div class="modal-content">
    <header class="modal-container color-primary">
      <span class="do-close modal-closebtn">&times;</span>
      <h2>Create</h2>
    </header>
    <div class="modal-container">
      <label>Name</label>
      <input class="modal-input-name" value="" autofocus="autofocus" required="required" />
    </div>
    <footer class="modal-container">
      <a class="btn-success do-confirmconfirm" href="#">CREATE</a>
      <a class="btn-cancel do-close" href="#">CANCLE</a>
    </footer>
  </div>
</div>

<!--edit-->
<div id="modal-edit" class="modal-area">
  <div class="modal-content">
    <header class="modal-container color-primary">
      <span class="do-close modal-closebtn">&times;</span>
      <h2>Edit</h2>
    </header>
    <div class="modal-container">
      <label>Name</label>
      <input class="modal-input-name" value="" autofocus="autofocus" required="required" />
    </div>
    <footer class="modal-container">
      <a class="btn-success do-confirm" href="#">SAVE</a>
      <a class="btn-cancel do-close" href="#">CANCLE</a>
    </footer>
  </div>
</div>


</script>
<!--delete-->

<div id="modal-delete" class="modal-area">
  <div class="modal-content">
    <header class="modal-container color-primary">
      <span class="do-close modal-closebtn">&times;</span>
      <h2>Delete</h2>
    </header>

    <div class="modal-container">
      <p>Are you sure wnat to delet [<span class="modal-delete-name">#</span>] ?</p>
    </div>
    <footer class="modal-container">
      <a class="btn-danger do-confirm" href="#">DELETE</a>
      <a class="btn-cancel do-close" href="#">CANCLE</a>
    </footer>
  </div>
</div>

<!--script-->
<script type="text/javascript">
  $(document).on("click", "a", function(){
    var modalType = $(this).attr('id');
    if(modalType==='create' || modalType==='edit' || modalType==='delete'){
      var dataLink = $(this).attr('data-link');
      var dataName = $(this).parents('.data-row').find('div[data-name="name"]').text();
      $('#modal-'+modalType).css('display', 'block');
      $('.modal-input-name').val(dataName);
      $('.modal-delete-name').text(dataName);
      $('.do-confirm').attr('href', dataLink);
    }
  });
  $('.do-close').click(function() {
    $(this).parents('.modal-area').css('display', 'none');
  });
</script>
  </div>
</div>
@stop