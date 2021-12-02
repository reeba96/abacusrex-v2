<form id="file_update" action="{{route('article.file.update')}}" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
  <input type="hidden" name='media_id' id="media_id" value="{{$media->id}}">
<div class="row">
      @if ( \Modules\Admin\Entities\Media::isImage($media->extension) )
        <div class="col-md-3 content">
          <?php $src = '/storage/' . $media->storage . '/' . $media->file_name . '.' . $media->extension; ?>
          <img id="edit_img" src="{{$src}}" alt="img" width="100%" style="margin-bottom: 8px;">
        </div>
      @else
        <div class="col-md-3 content">
          <img id="edit_img" src="/images/text-file-icon.png" alt="img" width="100%" style="margin-bottom: 8px;">
        </div>
      @endif


          <div class="col-md-8">
              <ul class="nav nav-tabs mt-3" role="tablist">
                <?php
                  $locale = app()->getLocale();
                  $languages = \LaravelLocalization::getSupportedLocales();
                
                  $language_keys = array_keys($languages);
                  //$langs = CMS\admin\Language::getLanguages();
                 ?>
      
                 @foreach ($language_keys as $key => $code)
                  @if ($code == $locale)
                      <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#file_{{$code}}">{{ $languages[$code]['name'] }}</a></li>
                  @else
                      <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#file_{{$code}}">{{ $languages[$code]['name'] }}</a></li>
                  @endif
                @endforeach
              </ul>
      
              <div class="tab-content"  id="nav-tabContent">
                  @foreach ($language_keys as $key => $code)
                  <?php
                        $title = 'title_' . $code;
                        $appears = 'appears_' . $code;
                        if ($media->$appears == true) {
                          $checked = 'checked';
                        } else {
                          $checked = '';
                        }
                       
                      ?>
                    @if ($code == $locale)
                      
                  
                    <div id="file_{{$code}}" class="tab-pane fade in active show">
                  @else
                    <div id="file_{{$code}}" class="tab-pane fade">
                  @endif
                    <div class="form-group mt-3">
                      <label for="file_title_{{$code}}">{{trans('translate.title') }}: </label>
                      <input type="text" name="file_title_{{$code}}" class="form-control" value="{{$media->$title}}">
                    </div>
      
                    <div class="form-group">
                      <label for="file_appears_{{$code}}">{{trans('translate.appears_in') }} {{$languages[$code]['name'] }}: </label>
                      <input type="checkbox" name="file_appears_{{$code}}" {{$checked}}>
                    </div>
                  </div>
                @endforeach
      
              </div>
          </div>
      
        </div>
        <button type="submit" name="media_edit" id="hidden_submit" value="form_submit"></button>
      
      </form>
      
      <script>
        $(function() {
      
      
              var options = {
                target:        '',   // target element(s) to be updated with server response
                //beforeSubmit:  showRequest,  // pre-submit callback
                success:       showResponse  // post-submit callback
            };
      
            // bind to the form's submit event
      
      
            function showRequest(formData, jqForm, options) {
              return true;
            }
      
            // post-submit callback
            function showResponse(responseText, statusText, xhr, $form)  {
              $('#edit_file_modal').modal('hide');
            }
      
              $('#file_update').submit(function() {
                 $(this).ajaxSubmit(options);
      
                  // !!! Important !!!
                  // always return false to prevent standard browser submit and page navigation
                  return false;
              });
      
      
          $('#hidden_submit').hide();
      
          $('#btn_file_edit_confirmed').on('click', function(event) {
            $('#hidden_submit').trigger('click');
          });
      
              //jQuery Form
      
          //end of jQuery Form
        });
      </script>
      