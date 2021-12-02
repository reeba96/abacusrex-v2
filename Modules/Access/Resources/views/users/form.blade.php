

<div class="form-group row {{ $errors->has('confirmed') ? 'has-error' : '' }}">
    <label for="confirmed" class="col-md-2 control-label">{{ trans("translate.confirmed") }}</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="confirmed_1">
            	<input id="confirmed_1" class="" name="confirmed" type="checkbox" value="1" {{ old('confirmed', optional($user)->confirmed) == '1' ? 'checked' : '' }}>
                {{ trans('translate.yes') }}
            </label>
        </div>

        {!! $errors->first('confirmed', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email" class="col-md-2 control-label">{{ trans('translate.email') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="email" type="text" id="email" value="{{ old('email', optional($user)->email) }}" minlength="1" maxlength="255" required="true" placeholder='{{ trans('translate.email') }}'>
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('lastname') ? 'has-error' : '' }}">
    <label for="lastname" class="col-md-2 control-label">{{ __('translate.lastname') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="lastname" type="text" id="lastname" value="{{ old('lastname', optional($user)->lastname) }}" minlength="1" maxlength="255" required="true" placeholder='{{ trans('translate.lastname') }}'>
        {!! $errors->first('lastname', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('firstname') ? 'has-error' : '' }}">
    <label for="firstname" class="col-md-2 control-label">{{ __('translate.firstname') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="firstname" type="text" id="firstname" value="{{ old('firstname', optional($user)->firstname) }}" minlength="1" maxlength="255" required="true" placeholder='{{ trans('translate.firstname') }}'>
        {!! $errors->first('firstname', '<p class="help-block">:message</p>') !!}
    </div>
</div>

{{--
<div class="form-group row {{ $errors->has('country_id') ? 'has-error' : '' }}">
    <label for="type" class="col-md-2 control-label">{{ trans('translate.country') }}</label>
    <div class="col-md-10">
         {!! Form::select('country_id', $country_options, old('country_id', optional($user)->country_id),['class'=>"form-control"]  ) !!}
        {!! $errors->first('country_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('firm') ? 'has-error' : '' }}">
    <label for="firm" class="col-md-2 control-label">{{ __('translate.firm') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="firm" type="text" id="firm" value="{{ old('name', optional($user)->firm) }}" minlength="1" maxlength="255" required="true" placeholder="{{ __('translate.firm_placeholder') }}">
        {!! $errors->first('firm', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title" class="col-md-2 control-label">{{ __('translate.title') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="title" type="text" id="title" value="{{ old('title', optional($user)->title) }}" minlength="1" maxlength="255" placeholder='{{ trans('translate.address') }}'>
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('mobile') ? 'has-error' : '' }}">
    <label for="mobile" class="col-md-2 control-label">{{ __('translate.mobile') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="mobile" type="text" id="mobile" value="{{ old('name', optional($user)->mobile) }}" minlength="1" maxlength="255"  placeholder="{{ __('translate.mobile_placeholder') }}">
        {!! $errors->first('mobile', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('skype') ? 'has-error' : '' }}">
    <label for="skype" class="col-md-2 control-label">{{ __('translate.skype') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="skype" type="text" id="skype" value="{{ old('name', optional($user)->skype) }}" minlength="1" maxlength="255" placeholder="{{ __('translate.skype_placeholder') }}">
        {!! $errors->first('skype', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('image') ? 'has-error' : '' }}">
    <label for="image" class="col-md-2 control-label">{{ __('translate.image') }}</label>
    <div class="col-md-10">
        @if (!empty(optional($user)->image))
            <img src="/storage/users/{{$user->image}}" style="max-height: 200px">
        @endif
        <input class="form-control" name="image" type="file" id="image" value="{{ old('image', optional($user)->image) }}" maxlength="200" placeholder="{{__('translate.upload_image')}}">
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div>
--}}

@if ( !isset( $user ))

    <div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}">
        <label for="password" class="col-md-2 control-label">{{ trans('translate.password') }}</label>
        <div class="col-md-10">
            <input class="form-control" name="password" type="password" id="password" value="{{ old('name', optional($user)->password) }}" minlength="1" maxlength="25" required="true" placeholder='{{ trans('translate.password') }}'>
            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <h3>{{ trans('translate.roles') }}</h3>
    @include ('access::roles.user_roles_pivot', [
        'user' => $user,
        'roleObjects' => $roleObjects
        ])
@endif
