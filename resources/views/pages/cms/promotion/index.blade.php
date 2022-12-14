@extends('layouts.cms')
@section('title', 'Promotions Banner')
@section('content')
   
    </style>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Promotions Banner</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Promotions Banner
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <button id="addPromotion"
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
                                    <table class="table" id="promotion_table">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Title</th>
                                                <th>Page Position</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $promotion)
                                                <tr class="text-center">
                                                    <td>
                                                        <div class="avatar mr-1 avatar-lg bg-transparent">
                                                            @if ($promotion->image)
                                                                <img src="{{ asset('/img/user/' . $promotion->image) }}"
                                                                    alt="{{ $promotion->name }}">
                                                            @else
                                                                <img src=https://dummyimage.com/240x250/A58639/fff.png&text=BANNER"
                                                                    alt="{{ $promotion->name }}">
                                                            @endif
                                                        </div>
                                                        <br>
                                                        {{ $promotion->title }}
                                                    </td>
                                                    <td class="text-capitalize">
                                                        {{ $promotion->position }}
                                                    </td>
                                                    <td class="text-capitalize">{{ $promotion->status }}</td>
                                                    <td>
                                                        @can('promotions-edit')
                                                            <button
                                                                class="btn btn-outline-primary round mr-1 mb-1 waves-effect waves-light edit-promotion"
                                                                type="button" data-id="{{ $promotion->id }}">Update</button>
                                                        @endcan
                                                        @can('promotions-delete')
                                                            <button type="button"
                                                                class="btn btn-outline-danger round mr-1 mb-1 waves-effect waves-light"
                                                                id="delete-promotion" data-id="{{ $promotion->id }}"
                                                                data-name="{{ $promotion->title }}">Delete</button>
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
                        {!! $data->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modals --}}
    <div class="modal fade text-left" data-backdrop="false" id="promotion-modal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="promotionForm" name="promotionForm" enctype="multipart/form-data">
                    <input type="hidden" name="promotion_id" id="promotion_id">
                    <div class="modal-body">
                        <div class="row mb-2 justify-content-center">
                            <div class="col-auto">
                                <img class="avatar-sm rounded-circle" width="100" height="100" id="modal-preview"
                                    src="https://via.placeholder.com/150"><br><br>
                                <div class="upload-btn-wrapper">
                                    <button class="btn-upload">Upload Banner</button>
                                    <input id="image" type="file" name="image" accept="image/*"
                                        onchange="readURL(this);">
                                </div>
                                <input type="hidden" name="hidden_image" id="hidden_image">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Title </label>
                                <input id="title_form" name="title" type="text" placeholder="Title"
                                    class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Urls </label>
                                <input id="urls" name="urls" type="text" placeholder="Url"
                                    class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <select class="form-control" name="position" id="position">
                                    <option value="home">Home Page</option>
                                    <option value="our-villa">Villa Page</option>
                                    <option value="dinings">Dining Page</option>
                                    <option value="menaka-spa">Spa Page</option>
                                    <option value="weddings">Wedding Page</option>
                                    <option value="offers">Offers Page</option>
                                    <option value="experience">Experience Page</option>
                                    <option value="gallery">Gallery Page</option>
                                    <option value="contact-us">Contact Page</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <select class="form-control" name="status" id="status">
                                    <option value="active">Active</option>
                                    <option value="deactive">Deactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn-save" value="create">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#addPromotion').click(function() {
                $('#btn-save').val("create-promotion");
                $('#title').html("Create Promotion");
                $('#promotionForm').trigger("reset");
                $('#promotion-modal').modal('show');
                $('#modal-preview').attr('src', 'https://via.placeholder.com/350');

            });

            $('body').on('click', '.edit-promotion', function() {
                var promotion_id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: SITEURL + "/dashboard/promotions/edit/" + promotion_id,
                    success: function(data) {
                        $('#title').html("Edit Promotion");
                        $('#btn-save').val("edit-promotion");
                        $('#promotion-modal').modal('show');
                        $('#promotion_id').val(data.id);
                        $('#title_form').val(data.title);
                        $('#position').val(data.position);
                        $('#urls').val(data.urls);
                        $('#status').val(data.status);
                        $('#modal-preview').attr('alt', 'No image available');
                        if (data.image) {
                            $('#modal-preview').attr('src', '{{ URL::to('/img/user') }}' + '/' + data.image);
                            $('#hidden_image').attr('src', '{{ URL::to('/img/user') }}' + '/' + data.image);
                        }
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });

            });

            $('body').on('click', '#delete-promotion', function() {
                var promotion_id = $(this).data('id');
                var promotion_name = $(this).data('name');
                var text_data = 'Are you sure to delete promotion ' + ' ' + promotion_name + ' ?';
                Swal.fire({
                    title: 'Delete Banner Promotion ',
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
                            url: SITEURL + "/dashboard/promotions/destroy/" + promotion_id,
                            dataType: "JSON",
                            success: function(data) {
                                if (data.status == true) {
                                    $("#promotion_table").load(window.location.href +
                                        " #promotion_table");
                                    Swal.fire({
                                        type: "success",
                                        title: 'Deleted!',
                                        text: 'Banner Promotion has been delete',
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

        $('body').on('submit', '#promotionForm', function(e) {
            e.preventDefault();
            var actionType = $('#btn-save').val();
            $('#btn-save').html('Sending..');
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: SITEURL + "/dashboard/promotions/store",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#promotionForm').trigger("reset");
                    $('#promotion-modal').modal('hide');
                    $('#btn-save').html('Save Changes');
                    $("#promotion_table").load(window.location.href + " #promotion_table");
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#btn-save').html('Save Changes');
                }
            });
        });
    </script>
@endpush
