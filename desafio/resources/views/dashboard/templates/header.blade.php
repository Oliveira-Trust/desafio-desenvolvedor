<!-- start: header -->
@php
    $user = auth()->user();
@endphp
<header class="header">
    <div class="logo-container">
        <a href="/dashboard" class="logo">
            <img src="/assets/images/logo-oliveiratrust.png" height="35" alt="JSOFT Admin" />
        </a>
        <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <!-- start: search & user box -->
    <div class="header-right">

        <span class="separator"></span>

        <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
                <figure class="profile-picture">
                    <img src="/assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
                </figure>
                <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com">
                    <span class="name">{{ $user->name }}</span>
                    <span class="role">{{ $user->profile->name }}</span>
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled">
                    <li class="divider"></li>

                    <form id="formLogout" action="/logout" method="post">
                        @csrf
                    </form>

                    <li>
                        <a role="menuitem" tabindex="-1" href="javascript:void(0)" onclick="document.getElementById('formLogout').submit()"><i class="fa fa-power-off"></i> Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end: search & user box -->
</header>
<!-- end: header -->