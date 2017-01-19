<!--add-->
<div id="modal-create" class="modal-area">
  <div class="modal-content">
    <header class="modal-container color-pconfirmrimary">
      <span class="do-close modal-closebtn">&times;</span>
      <h2>Create</h2>
    </header>
    <div class="modal-container">
      <label>Name</label>
      <input class="editName" value="" autofocus="autofocus" required="required" />
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
      <input class="editName" value="" autofocus="autofocus" required="required" />
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
      <p>Are you sure wnat to delet [<span class="delete-message">#</span>] ?</p>
    </div>
    <footer class="modal-container">
      <a class="btn-danger do-confirm" href="#">DELETE</a>
      <a class="btn-cancel do-close" href="#">CANCLE</a>
    </footer>
  </div>
</div>

<!--script-->
<script type="text/javascript">
  $(a).click(function() {
    var modalType = $(this).attr(id);
    if(modalType==='create' || modalType==='edit' ||modalType==='delete'){
      var dataLink = $(this).attr('data-link');
      var dataName = $(this).parents('.data-row').find('div[data-name="name"]').text();
      $('#modal-'+modalType).css('display', 'block');
      $('.editName').val(dataName);
      $('.do-confirm').attr('href', dataLink);
    }
  });
  $('.do-close').click(function() {
    $(this).parents('div').css('display', 'none');
  });
</script>