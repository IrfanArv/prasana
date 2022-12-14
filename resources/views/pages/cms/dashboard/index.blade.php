@extends('layouts.cms')
@section('title', 'Dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Dashboard</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-xl-3 col-md-3 col-sm-6">
                    <a href="{{ url('/dashboard/villa') }}">
                        <div class="card text-center">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="avatar bg-rgba-info p-50 m-0 mb-1">
                                        <div class="avatar-content">
                                            <i class="feather icon-package text-info font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700">{{ $villa }} </h2>
                                    <p class="mb-0 line-ellipsis">Room Villa</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-warning p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather icon-wind text-warning font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{ $experience }}</h2>
                                <p class="mb-0 line-ellipsis">Experience</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather icon-heart text-danger font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{ $wedding }}</h2>
                                <p class="mb-0 line-ellipsis">Wedding Packages</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-primary p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather icon-sun text-primary font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{ $offer }}</h2>
                                <p class="mb-0 line-ellipsis">Special Offers</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- <div class="row">
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">86%</h2>
                                <p>CPU Usage</p>
                            </div>
                            <div class="avatar bg-rgba-primary p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-cpu text-primary font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">1.2gb</h2>
                                <p>Memory Usage</p>
                            </div>
                            <div class="avatar bg-rgba-success p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-server text-success font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">0.1%</h2>
                                <p>Downtime Ratio</p>
                            </div>
                            <div class="avatar bg-rgba-danger p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-activity text-danger font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">13</h2>
                                <p>Issues Found</p>
                            </div>
                            <div class="avatar bg-rgba-warning p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-alert-octagon text-warning font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    @endsection
