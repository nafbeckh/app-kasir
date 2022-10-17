<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
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
            return DataTables::of(Kategori::query())->toJson();
        }
        return view('kategori.data', compact(['user', 'toko']))->with('title', 'Data Kategori');
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
            'nama'      => 'required|max:25|min:2',
        ]);
        $kategori = Kategori::create([
            'nama_kat'     => $request->nama,
        ]);
        if ($kategori) {
            return response()->json(['status' => true, 'message' => 'Success Insert Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Insert Data']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Kategori $kategori)
    {
        //
        if ($request->ajax()) {
            $kategori = Kategori::find($kategori->id);
            return response()->json(['status' => true, 'message' => '', 'data' => $kategori]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
        $this->validate($request, [
            'nama'      => 'required|max:25|min:2|unique:kategoris,nama_kat,' . $kategori->id,
        ]);
        $kategori = Kategori::findOrFail($kategori->id);
        $kategori->update([
            'nama_kat'        => $request->nama,
        ]);
        if ($kategori) {
            return response()->json(['status' => true, 'message' => 'Success Update Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Update Data']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        //
        $kategori = Kategori::findOrFail($kategori->id);
        $kategori->delete();
        if ($kategori) {
            return response()->json(['status' => true, 'message' => 'Success Delete Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Delete Data']);
        }
    }

    public function destroyBatch(Request $request)
    {
        if ($request->id) {
            foreach ($request->id as $id) {
                $kategori = Kategori::findOrFail($id);
                $kategori->delete();
            }
            return response()->json(['status' => true, 'message' => 'Success Delete Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'No Selected Data']);
        }
    }
}
