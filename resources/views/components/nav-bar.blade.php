<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="bell"></i>
                        @if ($totalRequest > 0)
                            <span class="indicator">{{ $totalRequest }}</span>
                        @endif
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">
                        @if ($totalRequest > 0)
                            {{ $totalRequest }} request pending
                        @else
                            Tidak ada request
                        @endif
                    </div>
                    @if ($totalRequest > 0)
                        <div class="list-group">
                            <a href="/dashboard" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-10">
                                        <div class="text-dark">Request pending</div>
                                        <div class="text-muted small mt-1">Terdapat request keluar masuk yang masih
                                            dalam status pending</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @else
                    @endif
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" data-bs-toggle="dropdown">
                    <img src="{{ asset('images/avatar.jpg') }}" class="avatar img-fluid rounded me-1"
                        alt="{{ auth()->user()->nama }}" />
                    <span class="text-dark">{{ auth()->user()->nama }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end mt-2">
                    <form action="/logout" method="post">
                        @csrf
                        <button class="dropdown-item">Log out</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
