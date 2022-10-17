<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PengeluaranController extends Controller
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
            return DataTables::of(Pengeluaran::query())->toJson();
        }

        return view('pengeluaran.data', compact(['user', 'toko']))->with('title', 'Data Pengeluaran');
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
            'deskripsi'    => 'required',
            'nominal'  => 'required',
        ]);
        $pengeluaran = Pengeluaran::create([
            'deskripsi'     => $request->deskripsi,
            'nominal'       => $request->nominal,
            'telp'          => $request->telp,
        ]);
        if ($pengeluaran) {
            return response()->json(['status' => true, 'message' => 'Success Insert Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Insert Data']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pengeluaran $pengeluaran)
    {
        //
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,  Pengeluaran $pengeluaran)
    {
        //
        if ($request->ajax()) {
            $pengeluaran = Pengeluaran::find($pengeluaran->id);
            return response()->json(['status' => true, 'message' => '', 'data' => $pengeluaran]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        //
        $this->validate($request, [
            'deskripsi'    => 'required',
            'nominal'  => 'required',
        ]);
        $pengeluaran = Pengeluaran::findOrFail($pengeluaran->id);
        $pengeluaran->update([
            'deskripsi'    => $request->deskripsi,
            'nominal'      => $request->nominal,
        ]);

        if ($pengeluaran) {
            return response()->json(['status' => true, 'message' => 'Success Insert Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Insert Data']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        //
        $pengeluaran = Pengeluaran::findOrFail($pengeluaran->id);
        $pengeluaran->delete();

        if ($pengeluaran) {
            return response()->json(['status' => true, 'message' => 'Success Delete Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Delete Data']);
        }
    }

    public function destroyBatch(Request $request)
    {
        if ($request->id) {
            foreach ($request->id as $id) {
                $pengeluaran = Pengeluaran::findOrFail($id);
                $pengeluaran->delete();
            }
            return response()->json(['status' => true, 'message' => 'Success Delete Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'No Selected Data']);
        }
    }
}
