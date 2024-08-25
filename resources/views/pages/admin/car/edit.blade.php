@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.css">
@endpush

@section('content')
    <section class="dashboard">
        <div class="container-dashboard">
            <div class="title d-flex align-items-center gap-2 my-4">
                <a href="{{ route('cars.index') }}" class="text-dark" title="Back">
                    <i class="bx bx-arrow-back fw-bold fs-4 mt-2 mt-md-1"></i>
                </a>
                <h2 class="text-dark fw-semibold">Edit Mobil</h2>
            </div>

            <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-3">
                @csrf @method('PUT')
        
                <div class="card border-0">
                    <div class="card-body">
                        <h4 class="card-title">Assets</h4>
                        <hr class="bg-secondary">
                        <div class="mb-3">
                            <div class="previwe-img d-flex justify-content-center mb-2 bg-soft-blue p-5">
                                <img src="{{ asset('storage/cars/' . $car->image) }}" class="car-image" alt="image preview" id="image-preview" style="width: 120px;">
                            </div>
                            <label for="image">Gambar<strong class="text-danger">*</strong></label>
                            <input type="file" name="image" accept=".jpg, .jpeg, .png, .webp" id="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
        
                <div class="card border-0">
                    <div class="card-body">
                        <h4 class="card-title">Data</h4>
                        <hr class="bg-secondary">
                        <div class="d-flex flex-column flex-lg-row gap-3 mb-3">
                            <div class="brand w-100">
                                <label for="brand">Merek<strong class="text-danger">*</strong></label>
                                <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror" id="brand" placeholder="Masukkan merek mobil" value="{{ $car->brand }}" required>
                                @error('brand')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="model w-100">
                                <label for="model">Model<strong class="text-danger">*</strong></label>
                                <input type="text" name="model" class="form-control @error('model') is-invalid @enderror" id="model" placeholder="Masukkan model mobil" value="{{ $car->model }}" required>
                                @error('model')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-lg-row gap-3 mb-3">
                            <div class="production_year w-100">
                                <label for="production_year">Tahun Pembuatan<strong class="text-danger">*</strong></label>
                                <input type="number" name="production_year" class="form-control @error('production_year') is-invalid @enderror" id="production_year" placeholder="Masukkan tahun pembuatan mobil" value="{{ $car->production_year }}" required>
                                @error('production_year')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="license_plate w-100">
                                <label for="license_plate">Plat Nomor<strong class="text-danger">*</strong></label>
                                <input type="text" name="license_plate" class="form-control @error('license_plate') is-invalid @enderror" id="license_plate" placeholder="Masukkan plat nomor" value="{{ $car->license_plate }}" required>
                                @error('license_plate')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-lg-row gap-3 mb-3">
                            <div class="color w-100">
                                <label for="color">Warna<strong class="text-danger">*</strong></label>
                                <input type="text" name="color" class="form-control @error('color') is-invalid @enderror" id="color" placeholder="Masukkan warna mobil" value="{{ $car->color }}" required>
                                @error('color')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="seats w-100">
                                <label for="seats">Kapasitas Penumpang<strong class="text-danger">*</strong></label>
                                <input type="number" name="seats" class="form-control @error('seats') is-invalid @enderror" id="seats" placeholder="Masukkan kapasitas penumpang" value="{{ $car->seats }}" required>
                                @error('seats')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="price w-100">
                                <label for="price">Harga <small>(per hari)</small><strong class="text-danger">*</strong></label>
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Masukkan harga sewa" value="{{ $car->price }}" required>
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="description">{{ $car->description }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-2">
                    <button class="btn btn-primary" type="submit">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.2/"
            }
        }
    </script>
    <script type="module" src="{{ url('assets/js/ckeditor.js') }}"></script>
@endpush
