@extends('template.master')

@section('page-title', 'Detail Mobil')

@section('content')
    <div class="container my-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @foreach ($cars as $car)
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $car->name }} ({{ $car->year }})</h4>
                        </div>
                        <div class="card-body">
                            <!-- Carousel for Images -->
                            <div id="carCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @if ($car->front_view_image)
                                        <div class="carousel-item active">
                                            <img src="{{ asset('storage/' . $car->front_view_image) }}"
                                                class="d-block w-100" alt="Tampak Depan">
                                        </div>
                                    @endif
                                    @if ($car->back_view_image)
                                        <div class="carousel-item">
                                            <img src="{{ asset('storage/' . $car->back_view_image) }}" class="d-block w-100"
                                                alt="Tampak Belakang">
                                        </div>
                                    @endif
                                    @if ($car->left_view_image)
                                        <div class="carousel-item">
                                            <img src="{{ asset('storage/' . $car->left_view_image) }}" class="d-block w-100"
                                                alt="Tampak Samping Kiri">
                                        </div>
                                    @endif
                                    @if ($car->right_view_image)
                                        <div class="carousel-item">
                                            <img src="{{ asset('storage/' . $car->right_view_image) }}"
                                                class="d-block w-100" alt="Tampak Samping Kanan">
                                        </div>
                                    @endif
                                    @if ($car->interior_view_image)
                                        <div class="carousel-item">
                                            <img src="{{ asset('storage/' . $car->interior_view_image) }}"
                                                class="d-block w-100" alt="Interior">
                                        </div>
                                    @endif
                                </div>
                                <!-- Carousel Controls -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#carCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <!-- Car Details -->
                            <p><strong>Brand:</strong> {{ $car->brand }}</p>
                            <p><strong>Model:</strong> {{ $car->model }}</p>
                            <p><strong>Year:</strong> {{ $car->year }}</p>
                            <p><strong>Price:</strong> {{ number_format($car->price, 2, ',', '.') }} IDR</p>
                            <p><strong>Status:</strong> {{ ucfirst($car->status) }}</p>
                            <p><strong>Description:</strong> {{ $car->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
