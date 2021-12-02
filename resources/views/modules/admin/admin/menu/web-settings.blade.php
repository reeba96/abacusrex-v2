@extends ('admin::admin.layouts.master')

@section ('css')
<link rel='stylesheet' href='//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css'>
<script src='//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js'> </script>
@endsection

@section ('content')
    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <div class="card">

        <div class="card-header">

            <div class="float-left">
                <h4>{{trans('translate.settings')}}</h4>
            </div>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="" id="add_setting" class="btn btn-success" data-toggle="modal"  data-target="#add_modal" title='{{ trans("translate.create") }}'>
                    <i class="fas fa-plus-square"></i>
                </a> 
            </div>
            
        </div>

        @if ($settings->isEmpty())
            <div class="card-body text-center">
                <h4>{{ trans("translate.empty_space") }}</h4>
            </div>
        @else
        <div class="card-body card-body-with-table">
            <div class="table-responsive">
                <table id="mailables_list" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">{{trans('translate.name')}}</th>
                            <th scope="col">{{trans('translate.content')}}</th>
                            <th scope="col">{{trans('translate.type')}}</th>
                            <th scope="col">{{trans('translate.enabled')}}</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($settings as $setting)
                        <tr>
                            <td>{{ $setting['name'] }}</td>
                            <td>{{ $setting['content'] }}</td>
                            <td>{{ $setting['type'] }}</td>
                            @if($setting['enabled'] == 1) <td>{{trans('translate.yes')}}</td>
                            @else <td>{{trans('translate.no')}}</td> @endif
                            <td>
                                <form method="POST" action="{!! route('delete.settings') !!}" accept-charset="UTF-8">
                                    <input name="id" value="{{ $setting['id'] }}" type="hidden">
                                    {{ csrf_field() }}
                                    <div class="btn-group btn-group-xs float-right" role="group">
                                        <a href="{{ route('edit.setting', $setting['id']) }}" class="btn btn-primary" title={{ trans("translate.edit") }}>
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="submit" class="btn btn-danger" title='{{ trans("translate.delete") }}' onclick='return confirm(&quot;{{ trans("translate.delete_confirm") }}&quot;)'>
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>  
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @endif
    </div>

    {{-- Add new setting --}}
    <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{trans('translate.add_setting') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="edit_modal_body box-body">
                        <form id="add" action="{{ route('add.settings') }}" method="post">

                            {{ csrf_field() }}
                            <div class="form-group">
                            <label class="control-label">{{ trans("translate.name") }}: </label>
                                <input type='text' id='add-setting-name' name="name" class="form-control">
                            </div>
                            <div class="form-group">
                            <label class="control-label">{{ trans("translate.content") }}: </label>
                                <textarea class="form-control content-textarea" name="content" id="add-setting-content"></textarea>
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type='checkbox' name="is_online"> {{ trans("translate.enabled") }}
                                </label>
                            </div>
                            <label class="control-label">{{ trans("translate.type") }}:</label>
                                <select class="form-control" name="type">
                                    <option selected="selected" value="meta">meta</option>
                                    <option value="config">config</option>
                                    <option value="begin_of_head">begin_of_header</option>
                                    <option value="end_of_header">end_of_header</option>
                                    <option value="begin_of_body">begin_of_body</option>
                                    <option value="end_of_body">end_of_body</option>
                                    <option value="script">script</option>
                                </select>

                            <input type="submit" id="hidden_add" style="display: none">
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('translate.cancel') }}</button>
                    <button type="button" id="add_settings"  class="btn btn-primary">{{trans('translate.save') }}</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end of add modal --}}

    {{-- add new setting --}}
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{trans('translate.change_file') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="edit_modal_body">
                       Are you sure do you want to delete this setting?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('translate.cancel') }}</button>
                    <button type="button" id="delete_settings"  class="btn btn-danger">{{trans('translate.delete') }}</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end of add modal --}}




<script>
    
$(function() {
    var token = '{{ Session::token() }}';

    $('#hidden_submit').hide();

    /* Trigger the edit form submit when the modal is "saved" */
    $('#edit_settings').on('click', function() {
        $('#hidden_submit').trigger('click');
    });

    /* Trigger the add form submit */
    $('#add_settings').on('click', function() {
        $('#hidden_add').trigger('click');
    });


    /* Add data to modal */
    $('#edit_modal').on('show.bs.modal', function(event) {
        var id = $(event.relatedTarget).attr('data-id');
        $('#id').attr('value', id);

        $.ajax({
           method: 'POST',
           url: '{{ route("get.selected.settings") }}',
           data: {id: id, _token: token}
        }).done(function(msg) {
            console.log(msg['type']);
            $('#name').val(msg['name']);
            $('#content').val(msg['content']);
            $('#type').val(msg['type']);
            if (msg['is_online'] == 1 ) {
                $('#is_online').prop('checked', true);
            } else {
                $('#is_online').prop('checked', false);
            }
        });
    });

    $('#delete_modal').on('show.bs.modal', function(event) {
       var id = $(event.relatedTarget).attr('data-id');
       $('#delete_settings').attr('data-id', id);
    });

    $('#delete_settings').on('click', function() {
       var id = $(this).attr('data-id');

       $.ajax({
           method: 'POST',
           url: '{{ route("delete.settings") }}',
           data: {id: id, _token: token}
       }).done(function(msg) {
           if (msg['status'] == 'success') {
               $('#delete_modal').modal('hide');
               $('.modal-backdrop').remove();
               table.ajax.reload();
           }
       });
    });

    /* ajaxForm edit */
    var options = {
                target:        '',   // target element(s) to be updated with server response
                beforeSubmit:  showRequest,  // pre-submit callback
                success:       showResponse,  // post-submit callback
                type:      'post',        // 'get' or 'post', override for form's 'method' attribute
                dataType:  'json',       // 'xml', 'script', or 'json' (expected server response type)
                clearForm: false        // clear all form fields after successful submit

            };

            // bind form using 'ajaxForm'
        $('#update_settings').ajaxForm(options);

        // pre-submit callback
        function showRequest(formData, jqForm, options) {
            return true;
        }

        // post-submit callback
        function showResponse(responseText, statusText, xhr, $form)  {
            $('.edit-settings-error').remove();
            $('.error-field').removeClass('error-field');

            if (responseText['status'] == 'success') {
                $('#edit_modal').modal('hide');
                $('.modal-backdrop').remove();
                table.ajax.reload();
            } else {
                var messages = responseText.messages;
                for (var field in messages) {
                    var errorMsg = messages[field][0];
                    $('#' + field).after("<span class='edit-settings-error form-error-msg'>" + errorMsg + "</span>");
                    $('#' + field).addClass('error-field');
                }
            }
        }


        /* ajaxForm add */
    var options = {
                target:        '',   // target element(s) to be updated with server response
                beforeSubmit:  showAddRequest,  // pre-submit callback
                success:       showAddResponse,  // post-submit callback
                type:      'post',        // 'get' or 'post', override for form's 'method' attribute
                dataType:  'json',       // 'xml', 'script', or 'json' (expected server response type)
                clearForm: false        // clear all form fields after successful submit
            };

            // bind form using 'ajaxForm'
        $('#add').ajaxForm(options);

        // pre-submit callback
        function showAddRequest(formData, jqForm, options) {
            return true;
        }

        // post-submit callback
        function showAddResponse(responseText, statusText, xhr, $form)  {
            $('.add-settings-error').remove();
            $('.error-field').removeClass('error-field');

            if (responseText['status'] == 'success') {
                $('#add_modal').modal('hide');
                $('.modal-backdrop').remove();
                table.ajax.reload();
            } else {
                var messages = responseText.messages;
                for (var field in messages) {
                    var errorMsg = messages[field][0];
                    $('#add-setting-' + field).after("<span class='add-settings-error form-error-msg'>" + errorMsg + "</span>");
                    $('#add-setting-' + field).addClass('error-field');
                }
            }
        }
});

$('#add_modal').on('show.bs.modal', function(event) {
    $('.add-settings-error').remove();
    $('.error-field').removeClass('error-field');
    $('#add')[0].reset();
});

$('#edit_modal').on('show.bs.modal', function(event) {
    $('.edit-settings-error').remove();
    $('.error-field').removeClass('error-field');
    $('#update_settings')[0].reset();
});
</script>

@endsection
