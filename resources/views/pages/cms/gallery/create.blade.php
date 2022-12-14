@extends('layouts.cms')
@section('title', 'Create Gallery')
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
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard/gallery') }}">Gallery</a>
                                </li>
                                <li class="breadcrumb-item active">Create Gallery
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <p class="mb-0">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    </p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>Title</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input name="title" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>Gallery</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="needsclick dropzone" id="document-dropzone"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8 offset-md-4 text-right mt-3">
                                                <a class="btn btn-light mr-1 mb-1" href="{{ url('dashboard/gallery') }}">
                                                    Back</a>
                                                <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: '{{ route('gallery.storeMedia') }}',
            maxFilesize: 4, // MB
            addRemoveLinks: true,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="photo[]" value="' + response.name + '">')
                uploadedDocumentMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="photo[]"][value="' + name + '"]').remove()
            }
        }
    </script>
@endpush
