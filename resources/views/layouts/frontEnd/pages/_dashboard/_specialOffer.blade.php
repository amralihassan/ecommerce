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
