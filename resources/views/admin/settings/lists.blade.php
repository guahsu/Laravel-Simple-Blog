@extends('layouts.admin')
@section('metaImg','imgLink')
@section('metaDesc','descText')
@section('pageTitle',' - Settings')

@section('breadcrumbs')
<!-- breadcrumbs -->
<li>Settings</li>
@stop

@section('containerHeader')
<!-- container header -->
<h1 class="title">Settings</h1>
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
      <div class="data-cell">key</div>
      <div class="data-cell">value</div>
      <div class="data-cell">action</div>
    </div>

    @foreach($settings as $setting)
    <div class="data-row" data-id="{{ $setting->id }}">
      <div class="data-cell" data-name="key">{{ $setting->key }}</div>
      <div class="data-cell" data-name="value">{{ $setting->value }}</div>
      <div class="data-cell data-cell-action">
        <a id="edit" class="btn-primary" data-link="{{ asset('admin/settings/edit/' . $setting->id) }}">Edit</a>
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
    </footer>
  </div>
</div>
@stop

@section('pageJs')
<script type="text/javascript">
  $(document).on("click", "a", function(){
    var modalType = $(this).attr('id');
    if(modalType==='edit'){
      var dataLink = $(this).attr('data-link');
      var dataValue = $(this).parents('.data-row').find('[data-name="value"]').text();
      $('.modal-area').css('display', 'block');
      $('#modal-head').text(modalType);
      $('#modal-body').html('<label>Value</label><br><input class="modal-input-value" value="' + dataValue + '" autofocus="autofocus" required="required" />' );
      $('#modal-footer').html('<a id="do-save" class="btn-success" data-url="'+ dataLink +'">SAVE</a><a class="btn-cancel do-close" href="#">CANCLE</a>');
    }
  });
  $(document).on("click", ".do-close", function(){
    $('.modal-area').css('display', 'none');
    $('#modal-head').text('');
    $('#modal-body').html('');
    $('#modal-footer').html('');
  });

  $(document).on("click", "#do-save", function(){
    var ajaxUrl = $(this).attr('data-url');
    var ajaxData = { 'value': $('.modal-input-value').val()};
    $.ajax({
      url: ajaxUrl,
      type: 'POST',
      data: ajaxData,
      beforeSend: function (xhr) {
        var token = $('meta[name="csrf_token"]').attr('content');
        if (token) {
              return xhr.setRequestHeader('X-CSRF-TOKEN', token);
        }
      },
      success: function(data){
          $('div[data-id="'+ data['id'] +'"]').find('[data-name="value"]').text(data['value']);
          $('.do-close').trigger('click');

      },
      error: function(data){
        var errors = data.responseJSON;
        console.log(errors);
        alert(errors);
      }
    })
  });

</script>
@stop