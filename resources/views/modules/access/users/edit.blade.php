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
                <?php if( !empty($user->firstname) && !empty($user->lastname)  ) { $name = $user->firstname. " " .$user->lastname; } else { $name = 'User'; } ?>
                <h4>{{ $name }}</h4>
            </div>
            <div class="btn-group btn-group-sm float-right" role="group">

                <a href="{{ route('users.user.index') }}" class="btn btn-primary" title={{ trans('translate.show_all') }}>
                    <i class="fas fa-list"></i>
                </a>

                <a href="{{ route('users.user.create') }}" class="btn btn-success" title={{ trans('translate.create') }}>
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

            <form method="POST" action="{{ route('users.user.update', $user->id) }}"  enctype="multipart/form-data"  id="edit_user_form" name="edit_user_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('access::users.form', [
                                        'user' => $user,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value={{ trans('translate.update') }}>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <!-- CHANGE PASSWORD -->
    <div class="card">
        <div class="card-header">

            <div class="float-left">
                <h4>{{trans('translate.new_pass') }}</h4>
            </div>
        </div>
        <form method="POST" action="{{ route('users.user.update.password', $user->id) }}"  enctype="multipart/form-data"  accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group row">
                    <label for="firstname" class="col-md-2 control-label">{{ __('translate.new_pass') }}</label>
                    <div class="col-md-8">
                        <input class="form-control" name="password" type="password" id="password" minlength="6" maxlength="255" required="true" placeholder='{{ trans('translate.new_pass') }}'>
                    </div>
                    <div class="col-md-2">
                        <input class="btn btn-primary" type="submit" value={{ trans('translate.update') }}>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- END OF CHANGE PASSWORD -->

    <!-- INVOICES -->
    <div class="card">
        <div class="card-header">

            <div class="float-left">
                <h4>{{trans('translate.invoice_accounts') }}</h4>
            </div>
        </div>
        <div class="card-body">
            @if(count($InvoiceAccounts) == 0)
                <div class="card-body text-center">
                    <h4>{{ trans('translate.empty_space') }}</h4>
                </div>
            @else
                <ul class="nav nav-tabs" role="tablist">
                    @foreach($InvoiceAccounts as $key => $InvoiceAccount)
                        <li class="nav-item" role="presentation"><a class="nav-link {{ session('invoice_account_id') ? (session('invoice_account_id') == $InvoiceAccount->id ? 'active' : '') : ($key == 0 ? 'active' : '') }}" role="tab" data-toggle="tab" href="#desc_{{ $InvoiceAccount->id }}">
                            {{ __($account_types[$InvoiceAccount->account_type])}}</a></li>
                    @endforeach
                </ul>

                <div class="tab-content mt-3"  id="myTabContent">

                    @foreach($InvoiceAccounts as $key => $InvoiceAccount)
                     @php
                        if ($InvoiceAccount->account_type == 1)
                            $form = 'form';
                        else {
                            $form = 'companyForm';
                        }
                        @endphp

                        <div id="desc_{{ $InvoiceAccount->id }}" class="content tab-pane fade {{ session('invoice_account_id') ? (session('invoice_account_id') == $InvoiceAccount->id ? 'active show' : '') : ($key == 0 ? 'active show' : '') }}"  role="tabpanel" aria-labelledby="{{$form}}tab">

                                <form method="POST" enctype="multipart/form-data" action="{{ route('front.invoiceAccount.admin_update', $InvoiceAccount->id) }}"
                                accept-charset="UTF-8"
                                id="create_invoice-accounts_form_{{ $InvoiceAccount->account_type }}"
                                name="create_invoice-accounts_form_{{$InvoiceAccount->account_type}}"
                                class="form-horizontal">
                                    {{ csrf_field() }}
                                    <input name='admin_page_user_id' type='hidden' value={{$user->id}} />
                                    <input name="_method" type="hidden" value="PUT">
                                    <input name="account_type" type="hidden" value="{{$InvoiceAccount->account_type}}">
                                    @include ('front::user.invoiceAccounts.'.$form, [
                                                                'invoiceAccount' => $InvoiceAccount,
                                                                'user' => $user
                                                              ])
                                    <div class="form-group">
                                            <input class="btn btn-theme col-lg-4" type="submit" value="{{trans('PeopleCounter.save_continue') }}">
                                    </div>
                                </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <!-- END OF INVOICES -->

    <div class="card mt-3">

            <div class="card-header">
                <div class="float-left">
                    <h4>{{ trans('translate.roles') }}</h4>
                </div>

                <div class="btn-group btn-group-sm float-right" role="group">
                    <a href="{{ route('roles.role.create') }}" class="btn btn-success" title={{ trans('translate.create') }}>
                        <i class="fas fa-plus-square"></i>
                    </a>
                </div>

            </div>

            @if(count($roleObjects) == 0)
                <div class="card-body text-center">
                    <h4>{{ trans('translate.empty_space') }}</h4>
                </div>
            @else
            <div class="card-body card-body-with-table">
                <form method="POST" action="{{ route('users.user.roles.update', $user->id) }}" accept-charset="UTF-8">

                        @include ('access::roles.user_roles_pivot', [
                            'user' => $user,
                            'roleObjects' => $roleObjects
                            ])

                </form>
            </div>

            <div class="card-footer">

            </div>

            @endif

    </div>



    <div class="card mt-3">

            <div class="card-header">

                <div class="float-left">
                    <h4>{{ trans('translate.permissions') }}</h4>
                </div>

                <div class="btn-group btn-group-sm float-right" role="group">
                    <a href="{{ route('permissions.permission.create') }}" class="btn btn-success" title={{ trans('translate.create') }}>
                        <i class="fas fa-plus-square"></i>
                    </a>
                </div>

            </div>

            @if(count($permissionObjects) == 0)
                <div class="card-body text-center">
                    <h4>{{ trans('translate.empty_space') }}</h4>
                </div>
            @else
            <div class="card-body card-body-with-table">
                <form method="POST" action="{{ route('users.user.permissions.update', $user->id) }}" accept-charset="UTF-8">

                        @include ('access::permissions.user_permissions_pivot', [
                            'user' => $user,
                            'permissionObjects' => $permissionObjects
                            ])


                </form>
            </div>

            <div class="card-footer">

            </div>

            @endif

        </div>
    </div>

@endsection
