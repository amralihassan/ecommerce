@extends('layouts.frontEnd.site')
@section('content')
<div class="row">
    <div class="col-3" >
        <div class="col-md-12 col-sm-12">
            <div style="min-height: 700px;">
                <div class="form-group">
                    <div class="seachbox mb-2">
                      <input type="text" class="form-control round" placeholder="Search" id="input-search"
                      name="input-search">
                    </div>
                  </div>
                  <div class="row mb-1">
                    <div class="col-md-8 col-sm-12">
                      <div class="form-group">
                        <label class="mr-1">
                          <input type="checkbox" id="chk-ignore-case" value="false"> Ignore Case
                        </label>
                        <label class="mr-1">
                          <input type="checkbox" id="chk-exact-match" value="false"> Exact Match
                        </label>
                        <label class="mr-1">
                          <input type="checkbox" id="chk-reveal-results" value="false"> Reveal Results
                        </label>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
    </div>
    <div class="col-md-9">
        <div class="card" style="min-height: 700px;">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-xl-4 col-md-6 col-sm-4" >
                        <div class="" style="min-height: 370px; margin: 10px;">
                            <a href="{{route('product',$product->id)}}">
                                <img class="card-img-top img-fluid" src="{{asset('images/product_images/'.$product->product_image)}}">
                            </a>
                            <div class="card-body">
                                <p style="min-height: 80px" class="card-text">{{$product->ar_product_name}}</p>
                                <h3 class="blue"><strong>{{$product->price}} {{$product->country->currency}}</strong></h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection

