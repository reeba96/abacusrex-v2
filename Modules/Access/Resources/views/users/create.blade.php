@extends('admin::admin.layouts.master')

@section('content')

    <div class="card">

        <div class="card-header">
            
            <span class="float-left">
                <h4>{{ trans("translate.create_new_user") }}</h4>
            </span>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('users.user.index') }}" class="btn btn-primary" title={{ trans("translate.show_all") }}>
                    <i class="fas fa-list"></i>
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

            <form method="POST" action="{{ route('users.user.store') }}"  enctype="multipart/form-data"  accept-charset="UTF-8" id="create_user_form" name="create_user_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('access::users.form', [
                                        'user' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value={{ trans('translate.add') }}>
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection


