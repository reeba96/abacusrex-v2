
@extends('admin::admin.layouts.master')

@section('content')

<style>
    .swal2-content {
        font-size:13px !important;
    }
</style>
<div class="card">
    <div class="card-header">

            
            <span class="float-left">
                <h4>Create New Permissions</h4>
            </span>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('access.passport.index') }}" class="btn btn-primary" title="Show All Tokens">
                    <i class="fas fa-list"></i>
                </a>
            </div>

        </div>

        <div class="card-body">
        
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="#" accept-charset="UTF-8" id="frm_token" name="frm_token" class="form-horizontal">
            {{ csrf_field() }}
           
                <div class="form-group row {{ $errors->has('guard_name') ? 'has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Name</label>
                    <div class="col-md-10">
                        <input class="form-control" name="name" type="text" id="name" value="{{ old('name')}}" minlength="1" maxlength="255" required placeholder="Enter name here...">
                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 text-right">
                        <input class="btn btn-success" type="submit" id="btn_get_token" value="Add">
                    </div>
                </div>

            </form>

{{--
        <passport-clients></passport-clients>
        <passport-authorized-clients></passport-authorized-clients>
        <passport-personal-access-tokens></passport-personal-access-tokens> --}}
        
    </div>
</div>
  
@endsection


@push('scripts')

<script>
    $(function () {
    
        //$("#btn_get_token").click(function() {
        $("#frm_token").submit(function( event ) {
            event.preventDefault();
            $.post( "/oauth/personal-access-tokens",{ 'name' : $("#name").val() }, function( data ) {
                Swal.fire({
                        title: 'Access token',
                        text : data.accessToken,
                        customClass: {
                            content: 'font-size:12px'
                        }
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Swal.fire('Saved!', '', 'success');
                        window.location.href = "{{ route('access.passport.index') }}";
                    } 
                })
            });
        });
    });
</script>
@endpush