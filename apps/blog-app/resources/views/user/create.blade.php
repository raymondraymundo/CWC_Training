@extends('layouts.default')

@section('title', 'Add User')

@section('content-header')
    <a href="{{ route('users.index') }}" class="btn btn-primary"><i class="fa fa-reply-all"></i> Back</a>
    <ol class="breadcrumb">
        <li><p><i class="fa fa-users"></i> User</p></li>
        <li class="active"><a href="{{ route('users.create') }}">Add User</a></li>
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
                    <h3 class="box-title">Create User</h3>
                </div>
                <!-- box-header -->

                <!-- <form action="{{ route('users.store') }}" method="POST"> -->
                <form action="https://cwc-training-blog-app.local.host/users" method="POST">
                    @csrf

                    <!-- box-body -->
                    <div class="box-body">
                        @include('component.errors_and_messages')

                        <!-- row -->
                        <div class="row">
                            <!-- col-md-6 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name*</label>
                                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="form-control">
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                </div>
                            </div>
                            <!-- col-md-6 -->

                            <!-- col-md-6 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name*</label>
                                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="form-control">
                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                </div>
                            </div>
                            <!-- col-md-6 -->
                        </div>
                        <!-- row -->

                        <!-- row -->
                        <div class="row">
                            <!-- col-md-6 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Username*</label>
                                    <input type="text" name="username" id="username" value="{{ old('username') }}" class="form-control">
                                    <span class="text-danger">{{ $errors->first('username') }}</span>
                                </div>
                            </div>
                            <!-- col-md-6 -->

                            <!-- col-md-6 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Role*</label>
                                    <select name="role" id="role" class="form-control select2" style="width: 100%;">
                                        @if(old('role'))
                                            @if(old('role') == 1)
                                                <option value="1" selected>Admin</option>
                                                <option value="2">User</option>
                                            @else
                                                <option value="1">Admin</option>
                                                <option value="2" selected>User</option>
                                            @endif
                                        @else
                                            <option></option>
                                            <option value="1">Admin</option>
                                            <option value="2">User</option>
                                        @endif
                                    </select>
                                    <span class="text-danger">{{ $errors->first('role') }}</span>
                                </div>
                            </div>
                            <!-- col-md-6 -->
                        </div>
                        <!-- row -->

                        <hr class="divider">

                        <!-- row -->
                        <div class="row">
                            <!-- col-md-6 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                </div>
                            </div>
                            <!-- col-md-6 -->

                            <!-- col-md-6 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                </div>
                            </div>
                            <!-- col-md-6 -->
                        </div>
                        <!-- row -->
                    </div>
                    <!-- box-body -->

                    <!-- box-footer -->
                    <div class="box-footer">
                        <div class="btn-group pull-right">
                            <button type="reset" name="btnReset" id="btnReset" class="btn btn-default">Reset</button>
                            <button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <!-- box-footer -->
                </form>
            </div>
            <!-- box box-primary -->
        </div>
        <!-- col-md-12 -->
    </div>
    <!-- row -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize Select2 Elements
            $('.select2').select2({
                placeholder: 'Select an option',
                allowClear: true,
            });

            $('#btnReset').click(function() {
                $('.text-danger').html('');
            });
        });
    </script>
@endpush
