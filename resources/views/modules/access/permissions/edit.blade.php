@extends('admin::admin.layouts.master')

@section('content')

    <div class="card">
  
        <div class="card-header">

            <div class="float-left">
                <h4>{{ !empty($permissions->name) ? $permissions->name : 'Permissions' }}</h4>
            </div>
            <div class="btn-group btn-group-sm float-right" role="group">

                <a href="{{ route('permissions.permission.index') }}" class="btn btn-primary" title={{ trans("translate.show_all") }}>
                    <i class="fas fa-list"></i>
                </a>

                <a href="{{ route('permissions.permission.create') }}" class="btn btn-success" title={{ trans("translate.create") }}>
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

            <form method="POST" action="{{ route('permissions.permission.update', $permissions->id) }}" id="edit_permissions_form" name="edit_permissions_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('access::permissions.form', [
                                        'permissions' => $permissions,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value={{ trans("translate.update") }}>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection