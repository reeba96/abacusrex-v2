<input name="role_id" value="{{$role->id}}" type="hidden">
{{ csrf_field() }}

<div class="table-responsive">

    <table class="table table-striped ">
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Guard Name</th>
            </tr>
        </thead>
        <tbody>
        @foreach($permissionsObjects as $permission)
            <tr>
                <td>
                
                    <input type="checkbox" name="permissions[{{$permission->id}}]" value="{{$permission->name}}" {{ in_array($permission->id, $role_permissions ) ? ' checked' : ''}}></td>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->guard_name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <input class="btn btn-primary" type="submit" value="Update">
        </div>
    </div>