@extends('admin::admin.layouts.master')

{{-- @extends('admin::admin.mailables.layout.app') --}}

@section('content')

<div class="card">
	<!-- Editor Markdown/Html/Text -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
	<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/codemirror.js"></script>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/codemirror.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.0/tinymce.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/xml/xml.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/css/css.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/javascript/javascript.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/htmlmixed/htmlmixed.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/display/placeholder.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.11/lodash.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>


    <div class="card-header">

		<div class="float-left">
			<h4>{{ trans("translate.create_new_template") }}</h4>
		</div>

		<div class="btn-group btn-group-sm float-right" role="group">
			<button type="button" class="btn btn-secondary float-right preview-toggle mr-2" title='{{ trans("translate.preview") }}'>{{ trans("translate.preview") }}</button>  
			<a href="#newTemplateModal" class="btn btn-success" data-toggle="modal" data-target="#newTemplateModal" title='{{ trans("translate.create_new_template") }}'> {{ trans("translate.create") }} </a>
		</div>
		
    </div>
    
    <div class="card my-4">
        <form id="create_template" action="{{ route('createNewTemplate') }}" method="POST">
            @csrf
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <textarea id="template_editor" name="template_editor" cols="30" rows="100">{{ $skeleton['template'] }}</textarea>
                </div>
            </div>  
            <div class="modal fade" id="newTemplateModal" tabindex="-1" role="dialog" aria-labelledby="newTemplateModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ trans("translate.create_new_template") }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label='{{ trans("translate.close") }}'>
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-warning new-mailable-alerts d-none" role="alert"></div>
                            <div class="form-group">
                                <label for="template_name">{{ trans("translate.name") }}</label>
                                <input type="text" class="form-control" id="template_name" name="template_name" placeholder='{{ trans("translate.name") }}' required>
                            </div>
                            <div class="form-group">
                                <label for="template_description">{{ trans("translate.description") }}</label>
                                <input type="text" class="form-control" id="template_description" name="template_description" placeholder={{ trans("translate.description") }} required>
                            </div>
                            <input type="hidden" id="template_view_name" name="template_view_name" value="{{ $skeleton['name'] }}">
                            <input type="hidden" id="template_type" name="template_type" value="{{ $skeleton['type'] }}">
                            <input type="hidden" id="template_skeleton" name="template_skeleton" value="{{ $skeleton['skeleton'] }}">
                            <input type="hidden" id="plain_text" name="plain_text" value="">
                        </div>
                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans("translate.close") }}</button>
                            <button type="submit" class="btn btn-primary save-template">{{ trans("translate.create") }}</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        tinymce.init({
            selector: "textarea#template_editor",
            menubar : false,
            visual: false,
            height:700,
            inline_styles : true,
            plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table directionality emoticons template paste fullpage code legacyoutput"
            ],
            content_css: "css/content.css",
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image fullpage | forecolor backcolor emoticons | preview | code",
            fullpage_default_encoding: "UTF-8",
            fullpage_default_doctype: "<!DOCTYPE html>",
            init_instance_callback: function (editor)
            {
            setTimeout(function(){ 
                editor.execCommand("mceRepaint");
            }, 5000);
            }
        });

        $('.preview-toggle').click(function(){
            tinyMCE.execCommand('mcePreview');return false;
        });

        $('.save-template').click(function(){
            var postData = {
                template_editor: tinymce.get('template_editor').getContent(),
                template_name: template_name,
                template_description: template_description,
                template_view_name: template_view_name,
                template_type: template_type,
                template_skeleton: template_skeleton,
                plain_text: plaintextEditor.getValue(),
            }
                
            axios.post('{{ route('createNewTemplate') }}', postData)
            .then(function (response) {

                if (response.data.status == 'ok'){

                    alert(response.data.message);

                    setTimeout(function(){
                        window.location.replace(response.data.template_url);
                    }, 1000);

                } else { alert('Error: ' + response.data.message); }
            })

            .catch(function (error) { alert('Error' + error); });

        });

    });

                
</script>
   
@endsection