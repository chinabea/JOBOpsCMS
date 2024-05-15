<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link sidebar-dark-primary">
    <img src="{{ asset('dist/img/MICT-Logo.png') }}" alt="MICT Logo" class="brand-image img-circle elevation-3" style="opacity: .8; border: 2px solid white; border-radius: 50%;">

        <span class="brand-text font-weight-light">JObOps CMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="{{ $profilePictureUrl }}" class="img-circle elevation-2" alt="User Image" style="width: 50px; height: 50px;">

        </div>
        <div class="info">
          <a href="#" class="d-block">
            @if(Auth::user()->role == 4)
                <small>Student,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 3) 
                <small>MICT Staff,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 2)
                <small>Unit Admin,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 1)
                <small>Director,</small><br> 
                {{ Auth::user()->name }} 
            @else
                {{ Auth::user()->name }} 
            @endif

          </a>
        </div>
      </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                   
                    @if(Auth::user()->role == 4)
                        <a href="{{ route('staff.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'staff' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 3) 
                        <a href="{{ route('mict-staff.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'mict-staff.home' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 2)
                        <a href="{{ route('unit-head.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'unit-head.home' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 1)
                        <a href="{{ route('director.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'director.home' ? 'active' : '' }}">
                    @else
                        {{ Auth::user()->name }} 
                    @endif

                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">MAIN MENU</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p> Tickets <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('create.ticket') }}" class="nav-link {{ Route::currentRouteName() == 'create.ticket' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Request Ticket</p>
                            </a>
                        </li>
                        @if(Auth::user()->role == 1)
                        <li class="nav-item">
                            <a href="{{ route('tickets') }}" class="nav-link {{ Route::currentRouteName() == 'tickets' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>All Tickets</p>
                            </a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('tickets') }}" class="nav-link {{ Route::currentRouteName() == 'tickets' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-danger"></i>
                                <p>My Tickets</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                <!-- <br> -->
                <li class="nav-header">ADMINISTRATION</li>
                @if(Auth::user()->role == 1)
                <li class="nav-item">
                    <a href="{{ route('users') }}" class="nav-link {{ Route::currentRouteName() == 'users' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users mr-2"></i>
                        <p> Users </p>
                    </a>
                </li>
                @endif
                    @if(Auth::user()->role == 1)
                    <li class="nav-item">
                        <a href="{{ route('ictrams.index') }}" class="nav-link {{ Route::currentRouteName() == 'ictrams.index' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon text-white"></i>
                            <p>ICTRAM</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('mises.create') }}" class="nav-link {{ Route::currentRouteName() == 'mises.create' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon text-warning"></i>
                            <p>MIS</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('nicmus.create') }}" class="nav-link {{ Route::currentRouteName() == 'nicmus.create' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon text-danger"></i>
                            <p>NICMU</p>
                        </a>
                    </li>
                        @endif
                    
                <!-- <br> -->
                <li class="nav-header">OTHERS</li>
                <li class="nav-item">
                            <a href="{{ route('activity-log') }}" class="nav-link {{ Route::currentRouteName() == 'activity-log' ? 'active' : '' }}">
                        <i class="fas fa-folder-open nav-icon"></i>
                        <p>Activity Logs</p>
                    </a>
                </li>
                <li class="nav-item">
                            <a href="{{ route('faqs') }}" class="nav-link {{ Route::currentRouteName() == 'faqs' ? 'active' : '' }}">
                        <i class="fas fa-question-circle nav-icon"></i>
                        <p>FAQs</p>
                    </a>
                </li>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Route::currentRouteName() == 'settings' ? 'active' : '' }}">
                        <i class="fas fa-cogs nav-icon"></i>
                        <p>Settings</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="theme-toggle" class="nav-link">
                        <i class="nav-icon fas fa-adjust"></i>
                        <p>Theme</p>
                    </a>
                </li>
            </div>
        </aside>