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

      </ul>
    </div>
  </div>
