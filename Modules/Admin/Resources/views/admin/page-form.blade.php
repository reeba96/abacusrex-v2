    <?php
    $locale = app()->getLocale();

    $title = 'title_' . $locale;
    $page_title = $page->$title;
    $all_page = Modules\Admin\Entities\Page::all();
    $page_articles = $page->articles;
    $sharethis = Modules\Admin\Entities\CmsModule::where('name', 'ShareThis')->where('is_installed', true)->first();
    $qrcodegenerator = \Modules\Admin\Entities\CmsModule::where('name', 'QRCodeGenerator')->where('is_installed', true)->first();
    ?>


    @if ($page->id)
        <form action="{{route('page.update', ['id' => $page->id])}}" method="post">
        {{ method_field('PUT') }}
    @else
        <form action="{{route('page.store')}}" method="post">
    @endif
    {{csrf_field() }}

    <div class="row">

        <div class="card ml-3 w-100">
            <div class="card-header with-border" >
              <h3 class="card-title"><strong>{{ $page_title }}</strong></h3>
          </div>
          <!-- /.box-header -->
          <div class="card-body">

              <div class="col-md-1"></div>
              <table class="w-100">
                <tbody>

                    <tr>
                      <td><label for="posted" class="col-md-11 control-label">{{trans('translate.parent')}}</label></td>
                      <td>
                          <div class="col-md-8">
                              <select class="form-control" id="id_parent" name="parent_id">
                                <option value='0'> </option>
                                @foreach ($all_page as $parent)
                                    <option value='{{$parent->id}}' {{ $parent->id == $page->parent_id ? 'selected' : '' }}> {{ $parent->$title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                            <?php
                            if ($page->appears == 1) {
                                $appears = 'checked';
                            } else {
                                $appears = '';
                            }
                            ?>

                            <label for="nav" class="col-md-11 control-label">{{trans('translate.disp_in_nav') }}</label>

                        </td>

                        <td><div class="col-md-1">
                          <input type="checkbox" id="appears" name="appears" {{$appears}}>
                      </div>
                  </td>
              </tr>

              <tr>
                  <td style="width: 25%;"><label for="view" class="col-md-11 control-label">{{trans('translate.view')}}</label></td>
                  <td style="width: 25%;">
                      <div class="col-md-8">
                          <select class="form-control" id="view" name="view">
                            @foreach ($page_views as $view)
                              @if($view == $page->view)
                              <option value="{{$view}}" selected="selected">{{$view}}</<option>
                              @else
                                <option value="{{$view}}">{{$view}}</<option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                        </td>
                        <td style="width: 25%;">
                            <?php
                            if ($page->articles_nav == 1) {
                                $articles_nav = 'checked';
                            } else {
                                $articles_nav = '';
                            }
                            ?>

                            <label for="articles_nav" class="col-md-11 control-label">{{trans('translate.disp_article_in_nav')}}</label>

                        </td>
                        <td><div class="col-md-2">
                          <input type="checkbox" id="articles_nav" name='articles_nav' {{$articles_nav}}>
                      </div>
                  </td>
              </tr>

               <tr>
                  <td style="width: 25%;"><label for="access_level" class="col-md-11 control-label">{{trans('translate.user_permission')}}</label></td>
                  <td style="width: 25%;">
                        <div class="col-md-8">
                           {!! Form::select('permission_id', $page_permissions,  old('permission_id', optional($page)->permission_id), ['class'=>'form-control']) !!}
                         </div>
                    </td>
                    <td style="width: 25%;">
                        <?php
                        if ($page->bc == 1) {
                            $bc = 'checked';
                        } else {
                            $bc = '';
                        }
                        ?>

                        <label for="bc" class="col-md-11 control-label">{{trans('translate.show_bc')}}</label>

                    </td>

                  <td>
                  <div class="col-md-2">
                     <input type="checkbox" id="bc" name='bc' {{$bc}}>
                     </div>
                  </td>
               </tr>

               <tr>
                    


                   
                 <td style="width: 25%;"><label for="article_ordering" class="col-md-11 control-label">{{trans('translate.article_ordering')}}</label></td>
                 <td style="width: 25%;">
                     <div class="col-md-8">
                         <select class="form-control" id="ordering" name='article_ordering'>
                           <option value='1'>Order</option>
                           <option value='0'>Reverse order</option>
                                           <!-- REMOVED FROM REQUEST BECAUSE IT MUST BE BOOLEAN IN THE DATABASE
                                           <option>Date ascending</option>
                                           <option>Date descending</option>
                                       -->
                        </select>
                    </div>
                </td> 
                <td style="width: 25%;">
                    <label for="article_ordering" class="col-md-11 control-label">{{trans('translate.display_in_homepage')}}</label>
                </td>
                <td style="width: 25%;">
                    <div class="col-md-2">
                        <input type='checkbox' id="display_in_homepage" name='display_in_homepage' {{ $page->display_in_homepage ? 'checked' : '' }}>
                    </div>
                </td>

                           {{-- 
                           <td style="width: 25%;">
                          @php
                            if ($page->featured ==1 ) {
                               $featured = 'checked';
                           } else {
                               $featured = '';
                           }
                          @endphp

                           <label for="featured" class="col-md-11 control-label">{{trans('translate.featured')}}</label>

                       </td>

                       <td>
                            <div class="col-md-2">
                                <input type='checkbox' id="featured" name='featured' {{$featured}}>
                            </div>
                        </td>
                        --}}
               </tr>

               <tr>
                 <td style="width: 25%;"><label for='per_page' class='control-label col-md-11'>{{trans('translate.per_page')}}</label></td>
                 <td style="width: 25%;">
                     <div class="col-md-8">
                         <input type='text' class='form-control' id="per_page" name='per_page' value='{{ $page->per_page }}'>
                     </div>
                 </td>
                 <td style="width: 25%;">
                    {{--                   
                         <label for="languages" class="col-md-10 control-label">{{trans('translate.content_language')}}</label>
                    --}}

                   <?php
                   //$languages = Modules\Admin\Entities\Language::getLanguages();


                   ?>
               </td>
               <td>
                   {{-- <div class="col-md-8"> <select id='language' name='page_langs' class='form-control'>
                   @php $lang = $page->page_langs;@endphp
                   <option value='all'> All </option>
                   @foreach ($language_keys as $key => $code)
                     @if ($lang == $code && $lang != 'all')
                     <option value='{{ $code }}' selected>{{ $languages[$code]['name'] }}</option>
                     @else
                     <option value='{{ $code }}' >{{ $languages[$code]['name'] }}</option>
                     @endif
                   @endforeach
               </select> --}}
               </td>


               </tr>
               <tr>
                    @if( $sharethis && count($sharethis))
                         <td style="width: 25%;"><label for='share_this' class='control-label col-md-11'>{{trans('translate.share_this')}}</label></td>
                         <td style="width: 25%;">
                             <div class="col-md-8">
                                 <input type='checkbox' id="share_this" name='sharethis' {{ $page->sharethis ? 'checked' : '' }}>
                             </div>
                         </td>
                    @endif

                    @if( $qrcodegenerator && count($qrcodegenerator))
                         <td style="width: 25%;"><label for='qr_code_generator' class='control-label col-md-11'>{{trans('translate.qr_code_generator')}}</label></td>
                         <td style="width: 25%;">
                             <div class="col-md-8">
                                 <input type='checkbox' id="qr_code_generator" name='qrcode' {{ $page->qrcode ? 'checked' : '' }}>
                             </div>
                         </td>
                    @endif
               </tr>

                @if ($installed_modules)
                    @foreach($installed_modules as $im)
                        @if ($im->page_top)
                            <?php
                                $top = \App::call('\Modules\\' . $im->name . '\Http\Controllers\InstallController@get_page_top');
                                echo $top;
                            ?>
                        @endif
                    @endforeach
                @endif
         </tbody>
      </table>
   </div>
</div>
</div>

<div class="row">
<!-- TAB CONTENT -->
<div class="card ml-3 w-100">
    <div class="card-body">
        <div class="content">
            <ul class="nav nav-tabs" role="tablist">
                @foreach ($language_keys as $key => $code)
                    @if ($code == $locale)
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#{{ $code }}"> {{ $languages[$code]['name'] }}</a></li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#{{ $code }}"> {{ $languages[$code]['name'] }}</a></li>
                    @endif
                @endforeach
                <li class="nav-item"><a class="nav-link" data-toggle='tab' href='#meta'> Meta </a></li>
                @if ($installed_modules)
                    @foreach($installed_modules as $im)
                        @if ($im->page_tab)
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#{{ $im->name }}"> {{ $im->name }}</a></li>
                        @endif
                    @endforeach
                @endif
            </ul>
            <div class="col-md-12">
                <div class="tab-content  mt-3">

                    
                        @foreach ($language_keys as $key => $code)
                        @if ($code == $locale)
                            <div id="{{ $code }}" class="content tab-pane fade in active show">
                        @else
                            <div id="{{ $code }}" class="content tab-pane fade">
                        @endif
                                <div class="form-group row">
                                    <label for="title_{{$code}}" class="col-md-2 control-label">{{trans('translate.title')}}: </label>
                                    <div class="col-md-10">
                                        <?php $title = 'title_' . $code; $page_title = $page->$title; ?>
                                        <input type='text' name="title_{{$code}}" id="title_{{$code}}" class='form-control' value='{{ $page_title}} '>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="url_{{$code}}" class="col-md-2 control-label">URL auto: <input type="checkbox" name="auto_{{$code}}" id="auto_{{$code}}" /></label>
                                    <div class="col-md-10">
                                        <?php $url = 'url_' . $code; $page_url = $page->$url; ?>
                                        <input type='text' id='url_{{$code}}' name='url_{{$code}}' class='form-control' value='{{$page_url}}'>
                                    </div>
                                </div>
                                @if ($installed_modules)
                                @foreach ($installed_modules as $im)
                                    @if ($im->page_content)
                                        @php
                                            \App::call('\Modules\\' . $im->name . '\Http\Controllers\InstallController@get_page_content');
                                        @endphp
                                    @endif
                                @endforeach
                                @endif

                            </div>
                            @endforeach

                            <div id="meta" class="content tab-pane fade">
                                    <div class="card card-body">
                                        <ul class="nav nav-tabs" role="tablist">
                                            @foreach ($language_keys as $key => $code)
                                                @if ($code == $locale)
                                                    <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#desc_{{ $code }}"> {{  $languages[$code]['name'] }}</a></li>
                                                @else
                                                    <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#desc_{{ $code }}">{{  $languages[$code]['name'] }}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                
                                        <div class='tab-content mt-3'>
                                            
                                            @foreach ($language_keys as $key => $code)
                                                @if ($code == $locale)
                                                    <div id="desc_{{ $code }}" class="content tab-pane fade in active show">
                                                @else
                                                    <div id="desc_{{ $code }}" class="content tab-pane fade">
                                                @endif
                                                    <div class="form-group row">
                                                        <label for="description_{{$code}}" class="col-md-2 control-label text-right">{{__('translate.description')}}: </label>
                                                        <div class="col-md-10">
                                                            <?php 
                                                                $meta_desc = 'description_' . $code; 
                                                                $desc = $page->$meta_desc; 
                                                            ?>
                                                            <textarea type='text' name="{{$meta_desc}}" id="{{$meta_desc}}" class='form-control' value=' '>{{ $desc}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            
                                        </div>
                            </div>

                            @if ($installed_modules)
                                @foreach($installed_modules as $im)
                                    @if ($im->page_tab)
                                    <?php
                                        $tab = \App::call('\Modules\\' . $im->name . '\Http\Controllers\InstallController@get_page_tab');
                                    ?>
                                    <div id="{{ $im->name }}" class="content tab-pane fade">
                                        {!! $tab !!}
                                    </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div style="clear:both; height:60px;">
                    <span style="float:right;margin:10px 0;" >
                        <button type='submit' class='btn btn-primary'> Update</button>
                    </span>
                    <?php

                    if (count($languages) > 1) {
                        $loc = app()->getLocale();
                    } else {
                        $loc = app()->config->get('app.locale');
                    }
                    $url = 'url_' . $loc;
                    ?>
                    @if ($page->$url != 'home')
                    <span style="float:left;margin:10px 35px;" >
                        <button type='button' id='delete' data-toggle='modal' data-target='#delete_modal' class='btn btn-danger'> Delete </button>
                    </span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div> <!-- /panel-body -->
</div> <!-- /panel -->

<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="">Delete</h4>
            </div>
            <div class="modal-body">
                Are you sure to delete {{$page->$title}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn_delete_confirmed" class="btn btn-primary" data-id_page="{{$page->id}}">Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cancel_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_label" aria-hidden="true">
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
                <button type="button" id="btn_cancel_confirmed" data-id_page="page_id" class="btn btn-primary">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
$(function () {
   

console.log('aaa');
   

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
    
    <?php foreach ($language_keys as $key => $code ){?>
        var lang = '<?=$code?>';
        console.log( lang);
        if ( $("#url_"+lang).val() == make_slug($("#title_"+lang).val()) ){
                $("#auto_"+lang).attr('checked','checked');
        }
    <?php }?>
    
    var token = '{{ Session::token() }}';

    $('#btn_delete_confirmed').on("click", function(event){
        var id = $(this).data('id_page');
        $.ajax({
            url: "{{ route ('page.delete') }}",
            method: 'POST',
            data: {id: id, _token: token }
        }).done(function(msg) {
            if(msg['delete'] == 'success') {
                $('#delete_modal').modal('hide');
                $("#tree2").fancytree('getTree').reload();
                $('.modal-backdrop').remove();
                $('#response').html("The page removed successfully!");
            }
        });
    });

    
   
});
</script>
