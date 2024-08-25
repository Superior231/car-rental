@extends('layouts.main')

@section('content')
    <section class="banner">
        <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" space-between="15" loop="true"
            autoplay-delay="3500" autoplay-disable-on-interaction="false">
            @forelse ($banners as $item)
                <swiper-slide>
                    <img src="{{ asset('storage/banners/' . $item->image) }}" class="card-img" loading="lazy" alt="banner">
                </swiper-slide>
            @empty
                <div class="error-message-container d-flex justify-content-center align-items-center py-5 w-100">
                    <h4>Banner tidak ada.</h4>
                </div>
            @endforelse
        </swiper-container>
    </section>

    <section class="py-5 bg-white">
        <div class="container px-4 px-lg-5">
            <h3 class="title fw-semibold mb-4">Pilih tanggal booking</h3>
            <form action="#" method="post" class="select-booking d-flex align-items-end flex-column flex-md-row gap-3 w-100">
                <div class="d-flex flex-column flex-md-row gap-3 w-100">
                    <div class="date-start w-100">
                        <label for="from_date">Dari Tanggal</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                            <input type="date" id="from_date" class="form-control">
                        </div>
                    </div>
                    <div class="date-end w-100">
                        <label for="to_date">Sampai Tanggal</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                            <input type="date" id="to_date" class="form-control">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h3 class="fw-semibold mb-3">Katalog</h3>
            <div class="row row-cols-2 row-cols-lg-4 g-3">
                @forelse ($cars as $item)
                    <div class="col">
                        <a href="#" class="card card-product h-100">
                            <div class="car-image px-4 w-100">
                                <img src="{{ asset('storage/cars/' . $item->image) }}" alt="car image">
                            </div>
                            <div class="card-body p-3 p-lg-4">
                                <h5 class="text-dark fw-semibold mb-3">{{ $item->brand . ' ' . $item->model }}</h5>
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="d-flex align-items-center gap-1">
                                            <img src="{{ url('assets/images/seat.png') }}" style="width: 13px;" alt="seat icon">
                                            <span class="fs-7">{{ $item->seats }} seats</span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex align-items-center gap-1">
                                            <img src="{{ url('assets/images/money.png') }}" style="width: 13px;" alt="money icon">
                                            <span class="fs-7">Rp. {{ number_format($item->price) }}/hari</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="error-message-container d-flex justify-content-center align-items-center py-5 w-100">
                        <h4>Tidak ada mobil.</h4>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
@endpush
