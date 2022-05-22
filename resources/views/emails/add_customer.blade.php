@component('mail::message')
Dear {{ $data['full_name'] }}

Your Account on Carers Dazzle has been created. To access your dashboard, kindly click on the button below and use the given credentials to login.

@component('mail::button', ['url' => route('customer.dashboard')])
Go to Dashboard
@endcomponent

@component('mail::panel')
    Email: {{ $data['email'] }}<br>
    Password: {{ $data['password'] }}
@endcomponent

Thanks,<br>
Carers Dazzle
@endcomponent
