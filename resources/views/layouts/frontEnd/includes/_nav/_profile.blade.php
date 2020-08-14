<li class="dropdown dropdown-user nav-item">
    <a class=" nav-link " href="#">
      @auth
        <span class="mr-1">{{ trans('admin.hello') }},
            <span class="user-name text-bold-700">{{authInfo()->name}}</span>
        </span>
      @endauth
      @guest
          {{ trans('admin.login') }}
      @endguest

    </a>
  </li>
