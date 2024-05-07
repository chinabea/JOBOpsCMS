<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link sidebar-dark-primary">
        <img src="{{ asset('dist/img/MICT-Logo.png') }}" alt="MICT Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">JobOps CMS</span>
    </a>
    <div class="sidebar">
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
                    <a href="{{ route('users') }}" class="nav-link {{ Route::currentRouteName() == 'users' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users mr-2"></i>
                        <p> Users </p>
                    </a>
                </li>
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
                        <li class="nav-item">
                            <a href="{{ route('tickets') }}" class="nav-link {{ Route::currentRouteName() == 'tickets' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>All Tickets</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tickets') }}" class="nav-link {{ Route::currentRouteName() == 'tickets' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-danger"></i>
                                <p>My Tickets</p>
                            </a>
                        </li>
                    </ul>
                </li><br>
                <li class="nav-header">ADMINISTRATION</li>
                <li class="nav-item">
                            <a href="{{ route('tickets.assigned') }}" class="nav-link {{ Route::currentRouteName() == 'tickets.assigned' ? 'active' : '' }}">
                        <i class="fas fa-check-circle nav-icon"></i>
                        <p>Assigned Tickets</p>
                    </a>
                </li>
                <li class="nav-item">
                            <a href="{{ route('tickets.unassigned') }}" class="nav-link {{ Route::currentRouteName() == 'tickets.unassigned' ? 'active' : '' }}">
                        <i class="fas fa-times-circle nav-icon"></i>
                        <p>Unassigned Tickets</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tickets.unassigned') }}" class="nav-link {{ Route::currentRouteName() == 'tickets.unassigned' ? 'active' : '' }}">
                        <i class="fas fa-check-circle nav-icon"></i>
                        <p>My Unassigned Tickets</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-flag"></i>
                        <p> Priorities <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('priority-level.high') }}" class="nav-link {{ Route::currentRouteName() == 'priority-level.high' ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>High</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('priority-level.mid') }}" class="nav-link {{ Route::currentRouteName() == 'priority-level.mid' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>Mid</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('priority-level.low') }}" class="nav-link {{ Route::currentRouteName() == 'priority-level.low' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Low</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p> Status <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('status.open') }}" class="nav-link {{ Route::currentRouteName() == 'status.open' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-danger"></i>
                                <p>Open</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('status.in-progress') }}}" class="nav-link {{ Route::currentRouteName() == 'status.in-progress' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>In Progress</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('status.closed') }}" class="nav-link {{ Route::currentRouteName() == 'status.closed' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Closed</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon text-success"></i>
                                <p>Completed</p>
                            </a>
                        </li>
                    </ul>
                </li>
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
                    <a id="theme-toggle" class="nav-link">
                        <i class="nav-icon fas fa-adjust"></i>
                        <p>Theme</p>
                    </a>
                </li>
            </div>
        </aside>