@extends('layouts.app')


@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Showing All users
                            </span>

                            <div class="btn-group pull-right btn-group-xs">



                                {{-- <a href="{{ route('users.create') }}" class="btn btn-default btn-sm pull-right"
                                    data-toggle="tooltip" data-placement="left" title="Create New Office">
                                    <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                    Create New Office
                                </a> --}}

                                <button type="button" class="btn btn-default btn-sm pull-right" data-toggle="modal"
                                    data-target="#create">
                                    <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                    Create New User
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">



                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="user_count">
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Office</th>
                                        <th>Created</th>
                                        <th>Updated</th>

                                    </tr>
                                </thead>
                                <tbody id="users_table">
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>

                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->office->office_name }}</td>

                                            <td class="hidden-sm hidden-xs hidden-md">{{ $user->created_at }}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{ $user->updated_at }}</td>

                                            </td>
                                            <td>


                                                <button type="button" class="btn btn-sm btn-success btn-block"
                                                    data-toggle="modal" data-target="#edit{{ $user->id }}">
                                                    Edit User
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger btn-block"
                                                    data-toggle="modal" data-target="#delete{{ $user->id }}">
                                                    Delete User
                                                </button>

                                            </td>

                                        </tr>




                                        <div class="modal fade" id="edit{{ $user->id }}"
                                            tabindex="-{{ $user->id }}"
                                            aria-labelledby="#deleteLable{{$user->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="#deleteLable{{ $user->id }}">Edit
                                                            {{ $user->name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <form action="{{ route('users.update', ['id' => $user->id]) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <!-- Form fields go here -->
                                                                <div class="form-group">
                                                                    <label for="name{{$user->id}}">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="name{{$user->id}}" name="name"
                                                                        value="{{ $user->name }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="email">Email</label>
                                                                    <input type="email" class="form-control"
                                                                        id="email{{$user->id}}" name="email"
                                                                        value="{{ $user->email }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="selectOffice"{{$user->id}}>Select Office</label>
                                                                    <select class="form-control" id="selectOffice{{$user->id}}"
                                                                        name="office_id">
                                                                        @foreach ($offices as $office)
                                                                            <option value="{{ $office->id }}"
                                                                                {{ $office->id == $user->office_id ? 'selected' : '' }}>
                                                                                {{ $office->office_name }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="password{{$user->id}}">Password</label>
                                                                    <input type="password" class="form-control"
                                                                        id="{{$user->id}}password{{$user->id}}" name="password" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="password-confirm{{$user->id}}">Password Confirm</label>
                                                                    <input type="password" class="form-control"
                                                                        id="password-confirm{{$user->id}}" name="password_confirmation" required>
                                                                </div>

                                                                <!-- Add other form fields as   needed -->
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="delete{{ $user->id }}"
                                            tabindex="-{{ $user->id }}"
                                            aria-labelledby="#deleteLable{{ $user->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="#deleteLable{{ $user->id }}">Are
                                                            you sure?</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to proceed with this action?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel</button>
                                                        <a href="{{ route('users.delete', ['id' => $user->id]) }}"
                                                            class="btn btn-danger">Confirm</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </tbody>

                            </table>

                            <ul id="messages"></ul>
                            <div class="modal fade" id="create" tabindex="-1" aria-labelledby="#createLable"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="createLable">Add User
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <form action="{{ route('users.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('POST')


                                                    <!-- Form fields go here -->
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" id="email"
                                                            name="email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="office_id">Select Office</label>
                                                        <select class="form-control" id="office_id" name="office_id" required>
                                                            @foreach ($offices as $office)
                                                                <option value="{{ $office->id }}">
                                                                    {{ $office->office_name }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" id="password"
                                                            name="password" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password-confirm">Password Confirm</label>
                                                        <input type="password" class="form-control" id="password-confirm"
                                                            name="password_confirmation" required>
                                                    </div>
                                                    <!-- Add other form fields as   needed -->
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
