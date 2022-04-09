@extends('layouts.pages')
@section('content')

    @if($status === 'success')

    <h2>Payment successful</h2>
    @else

    <h2>Payment was not successful</h2>

    @endif

@endsection
