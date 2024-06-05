
@if(Auth::user()->role == 1)
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
            @if(Auth::user()->role == 1)
                <small>Director,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 2) 
                <small>ICTRAM Unit Head,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 3)
                <small>NICMU Unit Head,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 4)
                <small>MIS Unit Head,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 5)
                <small>Staff,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 6)
                <small>Student,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 7)
                <small>MICT Staff,</small><br> 
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
                   
                    @if(Auth::user()->role == 1)
                        <a href="{{ route('director.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'director.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 2 || Auth::user()->role == 3 || Auth::user()->role == 4) 
                        <a href="{{ route('unit-head.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'unit-head.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 5)
                        <a href="{{ route('staff.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'staff.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 6)
                        <a href="{{ route('student.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'student.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 7)
                        <a href="{{ route('mict-staff.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'mict-staff.dashboard' ? 'active' : '' }}">
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
                                <i class="far fa-circle nav-icon text-info"></i>
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
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-exclamation-triangle"></i>
                        <p> Status <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('status.open') }}" class="nav-link {{ Route::currentRouteName() == 'status.open' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Open</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('status.in-progress') }}" class="nav-link {{ Route::currentRouteName() == 'status.in-progress' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
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
                            <a href="{{ route('status.completed') }}" class="nav-link {{ Route::currentRouteName() == 'status.completed' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Completed</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- <li class="nav-header">ADMINISTRATION</li> -->
                @if(Auth::user()->role == 1 || Auth::user()->role == 2  || Auth::user()->role == 3 )
                    <li class="nav-item">
                        <a href="{{ route('unit.purchased') }}" class="nav-link {{ Route::currentRouteName() == 'unit.purchased' ? 'active' : '' }}">
                        <td><i class="fas fa-dollar-sign nav-icon"></i></td>
                            <p>Equipments</p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role == 1 || Auth::user()->role == 2 )
                    <li class="nav-item">
                        <a href="{{ route('ictrams.offices') }}" class="nav-link {{ Route::currentRouteName() == 'ictrams.offices' ? 'active' : '' }}">
                        <td><i class="fas fa-chart-line nav-icon"></i></td>

                            <p>Top Offices</p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role == 1)
                <li class="nav-item">
                    <a href="{{ route('users') }}" class="nav-link {{ Route::currentRouteName() == 'users' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users mr-2"></i>
                        <p> Users </p>
                    </a>
                </li>
                @endif
                <!-- @if(Auth::user()->role == 2)
                <li class="nav-item">
                    <a href="{{ route('ictram-tickets') }}" class="nav-link {{ Route::currentRouteName() == 'ictram-tickets' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university mr-2"></i>
                        <p> ICTRAM Tickets </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('nicmu-tickets') }}" class="nav-link {{ Route::currentRouteName() == 'nicmu-tickets' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university mr-2"></i>
                        <p> NICMU Tickets </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mis-tickets') }}" class="nav-link {{ Route::currentRouteName() == 'mis-tickets' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university mr-2"></i>
                        <p> MIS Tickets </p>
                    </a>
                </li>
                @endif -->

               
                @if(Auth::user()->role == 1 || Auth::user()->role == 2 )
                    <!-- <li class="nav-item">
                        <a href="{{ route('ictrams.index') }}" class="nav-link {{ Route::currentRouteName() == 'ictrams.index' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon text-white"></i>
                            <p>ICTRAM</p>
                        </a>
                    </li> -->
                <!-- <li class="nav-item">
                    <a href="{{ route('ictrams.index') }}" class="nav-link {{ Route::currentRouteName() == 'ictrams.index' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon text-white"></i>
                        <p> ICTRAM <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('ictrams.index') }}" class="nav-link {{ Route::currentRouteName() == 'ictrams.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Relational</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ictrams.JobTypes') }}" class="nav-link {{ Route::currentRouteName() == 'ictrams.JobTypes' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Job Types</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ictrams.Equipments') }}" class="nav-link {{ Route::currentRouteName() == 'ictrams.Equipments' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Equipments</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ictrams.Problems') }}" class="nav-link {{ Route::currentRouteName() == 'ictrams.Problems' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Problem/Issues</p>
                            </a>
                        </li>
                    </ul>
                </li> -->
                    @endif
                    @if(Auth::user()->role == 1 || Auth::user()->role == 3 )
                <!-- <li class="nav-item">
                    <a href="{{ route('nicmus.index') }}" class="nav-link {{ Route::currentRouteName() == 'nicmus.index' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon text-red"></i>
                        <p> NICMUS <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('nicmus.index') }}" class="nav-link {{ Route::currentRouteName() == 'nicmus.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Relational</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('nicmus.JobTypes') }}" class="nav-link {{ Route::currentRouteName() == 'nicmus.JobTypes' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Job Types</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('nicmus.Equipments') }}" class="nav-link {{ Route::currentRouteName() == 'nicmus.Equipments' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Equipments</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('nicmus.Problems') }}" class="nav-link {{ Route::currentRouteName() == 'nicmus.Problems' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Problem/Issues</p>
                            </a>
                        </li>
                    </ul>
                </li> -->
                    @endif
                    @if(Auth::user()->role == 1 || Auth::user()->role == 4 )
                <!-- <li class="nav-item">
                    <a href="{{ route('mises.index') }}" class="nav-link {{ Route::currentRouteName() == 'mises.index' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon text-yellow"></i>
                        <p> MIS <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('mises.index') }}" class="nav-link {{ Route::currentRouteName() == 'mises.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Relational</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('mises.JobTypes') }}" class="nav-link {{ Route::currentRouteName() == 'mises.JobTypes' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Job Types</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('mises.RequestTypes') }}" class="nav-link {{ Route::currentRouteName() == 'mises.RequestTypes' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Request Types</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('mises.AsNames') }}" class="nav-link {{ Route::currentRouteName() == 'mises.AsNames' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Account Name</p>
                            </a>
                        </li>
                    </ul>
                </li> -->
                @endif
                @if(Auth::user()->role == 1)
                <li class="nav-item">
                    <a href="{{ route('manage') }}" class="nav-link {{ Route::currentRouteName() == 'manage' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs mr-2"></i>
                        <p> Manage </p>
                    </a>
                </li>
                @endif
                
                <!-- <br> -->
                <li class="nav-header">OTHERS</li>
                <li class="nav-item">
                    <a href="https://m.me/332081713319212" class="nav-link">
                        <i class="far fa-circle nav-icon text-danger"></i>
                        <p>Messages 1</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://m.me/332081713319212?ref=homepage" class="nav-link">
                        <i class="far fa-circle nav-icon text-danger"></i>
                        <p>Messages 2</p>
                    </a>
                </li>
                <li class="nav-item">
                            <a href="{{ route('tickets.report') }}" class="nav-link {{ Route::currentRouteName() == 'tickets.report' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Reports</p>
                    </a>
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
                        <p>Dark Theme</p>
                    </a>
                </li>
            </div>
        </aside>
        
        
@elseif(Auth::user()->role == 2) 
            
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
                <small>ICTRAM Unit Head,</small><br> 
                {{ Auth::user()->name }} 
          </a>
        </div>
      </div>
      <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                   
                    @if(Auth::user()->role == 1)
                        <a href="{{ route('director.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'director.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 2 || Auth::user()->role == 3 || Auth::user()->role == 4) 
                        <a href="{{ route('unit-head.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'unit-head.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 5)
                        <a href="{{ route('staff.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'staff.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 6)
                        <a href="{{ route('student.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'student.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 7)
                        <a href="{{ route('mict-staff.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'mict-staff.dashboard' ? 'active' : '' }}">
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
                                <i class="far fa-circle nav-icon text-info"></i>
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
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-exclamation-triangle"></i>
                        <p> Status <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('status.open') }}" class="nav-link {{ Route::currentRouteName() == 'status.open' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Open</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('status.in-progress') }}" class="nav-link {{ Route::currentRouteName() == 'status.in-progress' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
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
                            <a href="{{ route('status.completed') }}" class="nav-link {{ Route::currentRouteName() == 'status.completed' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Completed</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- <li class="nav-header">ADMINISTRATION</li> -->
                @if(Auth::user()->role == 1 || Auth::user()->role == 2  || Auth::user()->role == 3 )
                    <li class="nav-item">
                        <a href="{{ route('unit.purchased') }}" class="nav-link {{ Route::currentRouteName() == 'unit.purchased' ? 'active' : '' }}">
                        <td><i class="fas fa-dollar-sign nav-icon"></i></td>
                            <p>Equipments</p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role == 1 || Auth::user()->role == 2 )
                    <li class="nav-item">
                        <a href="{{ route('ictrams.offices') }}" class="nav-link {{ Route::currentRouteName() == 'ictrams.offices' ? 'active' : '' }}">
                        <td><i class="fas fa-chart-line nav-icon"></i></td>

                            <p>Top Offices</p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role == 1)
                <li class="nav-item">
                    <a href="{{ route('users') }}" class="nav-link {{ Route::currentRouteName() == 'users' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users mr-2"></i>
                        <p> Users </p>
                    </a>
                </li>
                @endif
                <!-- @if(Auth::user()->role == 2) -->
                <li class="nav-item">
                    <a href="{{ route('ictram-tickets') }}" class="nav-link {{ Route::currentRouteName() == 'ictram-tickets' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university mr-2"></i>
                        <p> ICTRAM Tickets </p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="{{ route('nicmu-tickets') }}" class="nav-link {{ Route::currentRouteName() == 'nicmu-tickets' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university mr-2"></i>
                        <p> NICMU Tickets </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mis-tickets') }}" class="nav-link {{ Route::currentRouteName() == 'mis-tickets' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university mr-2"></i>
                        <p> MIS Tickets </p>
                    </a>
                </li> -->
                <!-- @endif -->

               
                <!-- @if(Auth::user()->role == 1 || Auth::user()->role == 2 )
                    @endif
                    @if(Auth::user()->role == 1 || Auth::user()->role == 3 )
                    @endif
                    @if(Auth::user()->role == 1 || Auth::user()->role == 4 )
                @endif -->
                <!-- @if(Auth::user()->role == 1)
                <li class="nav-item">
                    <a href="{{ route('units') }}" class="nav-link {{ Route::currentRouteName() == 'units' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs mr-2"></i>
                        <p> Manage </p>
                    </a>
                </li>
                @endif -->
                
                <li class="nav-header">OTHERS</li>
                <li class="nav-item">
                    <a href="{{ route('tickets.report') }}" class="nav-link {{ Route::currentRouteName() == 'tickets.report' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Reports</p>
                    </a>
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
                        <p>Dark Theme</p>
                    </a>
                </li>
            </div>
        </aside>



@elseif(Auth::user()->role == 3)
<!-- <small>NICMU Unit Head,</small><br>  -->
       
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
            <!-- @if(Auth::user()->role == 1)
                <small>Director,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 2) 
                <small>ICTRAM Unit Head,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 3) -->
                <small>NICMU Unit Head,</small><br> 
                {{ Auth::user()->name }} 
            <!-- @elseif(Auth::user()->role == 4)
                <small>MIS Unit Head,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 5)
                <small>Staff,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 6)
                <small>Student,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 7)
                <small>MICT Staff,</small><br> 
                {{ Auth::user()->name }} 
            @else
                {{ Auth::user()->name }} 
            @endif -->

          </a>
        </div>
      </div>
      <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                   
                    <!-- @if(Auth::user()->role == 1)
                        <a href="{{ route('director.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'director.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 2 || Auth::user()->role == 3 || Auth::user()->role == 4)  -->
                        <a href="{{ route('unit-head.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'unit-head.dashboard' ? 'active' : '' }}">
                    <!-- @elseif(Auth::user()->role == 5)
                        <a href="{{ route('staff.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'staff.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 6)
                        <a href="{{ route('student.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'student.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 7)
                        <a href="{{ route('mict-staff.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'mict-staff.dashboard' ? 'active' : '' }}">
                    @else
                        {{ Auth::user()->name }} 
                    @endif -->
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
                                <i class="far fa-circle nav-icon text-info"></i>
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
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-exclamation-triangle"></i>
                        <p> Status <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('status.open') }}" class="nav-link {{ Route::currentRouteName() == 'status.open' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Open</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('status.in-progress') }}" class="nav-link {{ Route::currentRouteName() == 'status.in-progress' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
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
                            <a href="{{ route('status.completed') }}" class="nav-link {{ Route::currentRouteName() == 'status.completed' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Completed</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- <li class="nav-header">ADMINISTRATION</li> -->
                @if(Auth::user()->role == 1 || Auth::user()->role == 2  || Auth::user()->role == 3 )
                    <li class="nav-item">
                        <a href="{{ route('unit.purchased') }}" class="nav-link {{ Route::currentRouteName() == 'unit.purchased' ? 'active' : '' }}">
                        <td><i class="fas fa-dollar-sign nav-icon"></i></td>
                            <p>Equipments</p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role == 1 || Auth::user()->role == 2 )
                    <li class="nav-item">
                        <a href="{{ route('ictrams.offices') }}" class="nav-link {{ Route::currentRouteName() == 'ictrams.offices' ? 'active' : '' }}">
                        <td><i class="fas fa-chart-line nav-icon"></i></td>

                            <p>Top Offices</p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role == 1)
                <li class="nav-item">
                    <a href="{{ route('users') }}" class="nav-link {{ Route::currentRouteName() == 'users' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users mr-2"></i>
                        <p> Users </p>
                    </a>
                </li>
                @endif
                <!-- @if(Auth::user()->role == 2)
                <li class="nav-item">
                    <a href="{{ route('ictram-tickets') }}" class="nav-link {{ Route::currentRouteName() == 'ictram-tickets' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university mr-2"></i>
                        <p> ICTRAM Tickets </p>
                    </a>
                </li>
                @elseif(Auth::user()->role == 3) -->
                <li class="nav-item">
                    <a href="{{ route('nicmu-tickets') }}" class="nav-link {{ Route::currentRouteName() == 'nicmu-tickets' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university mr-2"></i>
                        <p> NICMU Tickets </p>
                    </a>
                </li>
                <!-- @elseif(Auth::user()->role == 4)
                <li class="nav-item">
                    <a href="{{ route('mis-tickets') }}" class="nav-link {{ Route::currentRouteName() == 'mis-tickets' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university mr-2"></i>
                        <p> MIS Tickets </p>
                    </a>
                </li>
                @endif -->

               
                @if(Auth::user()->role == 1 || Auth::user()->role == 2 )
                    @endif
                    @if(Auth::user()->role == 1 || Auth::user()->role == 3 )
                    @endif
                    @if(Auth::user()->role == 1 || Auth::user()->role == 4 )
                @endif
                @if(Auth::user()->role == 1)
                <li class="nav-item">
                    <a href="{{ route('units') }}" class="nav-link {{ Route::currentRouteName() == 'units' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs mr-2"></i>
                        <p> Manage </p>
                    </a>
                </li>
                @endif
                
                <li class="nav-header">OTHERS</li>
                <li class="nav-item">
                            <a href="{{ route('tickets.report') }}" class="nav-link {{ Route::currentRouteName() == 'tickets.report' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Reports</p>
                    </a>
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
                        <p>Dark Theme</p>
                    </a>
                </li>
            </div>
        </aside>
            @elseif(Auth::user()->role == 4)
                <!-- <small>MIS Unit Head,</small><br>  -->

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
            @if(Auth::user()->role == 1)
                <small>Director,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 2) 
                <small>ICTRAM Unit Head,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 3)
                <small>NICMU Unit Head,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 4)
                <small>MIS Unit Head,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 5)
                <small>Staff,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 6)
                <small>Student,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 7)
                <small>MICT Staff,</small><br> 
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
                   
                    @if(Auth::user()->role == 1)
                        <a href="{{ route('director.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'director.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 2 || Auth::user()->role == 3 || Auth::user()->role == 4) 
                        <a href="{{ route('unit-head.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'unit-head.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 5)
                        <a href="{{ route('staff.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'staff.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 6)
                        <a href="{{ route('student.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'student.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 7)
                        <a href="{{ route('mict-staff.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'mict-staff.dashboard' ? 'active' : '' }}">
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
                                <i class="far fa-circle nav-icon text-info"></i>
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
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-exclamation-triangle"></i>
                        <p> Status <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('status.open') }}" class="nav-link {{ Route::currentRouteName() == 'status.open' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Open</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('status.in-progress') }}" class="nav-link {{ Route::currentRouteName() == 'status.in-progress' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
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
                            <a href="{{ route('status.completed') }}" class="nav-link {{ Route::currentRouteName() == 'status.completed' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Completed</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- <li class="nav-header">ADMINISTRATION</li> -->
                @if(Auth::user()->role == 1 || Auth::user()->role == 2  || Auth::user()->role == 3 )
                    <li class="nav-item">
                        <a href="{{ route('unit.purchased') }}" class="nav-link {{ Route::currentRouteName() == 'unit.purchased' ? 'active' : '' }}">
                        <td><i class="fas fa-dollar-sign nav-icon"></i></td>
                            <p>Equipments</p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role == 1 || Auth::user()->role == 2 )
                    <li class="nav-item">
                        <a href="{{ route('ictrams.offices') }}" class="nav-link {{ Route::currentRouteName() == 'ictrams.offices' ? 'active' : '' }}">
                        <td><i class="fas fa-chart-line nav-icon"></i></td>

                            <p>Top Offices</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('mis-tickets') }}" class="nav-link {{ Route::currentRouteName() == 'mis-tickets' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university mr-2"></i>
                        <p> MIS Tickets </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tickets.assigned') }}" class="nav-link {{ Route::currentRouteName() == 'tickets.assigned' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book mr-2"></i>
                        <p>Assigned Tickets</p>
                    </a>
                </li>

               
                @if(Auth::user()->role == 1 || Auth::user()->role == 2 )
                    @endif
                    @if(Auth::user()->role == 1 || Auth::user()->role == 3 )
                    @endif
                    @if(Auth::user()->role == 1 || Auth::user()->role == 4 )
                @endif
                @if(Auth::user()->role == 1)
                <li class="nav-item">
                    <a href="{{ route('units') }}" class="nav-link {{ Route::currentRouteName() == 'units' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs mr-2"></i>
                        <p> Manage </p>
                    </a>
                </li>
                @endif
                
                <li class="nav-header">OTHERS</li>
                <li class="nav-item">
                            <a href="{{ route('tickets.report') }}" class="nav-link {{ Route::currentRouteName() == 'tickets.report' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Reports</p>
                    </a>
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
                        <p>Dark Theme</p>
                    </a>
                </li>
            </div>
        </aside>
            @elseif(Auth::user()->role == 5)
                <!-- <small>Staff,</small><br> -->
                

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
            @if(Auth::user()->role == 1)
                <small>Director,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 2) 
                <small>ICTRAM Unit Head,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 3)
                <small>NICMU Unit Head,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 4)
                <small>MIS Unit Head,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 5)
                <small>Staff,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 6)
                <small>Student,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 7)
                <small>MICT Staff,</small><br> 
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
                   
                    @if(Auth::user()->role == 1)
                        <a href="{{ route('director.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'director.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 2 || Auth::user()->role == 3 || Auth::user()->role == 4) 
                        <a href="{{ route('unit-head.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'unit-head.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 5)
                        <a href="{{ route('staff.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'staff.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 6)
                        <a href="{{ route('student.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'student.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 7)
                        <a href="{{ route('mict-staff.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'mict-staff.dashboard' ? 'active' : '' }}">
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
                                <i class="far fa-circle nav-icon text-info"></i>
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
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-exclamation-triangle"></i>
                        <p> Status <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('status.open') }}" class="nav-link {{ Route::currentRouteName() == 'status.open' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Open</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('status.in-progress') }}" class="nav-link {{ Route::currentRouteName() == 'status.in-progress' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
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
                            <a href="{{ route('status.completed') }}" class="nav-link {{ Route::currentRouteName() == 'status.completed' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Completed</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- <li class="nav-header">ADMINISTRATION</li> -->
                @if(Auth::user()->role == 1 || Auth::user()->role == 2  || Auth::user()->role == 3 )
                    <li class="nav-item">
                        <a href="{{ route('unit.purchased') }}" class="nav-link {{ Route::currentRouteName() == 'unit.purchased' ? 'active' : '' }}">
                        <td><i class="fas fa-dollar-sign nav-icon"></i></td>
                            <p>Equipments</p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role == 1 || Auth::user()->role == 2 )
                    <li class="nav-item">
                        <a href="{{ route('ictrams.offices') }}" class="nav-link {{ Route::currentRouteName() == 'ictrams.offices' ? 'active' : '' }}">
                        <td><i class="fas fa-chart-line nav-icon"></i></td>

                            <p>Top Offices</p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role == 1)
                <li class="nav-item">
                    <a href="{{ route('users') }}" class="nav-link {{ Route::currentRouteName() == 'users' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users mr-2"></i>
                        <p> Users </p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->role == 2)
                <li class="nav-item">
                    <a href="{{ route('ictram-tickets') }}" class="nav-link {{ Route::currentRouteName() == 'ictram-tickets' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university mr-2"></i>
                        <p> ICTRAM Tickets </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('nicmu-tickets') }}" class="nav-link {{ Route::currentRouteName() == 'nicmu-tickets' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university mr-2"></i>
                        <p> NICMU Tickets </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mis-tickets') }}" class="nav-link {{ Route::currentRouteName() == 'mis-tickets' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university mr-2"></i>
                        <p> MIS Tickets </p>
                    </a>
                </li>
                @endif

               
                @if(Auth::user()->role == 1 || Auth::user()->role == 2 )
                    @endif
                    @if(Auth::user()->role == 1 || Auth::user()->role == 3 )
                    @endif
                    @if(Auth::user()->role == 1 || Auth::user()->role == 4 )
                @endif
                @if(Auth::user()->role == 1)
                <li class="nav-item">
                    <a href="{{ route('units') }}" class="nav-link {{ Route::currentRouteName() == 'units' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs mr-2"></i>
                        <p> Manage </p>
                    </a>
                </li>
                @endif
                
                <li class="nav-header">OTHERS</li>
                <li class="nav-item">
                            <a href="{{ route('tickets.report') }}" class="nav-link {{ Route::currentRouteName() == 'tickets.report' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Reports</p>
                    </a>
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
                        <p>Dark Theme</p>
                    </a>
                </li>
            </div>
        </aside>
            @elseif(Auth::user()->role == 6)
                <!-- <small>Student,</small><br>  -->
                

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
            @if(Auth::user()->role == 1)
                <small>Director,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 2) 
                <small>ICTRAM Unit Head,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 3)
                <small>NICMU Unit Head,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 4)
                <small>MIS Unit Head,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 5)
                <small>Staff,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 6)
                <small>Student,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 7)
                <small>MICT Staff,</small><br> 
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
                   
                    @if(Auth::user()->role == 1)
                        <a href="{{ route('director.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'director.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 2 || Auth::user()->role == 3 || Auth::user()->role == 4) 
                        <a href="{{ route('unit-head.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'unit-head.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 5)
                        <a href="{{ route('staff.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'staff.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 6)
                        <a href="{{ route('student.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'student.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 7)
                        <a href="{{ route('mict-staff.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'mict-staff.dashboard' ? 'active' : '' }}">
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
                                <i class="far fa-circle nav-icon text-info"></i>
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
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-exclamation-triangle"></i>
                        <p> Status <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('status.open') }}" class="nav-link {{ Route::currentRouteName() == 'status.open' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Open</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('status.in-progress') }}" class="nav-link {{ Route::currentRouteName() == 'status.in-progress' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
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
                            <a href="{{ route('status.completed') }}" class="nav-link {{ Route::currentRouteName() == 'status.completed' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Completed</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- <li class="nav-header">ADMINISTRATION</li> -->
                @if(Auth::user()->role == 1 || Auth::user()->role == 2  || Auth::user()->role == 3 )
                    <li class="nav-item">
                        <a href="{{ route('unit.purchased') }}" class="nav-link {{ Route::currentRouteName() == 'unit.purchased' ? 'active' : '' }}">
                        <td><i class="fas fa-dollar-sign nav-icon"></i></td>
                            <p>Equipments</p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role == 1 || Auth::user()->role == 2 )
                    <li class="nav-item">
                        <a href="{{ route('ictrams.offices') }}" class="nav-link {{ Route::currentRouteName() == 'ictrams.offices' ? 'active' : '' }}">
                        <td><i class="fas fa-chart-line nav-icon"></i></td>

                            <p>Top Offices</p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role == 1)
                <li class="nav-item">
                    <a href="{{ route('users') }}" class="nav-link {{ Route::currentRouteName() == 'users' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users mr-2"></i>
                        <p> Users </p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->role == 2)
                <li class="nav-item">
                    <a href="{{ route('ictram-tickets') }}" class="nav-link {{ Route::currentRouteName() == 'ictram-tickets' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university mr-2"></i>
                        <p> ICTRAM Tickets </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('nicmu-tickets') }}" class="nav-link {{ Route::currentRouteName() == 'nicmu-tickets' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university mr-2"></i>
                        <p> NICMU Tickets </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mis-tickets') }}" class="nav-link {{ Route::currentRouteName() == 'mis-tickets' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university mr-2"></i>
                        <p> MIS Tickets </p>
                    </a>
                </li>
                @endif

               
                @if(Auth::user()->role == 1 || Auth::user()->role == 2 )
                    @endif
                    @if(Auth::user()->role == 1 || Auth::user()->role == 3 )
                    @endif
                    @if(Auth::user()->role == 1 || Auth::user()->role == 4 )
                @endif
                @if(Auth::user()->role == 1)
                <li class="nav-item">
                    <a href="{{ route('units') }}" class="nav-link {{ Route::currentRouteName() == 'units' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs mr-2"></i>
                        <p> Manage </p>
                    </a>
                </li>
                @endif
                
                <li class="nav-header">OTHERS</li>
                <li class="nav-item">
                            <a href="{{ route('tickets.report') }}" class="nav-link {{ Route::currentRouteName() == 'tickets.report' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Reports</p>
                    </a>
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
                        <p>Dark Theme</p>
                    </a>
                </li>
            </div>
        </aside>
            @elseif(Auth::user()->role == 7)
                <!-- <small>MICT Staff,</small><br>  -->
                

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
            @if(Auth::user()->role == 1)
                <small>Director,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 2) 
                <small>ICTRAM Unit Head,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 3)
                <small>NICMU Unit Head,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 4)
                <small>MIS Unit Head,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 5)
                <small>Staff,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 6)
                <small>Student,</small><br> 
                {{ Auth::user()->name }} 
            @elseif(Auth::user()->role == 7)
                <small>MICT Staff,</small><br> 
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
                   
                    @if(Auth::user()->role == 1)
                        <a href="{{ route('director.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'director.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 2 || Auth::user()->role == 3 || Auth::user()->role == 4) 
                        <a href="{{ route('unit-head.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'unit-head.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 5)
                        <a href="{{ route('staff.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'staff.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 6)
                        <a href="{{ route('student.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'student.dashboard' ? 'active' : '' }}">
                    @elseif(Auth::user()->role == 7)
                        <a href="{{ route('mict-staff.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'mict-staff.dashboard' ? 'active' : '' }}">
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
                                <i class="far fa-circle nav-icon text-info"></i>
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
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-exclamation-triangle"></i>
                        <p> Status <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('status.open') }}" class="nav-link {{ Route::currentRouteName() == 'status.open' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Open</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('status.in-progress') }}" class="nav-link {{ Route::currentRouteName() == 'status.in-progress' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
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
                            <a href="{{ route('status.completed') }}" class="nav-link {{ Route::currentRouteName() == 'status.completed' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Completed</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- should be accessible for all -->
                
                <li class="nav-item">
                    <a href="https://m.me/332081713319212?ref=homepage" class="nav-link">
                        <i class="far fa-circle nav-icon text-danger"></i>
                        <p>Messages 2</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('tickets.assigned') }}" class="nav-link {{ Route::currentRouteName() == 'tickets.assigned' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book mr-2"></i>
                        <p>Assigned Tickets</p>
                    </a>
                </li>
               
                <li class="nav-header">OTHERS</li>
                <li class="nav-item">
                            <a href="{{ route('tickets.report') }}" class="nav-link {{ Route::currentRouteName() == 'tickets.report' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Reports</p>
                    </a>
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
                        <p>Dark Theme</p>
                    </a>
                </li>
            </div>
        </aside>
            @else
            
            @endif
















