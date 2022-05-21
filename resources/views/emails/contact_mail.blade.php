{{--@component('mail::message')--}}

    {{ $data['message'] }}<br><br><br>


Thanks,<br>
{{ $data['name'] }},<br>
    {{$data['email']}},<br>
    {{ $data['phone'] }}
{{--@endcomponent--}}
