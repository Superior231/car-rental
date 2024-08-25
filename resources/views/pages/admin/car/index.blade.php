@extends('layouts.admin')

@push('styles')
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
    <section class="dashboard">
        <div class="container-dashboard">
            <div class="title d-flex align-items-center justify-content-between my-4">
                <h2 class="text-dark fw-semibold">Daftar Mobil</h2>
                <a href="{{ route('cars.create') }}" class="d-flex align-items-center gap-1 text-light bg-primary py-2 px-3 rounded-3">
                    <i class='bx bx-plus fs-5'></i>
                    <span>Tambah Mobil</span>
                </a>
            </div>

            <div class="card border-0 rounded-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="carTable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Gambar</th>
                                    <th>Merek</th>
                                    <th>Model</th>
                                    <th>Warna</th>
                                    <th>Tahun Pembuatan</th>
                                    <th>Plat Nomor</th>
                                    <th>Kapasitas</th>
                                    <th>Harga</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $item)
                                    <tr>
                                        <td class="text-center">
                                            <div class="nomor text-center">
                                                <span class="fw-normal">{{ $loop->iteration }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="car-info" style="width: max-content;">
                                                <div class="car-image">
                                                    <img class="img" src="{{ asset('storage/cars/' . $item->image) }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="brand-info">
                                                <span class="fw-normal">{{ $item->brand }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="model-info">
                                                <span class="fw-normal">
                                                    {{ $item->model }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="color-info">
                                                <span class="fw-normal">
                                                    {{ $item->color }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="production-year-info">
                                                <span class="fw-normal">
                                                    {{ $item->production_year }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="license-plate-info">
                                                <span class="fw-normal">
                                                    {{ $item->license_plate }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="seats-info">
                                                <span class="fw-normal">
                                                    {{ $item->seats }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="price-info">
                                                <span class="fw-normal">
                                                    Rp. {{ number_format($item->price) }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="status-info d-flex justify-content-center align-items-center" style="width: 100%;">
                                                @if ($item->status === 'Available')
                                                    <i class='bx bxs-check-circle text-success fs-2' title="Available"></i>
                                                @else
                                                    <i class='bx bxs-time text-secondary fs-2' title="On Going"></i>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="actions d-flex justify-content-center align-items-center gap-2 w-100">
                                                <a href="{{ route('cars.edit', $item->id) }}" title="Edit">
                                                    <i class='bx bxs-pencil bg-primary'></i>
                                                </a>

                                                <form id="delete-car-form-{{ $item->id }}" action="{{ route('cars.destroy', $item->id) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
        
                                                    <button type="button" class="hapus-btn border-0 outline-0" onclick="confirmDeleteCar({{ $item->id }})" title="Hapus">
                                                        <i class='bx bxs-trash-alt bg-danger'></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
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
            $('#carTable').DataTable();
        });
        $('#carTable').DataTable({
            "language": {
                "searchPlaceholder": "Search cars..."
            }
        });

        function confirmDeleteCar(carId) {
            Swal.fire({
                icon: 'question',
                title: 'Anda Yakin?',
                text: 'Apakah Anda yakin ingin menghapus mobil ini?',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                customClass: {
                    popup: 'sw-popup',
                    title: 'sw-title',
                    htmlContainer: 'sw-text',
                    closeButton: 'sw-close',
                    icon: 'border-primary text-primary',
                    confirmButton: 'bg-danger',
                },
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-car-form-' + carId).submit();
                }
            });
        }
    </script>
@endpush
