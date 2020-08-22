      <nav class="navbar navbar-expand-md shadow-sm">
          <div class="container-fluid" id="contain">
              <div id="overlay"></div>
              <a class="navbar-brand" href="{{ url('/') }}">
                  {{ config('app.name') }}
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                  <span class="navbar-toggler-icon"></span>
              </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto justify-content-between">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->forename }}  {{ Auth::user()->surname }}<span class="caret"></span>
                                </a>


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.show', Auth::user()->member_uid) }}">Your Profile</a>
                                    <a class="dropdown-item" href="{{ route('events.index') }}">Upcoming Events</a>
                                  @can('View Members')
                                    <a class="dropdown-item" href="{{ route('admin.users.index') }}">Members</a>
                                  @endcan
                                  @can('View Droids')
                                    <a class="dropdown-item" href="{{ route('admin.droids.index') }}">Droids</a>
                                  @endcan
                                  @can('Edit Events')
                                    <a class="dropdown-item" href="{{ route('admin.events.index') }}">Events</a>
                                    <a class="dropdown-item" href="{{ route('admin.locations.index') }}">Locations</a>
                                  @endcan
                                  @can('Edit Achievements')
                                    <a class="dropdown-item" href="{{ route('admin.achievements.index') }}">Achievements</a>
                                  @endcan
                                  @can('Edit Clubs')
                                    <a class="dropdown-item" href="{{ route('admin.clubs.index') }}">Clubs</a>
                                  @endcan
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>