@extends('layouts.admin')
@section('content')
    <section class="container card card-primary">
        <form id="updateProductForm" action="{{ route('product.banner.update', $banner->id) }}">
            @csrf
            @method('PATCH')
            <div class="card-header row">
                <div class="col-md-10"><h4>Update Promotional Banner: {{ $banner->name }}</h4></div>
                <div class="col-md-2" style="float:right;">
                    <button class="btn btn-success" type="submit"><span class="fa fa-plus-circle"></span> Update Promotional Banner</button>
                </div>
            </div>
        </form>
    </section>
@endsection
