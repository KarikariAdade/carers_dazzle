@extends('layouts.pages')
@section('content')
    @inject('shopHelper', 'App\Helpers\ShopHelper')
    @push('custom-css')
        <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
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
    <div class="page-header mt-5 text-center" style="background-image: url({{ asset('assets/images/page-header-bg.jpg') }})">
        <div class="container">
            <h1 class="page-title">Dashboard<span>Account</span></h1>
        </div>
    </div>

    <div class="page-content mt-5">
        <div class="dashboard">
            <div class="container">
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
                                                        <div class="form-group">
                                                            <label for="first-name">First Name</label>
                                                            <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ $firstname }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="last-name">Last Name</label>
                                                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ $lastname }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">Email Address</label>
                                                    <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ auth()->guard('web')->user()->email }}">
                                                </div>
                                                <fieldset class="mt-5 mb-5">
                                                    <legend><strong>Shipping Details</strong></legend>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="display-name">Street Address 1 {{ auth()->guard('web')->user()->street_address_1 }}</label>
                                                                <input type="text" name="street_address_1" class="form-control" placeholder="Street Address 1" value="{{ auth()->guard('web')->user()->street_address_1 ?? null }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="display-name">Street Address 2 </label>
                                                                <input type="text" name="street_address_2" class="form-control" placeholder="Street Address 2" value="{{ auth()->guard('web')->user()->street_address_2 ?? null }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="display-name">Region </label>
                                                                <select name="region" class="form-control" id="shippingRegion" style="width: 100%;">
                                                                    <option></option>
                                                                    @foreach($regions as $region)
                                                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="display-name">Town</label>
                                                                <select id="shippingTown" class="select2 form-control" style="width:100%;" name="town">
                                                                    <option>{{ auth()->guard('web')->user()->getTown()->name ?? null }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="display-name">Zip Code</label>
                                                                <input type="text" name="zip_code" class="form-control" placeholder="Zip Code" value="{{ auth()->guard('web')->user()->zip_code ?? null }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                                    <legend><strong>Password change</strong></legend>
                                                    <div class="form-group">
                                                        <label for="current-pwd">Current Password</label>
                                                        <input type="password" class="form-control" name="current_password" placeholder="Current Password">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="new-pwd">New Password</label>
                                                                <input type="password" class="form-control" name="new_password" placeholder="New Password">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="confirm-pwd">Confirm Password</label>
                                                                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <div class="form-group">
                                                    <button class="btn btn-primary " type="submit">Save Changes</button>
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
