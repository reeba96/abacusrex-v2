<?php
$locale = app()->getLocale();

$title = 'title_' . $locale;
$article_title = $article->$title;
?>

<body>

    @if ($article->id)
        <form action="{{route('article.update', ['id' => $article->id])}}" method="post">
        {{ method_field('PUT') }}
    @else
        <form action="{{route('article.store')}}" method="post">
    @endif

    {{csrf_field() }}
   
    <div class="row">

        <div class="card shadow-sm ml-3 w-100">
            <div class="card-header with-border" >
                <h3 class="card-title"><strong>{{ $article_title }}</strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">

              <div class="row">
                  <div class='col-md-offset-1 col-md-6'>

                    @include('admin::admin.article_linked_pages', ['article' => $article])

                    <div class="form-group row">
                          <label for="posted" class="col-sm-4 col-form-label text-right">{{trans('translate.posted')}}</label>
                          <div class="col-sm-8">
                              <input type='text' class='form-control' name='start_date' id='posted' value="{{ $article->start_date }}">
                          </div>
                    </div>
                    <div class="form-group row">
                           <label for="online" class="col-sm-4 col-form-label text-right">{{trans('translate.online')}}</label>
                           <div class="col-sm-8">
                                <input type='text' class='form-control' id='online' name='end_date' value="{{ $article->end_date }}">
                          </div>
                    </div>
                    <div class='form-group row'>
                        <label for="view" class="control-label col-sm-4 col-form-label text-right">{{trans('translate.view')}}</label>
                        <div class="col-sm-8">
                        
                            <select class="form-control" id="view" name='view'>
                                @foreach ($article_views as $view)
                                  @if ($article->view == $view)
                                    <option value="{{$view}}" selected>{{$view}}</option>
                                  @else
                                    <option value="{{$view}}">{{$view}}</option>
                                  @endif
                                @endforeach
                             </select>
                         </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <?php
                        if ($article->archive == 1) {
                            $checked = 'checked';
                        } else {
                            $checked = '';
                        }
                    ?>
                    <div class='form-group'>
                        <label for="nav" class="control-label col-sm-12">{{trans('translate.archive') }}
                            <input type="checkbox" class="ml-3" id="archive" name="archive" {{$checked}}>
                        </label>
                    </div>

                    @if (!isset($article->id))
                    <div class='form-group'>
                            <label for="published" class="control-label col-sm-12">{{trans('translate.published') }}
                                <input type="checkbox" class="ml-3" value="1" id="published" name="published">
                            </label>
                        </div>
                    @endif

                  </div>
                  @if ($installed_modules)
                    @foreach($installed_modules as $im)
                        @if ($im->article_top)
                            <?php
                                //$top = \App::call('\CMS\cms_apps\\' . $im->name . '\Controllers\Install@get_article_top');
                               // echo $top;
                            ?>
                        @endif
                    @endforeach
                @endif <!-- end of row-->
                </div>
            </div>
        </div>
    </div>
    @if (in_array('Tag',$enabled_modules))
        @php
             $article_tags = $article->tagsTranslated()->get()->pluck('name');
            $tags = \Modules\Tag\Entities\Tag::where('type','article')->get();
            $tag_options = [];
            foreach( $tags as $tag){
                //dump($tag->name);
                $tag_arr = json_decode($tag->name);

                //dump($tag_arr->$locale);
                if (isset($tag_arr->$locale))
                    $tag_options[$tag_arr->$locale] = $tag_arr->$locale;

            }
            dump($tag_options);
           // dump($tags);
            
        @endphp
        <div class="row">
                <div class="card shadow-sm ml-3 w-100 pt-3 pl-3">
                    <div class='form-group'>
                        <label>{{__('translate.tags')}}</label> {!! Form::select('tags[]',$tag_options, $article_tags, ['multiple'=>'multiple','id' => 'tags']) !!}
                   
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('#tags').multiselect({
                                enableFiltering: true,
                                numberDisplayed: 8,
                                nonSelectedText: '{{__("translate.None_selected")}}',
                                nSelectedText: '{{__("translate.selected")}}',
                                allSelectedText: '{{__("translate.All_selected")}}',
                                filterPlaceholder: '{{__('translate.tags_filter')}}',
                                templates: {
                                    
                                   
                                   
                                    filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="fas fa-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
                                    filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default multiselect-clear-filter" type="button"><i class="fas fa-eraser"></i></button></span>',
                                   
                                }
                            });
                            });
                        </script>
                    </div>
                </div>
        </div>
    @endif

    <!-- OLD TAB -->
    <div class="row">

        <div class="card shadow-sm ml-3 w-100">
            <div class="card-body">

                <ul class="nav nav-tabs mt-3"  role="tablist">
                    @foreach ($language_keys as $key => $code)
                        @if ($code == $locale)
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#{{ $code }}"> {{ $languages[$code]['name'] }}</a></li>
                        @else
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#{{ $code }}"> {{ $languages[$code]['name'] }}</a></li>
                        @endif
                    @endforeach

                    <!-- Module extensions -->
                    @if ($installed_modules)
                        @foreach($installed_modules as $im)
                            @if ($im->article_tab)
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#{{ $im->name }}"> {{ $im->name }}</a></li>
                            @endif
                        @endforeach
                    @endif
                    @if( $article->id )
                        <li class="nav-item" style="float:right"><a class="nav-link" data-toggle="tab" href="#files"><i class="fa fa-paperclip"></i>  {{trans('translate.files') }}</a></li>
                    @endif
                </ul>

                <div class="tab-content">

                    @if( $article->id )
                    <div id="files" class="content tab-pane fade">

                            @include ('admin::admin.FineUpload.upload-form')

                    </div>
                    @endif

                    @foreach ($language_keys as $key => $code)
                    @if ($code == $locale)
                    <div id="{{ $code }}" class="content tab-pane fade in active show" >
                        @else
                        <div id="{{ $code }}" class="content tab-pane fade">
                            @endif

                            <?php
                            $title = 'title_' . $code;
                            $article_title = $article->$title;

                            $subtitle = 'subtitle_' . $code;
                            $article_subtitle = $article->$subtitle;

                            $author = 'author_' . $code;
                            $article_author = $article->$author;

                            $url = 'url_' . $code;
                            $article_url = $article->$url;



                            ?>
                            <br>
                            <div class="form-group row">
                                <label for="title_{{$code}}" class="col-md-2 col-form-label text-right">{{trans('translate.title')}}: </label>
                                <div class="col-md-10">
                                    <input type='text' id="title_{{$code}}" name="title_{{$code}}" class='form-control' value='{{ $article_title }}'>
                                </div>
                            </div>
                            <div class="form-group row"">
                                <label for="subtitle_{{$code}}" class="col-md-2 col-form-label text-right">{{trans('translate.subtitle')}}: </label>
                                <div class="col-md-10">
                                    <input type='text' id="subtitle_{{$code}}" name="subtitle_{{$code}}" class='form-control' value='{{$article_subtitle}}'>
                                </div>
                            </div>
                            <div class="form-group row">
                            
                                <label for="author_{{$code}}"  class="col-md-2 col-form-label text-right">{{trans('translate.author')}}: </label>
                                <div class="col-md-10">
                                    <input type='text' id="author_{{$code}}" name="author_{{$code}}" class='form-control' value='{{ $article_author }} '>
                                </div>
                            </div>
                            <div class="form-group row">
                                
                                <label for="url_{{$code}}" class="col-md-2 col-form-label text-right">URL auto: <input type="checkbox" name="auto_{{$code}}" id="auto_{{$code}}" /></label>
                                <div class="col-md-10">
                                    <input type='text' id='url_{{$code}}' name='url_{{$code}}' class='form-control' value='{{ $article_url}}'>
                                </div>
                            </div>

                            <!-- Module content -->
                            @if ($installed_modules)
                                @foreach($installed_modules as $im)
                                    @if ($im->article_content)
                                        <?php
                                            //$top = \App::call('\CMS\cms_apps\\' . $im->name . '\Controllers\Install@get_article_content');
                                        // echo $top;
                                        ?>
                                    @endif
                                @endforeach
                            @endif <!-- end of row-->
                            <!-- end of Module contnet-->

                            <div class="form-group col-md-12">

                                <?php
                                $content = 'content_' . $code;
                                $article_content = $article->$content;
                                ?>
                                   
                               
                                <textarea name="content_{{$code }}" id="content_{{ $code }}" name="content_{{ $code }}" rows="10" cols="80">
                                {!! $article_content !!}
                                </textarea>
                              
                            </div>
                        </div>
                        @endforeach
                        <!-- Module extension -->
                        @if ($installed_modules)
                            @foreach($installed_modules as $im)
                                @if ($im->article_tab)
                                    <div id="{{ $im->name }}" class="content tab-pane fade">
                                        {!! $im->name /* \App::call('\CMS\cms_apps\\' . $im->name . '\Controllers\Install@get_article_tab');*/ !!} -->
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
<!-- END OF OLD TAB -->

        <div style="clear:both; height:60px;">
            <span style="float:right;margin-right:30px;" >
                <button type='submit' id='update' class='btn btn-primary'> {{trans('translate.update') }} </button>
            </span>
            <span style="float:left;margin:10px 35px;" >
                <button type='button' id='delete' data-toggle='modal' data-target='#delete_modal' class='btn btn-danger'>{{trans('translate.delete') }}</button>
            </span>
        </div>
</form>
          </div>

{{-- MODALS --}}

<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="">{{trans('translate.delete') }}</h4>
                </div>
                <div class="modal-body">
                    {{ trans('translate.are_you_sure_to_delete') }} {{$article->$title}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="btn_delete_confirmed" class="btn btn-primary" data-article_id="{{$article->id}}">{{trans('translate.delete') }}</button>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="cancel_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="">Modal cancel title</h4>
                </div>
                <div class="modal-body">
                    Cancel confirm
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="btn_cancel_confirmed"  class="btn btn-primary">Cancel</button>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- editor modal --}}
    <div class="modal fade" id="edit_file_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{trans('translate.change_file') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    
                </div>
                <div class="modal-body">
                    <div id="edit_modal_body"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('translate.cancel') }}</button>
                    <button type="button" id="btn_file_edit_confirmed"  class="btn btn-primary" data-id="">{{trans('translate.save') }}</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end of editor modal --}}
</body>
<script>
    $(function () {

        tinymce.remove();
        @foreach ($language_keys as $key => $code)
        
            tinymce.init({
                selector: "#content_{{ $code }}",
                /*theme: "modern",*/height: 400,
                plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                        "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
                ],
                toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
                //  toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
                image_advtab: true ,

                external_filemanager_path:"/filemanager/",
                filemanager_title: "Responsive Filemanager",
                external_plugins: {
                    "responsivefilemanager": "/tinymce/plugins/responsivefilemanager/plugin.min.js",
                "filemanager": "/filemanager/plugin.min.js"
                },

                });
        @endforeach


        function make_slug( str ){
            str = str.toLowerCase();
            var from= "àáäâèéëêìíïîòóöôùúüûőűčćšđž";
            var to     = "aaaaeeeeiiiioooouuuuouccsdz";
            for (var i=0, l=from.length ; i<l ; i++) {
              str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }
            str = str.replace(/[^a-z0-9]+/g, '-');
            str = str.replace(/^-|-$/g, '');
            str = str.replace('---', '-');
            return str;
        }

        /* url generation trigger */
	$("[id^='title_']").on('keyup mousedown', function(event) {
            s = $(this).val();
            id = $(this).attr('id');
            lang =  id.substring(6);
            if ( $("#auto_"+lang).is(':checked') ){
                title = make_slug(s);
                $("#url_"+lang).val(title);
            }
        });

         $("[id^='auto_']").change(function(event) {
            if ( $(this).is(':checked') ) {
                id = $(this).attr('id');
                lang = id.substring(5);
                title = make_slug( $("#title_"+lang).val() );
                $("#url_"+lang).val(title);
            }
         });

         $("[id^='url_']").keyup(function(event) {
                s = $(this).val();
                id = $(this).attr('id');
                lang = id.substring(4);
                if ( $(this).val() == make_slug($("#title_"+lang).val()) ){
                    $("#auto_"+lang).attr('checked','checked');
                }
                else {
                    $("#auto_"+lang).removeAttr('checked');
                }
         });

         <?php

         foreach ($language_keys as $key => $code ):?>
            var lang = '<?=$code?>';
            if ( $("#url_"+lang).val() == make_slug($("#title_"+lang).val()) ){
                    $("#auto_"+lang).attr('checked','checked');
            }
         <?php endforeach;?>

        $("#posted").datepicker({
            dateFormat: 'yy-mm-dd',
            weekStart: 1,
            todayHighlight: true
        });

        $("#online").datepicker({
            dateFormat: 'yy-mm-dd',
            weekStart: 1,
            todayHighlight: true
        });

        var token = '{{ Session::token() }}';


        $('.btn_media').click(function(event) {
            var id = $(this).data('id');
            var src = $(this).data('file');
            $("#edit_modal_body").load( "{{ route('get.media.for.edit') }}", {id: id, _token: token} );
        });

        $('#btn_delete_confirmed').on('click', function() {
           var article_id = $(this).data('article_id');
           $.ajax({
               url: "{{ route('article.delete') }}",
               method: "POST",
               data: {id: article_id, parent: "{{$page_id}}", _token: token}
           }).done(function(msg) {
                if(msg['delete'] == 'success') {
                    $('#delete_modal').modal('hide');
                    $("#tree").fancytree('getTree').reload();
                    $(".modal-backdrop").remove();
                    $("#response").html("The article removed successfully!");
                 }
            });
        });

        



    });
</script>
