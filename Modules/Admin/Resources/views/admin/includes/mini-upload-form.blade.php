<form id="slide_image_upload" action="{{ route('slider.image.upload.form') }}" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
  <input type="file" name="slide_image_form" id='slide_image_input'>
  <input type="hidden" name="id" value="{{ $slide->id }}">
  <input type="hidden" id="lang" name="lang">
  <input type="submit" id="hidden_submit">
</form>

<script>
  $(function() {

  $('#hidden_submit').hide();

  var options = {
    target: '', // target element(s) to be updated with server response
    success: showResponse, // post-submit callback
    error: uploadFailed
  };

  function showRequest(formData, jqForm, options) {
    return true;
  };

  function uploadFailed(error) {
      if(error.responseJSON.exception.indexOf("PostTooLargeException") !== -1) {
          $('#slide_image_upload').append("<span class='form-error-msg slider-image-error'>Too big file size. Max 10 MB.</span>");

      } else {
          $('#slide_image_upload').append("<span class='form-error-msg slider-image-error'>Upload failed</span>");
      }
  }

  function showResponse(responseText, statusText, xhr, $form) {
    if (responseText.status == 'error') {
        $('#slide_image_upload').append("<span class='form-error-msg slider-image-error'>" + responseText.msg + "</span>");
        return;
    }

    var file = responseText.filename;
    var code = responseText.code;
    var lang = responseText.lang;
    var src = responseText.src;
    var btn = responseText.btn;
    $('#img_' + lang).attr('src', src);
    if (btn == 1) {
      $('#delete_button_' + lang).html('<button style="display:block" id="btn_delete_img" type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteImageModal" data-filename="' + file + '" data-lang="' + code + '"><span class="glyphicon glyphicon-trash"></span></button>');
    }
    $('#colOne').load('{{ route('refresh.slide.list') }}');
    $('#mdl_file_form').modal('hide');
  };

  $('#slide_image_upload').submit(function() {
    $('.slider-image-error').remove();
    $(this).ajaxSubmit(options);
    // !!! Important !!!
    // always return false to prevent standard browser submit and page navigation
    return false;
  });

  $('.btn_save_slide_image').on('click', function(event) {
    event.preventDefault();
    $('#hidden_submit').trigger('click');
  });
});

$('#mdl_file_form').on('show.bs.modal', function(event) {
    $('.slider-image-error').remove();
    $('#slide_image_input').val('');
});
</script>
