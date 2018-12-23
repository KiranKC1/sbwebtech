
<div class="container">
        <div class="row col-md-10">
    <table>
        <thead>
            <th>Name</th>
            <th>Email</th>
            <th>User</th>
            <th>Editor</th>
            <th>Admin</th>
            <th>Assign Role</th>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <form action="{{route('assign.roles')}}" method="POST">
                        <td>{{ $user->name}}</td>
                        <td>{{ $user->email}}<input type="hidden" name="email" value="{{$user->email}}"></td>
                        <td><input type="checkbox" {{ $user->hasRole('User') ? 'checked' : '' }} name="role_user"></td>
                        <td><input type="checkbox" {{ $user->hasRole('Editor') ? 'checked' : '' }} name="role_editor"></td>
                        <td><input type="checkbox" {{ $user->hasRole('Admin') ? 'checked' : '' }} name="role_admin"></td>
    
                        {{csrf_field()}}
                        <td><button type="submit" class="btn btn-success">Assign Roles</button></td>
                    </form>
                </tr>
                @endforeach
        </tbody>
    </table>
    </div>
</div>
