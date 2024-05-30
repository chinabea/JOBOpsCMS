<!-- <li class="nav-item">
    <a href="https://m.me/332081713319212?ref=homepage" id="openChatButton" class="nav-link">
        <i class="far fa-circle nav-icon text-danger"></i>
    </a>
</li> -->

        
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav ">
      <li class="nav-item ">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    

    <ul class="navbar-nav ml-auto">


    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="https://m.me/332081713319212?ref=homepage" id="openChatButton">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge"></span>
        </a>
        <!-- <button id="openChatButton" class="btn btn-primary">Open Chat</button> -->
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can... Call me whenever you can... Call me whenever you can...Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>




      <li class="nav-item dropdown">
        <a class="nav-link" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="{{ route('notifications') }}">
          <i class="far fa-bell"></i>
          @if(auth()->check())
              <span class="badge badge-warning navbar-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
          @endif
        </a>
        
        <style>
        .icon-circle {
            display: inline-flex;
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        </style>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        @if(auth()->check())
          <a href="{{ route('notifications') }}" class="dropdown-item dropdown-header btn bg-navy">Notifications ({{ auth()->user()->unreadNotifications->count() }})</a>
        @endif
        <div class="dropdown-divider"></div>
        <div style="max-height: 300px; overflow-y: auto;">
        

        @if (Auth::check())
        @foreach (Auth::user()->unreadNotifications as $notification)
        <!-- Message Start -->
        <a class="dropdown-item bg-light" href="{{ route('mark-notification-as-read', ['notification' => $notification->id]) }}">
          <div class="media">
          <span class="mr-3 icon-circle bg-info d-flex justify-content-center align-items-center">
              <i class="{{ $notification->data['icon'] }}"></i> 
          </span>
            <div class="media-body">
              <p class="text-sm text-bold"><i class="fas fa-clock"></i> {{ $notification->created_at->diffForHumans() }}</p>
              <p class="text-sm text-bold">{{ $notification->data['message'] }}</p>
            </div>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        <!-- Message End -->
        @endforeach
        @foreach (Auth::user()->readNotifications as $notification)
        <a href="{{ route('mark-notification-as-read', ['notification' => $notification->id]) }}" class="dropdown-item bg-light ">
          <div class="media">
          <span class="mr-3 my-2 icon-circle bg-info d-flex justify-content-center align-items-center">
              <i class="{{ $notification->data['icon'] }}"></i> 
          </span>
            <div class="media-body">
              <p class="text-sm text-muted"><i class="fas fa-clock"></i> {{ $notification->created_at->diffForHumans() }}</p>
              <p class="text-sm">{{ $notification->data['message'] }}</p>
            </div>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        
        @endforeach
        @endif


      </div>
      <div class="dropdown-divider" style="margin-top: 8px; margin-bottom: 8px;"></div>
      <form method="POST" action="{{ route('mark-all-as-read') }}">
        @csrf
        @method('POST')
        <button type="submit" class="btn btn-link dropdown-item dropdown-footer">Mark All as Read</button>
      </form>
    </div>
  </li>

<style>
    .unread-notification {
        background-color: #f3f4f6;
    }

</style>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(Auth::user()->role == 4)
                      <!-- Staff,  -->
                      {{ Auth::user()->name }} 
                    @elseif(Auth::user()->role == 3) 
                       <!-- MICT Staff,  -->
                       {{ Auth::user()->name }} 
                    @elseif(Auth::user()->role == 2)
                        <!-- Unit Admin,  -->
                        {{ Auth::user()->name }} 
                    @elseif(Auth::user()->role == 1)
                        <!-- Director,  -->
                        {{ Auth::user()->name }} 
                    @else
                        {{ Auth::user()->name }} 
                    @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('user.edit', auth()->id()) }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </a>
            </div>
        </li>
    </ul>

</nav>


