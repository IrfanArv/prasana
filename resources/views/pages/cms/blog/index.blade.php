@extends('layouts.cms')
@section('title', 'Blog Posts')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Blog Posts</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Blog Posts
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <a href="{{ route('blog.create') }}"
                        class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-light">
                        <i class="feather icon-plus-circle"></i></a>
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
                                    <table class="table" id="blog_table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Title</th>
                                                <th>Categories</th>
                                                <th>Status</th>
                                                <th>Featured</th>
                                                <th>Author</th>
                                                <th>Date</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($posts as $post)
                                                <tr>
                                                    <td class="text-center">
                                                        @if ($post->cover_image)
                                                            <div class="avatar mr-1 avatar-lg bg-transparent">
                                                                <img src="{{ asset('/img/blog/' . $post->cover_image) }}"
                                                                    alt="{{ $post->title }}">
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>{!! $post->title !!}</td>
                                                    <td>
                                                        @foreach ($post->categories as $cat)
                                                            <span class="badge badge-light-primary">{{ $cat->name }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @if ($post->is_published)
                                                            <span class="badge badge-light-success">Published</span>
                                                        @else
                                                            <span class="badge badge-light-warning">Draft</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($post->is_featured)
                                                            <span class="badge badge-light-info">Featured</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $post->author->name ?? '-' }}</td>
                                                    <td>{{ $post->created_at->format('d M Y') }}</td>
                                                    <td class="text-center">
                                                        <a class="btn btn-outline-primary round mr-1 mb-1 waves-effect waves-light"
                                                            href="{{ route('blog.edit', ['id' => $post->id]) }}">Update</a>
                                                        <button type="button" id="delete-blog"
                                                            data-id="{{ $post->id }}"
                                                            data-name="{{ $post->title }}"
                                                            class="btn btn-outline-danger round mr-1 mb-1 waves-effect waves-light">Delete</button>
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
        {!! $posts->render() !!}
    </div>
@endsection

@push('scripts')
    <script>
        $('body').on('click', '#delete-blog', function() {
            var blog_id = $(this).data('id');
            var blog_name = $(this).data('name');
            var text_data = 'Are you sure to delete blog post' + ' ' + blog_name + ' ?';
            Swal.fire({
                title: 'Delete Blog Post!',
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
                        url: SITEURL + "/dashboard/blog/destroy/" + blog_id,
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status == true) {
                                $("#blog_table").load(window.location.href +
                                    " #blog_table");
                                Swal.fire({
                                    type: "success",
                                    title: 'Deleted!',
                                    text: 'Blog post has been deleted.',
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
