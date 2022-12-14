@extends('layouts.cms')
@section('title', 'Gallery')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Gallery</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Gallery
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    @can('gallery-create')
                        <a href="{{ route('gallery.create') }}"
                            class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-light">
                            <i class="feather icon-plus-circle"></i></a>
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
                                    <table class="table" id="gallery_table">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Photos</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($gallerys as $gallery) 
                                                <tr>
                                                    <td>{{ $gallery->title }}</td>
                                                    <td class="p-1">
                                                        <ul class="list-unstyled users-list m-0  d-flex align-items-center">
                                                            @foreach ($gallery->getMedia($mediaCollection)->take(2) as $media)
                                                                <li class="avatar pull-up">
                                                                    <img class="media-object rounded-circle"
                                                                        src="{{ asset($media->getUrl()) }}"
                                                                        alt="{{ $media->getUrl() }}" height="30"
                                                                        width="30">
                                                                </li>
                                                            @endforeach
                                                            <li class="avatar pull-up bg-primary">
                                                                <div class="avatar-content">+</div>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td class="text-center">
                                                        @can('gallery-edit')
                                                            <a class="btn btn-outline-primary round mr-1 mb-1 waves-effect waves-light"
                                                                href="{{ route('gallery.edit', ['id' => $gallery->id]) }}">Update</a>
                                                        @endcan
                                                        @can('gallery-delete')
                                                            <button type="button" id="delete-gallery"
                                                                data-id="{{ $gallery->id }}" data-name="{{ $gallery->title }}"
                                                                class="btn btn-outline-danger round mr-1 mb-1 waves-effect waves-light">Delete</button>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('body').on('click', '#delete-gallery', function() {
            var gallery_id = $(this).data('id');
            var gallery_name = $(this).data('name');
            var text_data = 'Are you sure to delete gallery' + ' ' + gallery_name + ' ?';
            Swal.fire({
                title: 'Delete Gallery !',
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
                        url: SITEURL + "/dashboard/gallery/destroy/" + gallery_id,
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status == true) {
                                $("#gallery_table").load(window.location.href +
                                    " #gallery_table");
                                Swal.fire({
                                    type: "success",
                                    title: 'Deleted!',
                                    text: 'Gallery has been deleted.',
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
