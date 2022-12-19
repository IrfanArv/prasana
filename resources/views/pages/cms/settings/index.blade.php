@extends('layouts.cms')
@section('title', 'Settings')
@section('content')
    {!! Form::model($settings, ['method' => 'PATCH', 'route' => ['settings.update', $settings->id]]) !!}
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Settings</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Settings
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-md-12">
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
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-2">General Meta Tags</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="form-label-group">
                                        <input name="meta_title" value="{{ old('meta_title', $settings->meta_title) }}"
                                            placeholder="Meta Title" type="text" class="form-control" required>
                                        <label>Meta Title</label>
                                    </div>
                                    <div class="form-label-group">
                                        <textarea name="meta_description" rows="4" class="form-control" placeholder="Meta Description" required>{{ old('meta_description', $settings->meta_description) }}</textarea>
                                        <label>Meta Description</label>
                                    </div>
                                    <div class="form-label-group">
                                        <textarea name="meta_keyword" rows="2" class="form-control" placeholder="Meta Keyword" required>{{ old('meta_keyword', $settings->meta_keyword) }}</textarea>
                                        <label>Meta Keyword</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-2">WhatsApp Floating</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="form-label-group">
                                        <input name="wa_number" value="{{ old('wa_number', $settings->wa_number) }}"
                                            placeholder="WhatsApp Number" type="number" class="form-control" required>
                                        <label>WhatsaApp Number</label>
                                    </div>
                                    <div class="form-label-group">
                                        <textarea name="wa_message" rows="8" class="form-control" placeholder="WhatsApp Message" required>{{ old('wa_message', $settings->wa_message) }}</textarea>
                                        <label>WhatsaApp Message</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-2">Receiver Messages</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="form-label-group">
                                        <input name="email_reciver" value="{{ old('email_reciver', $settings->email_reciver) }}"
                                            placeholder="Email Revicer" type="text" class="form-control" required>
                                        <label>Email Receiver</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input name="wa_reciver" value="{{ old('wa_reciver', $settings->wa_reciver) }}"
                                            placeholder="WhatsApp Revicer" type="text" class="form-control" required>
                                        <label>WhatsApp Receiver</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-2">General</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body row">
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input name="phone" value="{{ old('phone', $settings->phone) }}"
                                                placeholder="Phone Number" type="text" class="form-control" required>
                                            <label>Phone</label>
                                        </div>
                                        <div class="form-label-group">
                                            <input name="email" value="{{ old('email', $settings->email) }}"
                                                placeholder="Email" type="text" class="form-control" required>
                                            <label>Email</label>
                                        </div>
                                        <div class="form-label-group">
                                            <input name="facebook" value="{{ old('facebook', $settings->facebook) }}"
                                                placeholder="Facebook" type="text" class="form-control" required>
                                            <label>Facebook</label>
                                        </div>
                                        <div class="form-label-group">
                                            <input name="instagram" value="{{ old('instagram', $settings->instagram) }}"
                                                placeholder="Instagram" type="text" class="form-control" required>
                                            <label>Instagram</label>
                                        </div>
                                        <div class="form-label-group">
                                            <input name="gplus" value="{{ old('gplus', $settings->gplus) }}"
                                                placeholder="Google Plus" type="text" class="form-control" required>
                                            <label>Google Plus</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <textarea name="maps" rows="11" class="form-control" placeholder="Maps Embed" required>{{ old('maps', $settings->maps) }}</textarea>
                                            <label>Maps Embed</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-label-group">
                                            <textarea name="address" rows="2" class="form-control" placeholder="Address" required>{{ old('address', $settings->address) }}</textarea>
                                            <label>Address</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-label-group">
                                            <textarea name="widget_book" rows="15" class="form-control" placeholder="Booking Widget" required>{{ old('widget_book', $settings->widget_book) }}</textarea>
                                            <label>Button Booking Widget</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
