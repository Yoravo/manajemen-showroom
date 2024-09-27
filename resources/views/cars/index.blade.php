@extends('template.master')

@section('page-title', 'Data Mobil')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search mobil" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Add mobil-->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_car">
                            Tambah Mobil
                        </button>
                        <!--end::Add mobil-->
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body py-4">

                    {{-- @if($errors->any())
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    @endif --}}
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_cars">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="text-start text-grey fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Nama Mobil</th>
                                <th class="min-w-125px">Brand</th>
                                <th class="min-w-125px">Model</th>
                                <th class="min-w-125px">Tahun</th>
                                <th class="min-w-125px">Harga</th>
                                <th class="min-w-125px">Status</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody class="text-grey-600 fw-semibold">
                            @foreach($cars as $car)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($car->front_view_image)
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <img src="{{ asset('storage/' . $car->front_view_image) }}" alt="Front View" class="img-thumbnail">
                                            </div>
                                        @endif
                                        <div>{{ $car->name }}</div>
                                    </div>
                                </td>
                                <td>{{ $car->brand }}</td>
                                <td>{{ $car->model }}</td>
                                <td>{{ $car->year }}</td>
                                <td>{{ number_format($car->price, 2, ',', '.') }} IDR</td>
                                <td>{{ ucfirst($car->status) }}</td>
                                <td class="text-end">
                                    <form action="{{ route('cars.edit', $car->id) }}" method="GET" style="display:inline;">
                                        <button type="submit" class="btn btn-primary btn-sm">edit</button>
                                    </form>
                                    <form action="{{ route('cars.destroy', $car) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus mobil ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->

                    <!--begin::Pagination-->
                    <div class="d-flex justify-content-end mt-5">
                        {{ $cars->links() }}
                    </div>
                    <!--end::Pagination-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
    </div>
</div>

<!--begin::Modal - Add Car-->
<div class="modal fade" id="kt_modal_add_car" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Mobil Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('cars.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Mobil</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" class="form-control" id="brand" name="brand" required>
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" class="form-control" id="model" name="model" required>
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">Tahun</label>
                        <input type="number" class="form-control" id="year" name="year" min="1900" max="{{ date('Y') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="available">Tersedia</option>
                            <option value="sold">Terjual</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <!-- Gambar Tampak Depan -->
                    <div class="mb-3">
                        <label for="front_view_image" class="form-label">Gambar Tampak Depan</label>
                        <input type="file" class="form-control" id="front_view_image" name="front_view_image" accept="image/*">
                    </div>
                    <!-- Gambar Tampak Belakang -->
                    <div class="mb-3">
                        <label for="back_view_image" class="form-label">Gambar Tampak Belakang</label>
                        <input type="file" class="form-control" id="back_view_image" name="back_view_image" accept="image/*">
                    </div>
                    <!-- Gambar Tampak Samping Kiri -->
                    <div class="mb-3">
                        <label for="left_view_image" class="form-label">Gambar Tampak Samping Kiri</label>
                        <input type="file" class="form-control" id="left_view_image" name="left_view_image" accept="image/*">
                    </div>
                    <!-- Gambar Tampak Samping Kanan -->
                    <div class="mb-3">
                        <label for="right_view_image" class="form-label">Gambar Tampak Samping Kanan</label>
                        <input type="file" class="form-control" id="right_view_image" name="right_view_image" accept="image/*">
                    </div>
                    <!-- Gambar Interior -->
                    <div class="mb-3">
                        <label for="interior_view_image" class="form-label">Gambar Interior</label>
                        <input type="file" class="form-control" id="interior_view_image" name="interior_view_image" accept="image/*">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
<!--end::Modal - Add Car-->

@endsection
