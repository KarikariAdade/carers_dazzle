@extends('layouts.website')
@section('content')

    <div class="my-account-wrapper mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row">
                        @include('layouts.customers')
                        <!-- My Account Tab Menu End -->

                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
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
        </div>
    </div>
@endsection
@push('custom-js')
    {!! $dataTable->scripts() !!}
@endpush

