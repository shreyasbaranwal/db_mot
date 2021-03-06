      <li class="c-header-nav-item dropdown mx-2">
        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="far fa-bell fa-2x"></i><span class="badge badge-primary badge-pill">
            {{ Auth::user()->unreadNotifications->count() }}
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg  d-md-down-none pt-0">
          <div class="dropdown-header bg-light">
            <strong>You have {{ Auth::user()->unreadNotifications->count() }} unread notifications</strong>
          </div>

          @foreach(Auth::user()->unreadNotifications as $notification)
            <a class="dropdown-item" href="{{ $notification->data['link'] }}">
              <div class="message">
                <div class="row">
                  <div class="col-sm-6">
                    {{ $notification->data['title'] }}
                  </div>
                  <div class="col-sm-6 float-right">
                    <span class="float-right"><small class="text-muted mt-1">{{ $notification->created_at }}</small></span>
                  </div>
                </div>

                <div class="row small text-muted">
                  <div class="col-sm-12">
                    {{ $notification->data['text'] }}
                  </div>
                </div>
              </div>
            </a>
          @endforeach
          <a class="dropdown-item text-center border-top" href="{{ route('notifications')}}">
            View all notifications
          </a>
        </div>
      </li>
