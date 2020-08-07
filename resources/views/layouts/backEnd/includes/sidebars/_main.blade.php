<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        {{-- dashboard --}}
        <li class=" nav-item">
            <a href="{{route('main.dashboard')}}"><i class="la la-home">
                </i><span class="menu-title" data-i18n="nav.support_raise_support.main">{{ trans('admin.dashboard') }}</span>
            </a>
        </li>
        {{-- website --}}
        <li class=" nav-item">
            <a target="blank" href="{{route('home')}}"><i class="la la-globe">
                </i><span class="menu-title" data-i18n="nav.support_raise_support.main">{{ trans('admin.website') }}</span>
            </a>
        </li>
        {{-- special_offers --}}
        <li class=" nav-item">
            <a href="{{route('main.dashboard')}}"><i class="la la-gift">
                </i><span class="menu-title" data-i18n="nav.support_raise_support.main">{{ trans('admin.special_offers') }}</span>
            </a>
        </li>
        {{-- products --}}
        <li class=" nav-item">
            <a href="{{route('main.dashboard')}}"><i class="la la-apple">
                </i><span class="menu-title" data-i18n="nav.support_raise_support.main">{{ trans('admin.products') }}</span>
            </a>
        </li>
        {{-- settings --}}
        <li class=" nav-item"><a href="#"><i class="la la-gear"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.settings') }}</span></a>
            <ul class="menu-content">
            <li class="{{request()->segment(3)=='countries'?'active':''}}"><a class="menu-item" href="{{route('countries.index')}}" data-i18n="nav.dash.ecommerce">{{ trans('admin.countries') }}</a></li>
              <li><a class="menu-item" href="#" data-i18n="nav.dash.ecommerce">{{ trans('admin.cities') }}</a></li>
              <li><a class="menu-item" href="#" data-i18n="nav.dash.ecommerce">{{ trans('admin.states') }}</a></li>
              <li><a class="menu-item" href="#" data-i18n="nav.dash.ecommerce">{{ trans('admin.categories') }}</a></li>
              <li><a class="menu-item" href="#" data-i18n="nav.dash.ecommerce">{{ trans('admin.departments') }}</a></li>
              <li><a class="menu-item" href="#" data-i18n="nav.dash.ecommerce">{{ trans('admin.specifications') }}</a></li>
            </ul>
          </li>
      </ul>
    </div>
  </div>
