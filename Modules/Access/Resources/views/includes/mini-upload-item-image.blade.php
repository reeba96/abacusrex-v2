<form id="add_item_image" action="{{ route('add.item.image') }}" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
  <input type='hidden' value='{{ $item->id }}' name='item_id'>
  <input type='file' id='item_image' name='item_image'>
  <input type='submit' id='submit_item_image' style="display:none;">
</form>

<script>
$(function() {

    var options = {
         target:  '', //current_tab,   // target element(s) to be updated with server response
         success: hideModal,  // post-submit callback
         error: uploadFailed
    };

    function hideModal(responseText, statusText, xhr, $form) {
      $('.slider-item-image-error').remove();
      if (responseText.status === 'success') {
          $('#slide-item-image').attr('src', '/storage/rev_slider/items/' + responseText.filename);

          $('#mdl_item_form').modal('hide');
          $('.modal-backdrop').remove();
      }
      if (responseText.status === 'error') {
          $('#submit_item_image').after("<span class='form-error-msg slider-item-image-error'>" + responseText.msg + "</span>");
      }

    };

    function uploadFailed(error) {
        $('.slider-item-image-error').remove();
        if(error.responseJSON.exception.indexOf("PostTooLargeException") !== -1) {
            $('#submit_item_image').after("<span class='form-error-msg slider-item-image-error'>Too big file size. Max 10 MB.</span>");
        } else {
            $('#submit_item_image').after("<span class='form-error-msg slider-item-image-error'>Upload failed</span>");
        }
    };

    $('#add_item_image').submit(function() {
      $(this).ajaxSubmit(options);
      return false;
    });

    $('#mdl_item_form').on('show.bs.modal', function(event) {
        $('.slider-item-image-error').remove();
        $('#item_image').val('');
    });

});
</script>
