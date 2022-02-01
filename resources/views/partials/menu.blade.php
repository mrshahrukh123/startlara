@php
    $is_users_menu = false;
    $is_general_menu = false;
    if(\Request::is('manage/users*') || \Request::is('manage/permissions*') || \Request::is('manage/roles*')){
        $is_users_menu=true;
    }
    if(\Request::is('general*')){
        $is_general_menu=true;
    }

@endphp
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link {{!$is_users_menu ? 'collapsed' :''}}" href="#" data-toggle="collapse" data-target="#users" aria-expanded="false" aria-controls="users">
                    <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>
                    Manage Users
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ $is_users_menu ? 'show' : ''  }}" id="users" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @can('list-role')
                            <a class="nav-link" href="{{route('manage.roles.index')}}">Roles</a>
                        @endcan
                        @can('list-permission')
                            <a class="nav-link" href="{{route('manage.permissions.index')}}">Permissions</a>
                        @endcan
                        @can('list-user')
                            <a class="nav-link" href="{{route('manage.users.index')}}">All Users</a>
                        @endcan
                    </nav>
                </div>
                <a class="nav-link {{!$is_general_menu ? 'collapsed' :''}}" href="#" data-toggle="collapse" data-target="#general" aria-expanded="false" aria-controls="general">
                    <div class="sb-nav-link-icon"><i class="fas fa-sliders-h"></i></div>
                    General
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>

                </a>
                <div class="collapse {{ $is_general_menu ? 'show' : ''  }}" id="general" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @can('manage-settings')
                            <a class="nav-link" href="{{route('general.settings')}}">Settings</a>
                        @endcan
                        @can('view-logs')
                            <a class="nav-link" href="{{route('general.logs')}}">Logs</a>
                        @endcan
                    </nav>
                </div>
            </div>
        </div>
        @guest
        @else
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                {{ Auth::user()->first_name }}
            </div>
        @endguest
    </nav>
</div>
