<?php 
    $page_views = app()->config->get('theme.page_views');
    $sharethis = CMS\admin\Module::where('name', 'ShareThis')->where('is_installed', true)->first();
    $qrcodegenerator = CMS\admin\Module::where('name', 'QRCodeGenerator')->where('is_installed', true)->first();
    
    
?>
<div class="content">
    <h3><strong>{{trans('translate.create_new_page') }}</strong></h3>
</div>
<form action="{{route('store.page')}}" method="post">
    {{csrf_field() }}
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="id_parent" class="col-md-6 control-label">{{trans('translate.parent')}}</label>
                <div class="col-md-6">
                    <?php
                    $all_page = CMS\admin\Page::all();
                    ?>

                    <select class="form-control" id="id_parent" style="width:160px;" name="parent_id">
                        <option value='0'> </option>
                        @foreach ($all_page as $parent)
                            <option value='{{$parent->id}}' {{ $parent->id == $page_id ? 'selected' : '' }}> {{ $parent->title_en }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="view" class="col-md-6 control-label">{{trans('translate.view')}}</label>
                <div class="col-md-6">
                    <select class="form-control" id="view" name="view" style="width:160px;">
                        @foreach ($page_views as $view)
                          <option value="{{ $view }}">{{ $view }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- REMOVED FROM REQUEST-->

            <div class="form-group">
                <label for="access_level" class="col-md-6 control-label">{{trans('translate.access_group')}}</label>
                <div class="col-md-6">
                    <select class="form-control" id="hozzaferes"  style="width:160px;">
                        <option>{{trans('translate.admin') }}</option>
                        <option>{{trans('translate.editor') }}</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="article_ordering" class="col-md-6 control-label">{{trans('translate.article_ordering')}}</label>
                <div class='col-md-6'>
                    <select class="form-control" id="ordering" name='article_ordering' style="width:160px;">
                        <option value='1'>{{trans('translate.order') }}</option>
                        <option value='0'>{{trans('translate.reverse_order') }}</option>
                        <!-- REMOVED FROM REQUEST BECAUSE IT MUST BE BOOLEAN IN THE DATABASE
                        <option>Date ascending</option>
                        <option>Date descending</option>
                        -->
                    </select>
                </div>
            </div>
            <div class='form-group'>
                <label for='per_page' class='control-label col-md-6'>{{trans('translate.per_page')}}</label>
                <div class='col-md-6'>
                    <input type='text' class='form-control' id="per_page" name='per_page' style="width:160px;">
                </div>
            </div>
        </div> <!-- end first row -->
        <div class="col-md-offset-1 col-md-5">
            <div class="form-group">
                <label for="nav" class="col-md-10 control-label">{{trans('translate.disp_in_nav')}}</label>
                <div class="col-md-2">
                    <input type="checkbox" id="nav" name='appears'>
                </div>
            </div>
            <div class="form-group">
                <label for="articles_nav" class="col-md-10 control-label">{{trans('translate.disp_article_in_nav')}}</label>
                <div class="col-md-2">
                    <input type="checkbox" id="articles_nav" name='articles_nav' >
                </div>
            </div>

            <div class="form-group">
                <label for="bc" class="col-md-10 control-label">{{trans('translate.show_bc')}}</label>
                <div class="col-md-2">
                    <input type="checkbox" id="bc" name='bc' >
                </div>
            </div>
            <div class="form-group">
                <label for="featured" class="col-md-10 control-label">{{trans('translate.featured')}}</label>
                <div class="col-md-2">
                    <input type='checkbox' id="featured" name='featured'>
                </div>
            </div>
            <?php
            $languages = CMS\admin\Language::getLanguages();
            ?>
            <div class="form-group">
                <label for="languages" class="col-md-10 control-label">{{trans('translate.content_language')}}</label>
                <div class='col-md-2'>
                    <select id='language' name='page_langs'>
                        <option value='all'>All</option>
                        @foreach($languages as $language)
                        <option value='{{$language['code']}}'>{{$language['name']}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            @if(count($sharethis))
                <div class="form-group">
                    <label for="share_this" class="col-md-10 control-label">{{trans('translate.share_this')}}</label>
                    <div class="col-md-2">
                        <input type='checkbox' id="share_this" name='sharethis'>
                    </div>
                </div>
            @endif
            @if(count($qrcodegenerator))
                <div class="form-group">
                    <label for="qr_code_generator" class="col-md-10 control-label">{{trans('translate.qr_code_generator')}}</label>
                    <div class="col-md-2">
                        <input type='checkbox' id="qr_code_generator" name='qrcode'>
                    </div>
                </div>
            @endif
        </div> <!-- /row -->
    </div>

    <div class="content">
        <ul class="nav nav-tabs">
            <?php $locale = app()->getLocale(); ?>
            @foreach ($languages as $language)
            @if ($language['code'] == $locale)
            <li class="active"><a data-toggle="tab" href="#{{ $language['code'] }}"> {{ $language['name'] }}</a></li>
            @else
            <li><a data-toggle="tab" href="#{{ $language['code'] }}"> {{ $language['name'] }}</a></li>
            @endif
            @endforeach
            <li><a data-toggle='tab' href='#meta'> {{trans('translate.meta') }} </a></li>
        </ul>

        <div class="tab-content">

            <div id="meta" class="content tab-pane fade">
                <ul class="nav nav-tabs">
                    @foreach ($languages as $language)
                    @if ($language['code'] == $locale)
                    <li class="active"><a data-toggle="tab" href="#desc_{{ $language['code'] }}"> {{ $language['code'] }}</a></li>
                    @else
                    <li><a data-toggle="tab" href="#desc_{{ $language['code'] }}"> {{ $language['code'] }}</a></li>
                    @endif
                    @endforeach
                </ul>

                <div class='tab-content'>
                    @foreach ($languages as $language)
                        @if ($language['code'] == $locale)
                            <div id="desc_{{ $language['code'] }}" class="content tab-pane fade in active">
                        @else
                            <div id="desc_{{ $language['code'] }}" class="content tab-pane fade">
                        @endif
                        <div class="form-group col-md-12">
                            <label for="description_{{$language['code']}}" class="col-md-2 control-label">{{trans('translate.description') }}: </label>
                                <div class="col-md-10">
                                    <input type='text' name="description_{{$language['code']}}" id="description_{{$language['code']}}" class='form-control' '>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @foreach ($languages as $language)
                @if ($language['code'] == $locale)
                    <div id="{{ $language['code'] }}" class="content tab-pane fade in active">
                @else
                    <div id="{{ $language['code'] }}" class="content tab-pane fade">
                @endif
                <div class="form-group col-md-12">
                    <label for="title_{{$language['code']}}" class="col-md-2 control-label">{{trans('translate.title')}}: </label>
                    <div class="col-md-10">
                        <input type='text' name="title_{{$language['code']}}" id="title_{{$language['code']}}" class='form-control'>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="url_{{$language['code']}}" class="col-md-2 control-label">URL auto: <input type="checkbox" name="auto_{{$language['code']}}" id="auto_{{$language['code']}}" /></label>
                        <div class="col-md-10">
                            <input type='text' id='url_{{$language['code']}}' name='url_{{$language['code']}}' class='form-control'>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
            <div style="clear:both; height:60px;">
                <span style="float:right;margin:10px 0;" >
                    <button type='submit' class='btn btn-primary'> {{trans('translate.save')}}</button>
                </span>
            </div>
            </form>
        </div> <!-- /panel-body -->
    </div> <!-- /panel -->
