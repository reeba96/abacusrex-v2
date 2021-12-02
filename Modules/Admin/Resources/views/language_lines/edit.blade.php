@extends('admin::admin.layouts.master')

@section('content')

    <div class="card">
  
        <div class="card-header">

            <div class="float-left">
                <h4>{{ !empty($title) ? $title : trans('translate.language_line') }}</h4>
            </div>
            <div class="btn-group btn-group-sm float-right" role="group">

                <a href="{{ route('language_lines.language_lines.index') }}" class="btn btn-primary" title="Show All Language Lines">
                    <i class="fas fa-list"></i>
                </a>

                <a href="{{ route('language_lines.language_lines.create') }}" class="btn btn-success" title="Create New Language Lines">
                    <i class="fas fa-plus-square"></i>
                </a>

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

            <form method="POST" action="{{ route('language_lines.language_lines.update', $languageLines->id) }}" id="edit_language_lines_form" name="edit_language_lines_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('admin::language_lines.form', [
                                        'languageLines' => $languageLines,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value='{{ trans('translate.update') }}'>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection