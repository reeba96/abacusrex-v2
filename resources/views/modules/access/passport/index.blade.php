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
                <h4>token</h4>
            </div>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('access.passport.create') }}" class="btn btn-success" title="Create New token">
                    <i class="fas fa-plus-square"></i>
                </a>
            </div>

        </div>
        
        @if(count($tokens) == 0)
            <div class="card-body text-center">
                <h4>No Token Available.</h4>
            </div>
        @else
        <div class="card-body card-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Created</th>
                            <th>Expires</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($tokens as $token)
                        <tr>
                            <td>{{ $token->name }}</td>
                            <td>{{ $token->created_at }}</td>
                            <td>{{ $token->expires_at }}</td>
                            <td>

                                <form method="POST" action="{!! route('access.passport.destroy', $token->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs float-right" role="group">
                                        <button type="submit" class="btn btn-danger" title="Delete Token" onclick="return confirm(&quot;Click Ok to delete token.&quot;)">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="card-footer">
         
        </div>
        
        @endif
    
    </div>
@endsection