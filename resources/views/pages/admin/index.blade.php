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

            <div class="title d-flex align-items-center justify-content-between mb-4 mt-5">
                <h3 class="text-dark fw-semibold">Banner</h3>
                <a href="#" data-bs-toggle="modal" data-bs-target="#tambah-banner-modal" class="d-flex align-items-center gap-1 text-light bg-primary py-2 px-3 rounded-3">
                    <i class='bx bx-plus fs-5'></i>
                    <span>Tambah Banner</span>
                </a>
            </div>

            <!-- Banner -->
            <div class="banner mb-4">
                <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" space-between="15" loop="true" autoplay-delay="3500" autoplay-disable-on-interaction="false">
                    @forelse ($banners as $item)
                        <swiper-slide>
                            <img src="{{ asset('storage/banners/'.$item->image) }}" class="card-img" style="border-radius: 5px;" loading="lazy" alt="banner">
                            <div class="actions">
                                <button type="button" class="btn edit-banner-btn text-light" onclick="editBanner('{{ $item->id }}', '{{ $item->image }}')" data-bs-toggle="modal" data-bs-target="#edit-banner-modal">Edit</button>
        
                                <form id="delete-banner-form-{{ $item->id }}" action="{{ route('admin.banner.delete', $item->id) }}" method="post" class="p-0 m-0 d-inline">
                                    @csrf
                                    @method('DELETE')
        
                                    <button type="button" class="btn delete-banner-btn text-danger" onclick="confirmDeleteBanner({{ $item->id }})">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </swiper-slide>
                    @empty
                        <div class="error-message-container d-flex justify-content-center align-items-center py-5 w-100">
                            <h4>Banner tidak ada.</h4>
                        </div>
                    @endforelse
                </swiper-container>
            </div>
            <!-- Banner End -->


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


    <!-- Modal -->
        <!-- Modal Tambah Banner -->
        <div class="modal fade" id="tambah-banner-modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-content">
                        <div class="modal-header mb-0 pb-0 border-0 d-flex align-items-center justify-content-between">
                            <h4 class="modal-title" id="tambah-banner-label">Tambah Banner</h4>
                            <div class="close-btn" data-bs-dismiss="modal" aria-label="Close" style="cursor: pointer;">
                                <i class='bx bx-x fs-2 icon'></i>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="previwe-img banner d-flex justify-content-center mb-3">
                                <img src="{{ url('assets/images/banner.png') }}" alt="image preview" id="image-preview">
                            </div>

                            <label for="image">Upload Banner (jpg, jpeg, png, atau webp)</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept=".jpg, .jpeg, .png, .webp" id="image" required>
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="modal-footer border-0">
                            <button type="submit" class="btn btn-primary px-4" id="tambah-banner-btn">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal Tambah Banner -->

        <!-- Modal Edit Banner -->
        <div class="modal fade" id="edit-banner-modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header mb-0 pb-0 border-0 d-flex align-items-center justify-content-between">
                        <h4 class="modal-title" id="edit-banner-label">Edit Banner</h4>
                        <div class="close-btn" data-bs-dismiss="modal" aria-label="Close" style="cursor: pointer;">
                            <i class='bx bx-x fs-2 icon'></i>
                        </div>
                    </div>
                    
                    <form id="edit-banner-form" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')

                        <div class="modal-body position-relative">
                            <div class="previwe-img banner d-flex justify-content-center mb-3">
                                <img src="" alt="image preview" id="edit-banner-preview">
                            </div>
        
                            <label for="edit-banner">Upload Banner (jpg, jpeg, png, atau webp)</label>
                            <input type="file" class="form-control upload-banner" name="image" accept=".jpg, .jpeg, .png, .webp" id="edit-banner">
                        </div>
                        <div class="modal-footer border-0">
                            <button type="submit" id="edit-banner-btn" class="btn btn-primary px-4">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>        
        <!-- Modal Edit Banner End -->
    <!-- Modal End -->
@endsection

@push('scripts')
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Datatables Js -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#bookingOngoingTable').DataTable();
        });
        $('#bookingOngoingTable').DataTable({
            "language": {
                "searchPlaceholder": "Search here..."
            }
        });

        function editBanner(id, banner) {
            var bannerUrl = '{{ asset('storage/banners/') }}' + '/' + banner;

            $('#edit-banner-preview').attr('src', bannerUrl);
            $('#edit-banner-form').attr('action', "{{ route('admin.banner.update', '') }}" + '/' + id);
            $('#edit-banner-modal').modal('show');
        }

        function confirmDeleteBanner(id) {
            Swal.fire({
                icon: 'question',
                title: 'Anda Yakin?',
                text: 'Apakah Anda yakin ingin menghapus banner ini?',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
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
                    document.getElementById('delete-banner-form-' + id).submit();
                }
            });
        }
    </script>
@endpush
