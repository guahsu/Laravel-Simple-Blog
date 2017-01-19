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
  </div>
</div>

<!--modal box-->
<div id="id01" class="modal-area">
  <div class="modal-content">
    <header class="modal-container color-primary">
      <span class="do-close modal-closebtn">&times;</span>
      <h2 id="modal-head">#</h2>
    </header>
    <div id="modal-body" class="modal-container">#</div>
    <footer id="modal-footer" class="modal-container">
      <a class="btn-cancel do-close" href="#">CANCLE</a>
    </footer>
  </div>
</div>
@stop

@section('pageJs')
<script type="text/javascript">
  $(document).on("click", "a", function(){
    var modalType = $(this).attr('id');
    if(modalType==='create' || modalType==='edit' || modalType==='delete'){
      var dataLink = $(this).attr('data-link');
      var dataName = $(this).parents('.data-row').find('div[data-name="name"]').text();
      $('.modal-area').css('display', 'block');
      $('#modal-head').text(modalType);
      if(modalType==='create'){
        $('#modal-body').html('<label>Name</label><input class="modal-input-name" value="" autofocus="autofocus" required="required" />');
        $('#modal-footer').html('<a class="btn-success do-confirm" href="#">CREATE</a><a class="btn-cancel do-close" href="#">CANCLE</a>');
      }else if(modalType==='edit'){
        $('#modal-body').html('<label>Name</label><input class="modal-input-name" value="' + dataName + '" autofocus="autofocus" required="required" />');
        $('#modal-footer').html('<a class="btn-success do-confirm" href="#">SAVE</a><a class="btn-cancel do-close" href="#">CANCLE</a>');
      }else if(modalType==='delete'){
        $('#modal-body').html('<p>Are you sure wnat to delete [<span class="delete-message">' + dataName +'</span>] ?</p>');
        $('#modal-footer').html('<a class="btn-danger do-confirm" href="#">DELETE</a><a class="btn-cancel do-close" href="#">CANCLE</a>');
      }else{
        alert('error..');
      }
      $('.do-confirm').attr('href', dataLink);
    }
  });
  $(document).on("click", ".do-close", function(){
    $(this).parents('.modal-area').css('display', 'none');
  });

  // var modal = document.getElementById('id01');
  // window.onclick = function(event) {
  //     if (event.target == modal) {
  //         modal.style.display = "none";
  //     }
  // }
</script>
@stop