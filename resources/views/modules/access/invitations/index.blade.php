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
                <h4>{{ trans("translate.invitations") }}</h4>
            </div>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('invitations.invitation.create') }}" class="btn btn-success" title='{{ trans("translate.create") }}'>
                    <i class="fas fa-plus-square"></i>
                </a>
            </div>

        </div>
        
        @if(count($invitations) == 0)
            <div class="card-body text-center">
                <h4>{{ trans("translate.empty_space") }}</h4>
            </div>
        @else
        <div class="card-body card-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ trans("translate.email") }}</th>
                            <th>{{ trans("translate.invitation_token") }}</th>
                            <th>{{ trans("translate.invited_at") }}</th>
                            <th>{{ trans("translate.registered_at") }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($invitations as $invitation)
                        <tr>
                            <td>{{ $invitation->email }}</td>
                            <td><a href="{{ $invitation->invitation_token }}" title="{{ $invitation->getLInk() }}"> {{ $invitation->invitation_token }}</a></td>
                            
                            <td>{{ $invitation->created_at }}</td>
                            <td>{{ $invitation->registered_at }}</td>

                            <td>

                                <form method="POST" action="{!! route('invitations.invitation.destroy', $invitation->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs float-right" role="group">
                                        <a href="{{ route('invitations.invitation.show', $invitation->id ) }}" class="btn btn-info" title={{ trans("translate.show") }}>
                                            <i class="fas fa-eye"></i>

                                        </a>
                                        <a href="{{ route('invitations.invitation.edit', $invitation->id ) }}" class="btn btn-primary" title={{ trans("translate.edit") }}>
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title='{{ trans("translate.delete") }}'  onclick='return confirm(&quot;{{ trans("translate.delete_confirm") }}&quot;)'>
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
            {!! $invitations->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection