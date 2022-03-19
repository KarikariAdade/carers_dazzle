<div class="col-lg-3 col-md-4">
    <div class="myaccount-tab-menu nav">
        <a href="{{ route('customer.dashboard') }}"><i class="fa fa-dashboard"></i>
            Dashboard</a>
        <a href="{{ route('customer.orders') }}"><i class="fa fa-cart-arrow-down"></i> Orders</a>
        <a href="{{ route('customer.invoices') }}"><i class="fa fa-cloud-download"></i> Invoices</a>
        <a href="{{ route('customer.account.index') }}"><i class="fa fa-user"></i> Account Details</a>
        <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Logout
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </a>
    </div>
</div>
