@extends('layouts.cms')
@section('title', 'Roles')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Roles</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Roles
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    @can('role-create')
                        <a href="{{ route('roles.create') }}"
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
                                    <table class="table" id="role_table">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Roles</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $key => $role)
                                                <tr class="text-center">
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $role->name }}</td>
                                                    <td>
                                                        @can('role-edit')
                                                            <a class="btn btn-outline-primary round mr-1 mb-1 waves-effect waves-light"
                                                                href="{{ route('roles.edit', $role->id) }}">Update</a>
                                                        @endcan
                                                        @can('role-delete')
                                                            <button type="button"
                                                                class="btn btn-outline-danger round mr-1 mb-1 waves-effect waves-light"
                                                                id="delete-role" data-id="{{ $role->id }}"
                                                                data-name="{{ $role->name }}">Delete</button>
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
                    {!! $roles->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('body').on('click', '#delete-role', function() {
            var role_id = $(this).data('id');
            var role_name = $(this).data('name');
            var text_data = 'Are you sure to delete role' + ' ' + role_name + ' ?';
            Swal.fire({
                title: 'Delete Roles',
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
                        url: SITEURL + "/dashboard/roles/destroy/" + role_id,
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status == true) {
                                $("#role_table").load(window.location.href +
                                    " #role_table");
                                Swal.fire({
                                    type: "success",
                                    title: 'Deleted!',
                                    text: 'Role has been deleted.',
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
