@extends('layouts.cms')
@section('title', 'Property Details')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Property Details</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Property Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <button id="addDetail" class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-light">
                        <i class="feather icon-plus-circle"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="detail_table">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Title</th>
                                                <th>Content</th>
                                                <th>Sort Order</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $detail)
                                                <tr class="text-center">
                                                    <td>{{ Str::limit($detail->title, 50) }}</td>
                                                    <td>{{ Str::limit(strip_tags($detail->content), 50) }}</td>
                                                    <td>{{ $detail->sort_order }}</td>
                                                    <td>
                                                        <button class="btn btn-outline-primary round mr-1 mb-1 waves-effect waves-light edit-detail" type="button" data-id="{{ $detail->id }}">Update</button>
                                                        <button type="button" class="btn btn-outline-danger round mr-1 mb-1 waves-effect waves-light" id="delete-detail" data-id="{{ $detail->id }}" data-name="{{ $detail->title }}">Delete</button>
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
                        {!! $data->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}
    <div class="modal fade text-left" data-backdrop="false" id="detail-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="detailForm" name="detailForm">
                    <input type="hidden" name="detail_id" id="detail_id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-9">
                                <label>Title</label>
                                <input id="detail_title" name="title" type="text" placeholder="Enter title" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Sort Order</label>
                                <input id="detail_sort_order" name="sort_order" type="number" placeholder="0" class="form-control" value="0">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Content</label>
                                <textarea class="form-control" name="content" id="detail_content" cols="10" rows="4" placeholder="Enter content"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn-save-detail" value="create">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#addDetail').click(function() {
                $('#btn-save-detail').val("create-detail");
                $('#title').html("Add Property Detail");
                $('#detailForm').trigger("reset");
                $('#detail-modal').modal('show');
            });

            $('body').on('click', '.edit-detail', function() {
                var detail_id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: SITEURL + "/dashboard/property-details/edit/" + detail_id,
                    success: function(data) {
                        $('#title').html("Edit Property Detail");
                        $('#btn-save-detail').val("edit-detail");
                        $('#detail-modal').modal('show');
                        $('#detail_id').val(data.id);
                        $('#detail_title').val(data.title);
                        $('#detail_content').val(data.content);
                        $('#detail_sort_order').val(data.sort_order);
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });

            $('body').on('click', '#delete-detail', function() {
                var detail_id = $(this).data('id');
                var detail_name = $(this).data('name');
                Swal.fire({
                    title: 'Delete Property Detail',
                    text: 'Are you sure to delete "' + detail_name + '"?',
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
                            url: SITEURL + "/dashboard/property-details/destroy/" + detail_id,
                            dataType: "JSON",
                            success: function(data) {
                                if (data.status == true) {
                                    $("#detail_table").load(window.location.href + " #detail_table");
                                    Swal.fire({
                                        type: "success",
                                        title: 'Deleted!',
                                        text: 'Property Detail has been deleted.',
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

        $('body').on('submit', '#detailForm', function(e) {
            e.preventDefault();
            $('#btn-save-detail').html('Sending..');
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: SITEURL + "/dashboard/property-details/store",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#detailForm').trigger("reset");
                    $('#detail-modal').modal('hide');
                    $('#btn-save-detail').html('Save');
                    $("#detail_table").load(window.location.href + " #detail_table");
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#btn-save-detail').html('Save');
                }
            });
        });
    </script>
@endpush
