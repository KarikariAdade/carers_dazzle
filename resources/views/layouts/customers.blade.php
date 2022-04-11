{{--<div class="col-lg-3 col-md-4">--}}
{{--    <div class="myaccount-tab-menu nav">--}}
{{--        <a href="{{ route('customer.dashboard') }}"><i class="fa fa-dashboard"></i>--}}
{{--            Dashboard</a>--}}
{{--        <a href="{{ route('customer.orders') }}"><i class="fa fa-cart-arrow-down"></i> Orders</a>--}}
{{--        <a href="{{ route('customer.invoices') }}"><i class="fa fa-cloud-download"></i> Invoices</a>--}}
{{--        <a href="{{ route('customer.account.index') }}"><i class="fa fa-user"></i> Account Details</a>--}}
{{--        <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Logout--}}
{{--            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                @csrf--}}
{{--            </form>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--</div>--}}

<aside class="col-md-3">
    <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="tab-dashboard-link" href="{{ route('customer.dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('customer.orders') }}" >Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('customer.invoices') }}">Invoices</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('customer.account.index') }}">Account Details</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Sign Out</a>


            
        </li>
    </ul>
</aside><!-- End .col-lg-3 -->
