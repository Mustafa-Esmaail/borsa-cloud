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
                                Showing All Office
                            </span>

                            <div class="btn-group pull-right btn-group-xs">



                                {{-- <a href="{{ route('users.create') }}" class="btn btn-default btn-sm pull-right"
                                    data-toggle="tooltip" data-placement="left" title="Create New Office">
                                    <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                    Create New Office
                                </a> --}}

                                <button type="button" class="btn btn-default btn-sm pull-right"
                                                    data-toggle="modal" data-target="#create">
                                                    <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                    Create New Office
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
                                        <th>Logo</th>
                                        <th>Office Name</th>
                                        <th>Office Owner</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Phone</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody id="users_table">
                                    @foreach ($offices as $office)
                                        <tr>
                                            <td>{{ $office->id }}</td>
                                            <td>
                                                <img class="img-fluid" style=" width: 100px;"
                                                    src="{{ asset('storage//chat_img/fWB0RxmzfrtLaOPlpkqU3Hbq8GIVk6hDmwTadDm1.jpg' ) }}" alt="Avatar">
                                            </td>
                                            <td>{{ $office->office_name }}</td>
                                            <td>{{ $office->office_owner }}</td>
                                            <td>{{ $office->country }}</td>
                                            <td>{{ $office->city }}</td>
                                            <td>{{ $office->phone }}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{ $office->created_at }}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{ $office->updated_at }}</td>



                                            </td>
                                            <td>

                                                {{-- <button type="button" class="btn btn-sm btn-info btn-block" data-toggle="modal" data-target="#show{{ $office->id }}">
                                                    Show office
                                                  </button> --}}
                                                <button type="button" class="btn btn-sm btn-success btn-block"
                                                    data-toggle="modal" data-target="#edit{{ $office->id }}">
                                                    Edit office
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger btn-block"
                                                    data-toggle="modal" data-target="#delete{{ $office->id }}">
                                                    Delete office
                                                </button>

                                            </td>

                                        </tr>




                                        {{-- <!-- Show Modal -->
  <div class="modal fade" id="show{{ $office->id }}" tabindex="-{{ $office->id }}" aria-labelledby="#deleteLable{{ $office->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="#deleteLable{{ $office->id }}">{{$office->office_name}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-4">.col-md-4</div>
                <div class="col-md-4 ms-auto">.col-md-4 .ms-auto</div>
              </div>



            </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <a href="{{ route('office.edit', ['id' =>  $office->id]) }}" class="btn btn-success">Edit</a>
        </div>
      </div>
    </div>
  </div> --}}

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="edit{{ $office->id }}"
                                            tabindex="-{{ $office->id }}"
                                            aria-labelledby="#deleteLable{{ $office->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="#deleteLable{{ $office->id }}">Edit
                                                            {{ $office->office_name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <form
                                                                action="{{ route('office.update', ['id' => $office->id]) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <!-- Form fields go here -->
                                                                <div class="form-group">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="name" name="office_name"
                                                                        value="{{ $office->office_name }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="office_owner">Office Owner</label>
                                                                    <input type="text" class="form-control"
                                                                        id="office_owner" name="office_owner"
                                                                        value="{{ $office->office_owner }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="country">Country</label>
                                                                    <input type="text" class="form-control"
                                                                        id="country" name="country"
                                                                        value="{{ $office->country }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="city">City</label>
                                                                    <input type="text" class="form-control"
                                                                        id="city" name="city"
                                                                        value="{{ $office->city }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="avatar">Logo</label>
                                                                    <input class="form-control" id="avatar"
                                                                        type="file" name="avatar" accept="image/*"
                                                                         value="{{ $office->avatar }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="phone">Phone</label>
                                                                    <input type="text" class="form-control"
                                                                        id="phone" name="phone"
                                                                        value="{{ $office->phone }}">
                                                                </div>
                                                                <!-- Add other form fields as   needed -->
                                                                <button type="submit"
                                                                    class="btn btn-primary">Save</button>
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
                                        <div class="modal fade" id="delete{{ $office->id }}"
                                            tabindex="-{{ $office->id }}"
                                            aria-labelledby="#deleteLable{{ $office->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="#deleteLable{{ $office->id }}">Are
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
                                                        <a href="{{ route('office.delete', ['id' => $office->id]) }}"
                                                            class="btn btn-danger">Confirm</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </tbody>

                            </table>
                            <div class="modal fade" id="create"
                                tabindex="-1"
                                aria-labelledby="#createLable" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="createLable">Add Office
                                                </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <form
                                                    action="{{ route('office.store') }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('POST')

                                                    <!-- Form fields go here -->
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control"
                                                            id="name" name="office_name"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="office_owner">Office Owner</label>
                                                        <input type="text" class="form-control"
                                                            id="office_owner" name="office_owner"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="country">Country</label>
                                                        <input type="text" class="form-control"
                                                            id="country" name="country"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="city">City</label>
                                                        <input type="text" class="form-control"
                                                            id="city" name="city"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="avatar">Logo</label>
                                                        <input class="form-control" id="avatar"
                                                            type="file" name="avatar" accept="image/*"
                                                            required >
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone">Phone</label>
                                                        <input type="text" class="form-control"
                                                            id="phone" name="phone" required
                                                            >
                                                    </div>
                                                    <!-- Add other form fields as   needed -->
                                                    <button type="submit"
                                                        class="btn btn-primary">Save</button>
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
