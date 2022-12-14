@extends('layouts.cms')
@section('title', 'Offers')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Offers</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Offers
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    @can('wedding-offers-create')
                        <a href="{{ route('offers.create') }}"
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
                                    <table class="table" id="offer_table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Title</th>
                                                <th>Slides</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $product)
                                                <tr>
                                                    @if ($product->image)
                                                        <td class="text-center">
                                                            <div class="avatar mr-1 avatar-lg bg-transparent">
                                                                <img src="{{ '/img/products/' . $product->image }}"
                                                                    alt="{{ $product->title }}">
                                                            </div>
                                                        </td>
                                                    @endif
                                                    <td>{{ $product->title }}</td>
                                                    <td class="p-1">
                                                        <ul class="list-unstyled users-list m-0  d-flex align-items-center">
                                                            @foreach ($product->getMedia($mediaCollection)->take(2) as $media)
                                                                <li class="avatar pull-up">
                                                                    <img class="media-object rounded-circle"
                                                                        src="{{ $media->getUrl() }}"
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
                                                        @can('wedding-offers-edit')
                                                            <a class="btn btn-outline-primary round mr-1 mb-1 waves-effect waves-light"
                                                                href="{{ route('offers.edit', ['id' => $product->id]) }}">Update</a>
                                                        @endcan
                                                        @can('wedding-offers-delete')
                                                            <button type="button" id="delete-offer"
                                                                data-id="{{ $product->id }}" data-name="{{ $product->title }}"
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
        {!! $data->render() !!}
    </div>
@endsection

@push('scripts')
    <script>
        $('body').on('click', '#delete-offer', function() {
            var offer_id = $(this).data('id');
            var offer_name = $(this).data('name');
            var text_data = 'Are you sure to delete offer' + ' ' + offer_name + ' ?';
            Swal.fire({
                title: 'Delete Offers !',
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
                        url: SITEURL + "/dashboard/product/destroy/" + offer_id,
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status == true) {
                                $("#offer_table").load(window.location.href +
                                    " #offer_table");
                                Swal.fire({
                                    type: "success",
                                    title: 'Deleted!',
                                    text: 'Offers has been deleted.',
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
