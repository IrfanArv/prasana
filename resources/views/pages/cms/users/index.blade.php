@extends('layouts.cms')
@section('title', 'Accounts')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Users</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Users
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    @can('users-create')
                        <a href="{{ route('users.create') }}"
                            class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-light"><i
                                class="feather icon-plus-circle"></i></a>
                    @endcan
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p class="mb-0">
                    {{ $message }}
                </p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                </button>
            </div>
        @endif
        <div class="content-body">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="user_table">
                                        <thead>
                                            <tr class="text-center">
                                                <th></th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Roles</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $user)
                                                <tr class="text-center">
                                                    <td class="text-center">
                                                        <div class="avatar mr-1 avatar-lg bg-transparent">
                                                            @if ($user->image)
                                                                <img src="{{ '/img/user/' . $user->image }}"
                                                                    alt="{{ $user->name }}">
                                                            @else
                                                                <img src="https://avatars.dicebear.com/api/adventurer/:jhone.svg"
                                                                    alt="{{ $user->name }}">
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        @if (!empty($user->getRoleNames()))
                                                            @foreach ($user->getRoleNames() as $v)
                                                                {{ $v }}
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @can('users-edit')
                                                            <a class="btn btn-outline-primary round mr-1 mb-1 waves-effect waves-light"
                                                                href="{{ route('users.edit', $user->id) }}">Update</a>
                                                        @endcan
                                                        @can('users-delete')
                                                            <button type="button"
                                                                class="btn btn-outline-danger round mr-1 mb-1 waves-effect waves-light"
                                                                id="delete-users" data-id="{{ $user->id }}"
                                                                data-name="{{ $user->name }}">Delete</button>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! $data->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('body').on('click', '#delete-users', function() {
            var users_id = $(this).data('id');
            var users_name = $(this).data('name');
            var text_data = 'Are you sure to delete user' + ' ' + users_name + ' ?';
            Swal.fire({
                title: 'Delete User',
                text: text_data,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-danger ml-1',
                buttonsStyling: false,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        url: SITEURL + "/dashboard/users/destroy/" + users_id,
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status == true) {
                                $("#user_table").load(window.location.href +
                                    " #user_table");
                                Swal.fire({
                                    type: "success",
                                    title: 'Deleted!',
                                    text: 'User has been deleted.',
                                    confirmButtonClass: 'btn btn-success',
                                })
                            }
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }

                    });
                }
            });
        });
    </script>
@endpush
