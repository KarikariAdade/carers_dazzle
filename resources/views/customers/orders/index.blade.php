@extends('layouts.pages')
@section('content')
    @push('custom-css')
        <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    @endpush
    <div class="page-header mt-5 text-center" style="background-image: url({{ asset('assets/images/page-header-bg.jpg') }})">
        <div class="container">
            <h1 class="page-title">Dashboard<span>Account</span></h1>
        </div><!-- End .container -->
    </div>

    <div class="page-content mt-5">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    @include('layouts.customers')
                        <!-- My Account Tab Menu End -->

                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-9">
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade show active" id="dashboad">
                                    <div class="myaccount-content">
                                        <div class="col-md-12 table-responsive p-3">
                                            {!! $dataTable->table(['class' => 'table table-hover table-striped']) !!}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
@endsection
@push('custom-js')
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    {!! $dataTable->scripts() !!}
@endpush

