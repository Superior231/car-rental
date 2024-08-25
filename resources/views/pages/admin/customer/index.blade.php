@extends('layouts.admin')

@push('styles')
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
    <section class="dashboard">
        <div class="container-dashboard">
            <div class="title d-flex align-items-center justify-content-between my-4">
                <h2 class="text-dark fw-semibold">Customers</h2>
                <a href="#" class="d-flex align-items-center gap-1 text-light bg-primary py-2 px-3 rounded-3" data-bs-toggle="modal" data-bs-target="#tambah-user-modal">
                    <i class='bx bx-plus fs-5'></i>
                    <span>Tambah User</span>
                </a>
            </div>

            <div class="card border-0 rounded-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="customerTable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Alamat</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $item)
                                    <tr>
                                        <td class="text-center">
                                            <div class="nomor text-center">
                                                <span class="fw-normal">{{ $loop->iteration }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="username-info d-flex justify-content-center align-items-center gap-2" style="width: max-content;">
                                                <div class="profile-image">
                                                    @if (!empty($item->avatar))
                                                        <img class="img" src="{{ asset('storage/avatars/' . $item->avatar) }}">
                                                    @elseif (!empty($item->avatar_google))
                                                        <img class="img" src="{{ $item->avatar_google }}">
                                                    @else
                                                        <img class="img" src="https://ui-avatars.com/api/?background=random&name={{ urlencode($item->name) }}">
                                                    @endif
                                                </div>
                                                <span class="fw-normal">{{ $item->name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="email-info">
                                                <span class="fw-normal">{{ $item->email }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="phone-info">
                                                <span class="fw-normal">
                                                    {{ $item->phone ? $item->phone : "None" }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="address-info">
                                                <span class="fw-normal">
                                                    {{ $item->address ? $item->address : "None" }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="actions d-flex justify-content-center align-items-center gap-2 w-100">
                                                <a href="#" onclick="editUser('{{ $item->id }}', '{{ $item->avatar }}', '{{ $item->avatar_google }}', '{{ $item->name }}', '{{ $item->email }}', '{{ $item->phone }}', '{{ $item->address }}')" data-bs-toggle="modal" data-bs-target="#edit-user-modal" title="Edit">
                                                    <i class='bx bxs-pencil bg-primary'></i>
                                                </a>

                                                <form id="delete-user-form-{{ $item->id }}" action="{{ route('customers.destroy', $item->id) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
        
                                                    <button type="button" class="hapus-btn border-0 outline-0" onclick="confirmDeleteUser({{ $item->id }})" title="Hapus">
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

    <!-- Modal -->
        <!-- Modal Tambah User -->
        <div class="modal fade" id="tambah-user-modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-0 d-flex align-items-center justify-content-between">
                        <h4 class="modal-title" id="tambah-user-label">Tambah user</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-body">
                            <div class="user-avatar">
                                <div class="avatar">
                                    <img src="{{ url('assets/images/user.jpg') }}" alt="image preview" id="image-preview">
                                </div>
                            </div>

                            <div class="mb-3 mt-4">
                                <label for="image">Upload foto <small>(jpg, jpeg, png, atau webp)</small></label>
                                <input type="file" class="form-control" name="avatar" id="image" accept=".jpg, .jpeg, .png, .webp">
                            </div>
                            <div class="mb-3">
                                <label for="name">Nama lengkap<strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama lengkap" autocomplete="off" value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email<strong class="text-danger">*</strong></label>
                                <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" id="email" placeholder="Masukkan email" autocomplete="off" value="{{ old('email') }}" required>
                            </div>
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="phone">
                                    <label for="phone">Phone number</label>
                                    <input type="number" class="form-control  @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Ex. 628960xxxxxxx" autocomplete="off" value="{{ old('phone') }}">
                                </div>
                                <div class="address">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Masukkan alamat lengkap" autocomplete="off" value="{{ old('address') }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password">password<strong class="text-danger">*</strong></label>
                                <div class="d-flex align-items-center position-relative">
                                    <input type="password" id="password" name="password"
                                        class="form-control"
                                        style="padding-right: 45px;" placeholder="Masukkan password" required>
                                    <div class="showPass d-flex align-items-center justify-content-center position-absolute end-0 h-100"
                                        id="showPass" style="cursor: pointer; width: 50px; border-radius: 0px 10px 10px 0px;"
                                        onclick="showPass()">
                                        <i class="fa-regular fa-eye-slash"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer border-0 mt-0 pt-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit User -->
        <div class="modal fade" id="edit-user-modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header mb-0 pb-0 border-0 d-flex align-items-center justify-content-between">
                        <h4 class="modal-title" id="edit-user-label">Edit User</h4>
                        <div class="close-btn" data-bs-dismiss="modal" aria-label="Close" style="cursor: pointer;">
                            <i class='bx bx-x fs-2 icon'></i>
                        </div>
                    </div>
                    
                    <form id="edit-user-form" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')

                        <div class="modal-body">
                            <figure class="user-avatar">
                                <div class="avatar">
                                    <img id="edit-avatar" class="img img-avatar" src="">
                                </div>
                            </figure>
        
                            <div class="mb-3">
                                <label for="edit-avatar-input">Upload foto (jpg, jpeg, png, atau webp)</label>
                                <input type="file" class="form-control upload-avatar" name="avatar" accept=".jpg, .jpeg, .png, .webp" id="edit-avatar-input">
                            </div>
                            <div class="mb-3">
                                <label for="edit-name">Nama lengkap<strong class="text-danger">*</strong></label>
                                <input type="text" id="edit-name" class="form-control" name="name" placeholder="Masukkan nama lengkap" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-email">Email</label>
                                <input type="email" id="edit-email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukkan email" autocomplete="off" required>
                            </div>

                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="edit-phone">
                                    <label for="edit-phone">Phone number</label>
                                    <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" id="edit-phone" placeholder="Ex. 628960xxxxxxx" autocomplete="off">
                                </div>
                                <div class="edit-address">
                                    <label for="edit-address">Address</label>
                                    <input type="text" class="form-control" name="address" id="edit-address" placeholder="Masukkan alamat lengkap" autocomplete="off">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="edit-password">Ubah password</label>
                                <div class="d-flex align-items-center position-relative">
                                    <input type="password" id="edit-password" name="password"
                                        class="form-control"
                                        style="padding-right: 45px;" placeholder="Masukkan password baru">
                                    <div class="showPass d-flex align-items-center justify-content-center position-absolute end-0 h-100"
                                        id="showPass3" style="cursor: pointer; width: 50px; border-radius: 0px 10px 10px 0px;"
                                        onclick="showPass3()">
                                        <i class="fa-regular fa-eye-slash"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="submit" id="edit-user-btn" class="btn btn-primary px-4">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- Modal End -->
@endsection

@push('scripts')
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Datatables Js -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script src="{{ url('assets/js/auth.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#customerTable').DataTable();
        });
        $('#customerTable').DataTable({
            "language": {
                "searchPlaceholder": "Search customers..."
            }
        });

        function editUser(id, avatar, avatar_google, name, email, phone, address) {
            var avatarUrl = avatar ? '{{ asset('storage/avatars/') }}/' + avatar : 
                    (avatar_google ? avatar_google : "https://ui-avatars.com/api/?background=random&name=" + encodeURIComponent(name));

            $('#edit-avatar').attr('src', avatarUrl);
            $('#edit-avatar-input').val('');
            $('#edit-name').val(name);
            $('#edit-email').val(email);
            $('#edit-phone').val(phone);
            $('#edit-address').val(address);

            $('#edit-user-form').attr('action', "{{ route('customers.update', '') }}" + '/' + id);
            $('#edit-user-modal').modal('show');
        }

        function confirmDeleteUser(userId) {
            Swal.fire({
                icon: 'question',
                title: 'Anda Yakin?',
                text: 'Apakah Anda yakin ingin menghapus user ini?',
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
                    document.getElementById('delete-user-form-' + userId).submit();
                }
            });
        }
    </script>
@endpush
