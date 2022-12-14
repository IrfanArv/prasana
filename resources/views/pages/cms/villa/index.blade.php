@extends('layouts.cms')
@section('title', 'Villa')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Villa</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Villa
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    @can('villa-create')
                        <a href="{{ url('/dashboard/villa/create') }}"
                            class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-light">
                            <i class="feather icon-plus-circle"></i>
                        </a>
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
                                    <table class="table" id="villas_table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="text-center">Title</th>
                                                <th class="text-center">Building Area</th>
                                                <th class="text-center">Capacity</th>
                                                <th class="text-center">Slides</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($villas as $key => $villa)
                                                <tr class="text-center">
                                                    <td class="text-center">
                                                        <div class="avatar mr-1 avatar-lg bg-transparent">
                                                            @if ($villa->image)
                                                                <img src="{{ asset('/img/villas/' . $villa->image) }}"
                                                                    alt="{{ $villa->name }}">
                                                            @else
                                                                <img src="https://dummyimage.com/100x100/fff/aaa"
                                                                    alt="{{ $villa->name }}">
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>{{ $villa->name }}</td>
                                                    <td>{{ $villa->building_area }} sqm</td>
                                                    <td>{{ $villa->capacity }} Guest</td>
                                                    <td class="p-1">
                                                        <ul class="list-unstyled users-list m-0  d-flex align-items-center">
                                                            @foreach ($villa->getMedia($mediaCollection)->take(2) as $media)
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
                                                    <td class="float-right">
                                                        @can('villa-edit')
                                                            <a href="{{ route('villa.edit', ['id' => $villa->id]) }}"
                                                                class="btn btn-outline-primary round mr-1 mb-1 waves-effect waves-light edit-feature"
                                                                type="button">Update</a>
                                                        @endcan
                                                        @can('villa-delete')
                                                            <button type="button"
                                                                class="btn btn-outline-danger round mr-1 mb-1 waves-effect waves-light"
                                                                id="delete-villa" data-id="{{ $villa->id }}"
                                                                data-name="{{ $villa->name }}">Delete</button>
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
                        {!! $villas->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('body').on('click', '#delete-villa', function() {
            var villa_id = $(this).data('id');
            var villa_name = $(this).data('name');
            var text_data = 'Are you sure to delete villa' + ' ' + villa_name + ' ?';
            Swal.fire({
                title: 'Delete villa !',
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
                        url: SITEURL + "/dashboard/villa/destroy/" + villa_id,
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status == true) {
                                $("#villas_table").load(window.location.href +
                                    " #villas_table");
                                Swal.fire({
                                    type: "success",
                                    title: 'Deleted!',
                                    text: 'Villa has been deleted.',
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
