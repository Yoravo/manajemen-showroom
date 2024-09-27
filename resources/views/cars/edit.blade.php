@extends('template.master')

@section('page-title', 'Edit Mobil')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <h3>Edit Mobil</h3>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <form method="POST" action="{{ route('cars.update', $car->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Mobil</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $car->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $car->brand) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="model" class="form-label">Model</label>
                            <input type="text" class="form-control" id="model" name="model" value="{{ old('model', $car->model) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="year" class="form-label">Tahun</label>
                            <input type="number" class="form-control" id="year" name="year" value="{{ old('year', $car->year) }}" min="1900" max="{{ date('Y') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $car->price) }}" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="available" {{ $car->status == 'available' ? 'selected' : '' }}>Tersedia</option>
                                <option value="sold" {{ $car->status == 'sold' ? 'selected' : '' }}>Terjual</option>
                                <option value="pending" {{ $car->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $car->description) }}</textarea>
                        </div>
                        <!-- Gambar Tampak Depan -->
                        <div class="mb-3">
                            <label for="front_view_image" class="form-label">Gambar Tampak Depan</label>
                            <input type="file" class="form-control" id="front_view_image" name="front_view_image" accept="image/*">
                            @if($car->front_view_image)
                                <img src="{{ asset('storage/' . $car->front_view_image) }}" alt="Front View" class="img-thumbnail mt-2" width="150">
                            @endif
                        </div>
                        <!-- Gambar Tampak Belakang -->
                        <div class="mb-3">
                            <label for="back_view_image" class="form-label">Gambar Tampak Belakang</label>
                            <input type="file" class="form-control" id="back_view_image" name="back_view_image" accept="image/*">
                            @if($car->back_view_image)
                                <img src="{{ asset('storage/' . $car->back_view_image) }}" alt="Back View" class="img-thumbnail mt-2" width="150">
                            @endif
                        </div>
                        <!-- Gambar Tampak Samping Kiri -->
                        <div class="mb-3">
                            <label for="left_view_image" class="form-label">Gambar Tampak Samping Kiri</label>
                            <input type="file" class="form-control" id="left_view_image" name="left_view_image" accept="image/*">
                            @if($car->left_view_image)
                                <img src="{{ asset('storage/' . $car->left_view_image) }}" alt="Left View" class="img-thumbnail mt-2" width="150">
                            @endif
                        </div>
                        <!-- Gambar Tampak Samping Kanan -->
                        <div class="mb-3">
                            <label for="right_view_image" class="form-label">Gambar Tampak Samping Kanan</label>
                            <input type="file" class="form-control" id="right_view_image" name="right_view_image" accept="image/*">
                            @if($car->right_view_image)
                                <img src="{{ asset('storage/' . $car->right_view_image) }}" alt="Right View" class="img-thumbnail mt-2" width="150">
                            @endif
                        </div>
                        <!-- Gambar Interior -->
                        <div class="mb-3">
                            <label for="interior_view_image" class="form-label">Gambar Interior</label>
                            <input type="file" class="form-control" id="interior_view_image" name="interior_view_image" accept="image/*">
                            @if($car->interior_view_image)
                                <img src="{{ asset('storage/' . $car->interior_view_image) }}" alt="Interior View" class="img-thumbnail mt-2" width="150">
                            @endif
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
                <!--end::Card body-->
            </div>
        </div>
    </div>
</div>
@endsection