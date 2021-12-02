@extends('admin::admin.layouts.master')

@section('content')

<div class="card">
    <div class="card-header">

        <span class="float-left">
            <h4>{{ isset($title) ? $title : trans("translate.invitations") }}</h4>
        </span>

        <div class="float-right">

            <form method="POST" action="{!! route('invitations.invitation.destroy', $invitation->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('invitations.invitation.index') }}" class="btn btn-primary" title={{ trans("translate.show_all") }}>
                        <i class="fas fa-list"></i>
                    </a>

                    <a href="{{ route('invitations.invitation.create') }}" class="btn btn-success" title={{ trans("translate.create") }}>
                        <i class="fas fa-plus-square"></i>
                    </a>
                    
                    <a href="{{ route('invitations.invitation.edit', $invitation->id ) }}" class="btn btn-primary" title={{ trans("translate.edit") }}>
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
            <dt>{{ trans("translate.email") }}</dt>
            <dd>{{ $invitation->email }}</dd>
            <dt>{{ trans("translate.invitation_token") }}</dt>
            <dd>{{ $invitation->invitation_token }}</dd>
            <dt>{{ trans("translate.registered_at") }}</dt>
            <dd>{{ $invitation->registered_at }}</dd>
            <dt>{{ trans("translate.created_at") }}</dt>
            <dd>{{ $invitation->created_at }}</dd>
            <dt>{{ trans("translate.last_update") }}</dt>
            <dd>{{ $invitation->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection