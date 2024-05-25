<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-fw fa-money-bill"></i>
        </div>
        <div class="sidebar-brand-text mx-3">BudgetBuddy</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Tools
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fas fa-fw fa-paperclip"></i>
            <span>Categories</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Expenses</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fas fa-fw fa-flag"></i>
            <span>Set a Goal</span>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>collapsable</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="#">Buttons</a>
                <a class="collapse-item" href="#">Cards</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
