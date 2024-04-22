
@php
    $role = auth()->user()->role;
@endphp

@if($role === 1)
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
@elseif($role === 2)
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

