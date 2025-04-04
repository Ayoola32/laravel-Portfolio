<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <div class="form-inline mr-auto"></div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, Ujang Maman</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                <a href="{{ route('profile.edit') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="features-settings.html" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="#"
                        onclick="event.preventDefault();
                                      this.closest('form').submit();"
                        class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>


            </div>
        </li>
    </ul>
</nav>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item active">
                <a href="{{ route('dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Dropdown</span></a>
                <ul class="dropdown-menu" style="display: none;">
                    <li><a class="nav-link" href="">test</a></li>

                </ul>
            </li>
            <li class="menu-header">Sections</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Hero</span></a>
                <ul class="dropdown-menu" style="display: none;">
                    <li><a class="nav-link" href="{{route('admin.typer-title.index')}}">Typer Title </a></li>
                    <li><a class="nav-link" href="{{route('admin.hero.index')}}">Hero section</a></li>

                </ul>
            </li>

            <li><a class="nav-link" href="{{route('admin.service.index')}}"><i class="far fa-square"></i> <span>Service</span></a></li>

            <li><a class="nav-link" href="{{route('admin.about.index')}}"><i class="far fa-square"></i> <span>About</span></a></li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Portfolio</span></a>
                <ul class="dropdown-menu" style="display: none;">
                    <li><a class="nav-link" href="{{route('admin.portfolio-category.index')}}">Portfolio Category</a></li>
                    <li><a class="nav-link" href="{{route('admin.portfolio-item.index')}}">Portfolio Items</a></li>
                    <li><a class="nav-link" href="{{route('admin.portfolio-settings.index')}}">Portfolio Settings</a></li>

                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Skills</span></a>
                <ul class="dropdown-menu" style="display: none;">
                    <li><a class="nav-link" href="{{route('admin.skills-item.index')}}">Skills Items</a></li>
                    <li><a class="nav-link" href="{{route('admin.skills-settings.index')}}">Skills Settings</a></li>

                </ul>
            </li>
            
            <li><a class="nav-link" href="{{route('admin.experience.index')}}"><i class="far fa-square"></i> <span>Experience</span></a></li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Feedback</span></a>
                <ul class="dropdown-menu" style="display: none;">
                    <li><a class="nav-link" href="{{route('admin.feedback.index')}}">Feedback Item</a></li>
                    <li><a class="nav-link" href="{{route('admin.feedback-settings.index')}}">Feedback Settings</a></li>

                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Blog</span></a>
                <ul class="dropdown-menu" style="display: none;">
                    <li><a class="nav-link" href="{{route('admin.blog.index')}}">Blog Lists</a></li>
                    <li><a class="nav-link" href="{{route('admin.blog-category.index')}}">Blog Category</a></li>
                    <li><a class="nav-link" href="{{route('admin.blog-settings.index')}}">Blog Settings</a></li>

                </ul>
            </li>

            <li><a class="nav-link" href="{{route('admin.contact-settings.index')}}"><i class="far fa-square"></i> <span>Contact Settings</span></a></li>
            
            {{-- <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li> --}}


        </ul>
    </aside>
</div>
