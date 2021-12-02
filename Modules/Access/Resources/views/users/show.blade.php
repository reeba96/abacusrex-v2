@extends('admin::admin.layouts.master')

@section('content')

<div class="card">
    <div class="card-header">

        <span class="float-left">
            <?php if( !empty($user->firstname) && !empty($user->lastname)  ) { $name = $user->firstname. " " .$user->lastname; } else { $name = 'User'; } ?>
            <h4>{{ $name }}</h4>
        </span>

        <div class="float-right">

            <form method="POST" action="{!! route('users.user.destroy', $user->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('users.user.index') }}" class="btn btn-primary" title={{ trans("translate.show_all") }}>
                        <i class="fas fa-list"></i>
                    </a>

                    <a href="{{ route('users.user.create') }}" class="btn btn-success" title={{ trans("translate.create") }}>
                        <i class="fas fa-plus-square"></i>
                    </a>
                    
                    <a href="{{ route('users.user.edit', $user->id ) }}" class="btn btn-primary" title={{ trans("translate.edit") }}>
                        <i class="fas fa-edit"></i>
                    </a>

                    <button type="submit" class="btn btn-danger" title={{ trans("translate.delete") }} onclick='return confirm(&quot;{{ trans("translate.delete_confirm") }}&quot;)'>
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>{{ trans("translate.firstname") }}</dt>
            <dd>{{ $user->firstname }}</dd>

            <dt>{{ trans("translate.lastname") }}</dt>
            <dd>{{ $user->lastname }}</dd>

            <dt>{{ trans("translate.email") }}</dt>
            <dd>{{ $user->email }}</dd>

            <dt>{{ trans('translate.firm')}}</dt>
            <dd>{{ $user->firm }}</dd>
            
            <dt>{{ trans('translate.title')}}</dt>
            <dd>{{ $user->title }}</dd>
            {{-- 
            <dt>{{ trans('translate.mobile')}}</dt>
            <dd>{{ $user->mobile }}</dd>

            <dt>{{ trans('translate.phone')}}</dt>
            <dd>{{ $user->phone }}</dd>

            <dt>{{ trans('translate.skype')}}</dt>
            <dd>{{ $user->skype }}</dd>
            --}}
            <dt>{{ trans('translate.image')}}</dt>
            <dd>
                @if (!empty(optional($user)->image))
                    <img src="/storage/users/{{$user->image}}" style="max-height: 200px">
                @endif
            </dd>
            <dt>{{ trans("translate.confirmed") }}</dt>
            <dd>{{ ($user->confirmed) ? trans("translate.yes") : trans("translate.no") }}</dd>
            <dt>{{ trans("translate.created_at") }}</dt>
            <dd>{{ $user->created_at }}</dd>
            <dt>{{ trans("translate.email_verified_at") }}</dt>
            <dd>{{ $user->email_verified_at }}</dd>
            <dt>{{ trans("translate.last_update") }}</dt>
            <dd>{{ $user->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection