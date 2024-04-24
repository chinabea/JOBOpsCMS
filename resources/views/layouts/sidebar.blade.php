
@php
    $role = auth()->user()->role;
@endphp

@if($role === 1)

<div class="col-md-3 left_col menu_fixed sidebar-dark">
    <div class="left_col scroll-view sidebar-dark">
    <div class="navbar nav_title sidebar-dark" style="border: 0;">
        <a href="index.html" class="site_title">
        <img src="{{ asset('production/images/MICT-logo.png') }}" style="width: 50px; height: auto;">
        <span>JOBOPS</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
        <div class="profile_pic">
        <img  src="{{ $profilePictureUrl }}" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
            @if(Auth::user()->role == 1)
                <span>Admin,</span>
                <h2>{{ Auth::user()->name }}</h2> 
            @elseif(Auth::user()->role == 2) 
                <span>MICT Staff,</span>
                <h2>{{ Auth::user()->name }}</h2> 
            @elseif(Auth::user()->role == 3)
                <span>Staff,</span>
                <h2>{{ Auth::user()->name }}</h2> 
            @else
                <span>Guest,</span>
                <h2>{{ Auth::user()->name }}</h2> 
            @endif
        </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-home"></i> Dashboard </a>
            </li>
            <li><a href="{{ route('users') }}"><i class="fa fa-users"></i> Users </a></li>
            <li><a><i class="fa fa-book"></i> Tickets <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{ route('tickets') }}">All Tickets</a></li>
                <li><a href="{{ route('status.open') }}">Open</a></li>
                <li><a href="{{ route('status.in-progress') }}">In Progress</a></li>
                <li><a href="{{ route('status.closed') }}">Closed</a></li>
            </ul>
            </li>
            <li><a href="{{ route('faqs') }}"><i class="fa fa-question-circle"></i> F.A.Q </a></li>
        </ul>
    </div>
    </div>
</div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
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
    </div>
    <!-- /menu footer buttons -->
    </div>
</div>
    
@elseif($role === 2)
@elseif($role === 3)

@else
    @include('sidebar-guest')

@endif

