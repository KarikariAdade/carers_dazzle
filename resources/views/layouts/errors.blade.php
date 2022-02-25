@if ($errors->any())

    <p class="alert alert-danger text-white">
        <span class="fa fa-exclamation"></span> {{ $errors->first() }}
    </p>

@endif


@if(session('success'))

    <p class="alert alert-success text-white">

        <span class="fa fa-exclamation-circle"></span>  {{session('success')}}

    </p>

@endif

@if(session('info'))

    <p class="alert alert-info text-white">

        <span class="fa fa-exclamation-circle"></span> {{session('info')}}

    </p>

@endif

@if(session('error'))

    <p class="alert alert-danger">

        <span class="fa fa-exclamation-circle"></span> {{session('error')}}

    </p>

@endif
