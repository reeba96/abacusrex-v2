

<div class="form-group row {{ $errors->has('name_en') ? 'has-error' : '' }}">
    <label for="name_en" class="col-md-2 control-label">{{ trans("translate.name") }} (en)</label>
    <div class="col-md-10">
        <input class="form-control" name="name_en" type="text" id="name_en" value="{{ old('name_en', optional($countries)->name_en) }}" minlength="1" maxlength="255" required="true" placeholder='{{ trans("translate.name") }} (en)'>
        {!! $errors->first('name_en', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('name_hu') ? 'has-error' : '' }}">
    <label for="name_hu" class="col-md-2 control-label">{{ trans("translate.name") }} (hu)</label>
    <div class="col-md-10">
        <input class="form-control" name="name_hu" type="text" id="name_hu" value="{{ old('name_hu', optional($countries)->name_hu) }}" minlength="1" maxlength="255" required="true" placeholder='{{ trans("translate.name") }} (hu)'>
        {!! $errors->first('name_hu', '<p class="help-block">:message</p>') !!}
    </div>
</div>

