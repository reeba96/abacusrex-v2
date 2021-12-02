@extends('admin::admin.layouts.master')

@section('content')

<div class="card">
    <div class="card-header">

        <span class="float-left">
            <h4>{{ isset($permissions->name) ? $permissions->name : 'Permissions' }}</h4>
        </span>

        <div class="btn-group btn-group-sm float-right" role="group">

            <form method="POST" action="{!! route('permissions.permission.destroy', $permissions->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('permissions.permission.index') }}" class="btn btn-primary" title='{{ trans("translate.show_all") }}'>
                        <i class="fas fa-list"></i>
                    </a>

                    <a href="{{ route('permissions.permission.create') }}" class="btn btn-success" title='{{ trans("translate.create") }}'>
                        <i class="fas fa-plus-square"></i>
                    </a>
                    
                    <a href="{{ route('permissions.permission.edit', $permissions->id ) }}" class="btn btn-primary" title='{{ trans("translate.edit") }}'>
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
            <dt>{{ trans("translate.name") }}</dt>
            <dd>{{ $permissions->name }}</dd>
            <dt>{{ trans("translate.guard_name") }}</dt>
            <dd>{{ $permissions->guard_name }}</dd>
            <dt>{{ trans("translate.created_at") }}</dt>
            <dd>{{ $permissions->created_at }}</dd>
            <dt>{{ trans("translate.last_update") }}</dt>
            <dd>{{ $permissions->updated_at }}</dd>
        </dl>

    </div>
</div>

@endsection
