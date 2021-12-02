<style>a.btn-get { padding: 6px 17px;}</style>

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
                <h4>Api Logs</h4>
            </div>
        </div>
        
      
            
            <div class="card-body card-body-with-table">
                <div class="table-responsive">
                    <form method="POST" action="{{ route('apilogs.apilog.filter') }}" id="filter_apilogs" name="filter_apilogs" accept-charset="UTF-8" class="form-horizontal">
                    {{ csrf_field() }}
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th>Method</th>
                                <th>Action</th>
                                <th>Url</th>
                                <th>Duration</th>
                                <th>Date</th>
                                <th>IP</th>
                                <th></th>
                            </tr>
                            <tr class="card-footer">
                                <th> {{  Form::select('method_filter', $methods, $method_filter,['class'=>"form-control"]) }}</th>
                                <th> {{  Form::select('action_filter', $actions, $action_filter,['class'=>"form-control"]) }}</th>
                                <th> {{  Form::text('url_filter', $url_filter,['class'=>"form-control"]) }}</th>
                                <th></th>
                                <th>  <div class="input-group date" id="date_filter" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#date_filter" name="date_filter" id="date_filter" value="{{ $date_filter }}"/>
                                        <div class="input-group-append" data-target="#date_filter" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div></th>
                                <th> {{  Form::text('ip_filter', $ip_filter,['class'=>"form-control"]) }}</th>
                                <th><button type="submit" class="btn btn-success float-right"><i class="fas fa-filter"></i> {{ __('translate.filter') }}</button></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @if(count($logs) == 0)
                                 <tr>
                                    <td colspan="7">
                                        <h4>No Api Logs Available.</h4>
                                    </td>
                                </tr>
                            @else
                                @foreach($logs as $log)
                                    <tr>
                                        <td>
                                            @if ($log->status>400)
                                                <a href="{{ route('api_logs.api_logs.show', $log->id ) }}" class="btn btn-danger font-weight-bold" title="Show Api Logs">
                                                    {{$log->method}}
                                                </a>
                                            @elseif($log->status>300)
                                                <a href="{{ route('api_logs.api_logs.show', $log->id ) }}" class="btn btn-info font-weight-bold">{{$log->method}}</a>
                                            @else
                                                <a href="{{ route('api_logs.api_logs.show', $log->id ) }}" class="btn btn-{{$log->method=="GET"? "success btn-get" : "success"}} font-weight-bold">{{$log->method}}</a>
                                            @endif
                                            
                                            <small class="col-md-2">
                                                <b>{{$log->status}}</b>
                                            </small>
                                        </td>
                                        <td>{{$log->action}}</td>
                                        <td>{{ $log->url }}</td>
                                        <td>{{$log->duration * 1000}}ms</td>
                                        <td>{{$log->created_at}}</td>
                                        <td>{{$log->ip}}</td>
                                        <td>
                                            <div class="btn-group btn-group-xs float-right" role="group">
                                                <a href="{{ route('api_logs.api_logs.show', $log->id ) }}" class="btn btn-info" title="Show Api Logs">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                        </tbody>
                    </table>
                    </form>
                </div>
            </div>

        @if(count($logs) == 0)
            <div class="card-footer ml-3">
                {!! $logs->appends($data)->render() !!}
            </div>
        @endif
       
    
    </div>
@endsection

@push('scripts')
    <script>
        $('#date_filter').datetimepicker({
            format: 'YYYY-MM-DD',
            twentyFour: false
        });
    </script>
@endpush
