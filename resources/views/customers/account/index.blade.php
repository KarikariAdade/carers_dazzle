@extends('layouts.website')
@section('content')
@push('custom-css')
    <style>
        .select2{
            width:100% !important;
        }

        .select2-container .select2-selection--single {
            height: 42px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 26px !important;
            top: 8px !important;
            width: 24px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 41px !important;
        }
    </style>
@endpush
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
                                        <h3>Account Details</h3>
                                        <div class="account-details-form">
                                            <form action="{{ route('customer.account.update') }}" method="POST" id="customerAccountUpdate">
                                                @csrf
                                                @method('POST')
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="first-name" class="required">First Name</label>
                                                            <input type="text" name="first_name" placeholder="First Name" value="{{ $firstname }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="last-name" class="required">Last Name</label>
                                                            <input type="text" name="last_name" placeholder="Last Name" value="{{ $lastname }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="single-input-item">
                                                    <label for="email" class="required">Email Address</label>
                                                    <input type="email" name="email" placeholder="Email Address" {{ auth()->user()->email }}>
                                                </div>
                                                <fieldset>
                                                    <legend>Shipping Details</legend>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="single-input-item">
                                                                <label for="display-name" class="required">Street Address 1 </label>
                                                                <input type="text" name="street_address_1" placeholder="Display Name" value="{{ auth()->user()->street_address_1 ?? null }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="single-input-item">
                                                                <label for="display-name">Street Address 2 </label>
                                                                <input type="text" name="street_address_2" placeholder="Display Name" value="{{ auth()->user()->street_address_2 ?? null }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="single-input-item">
                                                                <label for="display-name" class="required">Region </label>
                                                                <select name="region" class="select2" id="shippingRegion" style="width: 100%;">
                                                                    @foreach($regions as $region)
                                                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="single-input-item">
                                                                <label for="display-name" class="required">Town</label>
                                                                <select id="shippingTown" class="select2" style="width:100%;" name="town">
                                                                    <option>{{ auth()->user()->getTown()->name ?? null }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="single-input-item">
                                                                <label for="display-name" class="required">Zip Code</label>
                                                                <input type="text" name="zip_code" placeholder="Zip Code" value="{{ auth()->user()->zip_code ?? null }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                                    <legend>Password change</legend>
                                                    <div class="single-input-item">
                                                        <label for="current-pwd" class="required">Current Password</label>
                                                        <input type="password" name="current_password" placeholder="Current Password">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="new-pwd" class="required">New Password</label>
                                                                <input type="password" name="new_password" placeholder="New Password">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="confirm-pwd" class="required">Confirm Password</label>
                                                                <input type="password" name="confirm_password" placeholder="Confirm Password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <div class="single-input-item">
                                                    <button class="check-btn sqr-btn " type="submit">Save Changes</button>
                                                </div>
                                            </form>
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
    <script>
        $('#shippingRegion').change(function () {
            if ($(this).val() !== ''){
                let url = `{{ route('product.shipping.get.town') }}`,
                    output = ``;
                $.post(url, {'item': $(this).val()}, function (response){
                    console.log(response)
                    if(!jQuery.isEmptyObject(response)){
                        $.each(response, function(i, town) {
                            output += `<option value="${town.id}">${town.name}</option>`;
                        });
                        $('#shippingTown').html(output)
                    }
                })
            }else{
                $('#shippingTown').html('')
            }
        })
    </script>
@endpush
