@extends('layouts.default')

@section('title', 'User List')

@section('content-header')
    <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add User</a>
    <ol class="breadcrumb">
        <li><p><i class="fa fa-users"></i> User</p></li>
        <li class="active"><a href="{{ route('users.index') }}">User List</a></li>
    </ol>
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <!-- col-md-12 -->
        <div class="col-md-12">
            <!-- box box-primary -->
            <div class="box box-primary">
                <!-- box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">List of Users</h3>
                </div>
                <!-- box-header -->

                <!-- box-body -->
                <div class="box-body">
                    @include('component.errors_and_messages')

                    <div class="table-responsive">
                        <table id="usersTable" class="table table-bordered table-striped table-hover text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">isActive</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            @if(is_null($user->deleted_at))
                                                <span class="label label-success">Active</span>
                                            @else
                                                <span class="label label-warning">Inactive</span>
                                            @endif
                                        </td>
                                        <td colspan="2">
                                            <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- box-body -->
            </div>
            <!-- box box-primary -->
        </div>
        <!-- col-md-12 -->
    </div>
    <!-- row -->
@endsection

@push('scripts')
    <script>
        $('#usersTable').DataTable();
    </script>
@endpush