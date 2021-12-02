@extends('admin::admin.layouts.master')

@section('content')

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
                <h4>{{ trans('translate.language_line') }}</h4>
            </div>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('language_lines.language_lines.create') }}" class="btn btn-success" title='{{ trans("translate.create") }}'>
                    <i class="fas fa-plus-square"></i>
                </a>
            </div>

        </div>

        @if(count($languageLinesObjects) == 0)
            <div class="card-body text-center">
                <h4>{{ trans("translate.empty_space") }}</h4>
            </div>
        @else
        <div class="card-body card-body-with-table">
            <div class="table-responsive">
                <form method="POST" action="{{ route('language_lines.language_lines.filter') }}" id="filter_language_lines" name="filter_language_lines" accept-charset="UTF-8" class="form-horizontal">
                    {{ csrf_field() }}
                </form>
                <table class="table table-striped table-hover">
                    <thead>
                      
                            <tr>
                                <th>{{ trans("translate.group") }}<div>{{  Form::select('group_filter',$groups,$group_filter,['class'=>"form-control",'form'=>"filter_language_lines"]) }} </div></th>
                                <th>{{ trans("translate.key") }}<div>{{  Form::text('key_filter',$key_filter,['class'=>"form-control",'form'=>"filter_language_lines"]) }} </div></th>
                                <th><div class="flag {{$locale}}"></div> {{ __('language_line.translated_text') }}</th>
                                <th><button type="submit" form="filter_language_lines" class="btn btn-success float-right"><i class="fas fa-filter"></i> {{ __('translate.filter') }}</button></th>
                            </tr>

                       
                    </thead>
                    <tbody>
                    @foreach($languageLinesObjects as $languageLines)
                        <tr>
                            <td>{{ $languageLines->group }}</td>
                            <td>{{ $languageLines->key }}</td>
                            <td>{{ json_decode($languageLines->text)->$locale }}</td>
                            <td>

                                <form method="POST" action="{!! route('language_lines.language_lines.destroy', $languageLines->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs float-right" role="group">
                                        <a href="{{ route('language_lines.language_lines.show', $languageLines->id ) }}" class="btn btn-info" title='{{ trans("translate.show") }}'>
                                            <i class="fas fa-eye"></i>

                                        </a>
                                        <a href="{{ route('language_lines.language_lines.edit', $languageLines->id ) }}" class="btn btn-primary" title='{{ trans("translate.edit") }}'>
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

        <div class="card-footer">
            {!! $languageLinesObjects->appends($data)->render() !!}
        </div>

        @endif

    </div>
@endsection
