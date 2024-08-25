<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::all();

        return view('pages.admin.customer.index', [
            'title' => 'Customer',
            'active' => 'customer',
            'customers' => $customers
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,webp|max:5048',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
            'name' => 'required',
            'phone' => 'nullable|unique:users',
        ], [
            'avatar.mimes' => 'Upload gambar dengan format jpg, jpeg, png, atau webp',
            'email.unique' => 'Email sudah digunakan.',
            'phone.unique' => 'Nomor telepon sudah digunakan.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/avatars', $fileName);

            $data['avatar'] = $fileName;
        }

        $customer = User::create($data);

        if ($customer) {
            return redirect()->route('customers.index')->with('success', 'User berhasil dibuat!');
        } else {
            return redirect()->route('customers.index')->with('error', 'User gagal dibuat!');
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'phone' => [
                'nullable',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'nullable|min:8',
            'name' => 'required',
        ], [
            'email.unique' => 'Email sudah digunakan.',
            'phone.unique' => 'Nomor telepon sudah digunakan.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        $customer = User::find($id);
        $customer->name = $request->input('name', $customer->name);
        $customer->email = $request->input('email', $customer->email);
        $customer->phone = $request->input('phone', $customer->phone);
        $customer->address = $request->input('address', $customer->address);

        if ($request->input('password')) {
            $customer->password = Hash::make($request->input('password'));
        }

        if ($request->hasFile('avatar')) {
            // Hapus file lama jika ada
            if ($customer->avatar) {
                Storage::disk('public')->delete('avatars/' . $customer->avatar);
            }

            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/avatars', $fileName);

            $customer->avatar = $fileName;
        }

        $customer->save();

        if ($customer) {
            return redirect()->route('customers.index')->with('success', 'User berhasil diedit!');
        } else {
            return redirect()->route('customers.index')->with('error', 'User gagal diedit!');
        }
    }

    public function destroy(string $id)
    {
        $customer = User::find($id);

        if ($customer->avatar) {
            Storage::disk('public')->delete('avatars/' . $customer->avatar);
        }

        $customer->delete();

        if ($customer) {
            return redirect()->route('customers.index')->with('success', 'User berhasil dihapus!');
        } else {
            return redirect()->route('customers.index')->with('error', 'User gagal dihapus!');
        }
    }
}
