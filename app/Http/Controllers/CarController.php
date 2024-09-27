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

    public function edit(string $id): View
    {
        $car = Car::findOrFail($id);
        return view('cars.edit', compact('car'));
    }

    public function store(Request $request): RedirectResponse
    {
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
        $imageFields = ['front_view_image', 'back_view_image', 'left_view_image', 'right_view_image', 'interior_view_image'];

        // Simpan gambar baru
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $validatedData[$field] = $request->file($field)->store('cars', 'public');
            }
        }

        // Buat data mobil baru
        Car::create($validatedData);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('cars.index')->with('success', 'Mobil berhasil disimpan.');
    }

    public function update(Request $request, Car $car)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'price' => 'required|numeric',
            'status' => 'required|string',
            'description' => 'nullable|string',
            'front_view_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'back_view_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'left_view_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'right_view_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'interior_view_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jika ada gambar baru yang diupload, hapus gambar lama dan simpan yang baru
        if ($request->hasFile('front_view_image')) {
            // Hapus gambar lama jika ada
            if ($car->front_view_image) {
                Storage::delete('public/' . $car->front_view_image);
            }
            // Simpan gambar baru
            $validatedData['front_view_image'] = $request->file('front_view_image')->store('cars', 'public');
        }

        if ($request->hasFile('back_view_image')) {
            if ($car->back_view_image) {
                Storage::delete('public/' . $car->back_view_image);
            }
            $validatedData['back_view_image'] = $request->file('back_view_image')->store('cars', 'public');
        }

        if ($request->hasFile('left_view_image')) {
            if ($car->left_view_image) {
                Storage::delete('public/' . $car->left_view_image);
            }
            $validatedData['left_view_image'] = $request->file('left_view_image')->store('cars', 'public');
        }

        if ($request->hasFile('right_view_image')) {
            if ($car->right_view_image) {
                Storage::delete('public/' . $car->right_view_image);
            }
            $validatedData['right_view_image'] = $request->file('right_view_image')->store('cars', 'public');
        }

        if ($request->hasFile('interior_view_image')) {
            if ($car->interior_view_image) {
                Storage::delete('public/' . $car->interior_view_image);
            }
            $validatedData['interior_view_image'] = $request->file('interior_view_image')->store('cars', 'public');
        }

        // Update data mobil di database
        $car->update($validatedData);

        return redirect()->route('cars.index')->with('success', 'Data mobil berhasil diupdate.');
    }

    public function destroy(Car $car): RedirectResponse
    {
        // Hapus semua gambar yang terkait dengan mobil
        $imageFields = ['front_view_image', 'back_view_image', 'left_view_image', 'right_view_image', 'interior_view_image'];

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
