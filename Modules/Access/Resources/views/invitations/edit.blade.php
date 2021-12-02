@extends('admin::admin.layouts.master')

@section('content')

    <div class="card">
  
        <div class="card-header">

            <div class="float-left">
                <h4>{{ !empty($title) ? $title : trans("translate.invitations") }}</h4>
            </div>
            <div class="btn-group btn-group-sm float-right" role="group">

                <a href="{{ route('invitations.invitation.index') }}" class="btn btn-primary" title={{ trans("translate.show_all") }}>
                    <i class="fas fa-list"></i>
                </a>

                <a href="{{ route('invitations.invitation.create') }}" class="btn btn-success" title={{ trans("translate.create") }}>
                    <i class="fas fa-plus-square"></i>
                </a>

            </div>
        </div>

        <div class="card">
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('invitations.invitation.update', $invitation->id) }}" id="edit_invitation_form" name="edit_invitation_form" accept-charset="UTF-8" class="form-horizontal">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('access::invitations.form', ['invitation' => $invitation, ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value={{ trans("translate.update") }}>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection