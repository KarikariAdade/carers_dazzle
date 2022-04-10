@extends('layouts.pages')
@section('content')
    <div class="page-header text-center" style="background-img: url({{ asset('website_assets
/images/page-header-bg.jpg') }})">
        <div class="container">
            <h1 class="page-title">{{ $product->name }}</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">{{ $product->name }}</a></li>
                {{--                <li class="breadcrumb-item active" aria-current="page">Categories</li>--}}
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="container">
            @include('layouts.errors')
            <div class="product-details-top mb-2 mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery product-gallery-vertical">
                            <div class="row">
                                <div
                                    style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                                    <div class="swiper-wrapper">
                                        @foreach($product->getPicture as $image)
                                        <div class="swiper-slide">
                                            <img src="{{ asset($image->path) }}" class="img-fluid" style="    max-width: 100%; height: 468px;width: 100%;"/>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                                <div thumbsSlider="" class="swiper mySwiper">
                                    <div class="swiper-wrapper">
                                        @if(count($product->getPicture) > 1)
                                        @foreach($product->getPicture as $image)
                                            <div class="swiper-slide" >
                                                <img class="img-fluid" src="{{ asset($image->path) }}" style="width: 100%; height: 100px;"/>
                                            </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div><!-- End .row -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">
                        <div class="product-details product-details-centered">
                            <h1 class="product-title">{{ $product->name }}</h1><!-- End .product-title -->

                            <div class="ratings-container">
                                @if($rating > 0)
                                    <div class='starrr'></div>
                                @endif
                                <a class="ratings-text" href="#product-review-link" id="review-link">( {{ $product->getReviews->count() }} Reviews )</a>
                            </div><!-- End .rating-container -->

                            <div class="product-price">
                                {{ $product->convertCurrency() }}
                            </div><!-- End .product-price -->

                            <div class="product-content">
                                <p>{{ \Illuminate\Support\Str::limit($product->description, 100, '...') }}</p>
                            </div>

                            <div class="product-details-action">
                                <div class="details-action-col">
                                    <div class="product-details-quantity">
                                        <input type="number" id="itemQuantity" class="form-control" value="1" min="1" max="{{ $product->quantity }}" step="1" data-decimals="0" required="" style="display: none;">
                                    </div><!-- End .product-details-quantity -->

                                    <a href="{{ $product->generateCartRoute() }}" class="btn-product btn-cart" id="addToCartWithItem"><span>add to cart</span></a>
                                </div><!-- End .details-action-col -->

                                <div class="details-action-wrapper">
                                    @if(auth()->guard('web')->check())
                                    <a href="{{ route('customer.wishlist.store', $product->id) }}" class="btn-product btn-wishlist addToWishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                    @endif
                                </div><!-- End .details-action-wrapper -->
                            </div><!-- End .product-details-action -->

                            <div class="product-details-footer">
                                <div class="product-cat">
                                    <span>Category:</span>
                                    <a href="{{ $product->getCategory->generateCategoryRoute() }}">{{ $product->getCategory->name }}</a>
                                </div><!-- End .product-cat -->

                                <div class="social-icons social-icons-sm">
                                    <span class="social-label">Share:</span>
                                    <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                </div>
                            </div><!-- End .product-details-footer -->
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->

            <div class="product-details-tab">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping &amp; Returns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews ({{ $product->getReviews->count() }})</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                        <div class="product-desc-content">
                            <h3>Product Information</h3>
                            {{ nl2br($product->description) }}
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                        <div class="product-desc-content">
                            <h3>Delivery &amp; returns</h3>
                            <p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a><br>
                                We hope you’ll love every purchase, but if you ever need to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                        <div class="reviews">
                            <h3>Reviews ({{ $product->getReviews->count() }})</h3>
                            @if($product->getReviews->count() > 0)
                            <div class="review">
                                @foreach($product->getReviews as $review)
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <h4><a href="#" class="text-primary">{{ $review->getUser->name }}</a></h4>
                                        <div class="ratings-container">
                                            @for($i = 1; $i < $review->rating; $i++)
                                                <i class="fas fa-star filled" style="color: #fcb941;"></i>
                                            @endfor
                                        </div><!-- End .rating-container -->
                                        <span class="review-date"> {{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</span>
                                    </div><!-- End .col -->
                                    <div class="col">
                                        <h4 class="text-primary">{{ $review->title }}</h4>

                                        <div class="review-content">
                                            <p>{{ $review->description }}</p>
                                        </div><!-- End .review-content -->

                                    </div><!-- End .col-auto -->
                                </div><!-- End .row -->
                                    @endforeach

                                <button class="btn btn-primary" id="view_more_btn">Show More Reviews</button>
                            </div>
                            @endif
                            @if(auth()->guard('web')->check())
                            <div>
                                <h4> Add Review</h4>

                                <form class="row reviewForm mt-4" action="{{ route('customer.review.store', $product->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group col-md-3">
                                        <label>Rating <span class="text-danger">*</span></label>
                                        <div class="star-rating">
                                            <input id="star-5" type="radio" name="rating" value="5">
                                            <label for="star-5" title="5 stars">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                            <input id="star-4" type="radio" name="rating" value="4">
                                            <label for="star-4" title="4 stars">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                            <input id="star-3" type="radio" name="rating" value="3">
                                            <label for="star-3" title="3 stars">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                            <input id="star-2" type="radio" name="rating" value="2">
                                            <label for="star-2" title="2 stars">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                            <input id="star-1" type="radio" name="rating" value="1">
                                            <label for="star-1" title="1 star">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Your review <span class="text-danger">*</span></label>
                                        <textarea id="review_desc" maxlength="300" name="description" class="form-control"></textarea>
                                        <div class="d-flex justify-content-between mt-3"><small class="text-muted"><span id="chars"></span> characters remaining</small></div>
                                    </div>
                                    <div class="col-md-12 text-danger">
                                        <button class="btn btn-primary" id="reviewBtn" type="submit">Submit Review</button>
                                    </div>
                                </form>
                            </div>
                            @endif
                        </div><!-- End .reviews -->
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .product-details-tab -->

            <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->

            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow owl-loaded owl-drag" data-toggle="owl" data-owl-options="{
                            &quot;nav&quot;: false,
                            &quot;dots&quot;: true,
                            &quot;margin&quot;: 20,
                            &quot;loop&quot;: false,
                            &quot;responsive&quot;: {
                                &quot;0&quot;: {
                                    &quot;items&quot;:1
                                },
                                &quot;480&quot;: {
                                    &quot;items&quot;:2
                                },
                                &quot;768&quot;: {
                                    &quot;items&quot;:3
                                },
                                &quot;992&quot;: {
                                    &quot;items&quot;:4
                                },
                                &quot;1200&quot;: {
                                    &quot;items&quot;:4,
                                    &quot;nav&quot;: true,
                                    &quot;dots&quot;: false
                                }
                            }
                        }">
                <!-- End .product -->

                <!-- End .product -->

                <!-- End .product -->

                <!-- End .product -->

                <!-- End .product -->
                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1485px;">
                        @if(!empty($product->getCategory->getProducts))

                            @foreach($product->getCategory->getProducts as $related)
                        <div class="owl-item active" style="width: 277px; margin-right: 20px;">
                            <div class="product product-7 text-center">
                                <figure class="product-media">
                                    <span class="product-label label-new">New</span>
                                    <a href="{{ $related->generateRoute() }}">
                                        <img src="{{ asset($related->getSingleImage()) }}" alt="Product img" class="product-img">
                                    </a>
                                    <div class="product-action-vertical">
                                        @if(auth()->guard('web')->check())
                                        <a href="{{ route('customer.wishlist.store', $related->id) }}" class="btn-product-icon btn-wishlist btn-expandable addToWishlist"><span>add to wishlist</span></a>
                                        @endif
                                    </div>
                                    <div class="product-action">
                                        <a href="{{ route('website.cart.add', $product->id) }}" class="btn-product btn-cart addToCartBtn"><span>add to cart</span></a>
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="">{{ $related->getCategory->name }}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a href="{{ $related->generateRoute() }}">{{ $related->name }}</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        $ {{ $related->convertCurrency() }}
                                    </div><!-- End .product-price -->
                                    <div class="ratings-container">
                                        @for($i = 1; $i < number_format($product->averageRating, 1); $i++)
                                            <i class="fa-solid fa-star starrr"></i>
                                        @endfor
                                        @if($product->getReviews->count() < 1)
                                            <span class="ratings-text">( {{ $product->getReviews->count() }} Reviews)</span>
                                        @elseif($product->getReviews->count() > 1)
                                            <span class="ratings-text">( {{ $product->getReviews->count() }} Reviews)</span>
                                        @else
                                            <span class="ratings-text">( {{ $product->getReviews->count() }} Review)</span>
                                        @endif
                                    </div><!-- End .rating-container -->
                                </div><!-- End .product-body -->
                            </div>
                        </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="owl-nav">
                    <button type="button" role="presentation" class="owl-prev disabled"><i class="icon-angle-left"></i></button>
                    <button type="button" role="presentation" class="owl-next"><i class="icon-angle-right"></i></button>
                </div>
                <div class="owl-dots disabled">
                    <button role="button" class="owl-dot active"><span></span></button>
                    <button role="button" class="owl-dot"><span></span></button>
                    <button role="button" class="owl-dot"><span></span></button>
                </div>
            </div>
        </div><!-- End .container -->
    </div>
    @push('custom-js')
{{--    <script src="{{ asset('website_assets/js/jquery.elevateZoom.min.js') }}"></script>--}}
    <script>
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            spaceBetween: 4,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
        var swiper2 = new Swiper(".mySwiper2", {
            loop: true,
            spaceBetween: 1,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });

        function checkChars(){
            let numChars = $('#review_desc').val().length,
                maxChars = 300,
                remChars = maxChars - numChars;

            if (remChars < 1) {
                console.log('rem chars', remChars)
                $('#review_desc').val($('#review_desc').val().substring(0, maxChars));
                remChars = 0;
            }
            $('#review_desc').text(remChars);

            $('#chars').html(remChars)

        }

        $('#review_desc').bind('input keyup', function(){
            checkChars();
        });

        checkChars();

        $('.starrr').starrr({
            rating: {{ $rating }},
            readOnly: true
        })
    </script>
    @endpush
@endsection
