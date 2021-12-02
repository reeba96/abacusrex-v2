@if (isset($user))
    <input name="user_id" value="{{$user->id}}" type="hidden">
@endif
{{ csrf_field() }}

<div class="table-responsive">

    <table class="table table-striped ">
        <thead>
            <tr>
                <th></th>
                <th>{{ trans('translate.name') }}</th>
                <th>{{ trans('translate.guard_name') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($roleObjects as $role)
            <tr>
                <td>
                
                    <input type="checkbox" name="roles[{{$role->id}}]" value="{{$role->name}}" {{ in_array($role->id, $user_roles ) ? ' checked' : ''}}></td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->guard_name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@if (isset($user))
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <input class="btn btn-primary" type="submit" value={{ trans('translate.update') }}>
        </div>
    </div>
@endif