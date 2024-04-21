
@php
    $role = auth()->user()->role;
@endphp

@if($role === 1)
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link sidebar-dark-primary">
        <img src="{{ asset('dist/img/MICT-logo.png') }}" alt="JOBOPS CMS Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">JOBOPS CMS</span>
    </a>
    <div class="sidebar">

        <!-- Sidebar Menu -->
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
                        <i class="nav-icon fas fa-book"></i>
                        <p>Tickets</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('faqs') }}"
                        class="nav-link {{ Route::currentRouteName() == 'faqs' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>FAQs</p>
                    </a>
                </li>
                </li>
                <li class="nav-header">SETTINGS</li>
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
    <a href="{{ route('staff.home') }}" class="brand-link sidebar-dark-primary">
        <img src="{{ asset('dist/img/MICT-logo.png') }}" alt="JOBOPS CMS Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">JOBOPS CMS</span>
    </a>
    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('staff.home') }}"
                        class="nav-link {{ Route::currentRouteName() == 'staff.home' ? 'active' : '' }}">
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
                        <i class="nav-icon fas fa-book"></i>
                        <p>Tickets</p>
                    </a>
                </li>
                <li class="nav-header">SETTINGS</li>
                <li class="nav-item">
                    <a id="theme-toggle" class="nav-link">
                        <i class="nav-icon fas fa-adjust"></i>
                        <p>Theme</p>
                    </a>
                </li>
    </div>
</aside>


@elseif($role === 3)
<!-- FOR RESEARCHER -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('researcher.home') }}" class="brand-link sidebar-dark-primary">
        <img src="{{ asset('dist/img/MICT-logo.png') }}" alt="JOBOPS CMS Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">JOBOPS CMS</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-header">MAIN MENU</li>
                <li class="nav-item menu-open">
                <li class="nav-item">
                    <a href="{{ route('researcher.home') }}"
                        class="nav-link {{ Route::currentRouteName() == 'researcher.home' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                </li>
                <li class="nav-header">PROPONENTS</li>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tickets.create') }}"
                        class="nav-link {{ Route::currentRouteName() == 'tickets.create' ? 'active' : '' }}">
                        <i class="far fa-file nav-icon"></i>
                        <p>New Submission</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tickets') }}"
                        class="nav-link {{ Route::currentRouteName() == 'tickets' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Tickets</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('status.draft') }}"
                        class="nav-link {{ Route::currentRouteName() == 'status.draft' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-signature"></i>
                        <p>Draft</p>
                    </a>
                </li>
                <li class="nav-item">
                </li>
                <li class="nav-header">SETTINGS</li>
                <li class="nav-item">
                    <a id="theme-toggle" class="nav-link">
                        <i class="nav-icon fas fa-adjust"></i>
                        <p>Theme</p>
                    </a>
                </li>
    </div>
</aside>


@elseif($role === 4)
<!-- FOR REVIEWER -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('reviewer.home') }}" class="brand-link sidebar-dark-primary">
        <img src="{{ asset('dist/img/MICT-logo.png') }}" alt="JOBOPS CMS Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">JOBOPS CMS</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('reviewer.home') }}"
                    class="nav-link {{ Route::currentRouteName() == 'reviewer.home' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-header">SETTINGS</li>
            <li class="nav-item">
                <a id="theme-toggle" class="nav-link">
                    <i class="nav-icon fas fa-adjust"></i>
                    <p>Theme</p>
                </a>
            </li>
        </ul>
      </nav>
    </div>
</aside>


@else
    @include('sidebar-guest')

@endif

