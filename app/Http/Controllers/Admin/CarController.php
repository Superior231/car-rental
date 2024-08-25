<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();

        return view('pages.admin.car.index', [
            'title' => 'Daftar Mobil',
            'active' => 'car list',
            'cars' => $cars
        ]);
    }

    public function create()
    {
        return view('pages.admin.car.create', [
            'title' => 'Tambah Mobil',
            'active' => 'car list'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
            'brand' => 'required',
            'model' => 'required',
            'production_year' => 'required|integer',
            'license_plate' => 'required',
            'color' => 'required',
            'seats' => 'required|integer',
            'price' => 'required|integer',
        ], [
            'image.required' => 'Harap upload gambar.',
            'image.max' => 'Ukuran gambar terlalu besar. (Max. 10MB)',
            'image.mimes' => 'Upload gambar dengan format jpg, jpeg, png, atau webp',
            'image.image' => 'File yang diupload bukan gambar',
            'brand.required' => 'Harap isi merk mobil.',
            'model.required' => 'Harap isi model mobil.',
            'production_year.required' => 'Harap isi tahun produksi mobil.',
            'production_year.integer' => 'Tahun produksi harus berupa angka.',
            'license_plate.required' => 'Harap isi plat nomor mobil.',
            'color.required' => 'Harap pilih warna mobil.',
            'seats.required' => 'Harap isi kapasitas mobil.',
            'seats.integer' => 'Kapasitas harus berupa angka.',
            'price.required' => 'Harap isi harga mobil.',
            'price.integer' => 'Harga harus berupa angka.',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/cars', $fileName);

            $data['image'] = $fileName;
        }
        
        $car = Car::create($data);

        if ($car) {
            return redirect()->route('cars.index')->with('success', 'Mobil berhasil dibuat!');
        } else {
            return redirect()->route('cars.index')->with('error', 'Mobil gagal dibuat!');
        }
    }

    public function edit($id)
    {
        $car = Car::find($id);

        return view('pages.admin.car.edit', [
            'title' => 'Edit Mobil',
            'active' => 'car list',
            'car' => $car
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
            'brand' => 'required',
            'model' => 'required',
            'production_year' => 'required|integer',
            'license_plate' => 'required',
            'color' => 'required',
            'seats' => 'required|integer',
            'price' => 'required|integer',
        ], [
            'image.max' => 'Ukuran gambar terlalu besar. (Max. 10MB)',
            'image.mimes' => 'Upload gambar dengan format jpg, jpeg, png, atau webp',
            'image.image' => 'File yang diupload bukan gambar',
            'brand.required' => 'Harap isi merk mobil.',
            'model.required' => 'Harap isi model mobil.',
            'production_year.required' => 'Harap isi tahun produksi mobil.',
            'production_year.integer' => 'Tahun produksi harus berupa angka.',
            'license_plate.required' => 'Harap isi plat nomor mobil.',
            'color.required' => 'Harap pilih warna mobil.',
            'seats.required' => 'Harap isi kapasitas mobil.',
            'seats.integer' => 'Kapasitas harus berupa angka.',
            'price.required' => 'Harap isi harga mobil.',
            'price.integer' => 'Harga harus berupa angka.',
        ]);

        $data = $request->all();
        $car = Car::find($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/cars', $fileName);

            if ($car->image) {
                Storage::delete('public/cars/' . $car->image);
            }

            $data['image'] = $fileName;
        }
        
        $car->update($data);

        if ($car) {
            return redirect()->route('cars.index')->with('success', 'Mobil berhasil diupdate!');
        } else {
            return redirect()->route('cars.index')->with('error', 'Mobil gagal diupdate!');
        }
    }

    public function destroy($id)
    {
        $car = Car::find($id);

        if ($car->image) {
            Storage::delete('public/cars/' . $car->image);
        }

        $car->delete();

        if ($car) {
            return redirect()->route('cars.index')->with('success', 'Mobil berhasil dihapus!');
        } else {
            return redirect()->route('cars.index')->with('error', 'Mobil gagal dihapus!');
        }
    }
}
