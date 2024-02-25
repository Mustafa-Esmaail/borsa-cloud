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
                                Showing All Currencies
                            </span>

                            <div class="btn-group pull-right btn-group-xs">





                                <button type="button" class="btn btn-default btn-sm pull-right" data-toggle="modal"
                                    data-target="#create">
                                    <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                    Create New Currencies
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
                                        <th>Country</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody id="users_table">
                                    @foreach ($currencies as $currency)
                                        <tr>
                                            <td>{{ $currency->id }}</td>
                                            <td>{{ $currency->name }}</td>
                                            <td>{{ $currency->country }}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{ $currency->created_at }}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{ $currency->updated_at }}</td>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-success btn-block"
                                                    data-toggle="modal" data-target="#edit{{ $currency->id }}">
                                                    Edit Currency
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger btn-block"
                                                    data-toggle="modal" data-target="#delete{{ $currency->id }}">
                                                    Delete Currency
                                                </button>
                                            </td>

                                        </tr>




                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="edit{{ $currency->id }}"
                                            tabindex="-{{ $currency->id }}"
                                            aria-labelledby="#deleteLable{{ $currency->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="#deleteLable{{ $currency->id }}">Edit
                                                            {{ $currency->name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <form
                                                                action="{{ route('currency.update', ['id' => $currency->id]) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <!-- Form fields go here -->
                                                                <div class="form-group">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="name" name="name"
                                                                        value="{{ $currency->name }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="country">Country</label>
                                                                    <input type="text" class="form-control"
                                                                        id="country" name="country"
                                                                        value="{{ $currency->country }}">
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
                                        <div class="modal fade" id="delete{{ $currency->id }}"
                                            tabindex="-{{ $currency->id }}"
                                            aria-labelledby="#deleteLable{{ $currency->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="#deleteLable{{ $currency->id }}">Are
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
                                                        <a href="{{ route('currency.delete', ['id' => $currency->id]) }}"
                                                            class="btn btn-danger">Confirm</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </tbody>

                            </table>
                            <div class="modal fade" id="create" tabindex="-1" aria-labelledby="#createLable"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="createLable">Add Currency
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <form action="{{ route('currency.store') }}" method="POST">
                                                    @csrf
                                                    @method('POST')

                                                    <!-- Form fields go here -->
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="country">Country</label>
                                                        <input type="text" class="form-control" id="country"
                                                            name="country" required>
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
