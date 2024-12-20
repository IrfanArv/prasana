@extends('layouts.cms')
@section('title', 'Add New Villa')
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
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard/villa') }}">Villa</a>
                                </li>
                                <li class="breadcrumb-item active">Add New Villa
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
                                <form action="{{ route('villa.store') }}" method="POST" enctype="multipart/form-data">
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
                                                        <span>Villa Name</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input name="name" id="name" type="text"
                                                            class="form-control" onkeyup="convertToSlug()">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>URL</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input name="slug" id="slug" type="text"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>Building Area</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="building_area" type="number" class="form-control">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <span>SQM</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>Capacity</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="capacity" type="number" class="form-control">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <span>Guest</span>
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
                                                        <span>Slides</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="needsclick dropzone" id="document-dropzone"></div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>Services</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group m-checkbox-inline mb-0">
                                                            <input class="checkbox_animated" type="checkbox" id="checkAllServices">
                                                            <span>Check All</span>
                                                            <hr>
                                                            <div class="column-count-2">
                                                                @foreach ($serviceVilla as $value)
                                                                    {{ Form::checkbox('services[]', $value->id, false, ['class' => 'allService']) }}
                                                                    <span>{{ $value->name }}</span><br />
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>Room Feature</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group m-checkbox-inline mb-0">
                                                            <input class="checkbox_animated" type="checkbox"
                                                                id="checkAllFeature">
                                                            <span>Check All</span>
                                                            <hr>
                                                            <div class="column-count-2">
                                                                @foreach ($featureVilla as $value)
                                                                    {{ Form::checkbox('featured[]', $value->id, false, ['class' => 'allFeature']) }}
                                                                    <span>{{ $value->name }}</span><br />
                                                                @endforeach
                                                            </div>
                                                        </div>
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
                                                        <input name="meta_title" id="meta_title" type="text"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>Meta Description</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" name="meta_desc" id="meta_desc" cols="10" rows="2"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>Meta Keyword</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input name="meta_keyword" id="meta_keyword" type="text"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8 offset-md-4 text-right mt-3">
                                                <a class="btn btn-light mr-1 mb-1" href="{{ url('dashboard/villa') }}">
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
        CKEDITOR.replace('description', {
            allowedContent: true,
            versionCheck: false
        });
        $(document).ready(function() {
            $("#checkAllServices").click(function() {
                $('.allService').not(this).prop('checked', this.checked);
            });
            $("#checkAllFeature").click(function() {
                $('.allFeature').not(this).prop('checked', this.checked);
            });
        });
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
            }
        }

        function convertToSlug() {

            var name = document.getElementById('name').value;
            var strings = [name];
            var str = strings.filter(e => e.length > 0).join('-');
            str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();
            str = str.replace(/^\s+|\s+$/gm, '');
            str = str.replace(/\s+/g, '-');
            document.getElementById('slug').value = str;
            document.getElementById('meta_title').value = strings;
        }
    </script>
@endpush
