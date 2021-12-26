@extends('layouts.admin')
@section('content')
    <section class="container card card-primary">
        <div class="card-header row">
            <div class="col-md-10"><h4>Banner Details: {{ $banner->name }}</h4></div>
        </div>
        <div class="card-body">
            @include('layouts.errors')
            <div class="row">
                <div class="col-md-6 table-responsive p-3">
                    <table class=" table table-bordered table-striped">
                        <tr><td width="160"><h6><strong> Name</strong></h6></td><td style="font-size: 17px;">
                                {{ $banner->name }}</td></tr>
                        <tr><td width="160"><h6><strong>Marked Active</strong></h6></td><td style="font-size: 17px;">
                                @if($banner->is_active == true)
                                    <span class="badge badge-success shadow">Active</span>
                                @else
                                    <span class="badge badge-danger shadow">Inactive</span>
                                @endif
                            </td></tr>
                        <tr><td width="160"><h6><strong>Slider Featured</strong></h6></td><td style="font-size: 17px;">
                                @if($banner->is_slider_featured == true)
                                    <span class="badge badge-success shadow">Featured</span>
                                @else
                                    <span class="badge badge-danger shadow">Not Featured</span>
                                @endif
                            </td></tr>
                        <tr><td width="160"><h6><strong>Description </strong></h6></td><td style="font-size: 17px;">
                                {{ $banner->description ?? 'N/A' }}</td></tr>
                    </table>
                </div>
                <div class="col-md-6 table-responsive p-3">
                    <img class="img-fluid" src="{{ asset($banner->banner) }}">
                </div>
                <div class="col-md-8">
                    @if ($banner->is_active == false)
                     <a href="{{route('product.banner.mark.active', [$banner->id, 'active', 'raw'])}}" id="markActive" title="Mark as Active" class="btn table-btn btn-icon btn-success btn-sm shadow-success mr-2"><i class="fa mt-2 fa-stamp"></i> Mark Active</a>
                    @else
                        <a href="{{ route('product.banner.mark.active', [$banner->id, 'inactive', 'raw']) }}" id="markActive" title="Mark as Inactive" class="btn table-btn btn-icon btn-dark btn-sm shadow-dark mr-2"><i class="fa mt-2 fa-stamp"></i> Mark Inactive</a>
                    @endif

                    @if ($banner->is_slider_featured == false)
                    <a href="{{ route('product.banner.mark.featured', [$banner->id, 'mark_featured', 'raw']) }}" id="markFeatured" title="Mark Featured" class="btn table-btn btn-icon btn-info btn-sm shadow-info mr-2"><i class="fa mt-2 fa-check-circle"></i> Mark as Featured</a>
                    @else
                    <a href="{{ route('product.banner.mark.featured', [$banner->id, 'unmark_featured', 'raw']) }}" id="markFeatured" title="Remove Feature" class="btn table-btn btn-icon btn-dark btn-sm shadow-dark mr-2"><i class="fa mt-2 fa-times-circle"></i> Remove Featured</a>
                        @endif

                    <a href="{{ route('product.banner.edit', $banner->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Update Banner</a>
                </div>
            </div>
        </div>
    </section>
@endsection
