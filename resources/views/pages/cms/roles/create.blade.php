@extends('layouts.cms')
@section('title', 'Create Roles')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Roles</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard/roles') }}">Roles</a>
                                </li>
                                <li class="breadcrumb-item active">Create Roles
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
                                {!! Form::open(['route' => 'roles.store', 'method' => 'POST', 'class' => 'form form-horizontal']) !!}
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Role Name</span>
                                                </div>
                                                <div class="col-md-8">
                                                    {!! Form::text('name', null, ['placeholder' => 'Role Name', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Permissions</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group m-checkbox-inline mb-0">
                                                        <input class="checkbox_animated" type="checkbox" id="checkAll">
                                                        <span>Check All</span>
                                                        <hr>
                                                        <div class="column-count">
                                                        @foreach ($permission as $value)
                                                            {{ Form::checkbox('permission[]', $value->id, false, ['class' => 'checkbox_animated']) }}
                                                            <span>{{ $value->name }}</span><br />
                                                        @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-4 text-right">
                                            <a class="btn btn-light mr-1 mb-1" href="{{ url ('dashboard/roles')}}"> Back</a>
                                            <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
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
