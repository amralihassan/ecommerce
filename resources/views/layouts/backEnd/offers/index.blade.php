@extends('layouts.backEnd.cpanel')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">{{$title}}</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{aurl('dashboard')}}">{{ trans('admin.dashboard') }}</a></li>
            <li class="breadcrumb-item active">{{$title}}
            </li>
          </ol>
        </div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">{{$title}}</h4>
          <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
          <a href="{{route('offers.create')}}" class="btn btn-success buttons-print btn-success mb-1 mt-3">{{ trans('admin.add_offer') }}</a>
        </div>
        <div class="card-content collapse show">
          <div class="card-body card-dashboard">
                <div class="row">
                    @foreach ($offers as $offer)
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card">
                            <div class="card-content">
                                <img class="card-img-top img-fluid" src="{{asset('/images/offers\/').$offer->image_offer_name}}"
                                alt="Card image cap">
                                <div class="card-body">
                                <h4 class="card-title">{{$offer->title}}</h4>
                                <p>
                                    <strong>{{ trans('admin.start_time') }}</strong> : {{$offer->start_display}} <br>
                                    <strong>{{ trans('admin.end_time') }}</strong> : {{$offer->end_display}}
                                </p>
                                <a href="{{$offer->link}}">{{ trans('admin.offer') }}</a> |
                                <a href="{{$offer->link}}">{{ trans('admin.editing') }}</a> |
                                <a href="{{$offer->link}}">{{ trans('admin.delete') }}</a>

                                {{-- <a href="#" class="btn btn-outline-pink">Go somewhere</a> --}}
                                </div>
                            </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{$offers->links()}}
          </div>
        </div>
      </div>
    </div>
</div>


@endsection
