@extends('admin::admin.layouts.master')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 mt-2">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
