@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))

@section('title', __('Forbidden'))
@section('code', '403')
@extends('layouts.cms')
@section('content')
<div class="content-wrapper">
    <div class="content-body mt-5">
        <section class="row d-flex justify-content-center mt-5">
            <div class="col-12 mt-5">
                <div class="card auth-card bg-transparent shadow-none rounded-0 mb-0 w-100">
                    <div class="card-content">
                        <div class="card-body text-center">
                            <h1 class="font-large-2 my-2">@yield('message')</h1>
                            <a class="btn btn-primary btn-lg mt-2 waves-effect waves-light" href="{{ url('/dashboard') }}">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

