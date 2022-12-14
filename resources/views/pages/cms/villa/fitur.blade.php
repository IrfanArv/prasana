@extends('layouts.cms')
@section('title', 'Room Feature')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Room Feature</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Room Feature
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <button id="addFeature"
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
                                    <table class="table" id="fitur_table">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($fitur as $key => $feature)
                                                <tr class="text-center">
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $feature->name }}</td>
                                                    <td>
                                                        @can('villa-edit')
                                                            <button
                                                                class="btn btn-outline-primary round mr-1 mb-1 waves-effect waves-light edit-feature"
                                                                type="button" data-id="{{ $feature->id }}">Update</button>
                                                        @endcan
                                                        @can('villa-delete')
                                                            <button type="button"
                                                                class="btn btn-outline-danger round mr-1 mb-1 waves-effect waves-light"
                                                                id="delete-feature" data-id="{{ $feature->id }}"
                                                                data-name="{{ $feature->name }}">Delete</button>
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
                        {!! $fitur->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modals --}}
    <div class="modal fade text-left" data-backdrop="false" id="feature-modal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="featureForm" name="featureForm">
                    <input type="hidden" name="feature_id" id="feature_id">
                    <div class="modal-body">
                        <label>Feature Name </label>
                        <div class="form-group">
                            <input id="name" name="name" type="text" placeholder="Feature Name"
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
        // feature villa
        $(document).ready(function() {
            $('#addFeature').click(function() {
                $('#btn-save').val("create-feature");
                $('#title').html("Add Room Feature");
                $('#featureForm').trigger("reset");
                $('#feature-modal').modal('show');
            });

            $('body').on('click', '.edit-feature', function() {
                var feature_id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: SITEURL + "/dashboard/villas/room-feature/edit/" + feature_id,
                    success: function(data) {
                        $('#title').html("Edit Room Feature");
                        $('#btn-save').val("edit-feature");
                        $('#feature-modal').modal('show');
                        $('#feature_id').val(data.id);
                        $('#name').val(data.name);
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });

            });

            $('body').on('click', '#delete-feature', function() {
                var feature_id = $(this).data('id');
                var feature_name = $(this).data('name');
                var text_data = 'Are you sure to delete Feature' + ' ' + feature_name + ' ?';
                Swal.fire({
                    title: 'Delete Feature',
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
                            url: SITEURL + "/dashboard/villas/room-feature/destroy/" +
                                feature_id,
                            dataType: "JSON",
                            success: function(data) {
                                if (data.status == true) {
                                    $("#fitur_table").load(window.location.href +
                                        " #fitur_table");
                                    Swal.fire({
                                        type: "success",
                                        title: 'Deleted!',
                                        text: 'Feature has been deleted.',
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

        $('body').on('submit', '#featureForm', function(e) {
            e.preventDefault();
            var actionType = $('#btn-save').val();
            $('#btn-save').html('Sending..');
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: SITEURL + "/dashboard/villas/room-feature/store",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#featureForm').trigger("reset");
                    $('#feature-modal').modal('hide');
                    $('#btn-save').html('Save Changes');
                    $("#fitur_table").load(window.location.href + " #fitur_table");
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#btn-save').html('Save Changes');
                }
            });
        });
    </script>
@endpush
