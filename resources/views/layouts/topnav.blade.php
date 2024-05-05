
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ $profilePictureUrl }}" alt="">
                      @if(Auth::user()->role == 1)
                          {{ Auth::user()->name }}
                      @elseif(Auth::user()->role == 2)
                          {{ Auth::user()->name }}
                      @elseif(Auth::user()->role == 3)
                          {{ Auth::user()->name }}
                      @else
                          {{ Auth::user()->name }}
                      @endif
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('user.edit', auth()->id()) }}"><i class="fa fa-user mr-2"></i> Profile</a>

                      <!-- <a class="dropdown-item"  href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a> -->
                  <!-- <a class="dropdown-item"  href="javascript:;">Help</a> -->
                    <!-- <a class="dropdown-item"  href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a> -->


                    
                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out mr-2"></i>
                    Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </a>


                  </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                  <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell-o"></i>
                    <!-- <span class="badge bg-green">6</span> -->
                    @if(auth()->check())
                        <span class="badge bg-green">{{ auth()->user()->unreadNotifications->count() }}</span>
                    @endif
                  </a>
                  <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">

                  
        @if (Auth::check())
        @foreach (Auth::user()->unreadNotifications as $notification)
        <li class="nav-item">
          <a class="dropdown-item bg-light" href="{{ route('mark-notification-as-read', ['notification' => $notification->id]) }}">
            <span class="image"><img src="{{ $profilePictureUrl }}" alt="Profile Image" /></span>
            <span>
              <span>China Bea</span>
              <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
            </span>
            <span class="message">
              {{ $notification->data['message'] }}
            </span>
          </a>
        </li>
        @endforeach
        @foreach (Auth::user()->readNotifications as $notification)
        <li class="nav-item">
          <a class="dropdown-item bg-light" href="{{ route('mark-notification-as-read', ['notification' => $notification->id]) }}">
            <span class="image"><img src="{{ $profilePictureUrl }}" alt="Profile Image" /></span>
            <span>
              <span>China Bea</span>
              <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
            </span>
            <span class="message">
              {{ $notification->data['message'] }}
            </span>
          </a>
        </li>
        @endforeach
        @endif
        

                    <li class="nav-item">
                      <div class="text-center">
                       
      <form method="POST" action="{{ route('mark-all-as-read') }}">
        @csrf
        @method('POST')
                        <button type="submit" class="dropdown-item">
                          <strong>Mark All as Read</strong>
                          <!-- <i class="fa fa-angle-right"></i> -->
                        </button>
      </form>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->