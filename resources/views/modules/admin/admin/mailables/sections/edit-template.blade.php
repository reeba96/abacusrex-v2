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
			<h4>{{ $template['name'] }}</h4>
		</div>

		<div class="btn-group btn-group-sm float-right" role="group">
			<button type="button" class="btn btn-secondary float-right preview-toggle">{{ trans("translate.preview") }}</button>   
			<button type="button" class="btn btn-success float-right save-template">{{ trans("translate.update") }}</button> 
		</div>
		
	</div>

	<div class="card my-4">
		
		<div class="card my-4">
			<div class="card-header d-flex align-items-center justify-content-between">
				<h5>{{ trans("translate.details") }}</h5>
			</div>

			<div class="card-body card-bg-secondary">
				<table class="table mb-0 table-borderless">
					<tbody>
						<tr>
							<td class="table-fit font-weight-sixhundred">{{ trans("translate.slug") }}</td>
							<td>
								{{ $template['slug'] }}
							</td>
						</tr>
						<tr>
							<td class="table-fit font-weight-sixhundred">{{ trans("translate.description") }}</td>
							<td>
								{{ $template['description'] }}
							</td>
						</tr>
						<tr>
							<td class="table-fit font-weight-sixhundred">{{ trans("translate.template") }} {{ trans("translate.view") }}</td>
							<td> 
								{{ 'maileclipse::templates.'.$template['slug'] }}
							</td>
						</tr>
						<tr>
							<td class="table-fit font-weight-sixhundred">{{ trans("translate.template") }} {{ trans("translate.type") }}</td>
							<td>
								{{ ucfirst($template['template_type']) }}
							</td>
						</tr>
						<tr>
							<td class="table-fit font-weight-sixhundred">{{ trans("translate.template") }} {{ trans("translate.name") }}</td>
							<td>
								{{ ucfirst($template['template_view_name']) }}
							</td>
						</tr>
						<tr>
							<td class="table-fit font-weight-sixhundred">{{ trans("translate.template") }} {{ trans("translate.skeleton") }}</td>
							<td>
								{{ ucfirst($template['template_skeleton']) }}
							</td>
						</tr>
					</tbody>
					
				</table>
			</div>
		</div>
		
		<div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
				<textarea id="template_editor" cols="60" rows="40">{{ $template['template'] }}</textarea>
			</div>
		</div>	

	</div>	
</div>

<script type="text/javascript">

	$(document).ready(function(){

		var templateID = "{{ "template_view_".$template['slug'] }}";

		tinymce.init({
			selector: "textarea#template_editor",
			menubar : false,
			visual: false,
			height:600,
			inline_styles : true,
			plugins: [
					"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
					"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
					"save table directionality emoticons template paste fullpage code legacyoutput"
			],
			content_css: "",
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image fullpage table | forecolor backcolor emoticons | preview | code",
			fullpage_default_encoding: "UTF-8",
			fullpage_default_doctype: "<!DOCTYPE html>",
			init_instance_callback: function (editor) 
			{
				editor.on('Change', function (e) {
					if ($('.save-draft').hasClass('disabled')){
						$('.save-draft').removeClass('disabled').text('Save Draft');
					}
				});

				if (localStorage.getItem(templateID) !== null) {
					editor.setContent(localStorage.getItem(templateID));
				}

				setTimeout(function(){ 
					editor.execCommand("mceRepaint");
				}, 2000);

			}
		});


		$('.save-template').click(function(){

			if (confirm('{{ trans("translate.template_update_question") }} ')) {

				axios.post('{{ route('parseTemplate') }}', {
						markdown: tinymce.get('template_editor').getContent(), viewpath: "{{ $template['slug'] }}", template: true
				})
				.then(function (response) {
					if (response.data.status == 'ok'){
						alert('{{ trans("translate.template_was_successfully_updated") }}');
						localStorage.removeItem(templateID);
					} else { alert('Template not updated'); }
				})
				.catch(function (error) { alert("Error: " + error); });
			}

		});

		$('.preview-toggle').click(function(){
			tinyMCE.execCommand('mcePreview');
			return false;
		});

	});
                
</script>
   
@endsection