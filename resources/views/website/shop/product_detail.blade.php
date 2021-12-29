@extends('layouts.website')
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="shop-grid-left-sidebar.html">shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">product details</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-details-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="product-large-slider mb-20 slick-arrow-style_2 slick-initialized slick-slider"><button type="button" class="slick-prev slick-arrow" style=""><i class="fa fa-angle-left"></i></button>
                                    <div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 1416px;"><div class="pro-large-img img-zoom slick-slide" id="img1" data-slick-index="0" aria-hidden="true" tabindex="-1" style="width: 354px; position: relative; left: 0px; top: 0px; z-index: 998; opacity: 0; overflow: hidden; transition: opacity 500ms ease 0s;">
                                                <img src="assets/img/product/product-details-img1.jpg" alt="">
                                                <img role="presentation" alt="" src="file:///Users/highpriest/Downloads/Galio-Mega-Shop-Responsive-Bootstrap-Template/assets/img/product/product-details-img1.jpg" class="zoomImg" style="position: absolute; top: -285.067px; left: -124.494px; opacity: 0; width: 655px; height: 800px; border: none; max-width: none; max-height: none;"></div><div class="pro-large-img img-zoom slick-slide slick-current slick-active" id="img2" data-slick-index="1" aria-hidden="false" tabindex="0" style="width: 354px; position: relative; left: -354px; top: 0px; z-index: 999; opacity: 1; overflow: hidden;">
                                                <img src="assets/img/product/product-details-img2.jpg" alt="">
                                                <img role="presentation" alt="" src="file:///Users/highpriest/Downloads/Galio-Mega-Shop-Responsive-Bootstrap-Template/assets/img/product/product-details-img2.jpg" class="zoomImg" style="position: absolute; top: -47.7923px; left: -214.577px; opacity: 0; width: 655px; height: 800px; border: none; max-width: none; max-height: none;"></div><div class="pro-large-img img-zoom slick-slide" id="img3" data-slick-index="2" aria-hidden="true" tabindex="-1" style="width: 354px; position: relative; left: -708px; top: 0px; z-index: 998; opacity: 0; overflow: hidden; transition: opacity 500ms ease 0s;">
                                                <img src="assets/img/product/product-details-img3.jpg" alt="">
                                                <img role="presentation" alt="" src="file:///Users/highpriest/Downloads/Galio-Mega-Shop-Responsive-Bootstrap-Template/assets/img/product/product-details-img3.jpg" class="zoomImg" style="position: absolute; top: 0px; left: 0px; opacity: 0; width: 655px; height: 800px; border: none; max-width: none; max-height: none;"></div><div class="pro-large-img img-zoom slick-slide" id="img4" data-slick-index="3" aria-hidden="true" tabindex="-1" style="width: 354px; position: relative; left: -1062px; top: 0px; z-index: 998; opacity: 0; overflow: hidden; transition: opacity 500ms ease 0s;">
                                                <img src="assets/img/product/product-details-img4.jpg" alt="">
                                                <img role="presentation" alt="" src="file:///Users/highpriest/Downloads/Galio-Mega-Shop-Responsive-Bootstrap-Template/assets/img/product/product-details-img4.jpg" class="zoomImg" style="position: absolute; top: 0px; left: 0px; opacity: 0; width: 655px; height: 800px; border: none; max-width: none; max-height: none;"></div></div></div>



                                    <button type="button" class="slick-next slick-arrow" style=""><i class="fa fa-angle-right"></i></button></div>
                                <div class="pro-nav slick-padding2 slick-arrow-style_2 slick-initialized slick-slider"><button type="button" class="slick-prev slick-arrow" style=""><i class="fa fa-angle-left"></i></button>
                                    <div class="slick-list draggable" style="padding: 0px;"><div class="slick-track" style="opacity: 1; width: 1365px; transform: translate3d(-364px, 0px, 0px);"><div class="pro-nav-thumb slick-slide slick-cloned" data-slick-index="-5" aria-hidden="true" tabindex="-1" style="width: 81px;"><img src="assets/img/product/product-details-img1.jpg" alt=""></div><div class="pro-nav-thumb slick-slide slick-cloned" data-slick-index="-4" aria-hidden="true" tabindex="-1" style="width: 81px;"><img src="assets/img/product/product-details-img2.jpg" alt=""></div><div class="pro-nav-thumb slick-slide slick-cloned" data-slick-index="-3" aria-hidden="true" tabindex="-1" style="width: 81px;"><img src="assets/img/product/product-details-img3.jpg" alt=""></div><div class="pro-nav-thumb slick-slide slick-cloned" data-slick-index="-2" aria-hidden="true" tabindex="-1" style="width: 81px;"><img src="assets/img/product/product-details-img4.jpg" alt=""></div><div class="pro-nav-thumb slick-slide slick-cloned" data-slick-index="-1" aria-hidden="true" tabindex="-1" style="width: 81px;"><img src="assets/img/product/product-details-img2.jpg" alt=""></div><div class="pro-nav-thumb slick-slide slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" style="width: 81px;"><img src="assets/img/product/product-details-img1.jpg" alt=""></div><div class="pro-nav-thumb slick-slide slick-current slick-active slick-center" data-slick-index="1" aria-hidden="false" tabindex="0" style="width: 81px;"><img src="assets/img/product/product-details-img2.jpg" alt=""></div><div class="pro-nav-thumb slick-slide slick-active" data-slick-index="2" aria-hidden="false" tabindex="0" style="width: 81px;"><img src="assets/img/product/product-details-img3.jpg" alt=""></div><div class="pro-nav-thumb slick-slide slick-active" data-slick-index="3" aria-hidden="false" tabindex="0" style="width: 81px;"><img src="assets/img/product/product-details-img4.jpg" alt=""></div><div class="pro-nav-thumb slick-slide" data-slick-index="4" aria-hidden="true" tabindex="0" style="width: 81px;"><img src="assets/img/product/product-details-img2.jpg" alt=""></div><div class="pro-nav-thumb slick-slide slick-cloned" data-slick-index="5" aria-hidden="true" tabindex="-1" style="width: 81px;"><img src="assets/img/product/product-details-img1.jpg" alt=""></div><div class="pro-nav-thumb slick-slide slick-cloned" data-slick-index="6" aria-hidden="true" tabindex="-1" style="width: 81px;"><img src="assets/img/product/product-details-img2.jpg" alt=""></div><div class="pro-nav-thumb slick-slide slick-cloned" data-slick-index="7" aria-hidden="true" tabindex="-1" style="width: 81px;"><img src="assets/img/product/product-details-img3.jpg" alt=""></div><div class="pro-nav-thumb slick-slide slick-cloned" data-slick-index="8" aria-hidden="true" tabindex="-1" style="width: 81px;"><img src="assets/img/product/product-details-img4.jpg" alt=""></div><div class="pro-nav-thumb slick-slide slick-cloned" data-slick-index="9" aria-hidden="true" tabindex="-1" style="width: 81px;"><img src="assets/img/product/product-details-img2.jpg" alt=""></div></div></div>




                                    <button type="button" class="slick-next slick-arrow" style=""><i class="fa fa-angle-right"></i></button></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="product-details-des mt-md-34 mt-sm-34">
                                    <h3><a href="product-details.html">external product 12</a></h3>
                                    <div class="ratings">
                                        <span class="good"><i class="fa fa-star"></i></span>
                                        <span class="good"><i class="fa fa-star"></i></span>
                                        <span class="good"><i class="fa fa-star"></i></span>
                                        <span class="good"><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <div class="pro-review">
                                            <span>1 review(s)</span>
                                        </div>
                                    </div>
                                    <div class="customer-rev">
                                        <a href="#">(1 customer review)</a>
                                    </div>
                                    <div class="availability mt-10">
                                        <h5>Availability:</h5>
                                        <span>1 in stock</span>
                                    </div>
                                    <div class="pricebox">
                                        <span class="regular-price">$160.00</span>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.<br>
                                        Phasellus id nisi quis justo tempus mollis sed et dui. In hac habitasse platea dictumst. Suspendisse ultrices mauris diam. Nullam sed aliquet elit. Mauris consequat nisi ut mauris efficitur lacinia.</p>
                                    <div class="quantity-cart-box d-flex align-items-center">
                                        <div class="quantity">
                                            <div class="pro-qty"><span class="dec qtybtn">-</span><input type="text" value="1"><span class="inc qtybtn">+</span></div>
                                        </div>
                                        <div class="action_link">
                                            <a class="buy-btn" href="#">add to cart<i class="fa fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                    <div class="useful-links mt-20">
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Compare"><i class="fa fa-refresh"></i>compare</a>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Wishlist"><i class="fa fa-heart-o"></i>wishlist</a>
                                    </div>
                                    <div class="share-icon mt-20">
                                        <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                        <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                        <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                        <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details inner end -->

                    <!-- product details reviews start -->
                    <div class="product-details-reviews mt-34">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-review-info">
                                    <ul class="nav review-tab">
                                        <li>
                                            <a class="active" data-toggle="tab" href="#tab_one">description</a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#tab_two">information</a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#tab_three">reviews</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content reviews-tab">
                                        <div class="tab-pane fade show active" id="tab_one">
                                            <div class="tab-one">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit est, sed commodo augue nisi non neque.</p>
                                                <div class="review-description">
                                                    <div class="tab-thumb">
                                                        <img src="assets/img/about/services.jpg" alt="">
                                                    </div>
                                                    <div class="tab-des mt-sm-24">
                                                        <h3>Product Information :</h3>
                                                        <ul>
                                                            <li>Donec non est at libero vulputate rutrum.</li>
                                                            <li>Morbi ornare lectus quis justo gravida semper.</li>
                                                            <li>Pellentesque aliquet, sem eget laoreet ultrices</li>
                                                            <li>Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla</li>
                                                            <li>Donec a neque libero.</li>
                                                            <li>Pellentesque aliquet, sem eget laoreet ultrices</li>
                                                            <li>Morbi ornare lectus quis justo gravida semper.</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <p>Cras neque metus, consequat et blandit et, luctus a nunc. Etiam gravida vehicula tellus, in imperdiet ligula euismod eget. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam erat mi, rutrum at sollicitudin rhoncus, ultricies posuere erat. Duis convallis, arcu nec aliquam consequat, purus felis vehicula felis, a dapibus enim lorem nec augue. Nunc facilisis sagittis ullamcorper.</p>
                                                <p>Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus adipiscing nisl ut dolor dignissim semper. Nulla luctus malesuada tincidunt.</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_two">
                                            <table class="table table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td>color</td>
                                                    <td>black, blue, red</td>
                                                </tr>
                                                <tr>
                                                    <td>size</td>
                                                    <td>L, M, S</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="tab_three">
                                            <form action="#" class="review-form">
                                                <h5>1 review for Simple product 12</h5>
                                                <div class="total-reviews">
                                                    <div class="rev-avatar">
                                                        <img src="assets/img/about/avatar.jpg" alt="">
                                                    </div>
                                                    <div class="review-box">
                                                        <div class="ratings">
                                                            <span class="good"><i class="fa fa-star"></i></span>
                                                            <span class="good"><i class="fa fa-star"></i></span>
                                                            <span class="good"><i class="fa fa-star"></i></span>
                                                            <span class="good"><i class="fa fa-star"></i></span>
                                                            <span><i class="fa fa-star"></i></span>
                                                        </div>
                                                        <div class="post-author">
                                                            <p><span>admin -</span> 30 Nov, 2018</p>
                                                        </div>
                                                        <p>Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus</p>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span> Your Name</label>
                                                        <input type="text" class="form-control" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span> Your Email</label>
                                                        <input type="email" class="form-control" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span> Your Review</label>
                                                        <textarea class="form-control" required=""></textarea>
                                                        <div class="help-block pt-10"><span class="text-danger">Note:</span> HTML is not translated!</div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span> Rating</label>
                                                        &nbsp;&nbsp;&nbsp; Bad&nbsp;
                                                        <input type="radio" value="1" name="rating">
                                                        &nbsp;
                                                        <input type="radio" value="2" name="rating">
                                                        &nbsp;
                                                        <input type="radio" value="3" name="rating">
                                                        &nbsp;
                                                        <input type="radio" value="4" name="rating">
                                                        &nbsp;
                                                        <input type="radio" value="5" name="rating" checked="">
                                                        &nbsp;Good
                                                    </div>
                                                </div>
                                                <div class="buttons">
                                                    <button class="sqr-btn" type="submit">Continue</button>
                                                </div>
                                            </form> <!-- end of review-form -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details reviews end -->

                    <!-- related products area start -->
                    <div class="related-products-area mt-34">
                        <div class="section-title mb-30">
                            <div class="title-icon">
                                <i class="fa fa-desktop"></i>
                            </div>
                            <h3>related products</h3>
                        </div> <!-- section title end -->
                        <!-- featured category start -->
                        <div class="featured-carousel-active slick-padding slick-arrow-style slick-initialized slick-slider"><button type="button" class="slick-prev slick-arrow" style=""><i class="fa fa-angle-left"></i></button>
                            <!-- product single item start -->

                            <!-- product single item end -->
                            <!-- product single item start -->

                            <!-- product single item end -->
                            <!-- product single item start -->

                            <!-- product single item end -->
                            <!-- product single item start -->

                            <!-- product single item end -->
                            <!-- product single item start -->

                            <!-- product single item end -->
                            <!-- product single item start -->

                            <!-- product single item end -->
                            <div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 3840px; transform: translate3d(-768px, 0px, 0px);"><div class="product-item fix slick-slide slick-cloned" tabindex="-1" style="width: 226px;" data-slick-index="-3" aria-hidden="true">
                                        <div class="product-thumb">
                                            <a href="product-details.html" tabindex="-1">
                                                <img src="assets/img/product/product-img7.jpg" class="img-pri" alt="">
                                                <img src="assets/img/product/product-img8.jpg" class="img-sec" alt="">
                                            </a>
                                            <div class="product-label">
                                                <span>hot</span>
                                            </div>
                                            <div class="product-action-link">
                                                <a href="#" data-toggle="modal" data-target="#quick_view" tabindex="-1"> <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Quick view"><i class="fa fa-search"></i></span> </a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Wishlist" tabindex="-1"><i class="fa fa-heart-o"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Compare" tabindex="-1"><i class="fa fa-refresh"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to cart" tabindex="-1"><i class="fa fa-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h4><a href="product-details.html" tabindex="-1">grouped product</a></h4>
                                            <div class="pricebox">
                                                <span class="regular-price">$10.00</span>
                                                <div class="ratings">
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <div class="pro-review">
                                                        <span>1 review(s)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><div class="product-item fix slick-slide slick-cloned" tabindex="-1" style="width: 226px;" data-slick-index="-2" aria-hidden="true">
                                        <div class="product-thumb">
                                            <a href="product-details.html" tabindex="-1">
                                                <img src="assets/img/product/product-img9.jpg" class="img-pri" alt="">
                                                <img src="assets/img/product/product-img10.jpg" class="img-sec" alt="">
                                            </a>
                                            <div class="product-label">
                                                <span>hot</span>
                                            </div>
                                            <div class="product-action-link">
                                                <a href="#" data-toggle="modal" data-target="#quick_view" tabindex="-1"> <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Quick view"><i class="fa fa-search"></i></span> </a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Wishlist" tabindex="-1"><i class="fa fa-heart-o"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Compare" tabindex="-1"><i class="fa fa-refresh"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to cart" tabindex="-1"><i class="fa fa-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h4><a href="product-details.html" tabindex="-1">simple product 10</a></h4>
                                            <div class="pricebox">
                                                <span class="regular-price">$70.00</span>
                                                <div class="ratings">
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <div class="pro-review">
                                                        <span>1 review(s)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><div class="product-item fix slick-slide slick-cloned" tabindex="-1" style="width: 226px;" data-slick-index="-1" aria-hidden="true">
                                        <div class="product-thumb">
                                            <a href="product-details.html" tabindex="-1">
                                                <img src="assets/img/product/product-img11.jpg" class="img-pri" alt="">
                                                <img src="assets/img/product/product-img12.jpg" class="img-sec" alt="">
                                            </a>
                                            <div class="product-label">
                                                <span>hot</span>
                                            </div>
                                            <div class="product-action-link">
                                                <a href="#" data-toggle="modal" data-target="#quick_view" tabindex="-1"> <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Quick view"><i class="fa fa-search"></i></span> </a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Wishlist" tabindex="-1"><i class="fa fa-heart-o"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Compare" tabindex="-1"><i class="fa fa-refresh"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to cart" tabindex="-1"><i class="fa fa-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h4><a href="product-details.html" tabindex="-1">affiliate product</a></h4>
                                            <div class="pricebox">
                                                <span class="regular-price">$70.00</span>
                                                <div class="ratings">
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <div class="pro-review">
                                                        <span>1 review(s)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><div class="product-item fix slick-slide slick-current slick-active" tabindex="0" style="width: 226px;" data-slick-index="0" aria-hidden="false">
                                        <div class="product-thumb">
                                            <a href="product-details.html" tabindex="0">
                                                <img src="assets/img/product/product-img1.jpg" class="img-pri" alt="">
                                                <img src="assets/img/product/product-img2.jpg" class="img-sec" alt="">
                                            </a>
                                            <div class="product-label">
                                                <span>hot</span>
                                            </div>
                                            <div class="product-action-link">
                                                <a href="#" data-toggle="modal" data-target="#quick_view" tabindex="0"> <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Quick view"><i class="fa fa-search"></i></span> </a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Wishlist" tabindex="0"><i class="fa fa-heart-o"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Compare" tabindex="0"><i class="fa fa-refresh"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to cart" tabindex="0"><i class="fa fa-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h4><a href="product-details.html" tabindex="0">affiliate product</a></h4>
                                            <div class="pricebox">
                                                <span class="regular-price">$90.00</span>
                                                <div class="ratings">
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <div class="pro-review">
                                                        <span>1 review(s)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><div class="product-item fix slick-slide slick-active" tabindex="0" style="width: 226px;" data-slick-index="1" aria-hidden="false">
                                        <div class="product-thumb">
                                            <a href="product-details.html" tabindex="0">
                                                <img src="assets/img/product/product-img3.jpg" class="img-pri" alt="">
                                                <img src="assets/img/product/product-img4.jpg" class="img-sec" alt="">
                                            </a>
                                            <div class="product-label">
                                                <span>hot</span>
                                            </div>
                                            <div class="product-action-link">
                                                <a href="#" data-toggle="modal" data-target="#quick_view" tabindex="0"> <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Quick view"><i class="fa fa-search"></i></span> </a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Wishlist" tabindex="0"><i class="fa fa-heart-o"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Compare" tabindex="0"><i class="fa fa-refresh"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to cart" tabindex="0"><i class="fa fa-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h4><a href="product-details.html" tabindex="0">simple product 01</a></h4>
                                            <div class="pricebox">
                                                <span class="regular-price">$120.00</span>
                                                <div class="ratings">
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <div class="pro-review">
                                                        <span>1 review(s)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><div class="product-item fix slick-slide slick-active" tabindex="0" style="width: 226px;" data-slick-index="2" aria-hidden="false">
                                        <div class="product-thumb">
                                            <a href="product-details.html" tabindex="0">
                                                <img src="assets/img/product/product-img5.jpg" class="img-pri" alt="">
                                                <img src="assets/img/product/product-img6.jpg" class="img-sec" alt="">
                                            </a>
                                            <div class="product-label">
                                                <span>hot</span>
                                            </div>
                                            <div class="product-action-link">
                                                <a href="#" data-toggle="modal" data-target="#quick_view" tabindex="0"> <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Quick view"><i class="fa fa-search"></i></span> </a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Wishlist" tabindex="0"><i class="fa fa-heart-o"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Compare" tabindex="0"><i class="fa fa-refresh"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to cart" tabindex="0"><i class="fa fa-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h4><a href="product-details.html" tabindex="0">vertual product 05</a></h4>
                                            <div class="pricebox">
                                                <span class="regular-price">$60.00</span>
                                                <div class="ratings">
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <div class="pro-review">
                                                        <span>1 review(s)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><div class="product-item fix slick-slide" tabindex="-1" style="width: 226px;" data-slick-index="3" aria-hidden="true">
                                        <div class="product-thumb">
                                            <a href="product-details.html" tabindex="-1">
                                                <img src="assets/img/product/product-img7.jpg" class="img-pri" alt="">
                                                <img src="assets/img/product/product-img8.jpg" class="img-sec" alt="">
                                            </a>
                                            <div class="product-label">
                                                <span>hot</span>
                                            </div>
                                            <div class="product-action-link">
                                                <a href="#" data-toggle="modal" data-target="#quick_view" tabindex="-1"> <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Quick view"><i class="fa fa-search"></i></span> </a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Wishlist" tabindex="-1"><i class="fa fa-heart-o"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Compare" tabindex="-1"><i class="fa fa-refresh"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to cart" tabindex="-1"><i class="fa fa-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h4><a href="product-details.html" tabindex="-1">grouped product</a></h4>
                                            <div class="pricebox">
                                                <span class="regular-price">$10.00</span>
                                                <div class="ratings">
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <div class="pro-review">
                                                        <span>1 review(s)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><div class="product-item fix slick-slide" tabindex="-1" style="width: 226px;" data-slick-index="4" aria-hidden="true">
                                        <div class="product-thumb">
                                            <a href="product-details.html" tabindex="-1">
                                                <img src="assets/img/product/product-img9.jpg" class="img-pri" alt="">
                                                <img src="assets/img/product/product-img10.jpg" class="img-sec" alt="">
                                            </a>
                                            <div class="product-label">
                                                <span>hot</span>
                                            </div>
                                            <div class="product-action-link">
                                                <a href="#" data-toggle="modal" data-target="#quick_view" tabindex="-1"> <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Quick view"><i class="fa fa-search"></i></span> </a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Wishlist" tabindex="-1"><i class="fa fa-heart-o"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Compare" tabindex="-1"><i class="fa fa-refresh"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to cart" tabindex="-1"><i class="fa fa-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h4><a href="product-details.html" tabindex="-1">simple product 10</a></h4>
                                            <div class="pricebox">
                                                <span class="regular-price">$70.00</span>
                                                <div class="ratings">
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <div class="pro-review">
                                                        <span>1 review(s)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><div class="product-item fix slick-slide" tabindex="-1" style="width: 226px;" data-slick-index="5" aria-hidden="true">
                                        <div class="product-thumb">
                                            <a href="product-details.html" tabindex="-1">
                                                <img src="assets/img/product/product-img11.jpg" class="img-pri" alt="">
                                                <img src="assets/img/product/product-img12.jpg" class="img-sec" alt="">
                                            </a>
                                            <div class="product-label">
                                                <span>hot</span>
                                            </div>
                                            <div class="product-action-link">
                                                <a href="#" data-toggle="modal" data-target="#quick_view" tabindex="-1"> <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Quick view"><i class="fa fa-search"></i></span> </a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Wishlist" tabindex="-1"><i class="fa fa-heart-o"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Compare" tabindex="-1"><i class="fa fa-refresh"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to cart" tabindex="-1"><i class="fa fa-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h4><a href="product-details.html" tabindex="-1">affiliate product</a></h4>
                                            <div class="pricebox">
                                                <span class="regular-price">$70.00</span>
                                                <div class="ratings">
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <div class="pro-review">
                                                        <span>1 review(s)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><div class="product-item fix slick-slide slick-cloned" tabindex="-1" style="width: 226px;" data-slick-index="6" aria-hidden="true">
                                        <div class="product-thumb">
                                            <a href="product-details.html" tabindex="-1">
                                                <img src="assets/img/product/product-img1.jpg" class="img-pri" alt="">
                                                <img src="assets/img/product/product-img2.jpg" class="img-sec" alt="">
                                            </a>
                                            <div class="product-label">
                                                <span>hot</span>
                                            </div>
                                            <div class="product-action-link">
                                                <a href="#" data-toggle="modal" data-target="#quick_view" tabindex="-1"> <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Quick view"><i class="fa fa-search"></i></span> </a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Wishlist" tabindex="-1"><i class="fa fa-heart-o"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Compare" tabindex="-1"><i class="fa fa-refresh"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to cart" tabindex="-1"><i class="fa fa-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h4><a href="product-details.html" tabindex="-1">affiliate product</a></h4>
                                            <div class="pricebox">
                                                <span class="regular-price">$90.00</span>
                                                <div class="ratings">
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <div class="pro-review">
                                                        <span>1 review(s)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><div class="product-item fix slick-slide slick-cloned" tabindex="-1" style="width: 226px;" data-slick-index="7" aria-hidden="true">
                                        <div class="product-thumb">
                                            <a href="product-details.html" tabindex="-1">
                                                <img src="assets/img/product/product-img3.jpg" class="img-pri" alt="">
                                                <img src="assets/img/product/product-img4.jpg" class="img-sec" alt="">
                                            </a>
                                            <div class="product-label">
                                                <span>hot</span>
                                            </div>
                                            <div class="product-action-link">
                                                <a href="#" data-toggle="modal" data-target="#quick_view" tabindex="-1"> <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Quick view"><i class="fa fa-search"></i></span> </a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Wishlist" tabindex="-1"><i class="fa fa-heart-o"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Compare" tabindex="-1"><i class="fa fa-refresh"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to cart" tabindex="-1"><i class="fa fa-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h4><a href="product-details.html" tabindex="-1">simple product 01</a></h4>
                                            <div class="pricebox">
                                                <span class="regular-price">$120.00</span>
                                                <div class="ratings">
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <div class="pro-review">
                                                        <span>1 review(s)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><div class="product-item fix slick-slide slick-cloned" tabindex="-1" style="width: 226px;" data-slick-index="8" aria-hidden="true">
                                        <div class="product-thumb">
                                            <a href="product-details.html" tabindex="-1">
                                                <img src="assets/img/product/product-img5.jpg" class="img-pri" alt="">
                                                <img src="assets/img/product/product-img6.jpg" class="img-sec" alt="">
                                            </a>
                                            <div class="product-label">
                                                <span>hot</span>
                                            </div>
                                            <div class="product-action-link">
                                                <a href="#" data-toggle="modal" data-target="#quick_view" tabindex="-1"> <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Quick view"><i class="fa fa-search"></i></span> </a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Wishlist" tabindex="-1"><i class="fa fa-heart-o"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Compare" tabindex="-1"><i class="fa fa-refresh"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to cart" tabindex="-1"><i class="fa fa-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h4><a href="product-details.html" tabindex="-1">vertual product 05</a></h4>
                                            <div class="pricebox">
                                                <span class="regular-price">$60.00</span>
                                                <div class="ratings">
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <div class="pro-review">
                                                        <span>1 review(s)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><div class="product-item fix slick-slide slick-cloned" tabindex="-1" style="width: 226px;" data-slick-index="9" aria-hidden="true">
                                        <div class="product-thumb">
                                            <a href="product-details.html" tabindex="-1">
                                                <img src="assets/img/product/product-img7.jpg" class="img-pri" alt="">
                                                <img src="assets/img/product/product-img8.jpg" class="img-sec" alt="">
                                            </a>
                                            <div class="product-label">
                                                <span>hot</span>
                                            </div>
                                            <div class="product-action-link">
                                                <a href="#" data-toggle="modal" data-target="#quick_view" tabindex="-1"> <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Quick view"><i class="fa fa-search"></i></span> </a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Wishlist" tabindex="-1"><i class="fa fa-heart-o"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Compare" tabindex="-1"><i class="fa fa-refresh"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to cart" tabindex="-1"><i class="fa fa-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h4><a href="product-details.html" tabindex="-1">grouped product</a></h4>
                                            <div class="pricebox">
                                                <span class="regular-price">$10.00</span>
                                                <div class="ratings">
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <div class="pro-review">
                                                        <span>1 review(s)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><div class="product-item fix slick-slide slick-cloned" tabindex="-1" style="width: 226px;" data-slick-index="10" aria-hidden="true">
                                        <div class="product-thumb">
                                            <a href="product-details.html" tabindex="-1">
                                                <img src="assets/img/product/product-img9.jpg" class="img-pri" alt="">
                                                <img src="assets/img/product/product-img10.jpg" class="img-sec" alt="">
                                            </a>
                                            <div class="product-label">
                                                <span>hot</span>
                                            </div>
                                            <div class="product-action-link">
                                                <a href="#" data-toggle="modal" data-target="#quick_view" tabindex="-1"> <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Quick view"><i class="fa fa-search"></i></span> </a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Wishlist" tabindex="-1"><i class="fa fa-heart-o"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Compare" tabindex="-1"><i class="fa fa-refresh"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to cart" tabindex="-1"><i class="fa fa-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h4><a href="product-details.html" tabindex="-1">simple product 10</a></h4>
                                            <div class="pricebox">
                                                <span class="regular-price">$70.00</span>
                                                <div class="ratings">
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <div class="pro-review">
                                                        <span>1 review(s)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><div class="product-item fix slick-slide slick-cloned" tabindex="-1" style="width: 226px;" data-slick-index="11" aria-hidden="true">
                                        <div class="product-thumb">
                                            <a href="product-details.html" tabindex="-1">
                                                <img src="assets/img/product/product-img11.jpg" class="img-pri" alt="">
                                                <img src="assets/img/product/product-img12.jpg" class="img-sec" alt="">
                                            </a>
                                            <div class="product-label">
                                                <span>hot</span>
                                            </div>
                                            <div class="product-action-link">
                                                <a href="#" data-toggle="modal" data-target="#quick_view" tabindex="-1"> <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Quick view"><i class="fa fa-search"></i></span> </a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Wishlist" tabindex="-1"><i class="fa fa-heart-o"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Compare" tabindex="-1"><i class="fa fa-refresh"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to cart" tabindex="-1"><i class="fa fa-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h4><a href="product-details.html" tabindex="-1">affiliate product</a></h4>
                                            <div class="pricebox">
                                                <span class="regular-price">$70.00</span>
                                                <div class="ratings">
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <div class="pro-review">
                                                        <span>1 review(s)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="slick-next slick-arrow" style=""><i class="fa fa-angle-right"></i></button></div>
                        <!-- featured category end -->
                    </div>
                    <!-- related products area end -->
                </div>

                <!-- sidebar start -->
                <div class="col-lg-3">
                    <div class="shop-sidebar-wrap fix mt-md-22 mt-sm-22">
                        <!-- featured category start -->
                        <div class="sidebar-widget mb-22">
                            <div class="section-title-2 d-flex justify-content-between mb-28">
                                <h3>featured</h3>
                                <div class="category-append"><button class="slick-prev slick-arrow" style=""><i class="fa fa-angle-left"></i></button><button class="slick-next slick-arrow" style=""><i class="fa fa-angle-right"></i></button></div>
                            </div> <!-- section title end -->
                            <div class="category-carousel-active row slick-initialized slick-slider" data-row="4">
                                <div class="slick-list draggable">
                                    <div class="slick-track" style="opacity: 1; width: 1280px; transform: translate3d(-256px, 0px, 0px);">
                                        <div class="slick-slide slick-cloned" data-slick-index="2" aria-hidden="true" tabindex="-1" style="width: 256px;">
                                            <div>
                                                <div class="col" style="width: 100%; display: inline-block;">
                                                    <div class="category-item">
                                                        <div class="category-thumb">
                                                            <a href="product-details.html" tabindex="-1">
                                                                <img src="assets/img/product/product-img4.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="category-content">
                                                            <h4><a href="product-details.html" tabindex="-1">Virtual Product 01</a></h4>
                                                            <div class="price-box">
                                                                <div class="regular-price">
                                                                    $150.00
                                                                </div>
                                                                <div class="old-price">
                                                                    <del>$180.00</del>
                                                                </div>
                                                            </div>
                                                            <div class="ratings">
                                                                <span class="good"><i class="fa fa-star"></i></span>
                                                                <span class="good"><i class="fa fa-star"></i></span>
                                                                <span class="good"><i class="fa fa-star"></i></span>
                                                                <span class="good"><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                                <div class="pro-review">
                                                                    <span>1 review(s)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end single item -->
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- featured category end -->

                        <!-- manufacturer start -->
                        <div class="sidebar-widget mb-22">
                            <div class="sidebar-title mb-10">
                                <h3>Brands</h3>
                            </div>
                            <div class="sidebar-widget-body">
                                <ul>
                                    <li><i class="fa fa-angle-right"></i><a href="#">calvin klein</a><span>(10)</span></li>
                                    <li><i class="fa fa-angle-right"></i><a href="#">diesel</a><span>(12)</span></li>
                                    <li><i class="fa fa-angle-right"></i><a href="#">polo</a><span>(20)</span></li>
                                    <li><i class="fa fa-angle-right"></i><a href="#">Tommy Hilfiger</a><span>(12)</span></li>
                                    <li><i class="fa fa-angle-right"></i><a href="#">Versace</a><span>(16)</span></li>
                                </ul>
                            </div>
                        </div>

                        <!-- sidebar banner start -->
                        <div class="sidebar-widget mb-22">
                            <div class="img-container fix img-full mt-30">
                                <a href="#"><img src="assets/img/banner/banner_shop.jpg" alt=""></a>
                            </div>
                        </div>
                        <!-- sidebar banner end -->
                    </div>
                </div>
                <!-- sidebar end -->
            </div>
        </div>

    @endsection
