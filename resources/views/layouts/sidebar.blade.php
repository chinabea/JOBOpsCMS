
<div class="col-md-3 left_col menu_fixed sidebar-dark">
    <div class="left_col scroll-view sidebar-dark">
    <div class="navbar nav_title sidebar-dark" style="border: 0;">
        <a href="{{ route('admin.home') }}" class="site_title">
        <img src="{{ asset('production/images/MICT-logo.png') }}" style="width: 50px; height: auto;">
        <span><b>JOB OPS</b></span></a>
    </div>
    <div class="clearfix"></div>
    <div class="profile clearfix">
        <div class="profile_pic">
        <img  src="{{ $profilePictureUrl }}" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
            @if(Auth::user()->role == 1)
                <span>Admin</span>
                <h2>{{ Auth::user()->name }}</h2> 
            @elseif(Auth::user()->role == 2) 
                <span>MICT Staff</span>
                <h2>{{ Auth::user()->name }}</h2> 
            @elseif(Auth::user()->role == 3)
                <span>Staff</span>
                <h2>{{ Auth::user()->name }}</h2> 
            @else
                <span>Guest</span>
                <h2>{{ Auth::user()->name }}</h2> 
            @endif
        </div>
    </div>
    <br />
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
                <li><a href="{{ route('admin.home') }}"><i class="fa fa-home"></i> Dashboard </a>
                </li>
                <li><a><i class="fa fa-book"></i> Tickets <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('create.ticket') }}">Request Ticket</a></li>
                        @if(Auth::user()->role == 1)
                        <li><a href="{{ route('tickets') }}">All Tickets</a></li>
                        @else
                        <li><a href="{{ route('tickets') }}">My Tickets</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
        <div class="menu_section">
            <h3>ADMINISTRATION</h3>
            <ul class="nav side-menu">
                @if(Auth::user()->role == 1)
                <li><a href="{{ route('users') }}"><i class="fa fa-users"></i> Users </a></li>
                <li><a href="{{ route('tickets.unassigned') }}"><i class="fa fa-times"></i> Unassigned Tickets </a></li>
                @else 
                    <li><a href="{{ route('tickets.unassigned') }}"><i class="fa fa-times"></i> My Unassigned Tickets </a></li>
                
                @endif
                <li><a href="{{ route('tickets.assigned') }}"><i class="fa fa-check-square-o"></i> Assigned Tickets to Me </a></li>
                <li><a><i class="fa fa-flag"></i> Priorities <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('priority-level.high') }}">High</a></li>
                        <li><a href="{{ route('priority-level.mid') }}">Mid</a></li>
                        <li><a href="{{ route('priority-level.low') }}">Low</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-tasks"></i> Statuses <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('status.open') }}">Open</a></li>
                        <li><a href="{{ route('status.in-progress') }}">In Progress</a></li>
                        <li><a href="{{ route('status.closed') }}">Closed</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('activity-log') }}"><i class="fa fa-folder-open"></i> Activity Logs </a></li>
                <li><a href="{{ route('faqs') }}"><i class="fa fa-question-circle"></i> F.A.Qs </a></li>
                <li><a href="#"><i class="fa fa-cogs"></i> Settings</a></li>
            </ul>
        </div>
    </div>
</div>
    <!-- <div class="sidebar-footer hidden-small">
        <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
    </div> -->
</div>
</div>
    