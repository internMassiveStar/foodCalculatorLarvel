<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3">RuangAdmin</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    {{--  Waiter  --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('waiter-List') }}" data-target="#collapseBootstrap"
            aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Waiter</span>
        </a>

    </li>

    {{--  Table  --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('table-List') }}" data-target="#collapseBootstrap"
            aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Table</span>
        </a>

    </li>

    {{--  Food  --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ route('food-List') }}">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Food</span>
        </a>
    </li>


  {{--  Food Production  --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#production" aria-expanded="true"
            aria-controls="programinfo">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Food Production Form</span>
        </a>
        <div id="production" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('food-Production') }}">Food Production Add
                </a>
                <a class="collapse-item" href="{{ route('food-Production') }}">Food Production List</a>
               
            </div>
        </div>
    </li>

    {{--  Food Calculator  --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#programinfo" aria-expanded="true"
            aria-controls="programinfo">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Food Calculator Form</span>
        </a>
        <div id="programinfo" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('foodcalulator-List') }}">Food Calculator Add
                </a>
                <a class="collapse-item" href="{{ route('foodorder-List') }}">Food Order List Details</a>
                <a class="collapse-item" href="{{ route('kitchen-List') }}">Kitchen Complete Details</a>
                <a class="collapse-item" href="{{ route('price-List') }}">Price Order List Details</a>
            </div>
        </div>
    </li>





    <hr class="sidebar-divider">

</ul>
