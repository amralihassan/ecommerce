@extends('layouts.frontEnd.site')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mt-1">
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">{{ trans('admin.dashboard') }}</a></li>
            <li class="breadcrumb-item">
                @if (count($products) > 0)
                    <a href="{{route('all.products',$products[0]->department->id)}}">
                        @if (session('lang') =='ar')
                            {{$products[0]->department->ar_department_name}}
                        @else
                            {{$products[0]->department->en_department_name}}
                        @endif
                    </a>
                @endif

            </li>
            {{-- <li class="breadcrumb-item active">{{$title}} --}}
            </li>
          </ol>
        </div>
      </div>
    </div>
</div>
<div class="row mt-2">
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
                        @foreach ($specifications as $specification)
                            @if (session('lang') == 'ar')
                                <label class="black">{{$specification->ar_specification_name}}</label><br>
                                @foreach ($specification->definitions as $item)
                                    @foreach ($definitions as $definition)
                                        @if ($item->id == $definition->id)
                                            <div class="form-group">
                                                <label class="ml-1 mb-0">
                                                    <input type="checkbox" id="chk-ignore-case" value="false"> {{$item->ar_value}}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach
                            @else
                                <label class="black">{{$specification->en_specification_name}}</label>
                                @foreach ($specification->definitions as $item)
                                    @foreach ($definitions as $definition)
                                        @if ($item->id == $definition->id)
                                            <div class="form-group">
                                                <label class="ml-1 mb-0">
                                                    <input type="checkbox" id="chk-ignore-case" value="false"> {{$item->en_value}}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                  </div>
            </div>
          </div>
    </div>
    <div class="col-md-9">
        <div class="card" style="min-height: 700px;">
            <div class="row">
                @if (count($products) > 0)
                    @foreach ($products as $product)
                        <div class="col-xl-4 col-md-6 col-sm-4" >
                            <div class="" style="min-height: 370px; margin: 10px;">
                                <a href="{{route('product',$product->id)}}">
                                    <img class="card-img-top img-fluid" src="{{asset('images/product_images/'.$product->product_image)}}">
                                </a>
                                <div class="card-body">
                                    <p style="min-height: 80px" class="card-text">{{$product->ar_product_name}}</p>
                                    <h4 class="center up">{{$product->brand}}</h4>
                                    <h3 class="blue center up"><strong>{{$product->price}} {{$product->country->currency}}</strong></h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                        <div class="col-xl-12 mt-2 ml-2" >
                            <h3 class="red">{{ trans('admin.no_products') }}</h3>
                        </div>
                @endif

            </div>
        </div>
        {{$products->links()}}
    </div>
</div>
@endsection

