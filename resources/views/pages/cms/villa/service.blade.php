@extends('layouts.cms')
@section('title', 'Room Service')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Room Service</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Room Service
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <button id="addService"
                        class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-light">
                        <i class="feather icon-plus-circle"></i></button>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="service_table">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($services as $key => $service)
                                                <tr class="text-center">
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $service->name }}</td>
                                                    <td>
                                                        @can('villa-edit')
                                                            <button
                                                                class="btn btn-outline-primary round mr-1 mb-1 waves-effect waves-light edit-service"
                                                                type="button" data-id="{{ $service->id }}">Update</button>
                                                        @endcan
                                                        @can('villa-delete')
                                                            <button type="button"
                                                                class="btn btn-outline-danger round mr-1 mb-1 waves-effect waves-light"
                                                                id="delete-service" data-id="{{ $service->id }}"
                                                                data-name="{{ $service->name }}">Delete</button>
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
                    <div class="float-right">
                        {!! $services->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modals --}}
    <div class="modal fade text-left" data-backdrop="false" id="service-modal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="serviceForm" name="serviceForm">
                    <input type="hidden" name="service_id" id="service_id">
                    <div class="modal-body">
                        <label>Service Name </label>
                        <div class="form-group">
                            <input id="name" name="name" type="text" placeholder="Service Name"
                                class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // Service villa
        $(document).ready(function() {
            $('#addService').click(function() {
                $('#btn-save').val("create-service");
                $('#title').html("Add Room Service");
                $('#serviceForm').trigger("reset");
                $('#service-modal').modal('show');
            });

            $('body').on('click', '.edit-service', function() {
                var service_id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: SITEURL + "/dashboard/villas/room-service/edit/" + service_id,
                    success: function(data) {
                        $('#title').html("Edit Room Service");
                        $('#btn-save').val("edit-service");
                        $('#service-modal').modal('show');
                        $('#service_id').val(data.id);
                        $('#name').val(data.name);
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });

            });

            $('body').on('click', '#delete-service', function() {
                var service_id = $(this).data('id');
                var service_name = $(this).data('name');
                var text_data = 'Are you sure to delete' + ' ' + service_name + ' ?';
                Swal.fire({
                    title: 'Delete Service',
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
                            url: SITEURL + "/dashboard/villas/room-service/destroy/" +
                                service_id,
                            dataType: "JSON",
                            success: function(data) {
                                if (data.status == true) {
                                    $("#service_table").load(window.location.href +
                                        " #service_table");
                                    Swal.fire({
                                        type: "success",
                                        title: 'Deleted!',
                                        text: 'Service has been deleted.',
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
        });

        $('body').on('submit', '#serviceForm', function(e) {
            e.preventDefault();
            var actionType = $('#btn-save').val();
            $('#btn-save').html('Sending..');
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: SITEURL + "/dashboard/villas/room-service/store",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#serviceForm').trigger("reset");
                    $('#service-modal').modal('hide');
                    $('#btn-save').html('Save Changes');
                    $("#service_table").load(window.location.href + " #service_table");
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#btn-save').html('Save Changes');
                }
            });
        });
    </script>
@endpush
