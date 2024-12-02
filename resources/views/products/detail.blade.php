@extends('layouts.main')
@section('content')
<!-- Open Content -->
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-5 mt-5">
                <div class="card mb-3">
                    <img class="card-img img-fluid" src="/assets/{{$sp['images']}}" alt="Card image cap"
                        id="product-detail">
                </div>
                <div class="row">
                    <!--Start Carousel Wrapper-->
                    <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item"
                        data-bs-ride="carousel">
                        <!--Start Slides-->
                        <div class="carousel-inner product-links-wap" role="listbox">

                            <!--First slide-->
                            <div class="carousel-item active">
                                <div class="row">
                                    @if($sp['imgother'] != null)
                                        @foreach (json_decode($sp['imgother']) as $i=>$m)
                                            <div class="col-4">
                                                <a href="#">
                                                    <img class="card-img img-fluid" id="Product_Image_<?php echo $i ?>" src="/assets/{{$m}}"
                                                        alt="Product Image 1">
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <!--/.First slide-->
                        </div>
                        <!--End Slides-->
                    </div>
                    <!--End Carousel Wrapper-->
                    
                </div>
            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2">{{$sp['name']}}</h1>
                        <p class="h3 py-2">{{number_format($sp['gia'])}} đ</p>
                        <p class="py-2">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <span class="list-inline-item text-dark">Rating 4.8 | 36 Comments</span>
                        </p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Brand:</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted"><strong>{{$sp['th']}}</strong></p>
                            </li>
                        </ul>

                        <h6>Description:</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp incididunt ut
                            labore et dolore magna aliqua. Quis ipsum suspendisse. Donec condimentum elementum
                            convallis. Nunc sed orci a diam ultrices aliquet interdum quis nulla.</p>

                        <h6>Specification:</h6>
                        <ul class="list-unstyled pb-3">
                            <li>Lorem ipsum dolor sit</li>
                            <li>Amet, consectetur</li>
                            <li>Adipiscing elit,set</li>
                            <li>Duis aute irure</li>
                            <li>Ut enim ad minim</li>
                            <li>Dolore magna aliqua</li>
                            <li>Excepteur sint</li>
                        </ul>

                        <div >
                            <input type="hidden" name="product-title" value="Activewear">
                            <div class="row">
                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item">Size :
                                            <input type="hidden" name="product-size" id="product-size" value="S">
                                        </li>
                                        @if ($sp['mau'])
                                            @foreach (json_decode($sp['mau']) as $i => $v)
                                                <li class="list-inline-item"><span
                                                        class="btn btn-success btn-size"  onclick="btnChon({{ $i }})">{{$v->mau}}</span>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-success btn-lg auProduct" data-idv="{{$sp['idv']}}" data-sl={{1}} name="submit"
                                        >Add To Cart</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Close Content -->

<!-- Start Article -->
<section class="py-5">
    <div class="container">
        <div class="row text-left p-2 pb-3">
            <h4>Related Products</h4>
        </div>

        <!--Start Carousel Wrapper-->
        <div id="carousel-related-product">
            @foreach ($related as $j)
                <div class="p-2 pb-3">
                    <div class="product-wap card rounded-0">
                        <div class="card rounded-0">
                            <img class="card-img rounded-0 img-fluid" src="/assets/{{$j['images']}}">
                            <div
                                class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                <ul class="list-unstyled">
                                    <li><a class="btn btn-success text-white" href="shop-single.html"><i
                                                class="far fa-heart"></i></a></li>
                                    <li><a class="btn btn-success text-white mt-2" href="shop-single.html"><i
                                                class="far fa-eye"></i></a></li>
                                    <li><a class="btn btn-success text-white mt-2" href="shop-single.html"><i
                                                class="fas fa-cart-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="/{{$j['idCat']}}/{{$j['slug']}}" class="h3 text-decoration-none">{{$j['name']}}</a>
                            <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                <li class="pt-2">
                                    <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                </li>
                            </ul>
                            <ul class="list-unstyled d-flex justify-content-center mb-1">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                            </ul>
                            <p class="text-center mb-0">{{number_format($j['gia'])}} đ</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
<!-- End Article -->
<script>
    let btnChon = (i) => {
        let selColor = document.getElementById(`Product_Image_${i}`).src
        let proColor = document.getElementById("product-detail")
        proColor.src = selColor
    }


    $('#carousel-related-product').slick({
        infinite: true,
        arrows: false,
        slidesToShow: 4,
        slidesToScroll: 3,
        dots: true,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 3
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 3
            }
        }
        ]
    });


</script>
@endsection