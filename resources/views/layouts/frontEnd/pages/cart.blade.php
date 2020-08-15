@extends('layouts.frontEnd.site')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mt-1">
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">{{ trans('admin.dashboard') }}</a></li>
            <li class="breadcrumb-item">
                {{ trans('admin.cart') }} ({{session()->has('cart')?session('cart')->totalQty:0}})
            </li>
          </ol>
        </div>
      </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-9">
        @if(session()->has('cart'))
            @foreach ($cart->items as $product)
                <div class="card">
                    <div class="row">
                        <div class="col-md-2">
                            <img class="mt-1" width="100" height="100" src="{{asset('images/product_images/'.$product['image'])}}" alt="">
                        </div>
                        <div class="col-md-10">
                            <h5 class="mt-1">{{$product['item']}}</h5>
                            <h4 class="mt-1 blue"><strong>{{$product['price']}} جنيه</strong></h4>
                            <h6 class="mt-1"><strong>{{ trans('admin.brand') }}</strong> : {{$product['brand']}}</h6>
                            <h6 class="mt-1"><strong>{{ trans('admin.item_condition') }}</strong> : {{$product['item_condition']}}</h6>
                            <h6 class="mt-1"><strong>{{ trans('admin.note') }}</strong> : {{$product['note']}}</h6>
                            <h6 class="mt-1"><strong>{{ trans('admin.count') }}</strong> :
                                <input type="number" style="width: 70px; display:inline-block" min="1" id="qty" class="form-control" value="{{$product['qty']}}"></h6>
                            <hr>
                            <div class="mb-1">
                                <a href="#"> {{ trans('admin.erase') }}</a>
                            </div>
                        </div>

                    </div>

                </div>

            @endforeach
        @else
            <h3 class="red">{{ trans('admin.empty_car') }}</h3>
        @endif
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="col-md-12">
                <h6 class="mt-1"><strong>{{ trans('admin.total') }}</strong></h6>
                <h2 class="mt-1"><strong>{{ $cart->totalPrice }} جنيه</strong></h2>
                <hr>
                <div class="mb-1 center">
                    <a href="{{route('home')}}" class="btn btn-success">{{ trans('admin.continue_shopping') }}</a>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
