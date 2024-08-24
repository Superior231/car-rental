    <!-- Navbar -->
    <nav class="navbar d-block d-lg-none sticky-top">
        <div class="container-fluid d-flex align-items-center px-3 py-2">
            <a href="{{ route('admin.index') }}" class="logo fs-5">
                <img src="{{ url('assets/images/logo.png') }}" alt="logo">
                <span>Car Rental</span>
            </a>
            <a class="d-lg-none d-flex align-items-center fs-3" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#navMenu">
                <i class="bx bx-menu text-dark"></i>
            </a>
        </div>
    </nav>

    <!-- Sidebar -->
    <nav class="sidebar close d-none d-lg-block">
        <header>
            <div class="image-text">
                <a href="{{ route('admin.index') }}" class="image-text d-flex align-items-center p-3" style="gap: 12px;">
                    <div class="logo fs-5">
                        <img src="{{ url('assets/images/logo.png') }}" alt="logo">
                    </div>
                    <span class="text text-primary fw-bold"> &nbsp; Car Rental</span>
                </a>
            </div>
            <i class='bx bx-chevron-left toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links" style="margin-top: 70px;">
                    <li>
                        <a href="{{ route('admin.index') }}" class="side-link {{ $active === 'dashboard' ? 'active' : '' }}"
                            title="Dashboard">
                            <i class="bx bxs-dashboard icon"></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="side-link {{ $active === 'car list' ? 'active' : '' }}" title="Daftar Mobil">
                            <i class="bx bxs-car icon"></i>
                            <span class="text nav-text">Daftar Mobil</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="side-link {{ $active === 'booking' ? 'active' : '' }}" title="Booking">
                            <i class="bx bxs-calendar icon"></i>
                            <span class="text nav-text">Booking</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="side-link {{ $active === 'history' ? 'active' : '' }}" title="History">
                            <i class="bx bx-history icon"></i>
                            <span class="text nav-text">History</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="side-link {{ $active === 'customer' ? 'active' : '' }}" title="Customer">
                            <i class='bx bxs-group icon'></i>
                            <span class="text nav-text">Customer</span>
                        </a>
                    </li>
                </ul>

                <ul class="menu-links position-absolute bottom-0 w-100">
                    <li>
                        <a href="#" class="side-link" title="Pengaturan">
                            <i class='bx bxs-cog icon'></i>
                            <span class="text nav-text">Pengaturan</span>
                            <i class='bx bx-chevron-right icon text nav-text mx-auto me-0'></i>
                        </a>
                    </li>
                    <li>
                        <a id="logout-confirmaton" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); logout();" title="Keluar">
                            <i class='bx bx-log-out icon'></i>
                            <span class="text nav-text">Keluar</span>
                        </a>
        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="navMenu" aria-labelledby="navMenuLabel">
        <div class="offcanvas-header">
            <a href="{{ route('admin.index') }}" class="image-text d-flex align-items-center gap-1 py-2">
                <div class="logo fs-5">
                    <img src="{{ url('assets/images/logo.png') }}" alt="logo">
                </div>
                <span class="text text-primary fw-bold"> &nbsp; Car Rental</span>
            </a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="offcanvas-sidebar">
                <h5 class="mb-2 text-dark fw-semibold">Utama</h5>
                <a href="dashboard.html" class="link-menu btn {{ $active === 'dashboard' ? 'active' : '' }}">
                    <i class="bx bxs-dashboard"></i> Dashboard
                </a>
                <a href="dashboard-cars.html" class="link-menu btn {{ $active === 'car list' ? 'active' : '' }}">
                    <i class="bx bxs-car"></i> Daftar Mobil
                </a>

                <h5 class="mt-4 mb-2 text-dark fw-semibold">Booking</h5>
                <a href="dashboard-bookings.html" class="link-menu btn {{ $active === 'booking' ? 'active' : '' }}">
                    <i class="bx bxs-calendar"></i> Booking
                </a>
                <a href="dashboard-history.html" class="link-menu btn {{ $active === 'history' ? 'active' : '' }}">
                    <i class="bx bx-history"></i> History
                </a>
                <a href="dashboard-customers.html" class="link-menu btn {{ $active === 'customer' ? 'active' : '' }}">
                    <i class='bx bxs-group'></i> Customer
                </a>

                <h5 class="mt-4 mb-2 text-dark fw-semibold">Other</h5>
                <a href="dashboard-settings.html" class="link-menu btn {{ $active === 'setting' ? 'active' : '' }}">
                    <i class="bx bx-cog"></i> Pengaturan
                </a>
                <a id="logout-confirmaton" class="link-menu btn" href="{{ route('logout') }}"
                onclick="event.preventDefault(); logout();">
                    <i class='bx bx-log-out'></i> Keluar
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>

@push('scripts')
    <script>
        function logout() {
            Swal.fire({
                icon: 'question',
                title: 'Anda Yakin?',
                text: 'Apakah Anda yakin ingin keluar?',
                showCancelButton: true,
                confirmButtonText: 'Keluar',
                customClass: {
                    popup: 'sw-popup',
                    title: 'sw-title',
                    htmlContainer: 'sw-text',
                    icon: 'border-primary text-primary',
                    closeButton: 'bg-secondary border-0 shadow-none',
                    confirmButton: 'bg-danger border-0 shadow-none',
                },
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
@endpush
