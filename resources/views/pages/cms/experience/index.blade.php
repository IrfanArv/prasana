@extends('layouts.cms')
@section('title', 'Experience')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Experience</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Experience
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    @can('experience-create')
                        <a href="{{ route('experience.create') }}"
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
                                    <table class="table" id="experience_table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Title</th>
                                                <th>Location</th>
                                                <th>Slides</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($experiences as $experience)
                                                <tr>
                                                    @if ($experience->image)
                                                        <td class="text-center">
                                                            <div class="avatar mr-1 avatar-lg bg-transparent">
                                                                <img src="{{ '/img/experience/' . $experience->image }}" alt="{{ $experience->title }}">
                                                            </div>
                                                        </td>
                                                    @endif
                                                    <td>{{ $experience->title }}</td>
                                                    <td>{{ $experience->location }}</td>
                                                    <td class="p-1">
                                                        <ul class="list-unstyled users-list m-0  d-flex align-items-center">
                                                            @foreach ($experience->getMedia($mediaCollection)->take(2) as $media)
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
                                                        @can('experience-edit')
                                                            <a class="btn btn-outline-primary round mr-1 mb-1 waves-effect waves-light"
                                                                href="{{ route('experience.edit', ['id' => $experience->id]) }}">Update</a>
                                                        @endcan
                                                        @can('experience-delete')
                                                            <button type="button" id="delete-experience"
                                                                data-id="{{ $experience->id }}" data-name="{{ $experience->title }}"
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
        {!! $experiences->render() !!}
    </div>
@endsection

@push('scripts')
    <script>
        $('body').on('click', '#delete-experience', function() {
            var experience_id = $(this).data('id');
            var experience_name = $(this).data('name');
            var text_data = 'Are you sure to delete experience' + ' ' + experience_name + ' ?';
            Swal.fire({
                title: 'Delete experience !',
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
                        url: SITEURL + "/dashboard/experience/destroy/" + experience_id,
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status == true) {
                                $("#experience_table").load(window.location.href +
                                    " #experience_table");
                                Swal.fire({
                                    type: "success",
                                    title: 'Deleted!',
                                    text: 'experience has been deleted.',
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
