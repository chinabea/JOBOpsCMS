
@php
    $role = auth()->user()->role;
@endphp

@if($role === 1)
<div class="col-md-3 left_col">
    <div class="left_col scroll-view sidebar-dark">
    <div class="navbar nav_title sidebar-dark" style="border: 0;">
        <a href="index.html" class="site_title">
        <img src="{{ asset('production/images/MICT-logo.png') }}" style="width: 50px; height: auto;">

            <span>JOBOPS CMS</span>
        </a>
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
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu ">
        <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-home"></i> Dashboard </a>
            <!-- <ul class="nav child_menu">
                <li><a href="index.html">Dashboard</a></li>
                <li><a href="index2.html">Dashboard2</a></li>
                <li><a href="index3.html">Dashboard3</a></li>
            </ul> -->
            </li>
            <li><a href="{{ route('users') }}"><i class="fa fa-users"></i> Users </a></li>
            <li><a><i class="fa fa-book"></i> Tickets <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{ route('tickets') }}">All Tickets</a></li>
                <li><a href="media_gallery.html">Pending</a></li>
                <li><a href="typography.html">Done</a></li>
            </ul>
            </li>
            <li><a href="{{ route('faqs') }}"><i class="fa fa-question-circle"></i> F.A.Q </a></li>
        </ul>
        </div>
    </li>
</ul>
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
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="index.html" class="site_title">
        <img src="{{ asset('production/images/MICT-logo.png') }}" style="width: 50px; height: auto;">

            <span>JOBOPS CMS</span>
        </a>
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
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-home"> Dashboard</i>  <span class="fa fa-chevron-down"></span></a>
            <!-- <ul class="nav child_menu">
                <li><a href="index.html">Dashboard</a></li>
                <li><a href="index2.html">Dashboard2</a></li>
                <li><a href="index3.html">Dashboard3</a></li>
            </ul> -->
            </li>
            <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="form.html">General Form</a></li>
                <li><a href="form_advanced.html">Advanced Components</a></li>
                <li><a href="form_validation.html">Form Validation</a></li>
                <li><a href="form_wizards.html">Form Wizard</a></li>
                <li><a href="form_upload.html">Form Upload</a></li>
                <li><a href="form_buttons.html">Form Buttons</a></li>
            </ul>
            </li>
            <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="general_elements.html">General Elements</a></li>
                <li><a href="media_gallery.html">Media Gallery</a></li>
                <li><a href="typography.html">Typography</a></li>
                <li><a href="icons.html">Icons</a></li>
                <li><a href="glyphicons.html">Glyphicons</a></li>
                <li><a href="widgets.html">Widgets</a></li>
                <li><a href="invoice.html">Invoice</a></li>
                <li><a href="inbox.html">Inbox</a></li>
                <li><a href="calendar.html">Calendar</a></li>
            </ul>
            </li>
            <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="tables.html">Tables</a></li>
                <li><a href="tables_dynamic.html">Table Dynamic</a></li>
            </ul>
            </li>
            <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="chartjs.html">Chart JS</a></li>
                <li><a href="chartjs2.html">Chart JS2</a></li>
                <li><a href="morisjs.html">Moris JS</a></li>
                <li><a href="echarts.html">ECharts</a></li>
                <li><a href="other_charts.html">Other Charts</a></li>
            </ul>
            </li>
            <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                <li><a href="fixed_footer.html">Fixed Footer</a></li>
            </ul>
            </li>
        </ul>
        </div>
        <div class="menu_section">
        <h3>Live On</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="e_commerce.html">E-commerce</a></li>
                <li><a href="projects.html">Projects</a></li>
                <li><a href="project_detail.html">Project Detail</a></li>
                <li><a href="contacts.html">Contacts</a></li>
                <li><a href="profile.html">Profile</a></li>
            </ul>
            </li>
            <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="page_403.html">403 Error</a></li>
                <li><a href="page_404.html">404 Error</a></li>
                <li><a href="page_500.html">500 Error</a></li>
                <li><a href="plain_page.html">Plain Page</a></li>
                <li><a href="login.html">Login Page</a></li>
                <li><a href="pricing_tables.html">Pricing Tables</a></li>
            </ul>
            </li>
            <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="#level1_1">Level One</a>
                <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li class="sub_menu"><a href="level2.html">Level Two</a>
                    </li>
                    <li><a href="#level2_1">Level Two</a>
                    </li>
                    <li><a href="#level2_2">Level Two</a>
                    </li>
                    </ul>
                </li>
                <li><a href="#level1_2">Level One</a>
                </li>
            </ul>
            </li>                  
            <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
        </ul>
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
@elseif($role === 3)
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin.home') }}" class="brand-link sidebar-dark-primary">
        <img src="{{ asset('dist/img/MICT-logo.png') }}" alt="JOBOPS CMS Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">JOBOPS CMS</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('admin.home') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.home' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">MAIN MENU</li>
                <li class="nav-item">
                    <a href="{{ route('users') }}"
                        class="nav-link {{ Route::currentRouteName() == 'users' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users mr-2"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                    <li class="nav-item">
                        <a href="{{ route('tickets') }}"
                            class="nav-link {{ Route::currentRouteName() == 'tickets' ? 'active' : '' }}">
                            <i class="nav-icon far fa-circle"></i>
                            <p>All Tickets</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/forms/general.html" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p>Pending Tickets</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/forms/general.html" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>Done Tickets</p>
                        </a>
                    </li>
                </li>
                <li class="nav-header">OTHERS</li>
                <li class="nav-item">
                    <a href="{{ route('faqs') }}"
                        class="nav-link {{ Route::currentRouteName() == 'faqs' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>FAQs</p>
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

@else
    @include('sidebar-guest')

@endif

