<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Penjualan_detail;
use App\Models\Produk;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
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
            return DataTables::of(Penjualan::with('member', 'user')->get())->toJson();
        }
        return view('penjualan.data', compact(['user', 'toko']))->with('title', 'Data Penjualan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $id = Auth::id();
        $user = User::find($id);
        $toko = Setting::first();
        return view('penjualan.create', compact(['user', 'toko']))->with('title', 'Tambah Penjualan');
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
        $penjualan = Penjualan::latest()->first() ?? new Penjualan();
        $penjualan = Penjualan::create([
            'member_id'     => $request->input('member_id'),
            'user_id'       => Auth::id(),
            'kode_penj'     => 'INV' . tambah_nol_didepan((int)$penjualan->id + 1, 6),
            'total_item'    => $request->input('total_item'),
            'total_harga'   => $request->input('total_harga'),
            'diskon'        => $request->input('diskon'),
            'bayar'         => $request->input('bayar'),
            'diterima'      => $request->input('diterima'),
        ]);

        if ($penjualan) {
            foreach ($request->input('produk') as $p) {
                $penjualandt = Penjualan_detail::create([
                    'penjualan_id' => $penjualan->id,
                    'produk_id'    => $p[0],
                    'harga_jual'   => $p[3],
                    'jumlah'       => $p[4],
                    'diskon'       => $p[5],
                    'subtotal'     => $p[6],
                ]);
                $produk = Produk::find($p[0]);
                $produk->stok -= $p[4];
                $produk->update();
            }
            return response()->json(['status' => true, 'message' => 'Success Insert Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Insert Data']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjualan $penjualan)
    {
        //
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Penjualan $penjualan)
    {
        //
        if ($request->ajax()) {
            $penjualan =  Penjualan::with('member', 'penjualan_detail.produk')->find($penjualan->id);
            return response()->json(['status' => true, 'message' => '', 'data' => $penjualan]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        //
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjualan $penjualan)
    {
        //
        $penjualan = Penjualan::findOrFail($penjualan->id);
        $penjualan->delete();
        if ($penjualan) {
            return response()->json(['status' => true, 'message' => 'Success Delete Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Delete Data']);
        }
    }

    public function destroyBatch(Request $request)
    {
        if ($request->id) {
            foreach ($request->id as $id) {
                $penjualan = Penjualan::findOrFail($id);
                $penjualan->delete();
            }
            return response()->json(['status' => true, 'message' => 'Success Delete Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'No Selected Data']);
        }
    }


    public function penjualanPrintLast(Request $request)
    {
        $id = Auth::id();
        $user = User::find($id);
        $toko = Setting::first();
        $penjualan = Penjualan::where('user_id', $id)->with('penjualan_detail', 'user', 'member')->get()->last();
        // return response()->json($penjualan);
        if ($penjualan) {
            if ($request->area == 'full') {
                return view('penjualan.printFull', compact(['penjualan', 'user', 'toko']))->with('title', 'Print Penjualan');
            } else {
                return view('penjualan.printSmall', compact(['penjualan', 'user', 'toko']))->with('title', 'Print Penjualan');
            }
        } else {
            abort(404, 'belum ada data');
        }
    }

    public function print(Request $request, Penjualan $penjualan)
    {
        $id = Auth::id();
        $user = User::find($id);
        $toko = Setting::first();
        $penjualan = Penjualan::with('penjualan_detail', 'user', 'member')->find($penjualan->id);
        if ($penjualan) {
            if ($request->area == 'full') {
                return view('penjualan.printFull', compact(['penjualan', 'user', 'toko']))->with('title', 'Print Penjualan');
            } else {
                return view('penjualan.printSmall', compact(['penjualan', 'user', 'toko']))->with('title', 'Print Penjualan');
            }
        } else {
            abort(404, 'belum ada data');
        }
    }
}
