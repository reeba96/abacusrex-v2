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
                <h4 class="">{{ trans("translate.roles") }}</h4>
            </div>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('roles.role.create') }}" class="btn btn-success" title={{ trans("translate.create") }}>
                    <i class="fas fa-plus-square"></i>
                </a>
            </div>

        </div>
        
        @if(count($rolesObjects) == 0)
            <div class="card-body text-center">
                <h4>{{ trans("translate.empty_space") }}</h4>
            </div>
        @else
        <div class="card-body card-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ trans("translate.name") }}</th>
                            <th>{{ trans("translate.guard_name") }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($rolesObjects as $roles)
                        <tr>
                            <td>{{ $roles->name }}</td>
                            <td>{{ $roles->guard_name }}</td>

                            <td>

                                <form method="POST" action="{!! route('roles.role.destroy', $roles->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs float-right" role="group">
                                        <a href="{{ route('roles.role.show', $roles->id ) }}" class="btn btn-info" title={{ trans("translate.show") }}>
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('roles.role.edit', $roles->id ) }}" class="btn btn-primary" title={{ trans("translate.edit") }}>
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title={{ trans("translate.delete") }} onclick='return confirm(&quot;{{ trans("translate.delete_confirm") }}&quot;)'>
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
            {!! $rolesObjects->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection