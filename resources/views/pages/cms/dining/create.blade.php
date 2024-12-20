@extends('layouts.cms')
@section('title', 'Create Dining')
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
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard/dining') }}">Dining</a>
                                </li>
                                <li class="breadcrumb-item active">Create Dining
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
                                <form action="{{ route('dining.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12 px-3">
                                                <div class="row mb-2">
                                                    <div class="col-auto">
                                                        <img class="img-fluid rounded" id="modal-preview"
                                                            src="https://dummyimage.com/1000x250/A58639/fff.png&text=IMAGES"><br><br>
                                                        <div
                                                            class="upload-btn-wrapper d-flex justify-content-center align-self-center">
                                                            <button class="btn-upload">Upload Cover</button>
                                                            <input id="image" type="file" name="image"
                                                                accept="image/*" onchange="readURL(this);">
                                                        </div>
                                                        <input type="hidden" name="hidden_image" id="hidden_image">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 px-3 pt-2">
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>Title</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input name="title" id="title" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>Description</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <textarea class="ckeditor" name="description" id="description" cols="30" rows="10"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>URL</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input name="url" id="url" type="text"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>Slides</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="needsclick dropzone" id="document-dropzone"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8 offset-md-4 text-right mt-3">
                                                <a class="btn btn-light mr-1 mb-1" href="{{ url('dashboard/dining') }}">
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
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: '{{ route('dining.storeMedia') }}',
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
