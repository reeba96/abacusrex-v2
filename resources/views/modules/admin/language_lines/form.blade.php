
<div class="form-group row {{ $errors->has('group') ? 'has-error' : '' }}">
    <label for="group" class="col-md-2 control-label">{{ trans("translate.group") }}</label>
    <div class="col-md-10">
        <input class="form-control" name="group" type="text" id="group" value="{{ old('group', optional($languageLines)->group) }}" minlength="1" maxlength="255" required="true" placeholder='{{ trans("translate.group") }}'>
        {!! $errors->first('group', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('key') ? 'has-error' : '' }}">
    <label for="key" class="col-md-2 control-label">{{ trans("translate.key") }}</label>
    <div class="col-md-10">
        <input class="form-control" name="key" type="text" id="key" value="{{ old('key', optional($languageLines)->key) }}" minlength="1" maxlength="255" required="true" placeholder={{ trans("translate.key") }}>
        {!! $errors->first('key', '<p class="help-block">:message</p>') !!}
    </div>
</div>

@php 
    $fields_json = json_decode(optional($languageLines)->text);
   // dd($fields_json);    

    foreach ($language_keys as $key => $code){
        
        if( isset($fields_json->$code)) 
            $value = $fields_json->$code;
        else 
            $value = '';
        @endphp

        <div class="form-group">
            <label for="text2_{{$code}}" class="col-md-2 control-label">{{ trans("translate.key") }} [{{$code}}]</label>
            <div class="col-md-10">
                <input class="form-control" name="text_langs[{{$code}}]" type="text" id="text_langs_{{$code}}" value="{{$value}}" minlength="1" maxlength="255" placeholder="">
            </div>
        </div>

        @php


       // echo $value;

    }

@endphp

<input type="hidden" name="text" value="{{ old('text', optional($languageLines)->text) }}">

{{--
<div class="form-group row {{ $errors->has('text') ? 'has-error' : '' }}">
    <label for="text" class="col-md-2 control-label">Text</label>
    <div class="col-md-10">
        <textarea class="form-control" name="text" cols="50" rows="10" id="text" required="true" placeholder="Enter text here...">{{ old('text', optional($languageLines)->text) }}</textarea>
        {!! $errors->first('text', '<p class="help-block">:message</p>') !!}
    </div>
</div>
--}}

