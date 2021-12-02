@extends('admin::admin.layouts.master')

@section('content')

    <div class="card">
  
        <div class="card-header">

            <div class="float-left">
                <h4>{{ $setting->name }}</h4>
            </div>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('update.settings') }}" accept-charset="UTF-8" class="form-horizontal">
                {{ csrf_field() }}
                <input name="id" value="{{ $setting['id'] }}" type="hidden">

                <div class="form-group">
                    <label for="name" class="col-md-2 control-label">{{ trans("translate.name") }}</label>
                    <div class="col-md-8">
                        <input class="form-control" name="name" type="text" id="name" value="{{ $setting->name }}" minlength="1" maxlength="255" required="true" placeholder='{{ trans("translate.name") }}'>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="content" class="col-md-2 control-label">{{ trans("translate.content") }}</label>
                    <div class="col-md-8">
                        <input class="form-control" name="content" type="text" id="content" value="{{ $setting->content }}" minlength="1" maxlength="255" required="true" placeholder='{{ trans("translate.content") }}'>
                    </div>
                </div>

                <div class="form-group">
                    <label for="type" class="col-md-2 control-label">{{ trans("translate.type") }}</label>
                    <div class="col-md-8">
                        <select class="form-control" name="type">
                            @if($setting->type == 'meta')
                                <option selected="selected" value="meta">meta</option>
                                <option value="config">config</option>
                                <option value="begin_of_head">begin_of_header</option>
                                <option value="end_of_header">end_of_header</option>
                                <option value="begin_of_body">begin_of_body</option>
                                <option value="end_of_body">end_of_body</option>
                                <option value="script">script</option>
                            @elseif($setting->type == 'config')
                                <option selected="selected" value="config">config</option>
                                <option value="meta">meta</option>
                                <option value="begin_of_head">begin_of_header</option>
                                <option value="end_of_header">end_of_header</option>
                                <option value="begin_of_body">begin_of_body</option>
                                <option value="end_of_body">end_of_body</option>
                                <option value="script">script</option>
                            @elseif($setting->type == 'begin_of_head')
                                <option selected="selected" value="begin_of_head">begin_of_header</option>
                                <option value="config">config</option>
                                <option value="meta">meta</option>
                                <option value="end_of_header">end_of_header</option>
                                <option value="begin_of_body">begin_of_body</option>
                                <option value="end_of_body">end_of_body</option>
                                <option value="script">script</option>
                            @elseif($setting->type == 'end_of_header')
                                <option selected="selected" value="end_of_header">end_of_header</option>
                                <option value="config">config</option>
                                <option value="meta">meta</option>
                                <option value="begin_of_head">begin_of_header</option>
                                <option value="begin_of_body">begin_of_body</option>
                                <option value="end_of_body">end_of_body</option>
                                <option value="script">script</option>
                            @elseif($setting->type == 'begin_of_body')
                                <option selected="selected" value="begin_of_body">begin_of_body</option>
                                <option value="config">config</option>
                                <option value="meta">meta</option>
                                <option value="begin_of_head">begin_of_header</option>
                                <option value="end_of_header">end_of_header</option>
                                <option value="end_of_body">end_of_body</option>
                                <option value="script">script</option>
                            @elseif($setting->type == 'end_of_body')
                                <option selected="selected" value="end_of_body">end_of_body</option>
                                <option value="config">config</option>
                                <option value="meta">meta</option>
                                <option value="begin_of_head">begin_of_header</option>
                                <option value="end_of_header">end_of_header</option>
                                <option value="begin_of_body">begin_of_body</option>
                                <option value="script">script</option>
                            @elseif($setting->type == 'script')
                                <option selected="selected" value="script">script</option>
                                <option value="config">config</option>
                                <option value="meta">meta</option>
                                <option value="begin_of_head">begin_of_header</option>
                                <option value="end_of_header">end_of_header</option>
                                <option value="begin_of_body">begin_of_body</option>
                                <option value="end_of_body">end_of_body</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8">
                        <label>
                            @if($setting->enabled == 1)
                                <input type='checkbox' name="is_online" checked> {{ trans("translate.enabled") }}
                            @else 
                                <input type='checkbox' name="is_online"> {{ trans("translate.enabled") }}
                            @endif
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value='{{ trans("translate.update") }}'>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection