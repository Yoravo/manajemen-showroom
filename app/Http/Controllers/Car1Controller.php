<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;


class CarController extends Controller
{
    public function index(): View
    {
        $cars = Car::latest()->paginate(10);
        return view('cars.index', compact('cars'));
    }

    public function create(): View
    {
        return view('cars.create');
    }

    public function show(Car $car): View
    {
        $cars = Car::latest()->paginate(10);
        return view('cars.show', compact('cars'));
    }


    public function edit(Car $car): View
    {
        return view('cars.edit', compact('car'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|digits:4',
            'price' => 'required|numeric',
            'status' => 'required|in:available,sold,pending',
            'description' => 'nullable|string',
            'front_view_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'back_view_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'left_view_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'right_view_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'interior_view_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Inisialisasi array untuk menyimpan path gambar
        $imagePaths = [];

        // Daftar kolom gambar
        $imageFields = [
            'front_view_image',
            'back_view_image',
            'left_view_image',
            'right_view_image',
            'interior_view_image'
        ];

        // Simpan gambar dan simpan path-nya
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $imagePaths[$field] = $request->file($field)->store('cars', 'public');
            }
        }

        // Gabungkan data yang divalidasi dengan path gambar
        $carData = array_merge($validatedData, $imagePaths);

        // Buat mobil baru
        Car::create($carData);

        // Redirect dengan pesan sukses
        return redirect()->route('cars.index')->with('success', 'Mobil berhasil ditambahkan.');
    }

    public function update(Request $request, Car $car): RedirectResponse
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|digits:4',
            'price' => 'required|numeric|max:99999999999.99',
            'status' => 'required|in:available,sold,pending',
            'description' => 'nullable|string',
            'front_view_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'back_view_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'left_view_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'right_view_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'interior_view_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Daftar kolom gambar
        $imageFields = [
            'front_view_image',
            'back_view_image',
            'left_view_image',
            'right_view_image',
            'interior_view_image'
        ];

        // Simpan gambar baru dan hapus gambar lama jika ada
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // Hapus gambar lama jika ada
                if ($car->$field && Storage::disk('public')->exists($car->$field)) {
                    Storage::disk('public')->delete($car->$field);
                }

                // Simpan gambar baru
                $car->$field = $request->file($field)->store('cars', 'public');
            }
        }

        // Perbarui data mobil
        $car->update($validatedData);

        // Simpan perubahan
        $car->save();

        // Redirect dengan pesan sukses
        return redirect()->route('cars.index')->with('success', 'Mobil berhasil diupdate.');
    }


    public function destroy(Car $car): RedirectResponse
    {
        // Hapus semua gambar yang terkait dengan mobil
        $imageFields = [    
            'front_view_image',
            'back_view_image',
            'left_view_image',
            'right_view_image',
            'interior_view_image'
        ];

        foreach ($imageFields as $field) {
            if ($car->$field && Storage::disk('public')->exists($car->$field)) {
                Storage::disk('public')->delete($car->$field);
            }
        }

        // Hapus mobil dari database
        $car->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('cars.index')->with('success', 'Mobil berhasil dihapus.');
    }

}
