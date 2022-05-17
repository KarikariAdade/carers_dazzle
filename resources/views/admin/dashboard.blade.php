@extends('layouts.admin')
@section('content')
            <section class="section">
                <div class="row mb-3">
                    <div class="col-md-10">
                        @if(empty(auth()->guard('admin')->user()->phone))
                        <div class="alert alert-danger" id="phoneNumberMsg">
                            <p><span class="fa fa-exclamation-circle"></span> Your phone number has not been added. Processes that require the use of your phone number
                                will not work. Kindly add your phone number by clicking on "Add Phone" button</p>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-2 text-right">

                        <a href="{{ route('admin.dashboard.update.phone') }}" id="updatePhoneNumber" class="btn btn-primary btn-lg"><i class="fa fa-phone"></i>
                            @if(empty(auth()->guard('admin')->user()->phone))
                                Add Phone
                            @else
                                Update Phone
                            @endif
                        </a>

                    </div>
                </div>
                <div class="row ">
                    <div class="col-xl-5 col-lg-6">
                        <div class="card l-bg-red">
                            <div class="card-statistic-3">
                                <div class="card-icon card-icon-large"><i class="fa fa-award"></i></div>
                                <div class="card-content">
                                    <h4 class="card-title">Total Customers </h4>
                                    <span> {{$customers}}</span>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <div class="card l-bg-red">
                            <div class="card-statistic-3">
                                <div class="card-icon card-icon-large"><i class="fa fa-award"></i></div>
                                <div class="card-content">
                                    <h4 class="card-title">Total Revenue </h4>
                                    <span>GHS {{number_format($revenue, 2)}} </span>

                                </div>
                            </div>
                        </div>
                    </div>



                </div>

                <div class="row">
                    <div class="col-md-12 col-xs-6 col-sm-12 m-0 p-0">
                        <div class="card p-3">
                            <div class="card-header">
                                <h4>Product Orders</h4>

                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
{{--                                        <div class="row" style="padding-left: 15px">--}}
                                            <form class="row"  action="" method="GET">

                                                    <div class="col-md-4" style="padding-right: 10px">
                                                        <label>Start Date</label>
                                                        <input class="form-control" type="date" name="start_month" id="start_month" value="{{request()->start_month}}">
                                                    </div>
                                                    <div class="col-md-4" style="padding-right: 10px">
                                                        <label>End Date</label>
                                                        <input class="form-control" type="date" name="end_month" id="end_month" value="{{request()->end_month}}">
                                                    </div>
                                                    <div class="col-md-4" style="margin-top: 35px">
                                                        <button type="submit" class="btn btn-primary">Generate</button>
                                                    </div>


                                            </form>

{{--                                        </div>--}}
                                        <br>
                                        <div class="table-responsive">
                                            {!! $dataTable->table(['class' => 'table','id'=>'dataTable']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
{{--                    <div class="col-md-6 col-lg-12 col-xl-6">--}}
{{--                        <!-- Support tickets -->--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <h4>Support Ticket</h4>--}}
{{--                                <form class="card-header-form">--}}
{{--                                    <input type="text" name="search" class="form-control" placeholder="Search">--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="support-ticket media pb-1 mb-3">--}}
{{--                                    <img src="assets/img/users/user-1.png" class="user-img mr-2" alt="">--}}
{{--                                    <div class="media-body ml-3">--}}
{{--                                        <div class="badge badge-pill badge-success mb-1 float-right">Feature</div>--}}
{{--                                        <span class="font-weight-bold">#89754</span>--}}
{{--                                        <a href="javascript:void(0)">Please add advance table</a>--}}
{{--                                        <p class="my-1">Hi, can you please add new table for advan...</p>--}}
{{--                                        <small class="text-muted">Created by <span class="font-weight-bold font-13">John--}}
{{--                          Deo</span>--}}
{{--                                            &nbsp;&nbsp; - 1 day ago</small>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="support-ticket media pb-1 mb-3">--}}
{{--                                    <img src="assets/img/users/user-2.png" class="user-img mr-2" alt="">--}}
{{--                                    <div class="media-body ml-3">--}}
{{--                                        <div class="badge badge-pill badge-warning mb-1 float-right">Bug</div>--}}
{{--                                        <span class="font-weight-bold">#57854</span>--}}
{{--                                        <a href="javascript:void(0)">Select item not working</a>--}}
{{--                                        <p class="my-1">please check select item in advance form not work...</p>--}}
{{--                                        <small class="text-muted">Created by <span class="font-weight-bold font-13">Sarah--}}
{{--                          Smith</span>--}}
{{--                                            &nbsp;&nbsp; - 2 day ago</small>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="support-ticket media pb-1 mb-3">--}}
{{--                                    <img src="assets/img/users/user-3.png" class="user-img mr-2" alt="">--}}
{{--                                    <div class="media-body ml-3">--}}
{{--                                        <div class="badge badge-pill badge-primary mb-1 float-right">Query</div>--}}
{{--                                        <span class="font-weight-bold">#85784</span>--}}
{{--                                        <a href="javascript:void(0)">Are you provide template in Angular?</a>--}}
{{--                                        <p class="my-1">can you provide template in latest angular 8.</p>--}}
{{--                                        <small class="text-muted">Created by <span class="font-weight-bold font-13">Ashton Cox</span>--}}
{{--                                            &nbsp;&nbsp; -2 day ago</small>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="support-ticket media pb-1 mb-3">--}}
{{--                                    <img src="assets/img/users/user-6.png" class="user-img mr-2" alt="">--}}
{{--                                    <div class="media-body ml-3">--}}
{{--                                        <div class="badge badge-pill badge-info mb-1 float-right">Enhancement</div>--}}
{{--                                        <span class="font-weight-bold">#25874</span>--}}
{{--                                        <a href="javascript:void(0)">About template page load speed</a>--}}
{{--                                        <p class="my-1">Hi, John, can you work on increase page speed of template...</p>--}}
{{--                                        <small class="text-muted">Created by <span class="font-weight-bold font-13">Hasan--}}
{{--                          Basri</span>--}}
{{--                                            &nbsp;&nbsp; -3 day ago</small>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <a href="javascript:void(0)" class="card-footer card-link text-center small ">View--}}
{{--                                All</a>--}}
{{--                        </div>--}}
{{--                        <!-- Support tickets -->--}}
{{--                    </div>--}}


                </div>
            </section>
            <div class="modal fade" id="verifyPhone" tabindex="-1" role="dialog" aria-labelledby="verifyPhone"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Phone Number</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="updatePhoneForm" action="" method="POST">
                            <div class="modal-body">
                                @method('POST')
                                @csrf
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone" class="form-control" value="{{ auth()->guard('admin')->user()->phone }}">
                                </div>
                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                                <button type="submit" class="btn btn-success">Update Phone Number</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    @endsection
@push('custom-js')
    {!! $dataTable->scripts() !!}

@endpush
