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
                <h4>{{ trans("translate.user_logs") }}</h4>
            </div>
        </div>



            <div class="card-body card-body-with-table">
                <div class="table-responsive">
                    <form method="GET" action="{{ route('access.filter.user.logs') }}" id="filter_user_logs" name="filter_user_logs" accept-charset="UTF-8" class="form-horizontal">
                    {{ csrf_field() }}
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th>{{ trans("translate.activity") }}</th>
                                <th>{{ trans("translate.description") }}</th>
                                <th>{{ trans("translate.properties") }}</th>
                                <th>{{ trans("translate.created_at") }}</th>
                                <th></th>
                            </tr>
                            <tr class="card-footer">
                                <th> {{  Form::select('activity_filter', $activities, $activity_filter,['class'=>"form-control"]) }}</th>
                                <th><div class="input-group date" id="description_filter_div" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#description_filter" name="description_filter" id="description_filter" value="{{ $description_filter }}"/>
                                    </div>
                                </th>
                                <th></th>
                                <th>
                                    <!-- <div class="input-group date" id="date_filter" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#date_filter" name="date_filter" id="date_filter" value="{{ $date_filter }}"/>
                                        <div class="input-group-append" data-target="#date_filter" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div> -->
                                </th>
                                <th><button type="submit" class="btn btn-success float-right"><i class="fas fa-filter"></i> {{ __('translate.filter') }}</button></th>
                            </tr>
                        </thead>
                        <tbody>

                            @if(count($logs) == 0)
                                 <tr>
                                    <td colspan="7">
                                        <h4>{{ trans('translate.empty_space') }}</h4>
                                    </td>
                                </tr>
                            @else
                                @foreach($logs as $log)
                                    <tr>
                                        <td>{{$log->log_name}}</td>
                                        <td>
                                            {{ $log->description }}
                                        </td>
                                        <td> 
                                            @if (strpos($log->properties,'file')) 
                                                @php
                                                    $properties_json = json_decode($log->properties);
                                                //  dump($properties_json->file);
                                                $file = $properties_json->file;
                                                //$file = '';
                                                @endphp
                                                <a href="{{ route('PeopleCounter.downloadImport') }}?file={{$file}}"><i class="fas fa-cloud-download-alt"></i></a> 
                                            @endif
                                            {{$log->properties}}
                                           
                                        
                                        </td>
                                        <td>{{$log->created_at}}</td>
                                        <td>
                                            <!-- <div class="btn-group btn-group-xs float-right" role="group">
                                                <a href="{{ route('api_logs.api_logs.show', $log->id ) }}" class="btn btn-info" title="Show Api Logs">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div> -->
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
                <div style="width: 400px">
                {!! $logs->appends(Request::all())->links() !!}
            </div>

@endsection

@push('scripts')
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        $('#date_filter').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    </script> -->
@endpush
