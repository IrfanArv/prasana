@extends('layouts.cms')
@section('title', 'Update User')
@section('content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Update User</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard/users') }}">Users</a>
                                </li>
                                <li class="breadcrumb-item active">Update User
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
                                {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id], 'files' => true]) !!}
                                <div class="row">
                                    <div class="col-md-4 pl-4">
                                        <div class="row mb-2">
                                            <div class="col-auto">
                                                @if ($user->image)
                                                    <img class="avatar" id="modal-preview"
                                                        src="{{ asset('/img/user/' . $user->image) }}"
                                                        alt="{{ $user->name }}"><br><br>
                                                @else
                                                    <img class="avatar" id="modal-preview"
                                                        src="https://via.placeholder.com/100"><br><br>
                                                @endif
                                                <div class="upload-btn-wrapper">
                                                    <button class="btn-upload">Upload Avatar</button>
                                                    <input id="image" type="file" name="image" accept="image/*"
                                                        onchange="readURL(this);">
                                                </div>
                                                <input type="hidden" name="hidden_image" id="hidden_image">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Full Name</label>
                                            <div class="col-sm-8">
                                                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control', 'id' => 'name']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Email</label>
                                            <div class="col-sm-8">
                                                {!! Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Password</label>
                                            <div class="col-sm-8">
                                                {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Confirm Password</label>
                                            <div class="col-sm-8">
                                                {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Roles</label>
                                            <div class="col-sm-8">
                                                {!! Form::select('roles[]', $roles, [], ['class' => 'form-control ']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row text-right">
                                            <label class="col-sm-4 col-form-label"></label>
                                            <div class="col-sm-8">
                                                <a class="btn btn-outline-light round mr-1 mb-1 waves-effect waves-light"
                                                    href="{{ route('users.index') }}">Back </a>
                                                <button type="submit"
                                                    class="btn btn-outline-primary round mr-1 mb-1 waves-effect waves-light">Update</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
