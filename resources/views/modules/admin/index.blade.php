@extends('admin::layouts.master')

@section('content')
    <h1>Hello World3</h1>

    <p>
        This view is loaded from module: {!! config('admin.name') !!}
    </p>
    <h2>{{ app()->getLocale()}}</h2>
    <p>
    {{ trans('translate.users') }}</p>
    <p> {{ dd(LaravelLocalization::getSupportedLocales()) }} </p>


  
@endsection
