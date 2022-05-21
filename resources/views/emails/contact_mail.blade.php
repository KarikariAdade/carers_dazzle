{{--@component('mail::message')--}}

    {{ $data['message'] }}


Thanks,<br>
{{ $data['name'] }},<br>
    {{$data['email']}},<br>
    {{ $data['phone'] }}
{{--@endcomponent--}}
