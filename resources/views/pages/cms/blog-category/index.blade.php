@extends('layouts.cms')
@section('title', 'Blog Categories')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Blog Categories</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Blog Categories
                                </li>
                            </ol>
                        </div>
                    </div>
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
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ isset($editCategory) ? 'Edit Category' : 'Add Category' }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                                        </button>
                                    </div>
                                @endif
                                <form action="{{ route('blog-category.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ isset($editCategory) ? $editCategory->id : '' }}">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ isset($editCategory) ? $editCategory->name : old('name') }}"
                                            onkeyup="convertToSlug()">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" id="slug" class="form-control"
                                            value="{{ isset($editCategory) ? $editCategory->slug : old('slug') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="3">{{ isset($editCategory) ? $editCategory->description : old('description') }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($editCategory) ? 'Update' : 'Save' }}
                                    </button>
                                    @if (isset($editCategory))
                                        <a href="{{ route('blog-category.index') }}" class="btn btn-light">Cancel</a>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="category_table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Posts</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->slug }}</td>
                                                    <td>{{ $category->posts_count }}</td>
                                                    <td class="text-center">
                                                        <a class="btn btn-outline-primary round mr-1 mb-1 waves-effect waves-light btn-sm"
                                                            href="{{ route('blog-category.edit', ['id' => $category->id]) }}">Edit</a>
                                                        <button type="button" id="delete-category"
                                                            data-id="{{ $category->id }}"
                                                            data-name="{{ $category->name }}"
                                                            class="btn btn-outline-danger round mr-1 mb-1 waves-effect waves-light btn-sm">Delete</button>
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
    </div>
@endsection

@push('scripts')
    <script>
        function convertToSlug() {
            var title = document.getElementById('name').value;
            var str = title.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();
            str = str.replace(/^\s+|\s+$/gm, '');
            str = str.replace(/\s+/g, '-');
            document.getElementById('slug').value = str;
        }

        $('body').on('click', '#delete-category', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            Swal.fire({
                title: 'Delete Category!',
                text: 'Are you sure to delete category ' + name + ' ?',
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
                        url: SITEURL + "/dashboard/blog-category/destroy/" + id,
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status == true) {
                                $("#category_table").load(window.location.href + " #category_table");
                                Swal.fire({
                                    type: "success",
                                    title: 'Deleted!',
                                    text: 'Category has been deleted.',
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
