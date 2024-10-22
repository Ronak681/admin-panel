@extends('admin.layouts.main')

@section('content')
<div class="container mt-4">
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    @endif

    <div class="row justify-content-center mt-1">
        <div class="col-md-11">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h3 class="m-0">{{ ucfirst($roleName) }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('show.list', ['role_id' => $role_id]) }}" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search by name or email" value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                            <button class="btn btn-outline-danger" type="button" onclick="clearSearch()">Clear</button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($userslist->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center">No users found</td>
                                    </tr>
                                @else
                                    @foreach($userslist as $userlist)
                                        <tr>
                                            <td>{{ $userlist->first_name }}</td>
                                            <td>{{ $userlist->last_name }}</td>
                                            <td>{{ $userlist->email }}</td>
                                            <td>{{ $userlist->phone }}</td>
                                            <td>{{ $userlist->gender }}</td>
                                            <td>{{ $userlist->address }}</td>
                                            <td>{{ $userlist->status }}</td>
                                            <td>
                                                <a href="{{ route('edit.user', ['user_id' => $userlist->id, 'role_id' => $role_id]) }}">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                <form id="delete-user-from-{{$userlist->id}}" action="{{ route('delete.user', ['user_id' => $userlist->id]) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" style="border: none; background: none; color: red; cursor: pointer;" onclick="deleteUserList({{ $userlist->id }})">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function deleteUserList(id) {
        if (confirm("Are you sure you want to delete this user?")) {
            document.getElementById("delete-user-from-" + id).submit();
        }
    }

    function clearSearch() {
        document.querySelector('input[name="search"]').value = '';
        window.location.href = "{{ route('show.list', ['role_id' => $role_id]) }}";
    }

</script>
