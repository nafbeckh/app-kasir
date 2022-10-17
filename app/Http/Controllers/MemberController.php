<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Produk;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user = Auth::user();
        $toko = Setting::first();
        if ($request->ajax()) {
            return DataTables::of(Member::query())->toJson();
        }
        if ($user->hasRole('admin')) {
            return view('member.data', compact(['user', 'toko']))->with('title', 'Data Member');
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'nama'    => 'required|max:50|min:2|unique:members,nama',
            'alamat'  => 'required',
            'telp'    => 'required',
        ]);
        $member = Member::latest()->first() ?? new Member();
        $kode = 'M' . tambah_nol_didepan((int)$member->id + 1, 6);
        $member = Member::create([
            'kode_member'     => $kode,
            'nama'            => $request->nama,
            'alamat'          => $request->alamat,
            'telp'            => $request->telp,
        ]);
        if ($member) {
            return response()->json(['status' => true, 'message' => 'Success Insert Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Insert Data']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Member $member)
    {
        //
        if ($request->ajax()) {
            $member = Member::find($member->id);
            return response()->json(['status' => true, 'message' => '', 'data' => $member]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        //
        $this->validate($request, [
            'nama'      => 'required|max:50|min:2|unique:members,nama,' . $member->id,
            'alamat'  => 'required|max:50',
            'telp'    => 'required|max:18',
        ]);
        $member = Member::findOrFail($member->id);
        $member->update([
            'nama'            => $request->nama,
            'alamat'          => $request->alamat,
            'telp'            => $request->telp,
        ]);

        if ($member) {
            return response()->json(['status' => true, 'message' => 'Success Insert Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Insert Data']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
        $member = Member::findOrFail($member->id);
        $member->delete();

        if ($member) {
            return response()->json(['status' => true, 'message' => 'Success Delete Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Delete Data']);
        }
    }

    public function destroyBatch(Request $request)
    {
        if ($request->id) {
            foreach ($request->id as $id) {
                $member = Member::findOrFail($id);
                $member->delete();
            }
            return response()->json(['status' => true, 'message' => 'Success Delete Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'No Selected Data']);
        }
    }
}
