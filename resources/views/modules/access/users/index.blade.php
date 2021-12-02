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
                <h4>{{ trans("translate.users") }}</h4>
            </div>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('users.user.create') }}" class="btn btn-success" title={{ trans("translate.create") }}>
                    <i class="fas fa-plus-square"></i>
                </a>
            </div>

        </div>
        
        @if(count($users) == 0)
            <div class="card-body text-center">
                <h4>{{ trans("translate.empty_space") }}</h4>
            </div>
        @else
        <div class="card-body card-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <form method="POST" action="{{ route('users.user.filter') }}" id="filter_users" name="filter_users" accept-charset="UTF-8" class="form-horizontal">
                                {{ csrf_field() }}
                                <th>{{ trans("translate.firstname") }}  {{  Form::text('firstname_filter',$firstname_filter,['class'=>"form-control"]) }}</th>
                                <th>{{ trans("translate.lastname") }}  {{  Form::text('lastname_filter',$lastname_filter,['class'=>"form-control"]) }}</th>
                                <th>{{ trans("translate.email") }} {{  Form::text('email_filter',$email_filter,['class'=>"form-control"]) }}</th> 
                                <th>{{ trans("translate.created_at") }}</th>
                                <th>{{ trans("translate.confirmed") }}</th>
                                <th><button type="submit" class="btn btn-success float-right"><i class="fas fa-filter"></i> {{ __('translate.filter') }}</button></th>
                             </form>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->firstname }}</td>
                            <td>{{ $user->lastname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ ($user->confirmed) ? trans("translate.yes") : trans("translate.no") }}</td>
                            <td>
                                <form method="POST" action="{!! route('users.user.destroy', $user->id) !!}" accept-charset="UTF-8">
                                    <input name="_method" value="DELETE" type="hidden">
                                    {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs float-right" role="group">
                                        <a href="{{ route('users.user.show', $user->id ) }}" class="btn btn-info" title={{ trans("translate.show") }}>
                                            <i class="fas fa-eye"></i>

                                        </a>
                                        <a href="{{ route('users.user.edit', $user->id ) }}" class="btn btn-primary" title={{ trans("translate.edit") }}>
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
            {!! $users->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection