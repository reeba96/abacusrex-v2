@extends ('admin::admin.layouts.master')

@section ('content')
  <div class="content">
      <h2>@lang('translate.qr_codes')</h2>
  </div>

  @if(auth()->user()->is_admin)
      <div class='col-md-1'>
          <div>
              <a class='btn btn-app' data-toggle='modal' data-target='#create_modal'><i class='fa fa-plus'></i>{{trans('translate.add_qr_code') }}</a>
          </div>
      </div>
  @endif

  <div class="content" style="position: relative">
      <div id='ajax-loader'>
          <img src='/images/ajax-loader.gif'/>
      </div>

    <div class="col-md-offset-1 col-md-8">
      <div class="box">
        <div class="box-body no-padding">
          <table id="qr_codes_table" class="table">
            <tbody>
              <tr>
                <th class="center">{{trans('translate.qr_url') }}</th>
                <th class="center">Page</th>
                <th class="center" style="display: none;">{{trans('translate.qr_photo') }}</th>
                <th class="center"></th>
              </tr>
              @foreach ($qr_codes as $qr_code)
                <tr style="text-align: center">
                    <td id="url-{{$qr_code->id}}" ><a href="{{ $qr_code->url }}" target="_blank">{{ $qr_code->url }}</a></td>
                    <td id="page-{{$qr_code->id}}" >{{ $qr_code->page ? $qr_code->page->title_en : '-' }}</td>
                    <td id="photo-{{$qr_code->id}}" style="display: none;"><img src="{{ $qr_code->photo }}" style="width: 50px;"></td>

                  @if (auth()->user()->is_admin)
                  <td>
                  <span id="{{ $qr_code->id }}"></span>
                  <a id="e" data-toggle='modal' data-target='#edit_modal' >
                    <i class="fa fa-pencil-square-o"></i>
                  </a>
                  <a data-toggle="confirmation" data-id="{{ $qr_code->id }}" data-placement="top" class="delete_confirm">
                    <i class="fa fa-trash-o"></i>
                  </a>
                  </td>
                  @endif

              </tr>
            @endforeach
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>


  <div class="modal fade" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_label" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="">@lang('translate.create_new_qr_code')</h4>
                  </div>
                  <div class="modal-body">
                      <form id="add_qr_code">
                        <div class="form-group">
                          <label class="control-label">@lang('translate.qr_url')</label>
                          <input type='text' id="url" data-name="url" class="form-control" />
                        </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('translate.close') }}</button>
                      <button type="button" id="btn_create_confirm" class="btn btn-primary">{{trans('translate.create') }}</button>
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="edit_modal" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="">@lang('translate.edit_qr_code')</h4>
                  </div>
                  <div class="modal-body">
                      <form id="edit_user">

                        <div class="form-group">
                          <label class="control-label">@lang('translate.qr_url')</label>
                          <input type='text' id="edit_url" data-name="edit_url" class="form-control" />
                        </div>
                          <div class="form-group text-center">
                          <img id="edit_photo" data-name="edit_photo">
                        </div>

                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('translate.close') }}</button>
                      <button type="button" id="btn_edit_confirm" class="btn btn-primary">{{trans('translate.update') }}</button>
                  </div>
              </div>
          </div>
      </div>

  </div> <!-- end of content -->

  <script id="reload">

    $(function(){
      init();

      function init() {
        $('[data-toggle=confirmation]').confirmation({

          rootSelector: '[data-toggle=confirmation]',
          onConfirm: function(event) {
            var id = $(this)[0].id;

            $.ajax({
                method: 'DELETE',
                url: "/admin/admin/qrcodes/" + id,
                data : {_token: token}
            }).done(function(msg) {
                if (msg['message'] == 'OK') {
                    $('#url-' + msg['id']).parent().remove();
                } else {
                    console.log('error');
                }
            });
          }
        });
      }


      var token = "{{ Session::token() }}"

      $('#btn_create_confirm').on('click', function() {
          $('#create_modal').modal('hide');
          $('#ajax-loader').show();

          var url = $('#url').val();

          $.ajax({
              method: "POST",
              url: "{{ route('admin.qrcodes.store') }}",
              data: {url: url, _token: token}
          }).done(function(msg) {
              if(msg['message'] == "OK") {
                  $("#qr_codes_table").load(location.href+" #qr_codes_table>*", function() {
                    init();
                  });
                  $('#ajax-loader').hide();
                  console.log('qr code created');
              } else {
                  console.log('error');
              }
          });
      });

      var id;

      $(document).on('click', '#e', function() {

          var id = $(this).siblings()[0].getAttribute('id');
          window.id = id;
          var username = $('#url-' + id).text();
          var email = $('#photo-' + id + ' > img').attr('src');

          $('#edit_url').val(username);
          $('#edit_photo').attr('src', email);

          if ($('#page-' + id).text() != '-') {
              $('#edit_url').attr('disabled', 'disabled');
              $('#btn_edit_confirm').attr('disabled', 'disabled');
          } else {
              $('#edit_url').attr('disabled', false);
              $('#btn_edit_confirm').attr('disabled', false);
          }
      });

      $('#btn_edit_confirm').on('click', function() {
          var new_url = $('#edit_url').val();
          var id = window.id;
          var url = "/admin/admin/qrcodes/" + id;

          $.ajax({
              method: 'PUT',
              url: url,
              data: {url: new_url, _token: token}
          }).done(function(msg) {
              if (msg['message'] = 'OK') {
                  $('#edit_modal').modal('hide');
                  $('#url-' + msg['id']).html('<a href="' + msg['new_url'] + '" target="_blank">' + msg['new_url'] + '</a>');
                  $('#photo-' + msg['id']).html('<img src="' + msg['new_photo'] + '" style="width: 50px;">');
              } else {
                  console.log("Error");
              }
          });
      });

      /*  DELETE FUNCTION WITHOUT CINFIRM MODAL */

      // $(document).on('click', '#d', function() {
      //     var id = $(this).siblings()[0].getAttribute('id');

      //     $.ajax({
      //         method: 'POST',
      //         url: "{{ route('user.delete') }}",
      //         data : {id: id, _token: token}
      //     }).done(function(msg) {
      //         if (msg['message'] == 'OK') {
      //             $('#name-' + msg['id']).parent().remove();
      //         } else {
      //             console.log('error');
      //         }
      //     })
      // });

    });
  </script>
@endsection
