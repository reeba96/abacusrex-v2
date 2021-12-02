<style>dd{ min-height: 23px;}</style>
@extends('admin::admin.layouts.master')

@section('content')

<div class="card">
    <div class="card-header">

        <span class="float-left">
            <h4>{{ isset($title) ? $title : 'API Logs' }}</h4>
        </span>

        <div class="float-right">

            <div class="btn-group" role="group">
                <a href="{{ route('api_logs.api_logs.index') }}" class="btn btn-primary" title="Show All Api Logs">
                    <i class="fas fa-list"></i>
                </a>
            </div>

        </div>

    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>Method</dt>
            <dd>{{ $log->method }}</dd>
            <dt>Url</dt>
            <dd>{{ $log->url }}</dd>
            <dt>Payload</dt>
            <dd>{{ $log->payload }}</dd>
            <dt>Status</dt>
            <dd>{{ $log->status }}</dd>
            <dt>Response</dt>
            <dd>{{ $log->response }}</dd>
            <dt>Duration</dt>
            <dd>{{ $log->duration }}</dd>
            <dt>Controller</dt>
            <dd>{{ $log->controller }}</dd>
            <dt>Action</dt>
            <dd>{{ $log->action }}</dd>
            <dt>Models</dt>
            <dd style="margin-left: 180px;">{!! implode(',<br>',explode(',',$log->models)) !!}</dd>
            <dt>Ip</dt>
            <dd>{{ $log->ip }}</dd>
            <dt>Created At</dt>
            <dd>{{ $log->created_at }}</dd>


        </dl>

    </div>
</div>

@endsection