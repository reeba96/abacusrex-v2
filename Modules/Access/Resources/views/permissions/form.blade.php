
<div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans("translate.name") }}</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($permissions)->name) }}" minlength="1" maxlength="255" required="true" placeholder='{{ trans("translate.name") }}'>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('guard_name') ? 'has-error' : '' }}">
    <label for="guard_name" class="col-md-2 control-label">{{ trans("translate.guard_name") }}</label>
    <div class="col-md-10">
        <input class="form-control" name="guard_name" type="text" id="guard_name" value="{{ old('guard_name', optional($permissions)->guard_name) }}" minlength="1" maxlength="255" placeholder='{{ trans("translate.guard_name") }}'>
        {!! $errors->first('guard_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

