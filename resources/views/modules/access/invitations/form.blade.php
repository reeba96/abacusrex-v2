
<div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}" style="padding: 20px 20px 0px 20px;">
    <label for="email" class="col-md-2 control-label">{{ trans("translate.email") }}</label>
    <div class="col-md-10">
        <input class="form-control" name="email" type="text" id="email" value="{{ old('email', optional($invitation)->email) }}" minlength="1" maxlength="255" required="true" placeholder='{{ trans("translate.email") }}'>
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
