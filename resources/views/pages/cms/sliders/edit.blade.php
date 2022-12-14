@extends('layouts.cms')
@section('title', 'Edit Slider')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Sliders of Pages</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard/sliders') }}">Sliders of Pages</a>
                                </li>
                                <li class="breadcrumb-item active">Edit Sliders
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
                                <form action="{{ route('sliders.update', ['id' => $sliders->id]) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>Pages</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select class="form-control" name="pages">
                                                            @if (old('pages', $sliders->pages) === 'home')
                                                            <option value="home" selected>Home Page</option>
                                                            <option value="villa">Villa Page</option>
                                                            <option value="dining">Dining Page</option>
                                                            <option value="spa">Spa Page</option>
                                                            <option value="wedding">Wedding Page</option>
                                                            <option value="offers">Offers Page</option>
                                                            <option value="experience">Experience Page</option>
                                                            <option value="gallery">Gallery Page</option>
                                                            <option value="contact">Contact Page</option>
                                                            @endif
                                                            @if (old('pages', $sliders->pages) === 'villa')
                                                            <option value="home">Home Page</option>
                                                            <option value="villa" selected>Villa Page</option>
                                                            <option value="dining">Dining Page</option>
                                                            <option value="spa">Spa Page</option>
                                                            <option value="wedding">Wedding Page</option>
                                                            <option value="offers">Offers Page</option>
                                                            <option value="experience">Experience Page</option>
                                                            <option value="gallery">Gallery Page</option>
                                                            <option value="contact">Contact Page</option>
                                                            @endif
                                                            @if (old('pages', $sliders->pages) === 'dining')
                                                            <option value="home">Home Page</option>
                                                            <option value="villa">Villa Page</option>
                                                            <option value="dining" selected>Dining Page</option>
                                                            <option value="spa">Spa Page</option>
                                                            <option value="wedding">Wedding Page</option>
                                                            <option value="offers">Offers Page</option>
                                                            <option value="experience">Experience Page</option>
                                                            <option value="gallery">Gallery Page</option>
                                                            <option value="contact">Contact Page</option>
                                                            @endif
                                                            @if (old('pages', $sliders->pages) === 'spa')
                                                            <option value="home">Home Page</option>
                                                            <option value="villa">Villa Page</option>
                                                            <option value="dining">Dining Page</option>
                                                            <option value="spa" selected>Spa Page</option>
                                                            <option value="wedding">Wedding Page</option>
                                                            <option value="offers">Offers Page</option>
                                                            <option value="experience">Experience Page</option>
                                                            <option value="gallery">Gallery Page</option>
                                                            <option value="contact">Contact Page</option>
                                                            @endif
                                                            @if (old('pages', $sliders->pages) === 'wedding')
                                                            <option value="home">Home Page</option>
                                                            <option value="villa">Villa Page</option>
                                                            <option value="dining">Dining Page</option>
                                                            <option value="spa">Spa Page</option>
                                                            <option value="wedding" selected>Wedding Page</option>
                                                            <option value="offers">Offers Page</option>
                                                            <option value="experience">Experience Page</option>
                                                            <option value="gallery">Gallery Page</option>
                                                            <option value="contact">Contact Page</option>
                                                            @endif
                                                            @if (old('pages', $sliders->pages) === 'offers')
                                                            <option value="home">Home Page</option>
                                                            <option value="villa">Villa Page</option>
                                                            <option value="dining">Dining Page</option>
                                                            <option value="spa">Spa Page</option>
                                                            <option value="wedding">Wedding Page</option>
                                                            <option value="offers" selected>Offers Page</option>
                                                            <option value="experience">Experience Page</option>
                                                            <option value="gallery">Gallery Page</option>
                                                            <option value="contact">Contact Page</option>
                                                            @endif
                                                            @if (old('pages', $sliders->pages) === 'experience')
                                                            <option value="home">Home Page</option>
                                                            <option value="villa">Villa Page</option>
                                                            <option value="dining">Dining Page</option>
                                                            <option value="spa">Spa Page</option>
                                                            <option value="wedding">Wedding Page</option>
                                                            <option value="offers">Offers Page</option>
                                                            <option value="experience" selected>Experience Page</option>
                                                            <option value="gallery">Gallery Page</option>
                                                            <option value="contact">Contact Page</option>
                                                            @endif
                                                            @if (old('pages', $sliders->pages) === 'gallery')
                                                            <option value="home">Home Page</option>
                                                            <option value="villa">Villa Page</option>
                                                            <option value="dining">Dining Page</option>
                                                            <option value="spa">Spa Page</option>
                                                            <option value="wedding">Wedding Page</option>
                                                            <option value="offers">Offers Page</option>
                                                            <option value="experience" >Experience Page</option>
                                                            <option value="gallery" selected>Gallery Page</option>
                                                            <option value="contact">Contact Page</option>
                                                            @endif
                                                            @if (old('pages', $sliders->pages) === 'contact')
                                                            <option value="home">Home Page</option>
                                                            <option value="villa">Villa Page</option>
                                                            <option value="dining">Dining Page</option>
                                                            <option value="spa">Spa Page</option>
                                                            <option value="wedding">Wedding Page</option>
                                                            <option value="offers">Offers Page</option>
                                                            <option value="experience" >Experience Page</option>
                                                            <option value="gallery">Gallery Page</option>
                                                            <option value="contact" selected>Contact Page</option>
                                                            @endif
                                                            @if (old('pages', $sliders->pages) === 'home2')
                                                            <option value="home2" selected>Inner Home</option>
                                                            @endif
                                                            @if (old('pages', $sliders->pages) === 'spa2')
                                                            <option value="home">Home Page</option>
                                                            <option value="villa">Villa Page</option>
                                                            <option value="dining">Dining Page</option>
                                                            <option value="spa">Spa Page</option>
                                                            <option value="wedding">Wedding Page</option>
                                                            <option value="offers">Offers Page</option>
                                                            <option value="experience" >Experience Page</option>
                                                            <option value="gallery">Gallery Page</option>
                                                            <option value="contact" selected>Contact Page</option>
                                                            @endif
                                                            @if (old('pages', $sliders->pages) === 'spa2')
                                                            <option value="spa2" selected>Spa Slider</option>
                                                            @endif
                                                            @if (old('pages', $sliders->pages) === 'whim')
                                                            <option value="home">Home Page</option>
                                                            <option value="villa">Villa Page</option>
                                                            <option value="dining">Dining Page</option>
                                                            <option value="spa">Spa Page</option>
                                                            <option value="wedding">Wedding Page</option>
                                                            <option value="offers">Offers Page</option>
                                                            <option value="experience" >Experience Page</option>
                                                            <option value="gallery">Gallery Page</option>
                                                            <option value="contact" selected>Contact Page</option>
                                                            @endif
                                                            @if (old('pages', $sliders->pages) === 'whim')
                                                            <option value="whim" selected>Whim Restaurant</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>Title</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input name="title" value="{{ old('title', $sliders->title) }}" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <span>Sub Title</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input name="sub_title" value="{{ old('sub_title', $sliders->sub_title) }}" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <h3 class="text-center">Images of page</h3>
                                                <div class="needsclick dropzone" id="document-dropzone"></div>
                                            </div>
                                            <div class="col-md-8 offset-md-4 text-right mt-3">
                                                <a class="btn btn-light mr-1 mb-1" href="{{ url('dashboard/sliders') }}">
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
            url: '{{ route('sliders.storeMedia') }}',
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
    </script>
@endpush
