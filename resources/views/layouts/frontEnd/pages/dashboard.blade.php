@extends('layouts.frontEnd.site')
@section('content')

<div class="row">
    <div class="col-9 mt-3">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-example-generic" data-slide-to="1"></li>
              <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img src="{{asset('cpanel/app-assets/images/carousel/32.jpg')}}" alt="First slide">
              </div>
              <div class="carousel-item">
                <img src="{{asset('cpanel/app-assets/images/carousel/33.png')}}" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img src="{{asset('cpanel/app-assets/images/carousel/34.png')}}" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="col-3 mt-3">
        <img class="dashboard-image card-img-top img-fluid" src="{{asset('cpanel/app-assets/images/carousel/c1.jpg')}}">
        <img class="dashboard-image card-img-top img-fluid" src="{{asset('cpanel/app-assets/images/carousel/c2.png')}}">
    </div>
</div>
<div class="card-body mb-1 my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
    <div class="dashboard-border">
        <h4 class="card-title">موضه</h4>
        <div class="row">
        <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="{{asset('cpanel/app-assets/images/carousel/a1.jpg')}}" itemprop="contentUrl" data-size="480x360">
            <img class="img-thumbnail img-fluid" src="{{asset('cpanel/app-assets/images/carousel/a1.jpg')}}"
            itemprop="thumbnail" alt="Image description" />
            </a>
        </figure>
        <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="{{asset('cpanel/app-assets/images/carousel/a2.jpg')}}" itemprop="contentUrl" data-size="480x360">
            <img class="img-thumbnail img-fluid" src="{{asset('cpanel/app-assets/images/carousel/a2.jpg')}}"
            itemprop="thumbnail" alt="Image description" />
            </a>
        </figure>
        <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="{{asset('cpanel/app-assets/images/carousel/a3.jpg')}}" itemprop="contentUrl" data-size="480x360">
            <img class="img-thumbnail img-fluid" src="{{asset('cpanel/app-assets/images/carousel/a3.jpg')}}"
            itemprop="thumbnail" alt="Image description" />
            </a>
        </figure>
        <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="{{asset('cpanel/app-assets/images/carousel/a4.jpg')}}" itemprop="contentUrl" data-size="480x360">
            <img class="img-thumbnail img-fluid" src="{{asset('cpanel/app-assets/images/carousel/a4.jpg')}}"
            itemprop="thumbnail" alt="Image description" />
            </a>
        </figure>
        </div>
        <h6 class="card-title"><a href="#">المزيد</a></h6>
    </div>
    <div class="dashboard-border">
        <h4 class="card-title">الصحة والجمال</h4>
        <div class="row">
            <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="{{asset('cpanel/app-assets/images/carousel/b1.png')}}" itemprop="contentUrl" data-size="480x360">
                <img class="img-thumbnail img-fluid" src="{{asset('cpanel/app-assets/images/carousel/b1.png')}}"
                itemprop="thumbnail" alt="Image description" />
            </a>
            </figure>
            <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="{{asset('cpanel/app-assets/images/carousel/b2.png')}}" itemprop="contentUrl" data-size="480x360">
                <img class="img-thumbnail img-fluid" src="{{asset('cpanel/app-assets/images/carousel/b2.png')}}"
                itemprop="thumbnail" alt="Image description" />
            </a>
            </figure>
            <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="{{asset('cpanel/app-assets/images/carousel/b3.png')}}" itemprop="contentUrl" data-size="480x360">
                <img class="img-thumbnail img-fluid" src="{{asset('cpanel/app-assets/images/carousel/b3.png')}}"
                itemprop="thumbnail" alt="Image description" />
            </a>
            </figure>
            <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="{{asset('cpanel/app-assets/images/carousel/b4.png')}}" itemprop="contentUrl" data-size="480x360">
                <img class="img-thumbnail img-fluid" src="{{asset('cpanel/app-assets/images/carousel/b4.png')}}"
                itemprop="thumbnail" alt="Image description" />
            </a>
            </figure>
        </div>
        <h6 class="card-title"><a href="#">المزيد</a></h6>
    </div>
</div>
<div class="row match-height">
    <div class="col-lg-4 col-md-12">
        <div class="card text-center">
          <div class="card-content">
            <img class="card-img-top img-fluid" src="{{asset('cpanel/app-assets/images/carousel/24.png')}}"
            alt="Card image cap">
            <div class="card-body">
              <h4 class="card-title">Formal Shoes</h4>
              <p class="card-text">Some quick example text.</p>
              <div class="btn-group" role="group" aria-label="Basic example">
                <span class="btn btn-outline-blue-grey">$159</span>
                <button type="button" class="btn btn-outline-blue-grey">Shop Now <i class="ft-shopping-cart"></i></button>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="card text-center">
          <div class="card-content">
            <img class="card-img-top img-fluid" src="{{asset('cpanel/app-assets/images/carousel/24.png')}}"
            alt="Card image cap">
            <div class="card-body">
              <h4 class="card-title">Formal Shoes</h4>
              <p class="card-text">Some quick example text.</p>
              <div class="btn-group" role="group" aria-label="Basic example">
                <span class="btn btn-outline-blue-grey">$159</span>
                <button type="button" class="btn btn-outline-blue-grey">Shop Now <i class="ft-shopping-cart"></i></button>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="card text-center">
          <div class="card-content">
            <img class="card-img-top img-fluid" src="{{asset('cpanel/app-assets/images/carousel/24.png')}}"
            alt="Card image cap">
            <div class="card-body">
              <h4 class="card-title">Formal Shoes</h4>
              <p class="card-text">Some quick example text.</p>
              <div class="btn-group" role="group" aria-label="Basic example">
                <span class="btn btn-outline-blue-grey">$159</span>
                <button type="button" class="btn btn-outline-blue-grey">Shop Now <i class="ft-shopping-cart"></i></button>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 mt-3 mb-1">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card">
                              <div class="card-content">
                                <img class="card-img-top img-fluid" src="{{asset('cpanel/app-assets/images/carousel/24.png')}}"
                                alt="Card image cap">
                                <div class="card-body">
                                  <h4 class="card-title">Smart Wearable</h4>
                                  <p class="card-text">Oat cake ice cream candy chocolate cake chocolate cake cotton
                                    candy.
                                  </p>
                                </div>
                              </div>
                              <div class="card-footer text-muted">
                                <span class="float-left">$349</span>
                                <span class="float-right">Add To Cart <i class="la la-cart-plus"></i></span>
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                              <div class="card-content">
                                <img class="card-img-top img-fluid" src="{{asset('cpanel/app-assets/images/carousel/24.png')}}"
                                alt="Card image cap">
                                <div class="card-body">
                                  <h4 class="card-title">Smart Wearable</h4>
                                  <p class="card-text">Oat cake ice cream candy chocolate cake chocolate cake cotton
                                    candy.
                                  </p>
                                </div>
                              </div>
                              <div class="card-footer text-muted">
                                <span class="float-left">$349</span>
                                <span class="float-right">Add To Cart <i class="la la-cart-plus"></i></span>
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                              <div class="card-content">
                                <img class="card-img-top img-fluid" src="{{asset('cpanel/app-assets/images/carousel/24.png')}}"
                                alt="Card image cap">
                                <div class="card-body">
                                  <h4 class="card-title">Smart Wearable</h4>
                                  <p class="card-text">Oat cake ice cream candy chocolate cake chocolate cake cotton
                                    candy.
                                  </p>
                                </div>
                              </div>
                              <div class="card-footer text-muted">
                                <span class="float-left">$349</span>
                                <span class="float-right">Add To Cart <i class="la la-cart-plus"></i></span>
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                              <div class="card-content">
                                <img class="card-img-top img-fluid" src="{{asset('cpanel/app-assets/images/carousel/24.png')}}"
                                alt="Card image cap">
                                <div class="card-body">
                                  <h4 class="card-title">Smart Wearable</h4>
                                  <p class="card-text">Oat cake ice cream candy chocolate cake chocolate cake cotton
                                    candy.
                                  </p>
                                </div>
                              </div>
                              <div class="card-footer text-muted">
                                <span class="float-left">$349</span>
                                <span class="float-right">Add To Cart <i class="la la-cart-plus"></i></span>
                              </div>
                            </div>
                        </div>
                    </div>
                  </div>
              <div class="carousel-item">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                          <div class="card-content">
                            <img class="card-img-top img-fluid" src="{{asset('cpanel/app-assets/images/carousel/24.png')}}"
                            alt="Card image cap">
                            <div class="card-body">
                              <h4 class="card-title">Smart Wearable</h4>
                              <p class="card-text">Oat cake ice cream candy chocolate cake chocolate cake cotton
                                candy.
                              </p>
                            </div>
                          </div>
                          <div class="card-footer text-muted">
                            <span class="float-left">$349</span>
                            <span class="float-right">Add To Cart <i class="la la-cart-plus"></i></span>
                          </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                          <div class="card-content">
                            <img class="card-img-top img-fluid" src="{{asset('cpanel/app-assets/images/carousel/24.png')}}"
                            alt="Card image cap">
                            <div class="card-body">
                              <h4 class="card-title">Smart Wearable</h4>
                              <p class="card-text">Oat cake ice cream candy chocolate cake chocolate cake cotton
                                candy.
                              </p>
                            </div>
                          </div>
                          <div class="card-footer text-muted">
                            <span class="float-left">$349</span>
                            <span class="float-right">Add To Cart <i class="la la-cart-plus"></i></span>
                          </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                          <div class="card-content">
                            <img class="card-img-top img-fluid" src="{{asset('cpanel/app-assets/images/carousel/24.png')}}"
                            alt="Card image cap">
                            <div class="card-body">
                              <h4 class="card-title">Smart Wearable</h4>
                              <p class="card-text">Oat cake ice cream candy chocolate cake chocolate cake cotton
                                candy.
                              </p>
                            </div>
                          </div>
                          <div class="card-footer text-muted">
                            <span class="float-left">$349</span>
                            <span class="float-right">Add To Cart <i class="la la-cart-plus"></i></span>
                          </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                          <div class="card-content">
                            <img class="card-img-top img-fluid" src="{{asset('cpanel/app-assets/images/carousel/24.png')}}"
                            alt="Card image cap">
                            <div class="card-body">
                              <h4 class="card-title">Smart Wearable</h4>
                              <p class="card-text">Oat cake ice cream candy chocolate cake chocolate cake cotton
                                candy.
                              </p>
                            </div>
                          </div>
                          <div class="card-footer text-muted">
                            <span class="float-left">$349</span>
                            <span class="float-right">Add To Cart <i class="la la-cart-plus"></i></span>
                          </div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                          <div class="card-content">
                            <img class="card-img-top img-fluid" src="{{asset('cpanel/app-assets/images/carousel/24.png')}}"
                            alt="Card image cap">
                            <div class="card-body">
                              <h4 class="card-title">Smart Wearable</h4>
                              <p class="card-text">Oat cake ice cream candy chocolate cake chocolate cake cotton
                                candy.
                              </p>
                            </div>
                          </div>
                          <div class="card-footer text-muted">
                            <span class="float-left">$349</span>
                            <span class="float-right">Add To Cart <i class="la la-cart-plus"></i></span>
                          </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                          <div class="card-content">
                            <img class="card-img-top img-fluid" src="{{asset('cpanel/app-assets/images/carousel/24.png')}}"
                            alt="Card image cap">
                            <div class="card-body">
                              <h4 class="card-title">Smart Wearable</h4>
                              <p class="card-text">Oat cake ice cream candy chocolate cake chocolate cake cotton
                                candy.
                              </p>
                            </div>
                          </div>
                          <div class="card-footer text-muted">
                            <span class="float-left">$349</span>
                            <span class="float-right">Add To Cart <i class="la la-cart-plus"></i></span>
                          </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                          <div class="card-content">
                            <img class="card-img-top img-fluid" src="{{asset('cpanel/app-assets/images/carousel/24.png')}}"
                            alt="Card image cap">
                            <div class="card-body">
                              <h4 class="card-title">Smart Wearable</h4>
                              <p class="card-text">Oat cake ice cream candy chocolate cake chocolate cake cotton
                                candy.
                              </p>
                            </div>
                          </div>
                          <div class="card-footer text-muted">
                            <span class="float-left">$349</span>
                            <span class="float-right">Add To Cart <i class="la la-cart-plus"></i></span>
                          </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                          <div class="card-content">
                            <img class="card-img-top img-fluid" src="{{asset('cpanel/app-assets/images/carousel/24.png')}}"
                            alt="Card image cap">
                            <div class="card-body">
                              <h4 class="card-title">Smart Wearable</h4>
                              <p class="card-text">Oat cake ice cream candy chocolate cake chocolate cake cotton
                                candy.
                              </p>
                            </div>
                          </div>
                          <div class="card-footer text-muted">
                            <span class="float-left">$349</span>
                            <span class="float-right">Add To Cart <i class="la la-cart-plus"></i></span>
                          </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
@endsection
