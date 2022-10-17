<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Pembelian_detail;
use App\Models\Produk;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PembelianController extends Controller
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
            return DataTables::of(Pembelian::with('supplier')->get())->toJson();
        }
        return view('pembelian.data', compact(['user', 'toko']))->with('title', 'Data Pembelian');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = Auth::user();
        $toko = Setting::first();
        return view('pembelian.create', compact(['user', 'toko']))->with('title', 'Tambah Pembelian');
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
        $pembelian = Pembelian::latest()->first() ?? new Pembelian();
        $pembelian = Pembelian::create([
            'supplier_id'   => $request->input('supplier_id'),
            'kode_pemb'     => 'PMB' . tambah_nol_didepan((int)$pembelian->id + 1, 6),
            'total_item'    => $request->input('total_item'),
            'total_harga'   => $request->input('total_harga'),
            'diskon'        => $request->input('diskon'),
            'bayar'         => $request->input('bayar'),
        ]);

        if ($pembelian) {
            foreach ($request->input('produk') as $p) {
                $pembeliandt = Pembelian_detail::create([
                    'pembelian_id' => $pembelian->id,
                    'produk_id'    => $p[0],
                    'harga_beli'   => $p[3],
                    'jumlah'       => $p[4],
                    'subtotal'     => $p[5],
                ]);
                $produk = Produk::find($p[0]);
                $produk->stok += $p[4];
                $produk->update();
            }
            return response()->json(['status' => true, 'message' => 'Success Insert Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Insert Data']);
        }
        // return response()->json($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function show(Pembelian $pembelian)
    {
        //
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Pembelian $pembelian)
    {
        //
        if ($request->ajax()) {
            $pembelian =  Pembelian::with('supplier', 'pembelian_detail.produk')->find($pembelian->id);
            return response()->json(['status' => true, 'message' => '', 'data' => $pembelian]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembelian $pembelian)
    {
        //
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembelian $pembelian)
    {
        //
        $pembelian = Pembelian::findOrFail($pembelian->id);
        $pembelian->delete();
        if ($pembelian) {
            return response()->json(['status' => true, 'message' => 'Success Delete Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Delete Data']);
        }
    }

    public function destroyBatch(Request $request)
    {
        if ($request->id) {
            foreach ($request->id as $id) {
                $pembelian = Pembelian::findOrFail($id);
                $pembelian->delete();
            }
            return response()->json(['status' => true, 'message' => 'Success Delete Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'No Selected Data']);
        }
    }
}
