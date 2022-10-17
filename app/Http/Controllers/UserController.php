<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = Auth::user();
        $toko = Setting::first();
        if ($request->ajax()) {
            return DataTables::of(User::with('roles')->get())->toJson();
        }

        return view('user.data', compact(['user', 'toko']))->with('title', 'Data User');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'      => 'required|max:25|min:3',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:5',
            'foto'      => 'required|mimes:jpg,jpeg,png|max:10240',
            'level'     => 'required',
        ]);
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/assets/dist/img'), $nama);
            $foto = $nama;
        }
        $user = User::create([
            'nama'     => $request->nama,
            'email'     => $request->email,
            'password'   => Hash::make($request->password),
            'foto'       => $foto,
        ]);
        $user->assignRole($request->level);
        if ($user) {
            return response()->json(['status' => true, 'message' => 'Success Insert Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Insert Data']);
        }
    }

    public function edit(Request $request, $id)
    {
        if ($request->ajax()) {
            $user = User::with('roles')->find($id);
            return response()->json(['status' => true, 'message' => '', 'data' => $user]);
        } else {
            abort(404);
        }
    }

    public function update(Request $request, User $user)
    {

        if ($request->password == '' && $request->foto == '') {
            $this->validate($request, [
                'nama'      => 'required|max:25|min:3',
                'email'     => 'required|email|unique:users,email,' . $user->id,
                'level'     => 'required',
            ]);
        } elseif ($request->password == '' && $request->foto != '') {
            $this->validate($request, [
                'nama'      => 'required|max:25|min:3',
                'email'     => 'required|email|unique:users,email,' . $user->id,
                'foto'      => 'required|mimes:jpg,jpeg,png|max:10240',
                'level'     => 'required',
            ]);
        } elseif ($request->password != '' && $request->foto == '') {
            $this->validate($request, [
                'nama'      => 'required|max:25|min:3',
                'email'     => 'required|email|unique:users,email,' . $user->id,
                'password'  => ['required', 'same:password2', Password::min(8)->numbers()],
                'password2' => 'required',
                'level'     => 'required',
            ]);
        } else {
            $this->validate($request, [
                'nama'      => 'required|max:25|min:3',
                'email'     => 'required|email|unique:users,email,' . $user->id,
                'foto'      => 'required|mimes:jpg,jpeg,png|max:10240',
                'password'  => ['required', 'same:password2', Password::min(8)->numbers()],
                'password2' => 'required',
                'level'     => 'required',
            ]);
        }

        $user = User::findOrFail($user->id);
        if ($request->password == '' && $request->foto == '') {
            $user->update([
                'nama'        => $request->nama,
                'email'       => $request->email,
            ]);
            $user->syncRoles($request->level);
        } elseif ($request->password == '' && $request->foto != '') {
            File::delete(public_path('/assets/dist/img/') . $user->foto);
            $file = $request->file('foto');
            $nama = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/assets/dist/img'), $nama);
            $foto = $nama;
            $user->update([
                'nama'        => $request->nama,
                'email'       => $request->email,
                'foto'        => $foto,
            ]);
            $user->syncRoles($request->level);
        } elseif ($request->password != '' && $request->foto == '') {
            $user->update([
                'nama'        => $request->nama,
                'email'       => $request->email,
                'password'    => Hash::make($request->password),
            ]);
            $user->syncRoles($request->level);
        } else {
            File::delete(public_path('/assets/dist/img/') . $user->foto);
            $file = $request->file('foto');
            $nama = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/assets/dist/img'), $nama);
            $foto = $nama;
            $user->update([
                'nama'        => $request->nama,
                'email'       => $request->email,
                'foto'        => $foto,
                'password'    => Hash::make($request->password),
            ]);
            $user->syncRoles($request->level);
        }
        if ($user) {
            return response()->json(['status' => true, 'message' => 'Success Update Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Update Data']);
        }
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        File::delete(public_path('/assets/dist/img/') . $user->foto);
        $user->delete();

        if ($user) {
            return response()->json(['status' => true, 'message' => 'Success Delete Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Delete Data']);
        }
    }

    public function destroyBatch(Request $request)
    {
        // return response()->json($request->id);
        if ($request->id) {
            foreach ($request->id as $id) {
                $user = User::findOrFail($id);
                File::delete(public_path('/assets/dist/img/') . $user->foto);
                $user->delete();
            }
            return response()->json(['status' => true, 'message' => 'Success Delete Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'No Selected Data']);
        }
    }
}
