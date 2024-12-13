@extends('layouts.cms')
@section('title', 'Dining')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Dining</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Dining
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    @can('dining-create')
                        <a href="{{ route('dining.create') }}"
                            class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-light">
                            <i class="feather icon-plus-circle"></i></a>
                    @endcan
                </div>
            </div> --}}
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
                                    <table class="table" id="dining_table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Title</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dinings as $dining)
                                                <tr>
                                                    @if ($dining->image)
                                                        <td class="text-center">
                                                            <div class="avatar mr-1 avatar-lg bg-transparent">
                                                                <img src="{{ asset('/img/dining/' . $dining->image) }}"
                                                                    alt="{{ $dining->title }}">
                                                            </div>
                                                        </td>
                                                    @endif
                                                    <td>{!! $dining->title !!}</td>
                                                    <td class="text-center">
                                                        @can('dining-edit')
                                                            <a class="btn btn-outline-primary round mr-1 mb-1 waves-effect waves-light"
                                                                href="{{ route('dining.edit', ['id' => $dining->id]) }}">Update</a>
                                                        @endcan
                                                        {{-- @can('dining-delete')
                                                            <button type="button" id="delete-dining"
                                                                data-id="{{ $dining->id }}"
                                                                data-name="{{ $dining->title }}"
                                                                class="btn btn-outline-danger round mr-1 mb-1 waves-effect waves-light">Delete</button>
                                                        @endcan --}}
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
        {!! $dinings->render() !!}
    </div>
@endsection

@push('scripts')
    <script>
        $('body').on('click', '#delete-dining', function() {
            var dining_id = $(this).data('id');
            var dining_name = $(this).data('name');
            var text_data = 'Are you sure to delete dining' + ' ' + dining_name + ' ?';
            Swal.fire({
                title: 'Delete dining !',
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
                        url: SITEURL + "/dashboard/dining/destroy/" + dining_id,
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status == true) {
                                $("#dining_table").load(window.location.href +
                                    " #dining_table");
                                Swal.fire({
                                    type: "success",
                                    title: 'Deleted!',
                                    text: 'dining has been deleted.',
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
