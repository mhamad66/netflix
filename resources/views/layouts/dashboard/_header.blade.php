<header class="app-header"><a class="app-header__logo" href="index.html">Vali</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
      <!--Notification Menu--> 
      <!-- User Menu-->
      <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
          {{-- <li><a class="dropdown-item" href=><i class="fa fa-sign-out fa-lg"></i> Logout</a></li> --}}
          <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-jet-dropdown-link class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                <i class="fa fa-sign-out fa-lg"></i>logout
            </x-jet-dropdown-link>
        </form>
        </ul>
      </li>
    </ul>
  </header>