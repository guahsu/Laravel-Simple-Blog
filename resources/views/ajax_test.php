<script>
$('#postTag').change(function() {
    var tagId = $('#postTag option:last-child').val();
    var tagName = $('#postTag option:last-child').text();

    if(tagId === tagName){
        ajaxData = { 'tagName': tagName };

        $.ajax({
            url: '{{ asset("/admin/post/addTag") }}',
            type: 'POST',
            data: ajaxData,
            beforeSend: function (xhr) {
              var token = $('meta[name="csrf_token"]').attr('content');
              if (token) {
                    return xhr.setRequestHeader('X-CSRF-TOKEN', token);
              }
            },
            success: function(data){
              //$('.select2-selection__rendered li:nth-last-child(2)').attr('title', data);
              $('#postTag option:last-child').val(data);
            },
            error: function(){
              alert('error..');
            }
        })
    }
});
</script>