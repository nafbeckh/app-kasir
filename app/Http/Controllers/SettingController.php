<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $toko = Setting::first();
        return view('setting.toko', compact(['user', 'toko']))->with('title', 'Setting Toko');
    }

    public function update(Request $request)
    {
        $setting = Setting::first();
        if ($request->hasFile('foto')) {
            $this->validate($request, [
                'nama'      => 'required|max:25|min:3',
                'alamat'    => 'required',
                'telp'      => 'required',
                'foto'      => 'required|mimes:jpg,jpeg,png|max:10240',
            ]);
        } else {
            $this->validate($request, [
                'nama'      => 'required|max:25|min:3',
                'alamat'    => 'required',
                'telp'      => 'required',
            ]);
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama = 'logo-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            File::delete(public_path('/assets/dist/img/') . $setting->path_logo);
            $file->move(public_path('/assets/dist/img'), $nama);
            $setting->update([
                'nama_toko' => $request->nama,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'path_logo' => $nama,
            ]);
        } else {
            $setting->update([
                'nama_toko' => $request->nama,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
            ]);
        }
        if ($setting) {
            return redirect()->route('setting.toko')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('setting.toko')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function profile()
    {
        $user = Auth::user();
        $toko = Setting::first();
        $penjualan = Penjualan::where('user_id', $user->id)->sum('bayar');
        return view('setting.profile', compact(['user', 'toko', 'penjualan']))->with('title', 'Setting Profile');
    }

    public function profileUpdate(Request $request)
    {
        $user = User::find(Auth::id());
        if ($request->password == '' && $request->foto == '') {
            $this->validate($request, [
                'nama'      => 'required|max:25|min:3',
            ]);
        } elseif ($request->password == '' && $request->foto != '') {
            $this->validate($request, [
                'nama'      => 'required|max:25|min:3',
                'foto'      => 'required|mimes:jpg,jpeg,png|max:10240',
            ]);
        } elseif ($request->password != '' && $request->foto == '') {
            $this->validate($request, [
                'nama'      => 'required|max:25|min:3',
                'password'  => ['required', 'same:password2', Password::min(8)->numbers()],
                'password2' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'nama'      => 'required|max:25|min:3',
                'foto'      => 'required|mimes:jpg,jpeg,png|max:10240',
                'password'  => ['required', 'same:password2', Password::min(8)->numbers()],
                'password2' => 'required',
            ]);
        }

        if ($request->password == '' && $request->foto == '') {
            $user->update([
                'nama'        => $request->nama,
            ]);
        } elseif ($request->password == '' && $request->foto != '') {
            File::delete(public_path('/assets/dist/img/') . $user->foto);
            $file = $request->file('foto');
            $nama = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/assets/dist/img'), $nama);
            $foto = $nama;
            $user->update([
                'nama'        => $request->nama,
                'foto'        => $foto,
            ]);
        } elseif ($request->password != '' && $request->foto == '') {
            $user->update([
                'nama'        => $request->nama,
                'password'    => Hash::make($request->password),
            ]);
        } else {
            File::delete(public_path('/assets/dist/img/') . $user->foto);
            $file = $request->file('foto');
            $nama = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/assets/dist/img'), $nama);
            $foto = $nama;
            $user->update([
                'nama'        => $request->nama,
                'foto'        => $foto,
                'password'    => Hash::make($request->password),
            ]);
        }
        if ($user) {
            return redirect()->route('setting.profile')->with(['success' => 'Berhasil Update Data!']);
        } else {
            return redirect()->route('setting.profile')->with(['success' => 'Gagal Update Data!']);
        }
    }
}
