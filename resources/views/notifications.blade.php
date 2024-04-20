

@if (Auth::check())
        @foreach (Auth::user()->unreadNotifications as $notification)
        <!-- Message Start -->
        <h3>Unread Notifications</h3>
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
        
        <h3>Read Notifications</h3>
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