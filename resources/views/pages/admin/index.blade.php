@extends('layouts.admin')

@push('styles')
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
    <section class="dashboard">
        <div class="container-dashboard">
            <div class="title my-4">
                <h2 class="text-dark fw-semibold">Selamat Datang Kembali, {{ Auth::user()->name }} 👋</h2>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-2 g-md-3" id="row-dashboard">
                <a href="{{ route('cars.index') }}" class="col">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-center justify-content-between p-4">
                            <div class="d-flex gap-2">
                                <i class="bx bxs-car fs-1 text-primary"></i>
                                <div class="card-info d-flex flex-column">
                                    <h4 class="text-dark">{{ $carCount }} Mobil</h4>
                                    <p class="text-secondary fs-7">Jumlah Mobil</p>
                                </div>
                            </div>
                            <i class='bx bx-chevron-right fs-3'></i>
                        </div>
                    </div>
                </a>
                <a href="{{ route('customers.index') }}" class="col">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-center justify-content-between p-4">
                            <div class="d-flex gap-2">
                                <i class='bx bxs-group fs-1 text-primary'></i>
                                <div class="card-info  d-flex flex-column">
                                    <h4 class="text-dark">{{ $customerCount }} Customer</h4>
                                    <p class="text-secondary fs-7">Jumlah Customer</p>
                                </div>
                            </div>
                            <i class='bx bx-chevron-right fs-3'></i>
                        </div>
                    </div>
                </a>
                <a href="#" class="col">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-center justify-content-between p-4">
                            <div class="d-flex gap-2">
                                <i class="bx bx-calendar fs-1 text-primary"></i>
                                <div class="card-info d-flex flex-column">
                                    <h4 class="text-dark">7 Booking</h4>
                                    <p class="text-secondary fs-7">Jumlah Booking</p>
                                </div>
                            </div>
                            <i class='bx bx-chevron-right fs-3'></i>
                        </div>
                    </div>
                </a>
                <a href="#" class="col">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-center justify-content-between p-4">
                            <div class="d-flex gap-2">
                                <i class="bx bx-money-withdraw fs-1 text-primary"></i>
                                <div class="card-info d-flex flex-column">
                                    <h4 class="text-dark">Rp. 10.000.000</h4>
                                    <p class="text-secondary fs-7">Total Pendapatan</p>
                                </div>
                            </div>
                            <i class='bx bx-chevron-right fs-3'></i>
                        </div>
                    </div>
                </a>
            </div>

            <div class="title mt-5 mb-4">
                <h3 class="text-dark fw-semibold">Booking Ongoing</h3>
            </div>
            <div class="card border-0 rounded-3">
                <div class="card-body">
                    <div class="table-responsive pb-5">
                        <table class="table table-striped table-hover" id="bookingOngoingTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="px-auto px-lg-2 text-center">No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Mobil</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="nomor text-center">
                                            <span class="fw-normal">1</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="username-info d-flex justify-content-center align-items-center gap-2" style="width: max-content;">
                                            <div class="profile-image">
                                                <img class="img" src="https://ui-avatars.com/api/?background=random&name=AliSofiyan">
                                            </div>
                                            <span class="fw-normal">Ali Sofiyan</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="car-info">
                                            <span class="fw-normal">Toyota Avanza</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="start-info">
                                            <span class="fw-normal">05 Mei 2024</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="end-info">
                                            <span class="fw-normal">07 Mei 2024</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="status-info d-flex justify-content-center" style="width: 100%;">
                                            <span class="badge bg-primary fw-normal">On Going</span>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="nomor text-center">
                                            <span class="fw-normal">2</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="username d-flex justify-content-start" style="width: max-content;">
                                            <div class="username-info d-flex justify-content-center align-items-center gap-2">
                                                <div class="profile-image">
                                                    <img class="img" src="https://ui-avatars.com/api/?background=random&name=JohnDoe">
                                                </div>
                                                <span class="fw-normal">John Doe</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="car-info">
                                            <span class="fw-normal">Toyota Avanza</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="start-info">
                                            <span class="fw-normal">05 Mei 2024</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="end-info">
                                            <span class="fw-normal">07 Mei 2024</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="status-info d-flex justify-content-center" style="width: 100%;">
                                            <span class="badge bg-primary fw-normal">On Going</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Datatables Js -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#bookingOngoingTable').DataTable();
        });
        $('#bookingOngoingTable').DataTable({
            "language": {
                "searchPlaceholder": "Search here..."
            }
        });
    </script>
@endpush
