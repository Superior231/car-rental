<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $customerCount = User::all()->count();
        $carCount = Car::all()->count();
        $banners = Banner::orderBy('updated_at', 'desc')->get();

        return view('pages.admin.index', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'customerCount' => $customerCount,
            'carCount' => $carCount,
            'banners' => $banners
        ]);
    }

    public function bannerStore(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
        ], [
            'image.required' => 'Harap upload gambar.',
            'image.max' => 'Ukuran gambar terlalu besar. (Max. 10MB)',
            'image.mimes' => 'Upload gambar dengan format jpg, jpeg, png, atau webp',
            'image.image' => 'File yang diupload bukan gambar',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/banners', $fileName);

            $data['image'] = $fileName;
        }
        
        $banner = Banner::create($data);

        if ($banner) {
            return redirect()->route('admin.index')->with('success', 'Banner berhasil dibuat!');
        } else {
            return redirect()->route('admin.index')->with('error', 'Banner gagal dibuat!');
        }
    }

    public function bannerUpdate(Request $request, $id)
    {
        $request->validate([
            'image' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
        ], [
            'image.max' => 'Ukuran gambar terlalu besar. (Max. 10MB)',
            'image.mimes' => 'Upload gambar dengan format jpg, jpeg, png, atau webp',
            'image.image' => 'File yang diupload bukan gambar',
        ]);

        $data = $request->all();
        $banner = Banner::find($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/banners', $fileName);

            if ($banner->image) {
                Storage::delete('public/banners/' . $banner->image);
            }

            $data['image'] = $fileName;
        }

        $banner->update($data);

        if ($banner) {
            return redirect()->route('admin.index')->with('success', 'Banner berhasil diupdate!');
        } else {
            return redirect()->route('admin.index')->with('error', 'Banner gagal diupdate!');
        }
    }

    public function bannerDelete($id)
    {
        $banner = Banner::find($id);

        if ($banner->image) {
            Storage::delete('public/banners/' . $banner->image);
        }

        $banner->delete();

        if ($banner) {
            return redirect()->route('admin.index')->with('success', 'Banner berhasil dihapus!');
        } else {
            return redirect()->route('admin.index')->with('error', 'Banner gagal dihapus!');
        }
    }
}
