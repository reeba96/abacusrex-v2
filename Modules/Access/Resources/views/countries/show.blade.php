@extends('admin::admin.layouts.master')

@section('content')

<div class="card">
    <div class="card-header">

        <span class="float-left">
            <h4>{{ isset($title) ? $title : trans('translate.countries') }}</h4>
        </span>

        <div class="float-right">

            <form method="POST" action="{!! route('countries.country.destroy', $countries->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('countries.country.index') }}" class="btn btn-primary" title='{{ trans("translate.show_all") }}'>
                        <i class="fas fa-list"></i>
                    </a>

                    <a href="{{ route('countries.country.create') }}" class="btn btn-success" title='{{ trans("translate.create") }}'>
                        <i class="fas fa-plus-square"></i>
                    </a>
                    
                    <a href="{{ route('countries.country.edit', $countries->id ) }}" class="btn btn-primary" title='{{ trans("translate.edit") }}'>
                        <i class="fas fa-edit"></i>
                    </a>

                    <button type="submit" class="btn btn-danger" title='{{ trans("translate.delete") }}' onclick='return confirm(&quot;{{ trans("translate.delete_confirm") }}&quot;)'>
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>{{ trans("translate.created_at") }}</dt>
            <dd>{{ $countries->created_at }}</dd>
            <dt>{{ trans("translate.name") }} (de)</dt>
            <dd>{{ $countries->name_de }}</dd>
            <dt>{{ trans("translate.name") }} (en)</dt>
            <dd>{{ $countries->name_en }}</dd>
            <dt>{{ trans("translate.name") }} (hu)</dt>
            <dd>{{ $countries->name_hu }}</dd>
            <dt>{{ trans("translate.last_update") }}</dt>
            <dd>{{ $countries->updated_at }}</dd>
        </dl>

    </div>
</div>

@endsection