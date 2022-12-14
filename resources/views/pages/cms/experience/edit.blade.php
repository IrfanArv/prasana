@extends('layouts.cms')
@section('title', 'Edit Experience')
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
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard/experience') }}">Experience</a>
                                </li>
                                <li class="breadcrumb-item active">Edit Experience
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
                                <form action="{{ route('experience.update', ['id' => $experiences->id]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12 px-3">
                                                <div class="row mb-2">
                                                    <div class="col-auto">
                                                        @if ($experiences->image)
                                                            <img class="img-fluid rounded" id="modal-preview"
                                                                src="{{ asset('/img/experience/' . $experiences->image) }}"><br><br>
                                                        @else
                                                            <img class="img-fluid rounded" id="modal-preview"
                                                                src="https://dummyimage.com/1000x250/A58639/fff.png&text=IMAGES"><br><br>
                                                        @endif
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
                                                        <input value="{{ old('title', $experiences->title) }}"
                                                            name="title" id="title" type="text"
                                                            class="form-control" onkeyup="convertToSlug()">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>URL</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input name="slug" id="slug" type="text"
                                                            value="{{ old('slug', $experiences->slug) }}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>Location</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input name="location" type="text"
                                                            value="{{ old('location', $experiences->location) }}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>Description</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <textarea class="ckeditor" name="description" id="description" cols="30" rows="10">{{ old('description', $experiences->description) }}</textarea>
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
                                                <h4 class="content-header-title float-left mb-0">Meta Tags</h4>
                                                <br>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>Meta Title</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input name="meta_title" value="{{ old('meta_title', $experiences->meta_title) }}" id="meta_title" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>Meta Description</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control"  name="meta_desc" id="meta_desc" cols="10" rows="2">{{ old('meta_desc', $experiences->meta_desc) }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>Meta Keyword</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input name="meta_keyword" value="{{ old('meta_keyword', $experiences->meta_keyword) }}" id="meta_keyword" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8 offset-md-4 text-right mt-3">
                                                <a class="btn btn-light mr-1 mb-1" href="{{ url('dashboard/experience') }}">
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
            url: '{{ route('experience.storeMedia') }}',
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
            },
            init: function() {
                @if (isset($photos))
                    var files =
                        {!! json_encode($photos) !!}
                    for (var i in files) {
                        var file = files[i]
                        //    console.log(file);
                        file = {
                            ...file,
                            width: 226,
                            height: 324
                        }
                        this.options.addedfile.call(this, file)
                        this.options.thumbnail.call(this, file, file.original_url)
                        file.previewElement.classList.add('dz-complete')

                        $('form').append('<input type="hidden" name="photo[]" value="' + file.file_name + '">')
                    }
                @endif
            }
        }

        function convertToSlug() {

            var title = document.getElementById('title').value;
            var strings = [title];
            var str = strings.filter(e => e.length > 0).join('-');
            str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();
            str = str.replace(/^\s+|\s+$/gm, '');
            str = str.replace(/\s+/g, '-');
            document.getElementById('meta_title').value = strings;
            document.getElementById('slug').value = str;
        }
    </script>
@endpush
