@extends('layouts.pages')
@section('content')
    <div class="error-content text-center" style="background-image: url({{ asset('assets/images/backgrounds/error-bg.jpg') }})">
        <div class="container">
            <h1 class="error-title">Error 404</h1><!-- End .error-title -->
            <p>We are sorry, the page you've requested is not available.</p>
            <a href="{{ route('website.home') }}" class="btn btn-outline-primary-2 btn-minwidth-lg">
                <span>BACK TO HOMEPAGE</span>
                <i class="icon-long-arrow-right"></i>
            </a>
        </div><!-- End .container -->
    </div>
@endsection
