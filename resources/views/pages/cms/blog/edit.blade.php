@extends('layouts.cms')
@section('title', 'Edit Blog Post')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #a58639 !important;
            border-color: #a58639 !important;
            color: white !important;
        }
        .cover-preview-wrapper {
            position: relative;
            width: 100%;
            max-height: 180px;
            overflow: hidden;
            border-radius: 8px;
            border: 2px dashed #d9d9d9;
            cursor: pointer;
            transition: border-color 0.3s;
        }
        .cover-preview-wrapper:hover {
            border-color: #a58639;
        }
        .cover-preview-wrapper img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        .cover-preview-wrapper .cover-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .cover-preview-wrapper:hover .cover-overlay {
            opacity: 1;
        }
        .cover-overlay span {
            color: white;
            font-size: 14px;
            font-weight: 600;
        }
        .cover-placeholder {
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: #aaa;
        }
        .cover-placeholder i {
            font-size: 32px;
            margin-bottom: 8px;
        }
        .sidebar-card {
            border: 1px solid #e4e7ed;
            border-radius: 8px;
        }
        .sidebar-card .card-header {
            background: #f8f9fa;
            border-bottom: 1px solid #e4e7ed;
            padding: 12px 16px;
        }
        .sidebar-card .card-header h6 {
            margin: 0;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #636363;
        }
        .sidebar-card .card-body {
            padding: 16px;
        }
        .seo-preview {
            background: #fff;
            border: 1px solid #dadce0;
            border-radius: 8px;
            padding: 12px;
            font-family: Arial, sans-serif;
        }
        .seo-preview .seo-title {
            color: #1a0dab;
            font-size: 16px;
            font-weight: 400;
            margin-bottom: 2px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .seo-preview .seo-url {
            color: #006621;
            font-size: 13px;
            margin-bottom: 4px;
        }
        .seo-preview .seo-desc {
            color: #545454;
            font-size: 13px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Edit Post</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard/blog') }}">Blog</a></li>
                                <li class="breadcrumb-item active">Edit Post</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                    </button>
                </div>
            @endif

            <form action="{{ route('blog.update', ['id' => $post->id]) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    {{-- LEFT: Main Content --}}
                    <div class="col-lg-8">
                        {{-- Title --}}
                        <div class="card mb-1">
                            <div class="card-body py-1">
                                <input name="title" id="title" type="text" class="form-control border-0 px-0"
                                    value="{{ old('title', $post->title) }}"
                                    placeholder="Post title..." onkeyup="autoGenerate()"
                                    style="font-size: 22px; font-weight: 600; height: 50px;">
                            </div>
                        </div>

                        {{-- Content Editor --}}
                        <div class="card">
                            <div class="card-body p-0">
                                <textarea class="form-control" name="content" id="content" cols="30" rows="15">{{ old('content', $post->content) }}</textarea>
                            </div>
                        </div>

                        {{-- Excerpt --}}
                        <div class="card">
                            <div class="card-header py-1">
                                <h6 class="mb-0"><i class="feather icon-align-left mr-1"></i>Excerpt</h6>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" name="excerpt" id="excerpt" rows="3"
                                    placeholder="Short summary for preview cards...">{{ old('excerpt', $post->excerpt) }}</textarea>
                            </div>
                        </div>

                        {{-- Gallery --}}
                        <div class="card">
                            <div class="card-header py-1">
                                <h6 class="mb-0"><i class="feather icon-image mr-1"></i>Gallery Photos</h6>
                            </div>
                            <div class="card-body">
                                <div class="needsclick dropzone" id="document-dropzone"></div>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT: Sidebar Settings --}}
                    <div class="col-lg-4">
                        {{-- Publish Settings --}}
                        <div class="card sidebar-card mb-2">
                            <div class="card-header">
                                <h6><i class="feather icon-settings mr-1"></i>Publish</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-1">
                                    <fieldset>
                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                            <input type="checkbox" name="is_published" value="1"
                                                {{ $post->is_published ? 'checked' : '' }}>
                                            <span class="vs-checkbox"><span class="vs-checkbox--check"><i class="vs-icon feather icon-check"></i></span></span>
                                            <span>Publish immediately</span>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="mb-1">
                                    <fieldset>
                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                            <input type="checkbox" name="is_featured" value="1"
                                                {{ $post->is_featured ? 'checked' : '' }}>
                                            <span class="vs-checkbox"><span class="vs-checkbox--check"><i class="vs-icon feather icon-check"></i></span></span>
                                            <span>Featured post</span>
                                        </div>
                                    </fieldset>
                                </div>
                                <div>
                                    <label class="small text-muted mb-50">Schedule date (optional)</label>
                                    <input name="published_at" type="datetime-local" class="form-control form-control-sm"
                                        value="{{ $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '' }}">
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-light btn-sm" href="{{ url('dashboard/blog') }}">
                                        <i class="feather icon-arrow-left mr-25"></i>Back</a>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="feather icon-save mr-25"></i>Update Post</button>
                                </div>
                            </div>
                        </div>

                        {{-- Cover Image --}}
                        <div class="card sidebar-card mb-2">
                            <div class="card-header">
                                <h6><i class="feather icon-camera mr-1"></i>Cover Image</h6>
                            </div>
                            <div class="card-body p-1">
                                <label for="image" class="mb-0 w-100" style="cursor:pointer">
                                    <div class="cover-preview-wrapper">
                                        @if ($post->cover_image)
                                            <div id="cover-placeholder" class="cover-placeholder" style="display:none;">
                                                <i class="feather icon-upload-cloud"></i>
                                                <span>Click to upload cover</span>
                                            </div>
                                            <img id="modal-preview" src="{{ asset('/img/blog/' . $post->cover_image) }}">
                                        @else
                                            <div id="cover-placeholder" class="cover-placeholder">
                                                <i class="feather icon-upload-cloud"></i>
                                                <span>Click to upload cover</span>
                                            </div>
                                            <img id="modal-preview" src="" style="display:none;">
                                        @endif
                                        <div class="cover-overlay">
                                            <span><i class="feather icon-edit-2 mr-50"></i>Change cover</span>
                                        </div>
                                    </div>
                                </label>
                                <input id="image" type="file" name="cover_image" accept="image/*"
                                    onchange="previewCover(this);" style="display:none;">
                                <input type="hidden" name="hidden_image" value="{{ $post->cover_image }}">
                            </div>
                        </div>

                        {{-- Categories --}}
                        <div class="card sidebar-card mb-2">
                            <div class="card-header">
                                <h6><i class="feather icon-folder mr-1"></i>Categories</h6>
                            </div>
                            <div class="card-body">
                                <select name="categories[]" id="categories" class="select2 form-control" multiple>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Tags --}}
                        <div class="card sidebar-card mb-2">
                            <div class="card-header">
                                <h6><i class="feather icon-tag mr-1"></i>Tags</h6>
                            </div>
                            <div class="card-body">
                                <select name="tags[]" id="tags" class="select2 form-control" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            {{ in_array($tag->id, $selectedTags) ? 'selected' : '' }}>
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- SEO --}}
                        <div class="card sidebar-card mb-2">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0"><i class="feather icon-search mr-1"></i>SEO</h6>
                                <small class="text-muted">Auto-generated</small>
                            </div>
                            <div class="card-body">
                                <div class="seo-preview mb-1">
                                    <div class="seo-title" id="seo-preview-title">{{ $post->meta_title ?? $post->title }} — Prasana</div>
                                    <div class="seo-url" id="seo-preview-url">prasanaresort.com › blog › {{ $post->slug }}</div>
                                    <div class="seo-desc" id="seo-preview-desc">{{ $post->meta_desc ?? $post->excerpt ?? 'Post description...' }}</div>
                                </div>
                                <input type="hidden" name="slug" id="slug" value="{{ old('slug', $post->slug) }}">
                                <div class="mb-1">
                                    <label class="small text-muted mb-25">Meta Title</label>
                                    <input name="meta_title" id="meta_title" type="text" class="form-control form-control-sm"
                                        value="{{ old('meta_title', $post->meta_title) }}"
                                        placeholder="Auto-filled from title">
                                </div>
                                <div class="mb-1">
                                    <label class="small text-muted mb-25">Meta Description</label>
                                    <textarea class="form-control form-control-sm" name="meta_desc" id="meta_desc"
                                        rows="2" placeholder="Auto-filled from excerpt">{{ old('meta_desc', $post->meta_desc) }}</textarea>
                                </div>
                                <div>
                                    <label class="small text-muted mb-25">Meta Keywords</label>
                                    <input name="meta_keyword" id="meta_keyword" type="text"
                                        class="form-control form-control-sm"
                                        value="{{ old('meta_keyword', $post->meta_keyword) }}"
                                        placeholder="comma, separated, keywords">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content', {
            allowedContent: true,
            versionCheck: false,
            height: 350,
            removePlugins: 'elementspath',
            toolbar: [
                { name: 'styles', items: ['Format'] },
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Blockquote'] },
                { name: 'links', items: ['Link', 'Unlink'] },
                { name: 'insert', items: ['Image', 'Table', 'HorizontalRule'] },
                { name: 'tools', items: ['Maximize'] },
                { name: 'clipboard', items: ['Undo', 'Redo'] },
            ]
        });

        $('.select2').select2({
            width: '100%',
            placeholder: 'Select or search...'
        });

        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: '{{ route('blog.storeMedia') }}',
            maxFilesize: 4,
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
                    var files = {!! json_encode($photos) !!}
                    for (var i in files) {
                        var file = files[i]
                        file = { ...file, width: 226, height: 324 }
                        this.options.addedfile.call(this, file)
                        this.options.thumbnail.call(this, file, file.original_url)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="photo[]" value="' + file.file_name + '">')
                    }
                @endif
            }
        }

        function previewCover(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#modal-preview').attr('src', e.target.result).show();
                    $('#cover-placeholder').hide();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function autoGenerate() {
            var title = document.getElementById('title').value;

            // Auto-generate slug
            var str = title.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();
            str = str.replace(/^\s+|\s+$/gm, '');
            str = str.replace(/\s+/g, '-');
            document.getElementById('slug').value = str;

            // Auto-generate meta title
            document.getElementById('meta_title').value = title;

            // Update SEO preview
            document.getElementById('seo-preview-title').textContent = (title || 'Post Title') + ' — Prasana';
            document.getElementById('seo-preview-url').textContent = 'prasanaresort.com › blog › ' + (str || '...');
        }

        // Auto-fill meta description from excerpt
        document.getElementById('excerpt').addEventListener('input', function() {
            var excerpt = this.value;
            document.getElementById('meta_desc').value = excerpt;
            document.getElementById('seo-preview-desc').textContent = excerpt || 'Post description will appear here...';
        });
    </script>
@endpush
