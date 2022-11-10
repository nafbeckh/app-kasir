<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Penjualan_detail;
use App\Models\Terlaris;
use App\Models\Produk;
use App\Models\Setting;
use App\Models\User;
use App\Models\Meja;
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
            return DataTables::of(Penjualan::where('status', '=', 'Sudah Bayar')->with('meja', 'kasir')->get())->toJson();
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
        return view('penjualan.create', compact(['user', 'toko']))->with('title', 'Pembayaran Transaksi');
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
        // $penjualan = Penjualan::latest()->first() ?? new Penjualan();
        // $penjualan = Penjualan::create([
        //     'meja_id'       => $request->input('meja_id'),
        //     'waiters_id'    => Auth::id(),
        //     'total_item'    => $request->input('total_item'),
        //     'total_harga'   => $request->input('total_harga'),
        //     'bayar'         => $request->input('bayar'),
        //     'diterima'      => $request->input('diterima'),
        // ]);

        // if ($penjualan) {
        //     foreach ($request->input('produk') as $p) {
        //         $penjualandt = Penjualan_detail::create([
        //             'penjualan_id' => $penjualan->id,
        //             'produk_id'    => $p[0],
        //             'harga_jual'   => $p[1],
        //             'jumlah'       => $p[2],
        //             'subtotal'     => $p[3],
        //         ]);
        //         // $produk = Produk::find($p[0]);
        //         // $produk->stok -= $p[4];
        //         // $produk->update();
        //     }
        //     return response()->json(['status' => true, 'message' => 'Success Insert Data']);
        // } else {
        //     return response()->json(['status' => false, 'message' => 'Failed Insert Data']);
        // }
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
            $penjualan =  Penjualan::with('meja', 'penjualan_detail.produk')->find($penjualan->id);
            return response()->json(['status' => true, 'message' => '', 'data' => $penjualan]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $kasir_id = Auth::id();
            $penjualan = Penjualan::findOrFail($id);
            $penjualan->update([
                'kasir_id'         => $kasir_id,
                'bayar'            => $request->bayar,
                'diterima'         => $request->diterima,
                'status'           => 'Sudah Bayar'
            ]);

            $meja = Meja::where(['id' => $penjualan->meja_id, 'penjualan_aktif' => $id]);
            $meja->update([
                'penjualan_aktif'  => 0,
                'status'           => 'Meja Kosong'
            ]);

            $penjualandt = Penjualan_detail::select('produk_id', 'jumlah')->where(['penjualan_id' => $id])->get();
            foreach ($penjualandt as $item) {
                $terlaris = Terlaris::where(['produk_id' => $item->produk_id, 'tanggal' => date('Y-m-d')]);
                if ($terlaris->count()) {
                    $getJumlah = $terlaris->get('jumlah');
                    $jumlah = $getJumlah[0]->jumlah;
                    $terlaris->update([
                        'jumlah'  => $item->jumlah + $jumlah,
                    ]);
                    
                } else{
                    $terlaris = Terlaris::create([
                        'produk_id' => $item->produk_id,
                        'jumlah'  => $item->jumlah,
                        'tanggal' => date('Y-m-d')
                    ]);
                }
            }
                
            if ($penjualan && $meja && $terlaris) {
                return response()->json(['status' => true, 'message' => 'Transaction Success']);
            } else {
                return response()->json(['status' => false, 'message' => 'Transaction Failed']);
            }
        } else {
            abort(404);
        }
        
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
        $penjualan = Penjualan::where('kasir_id', $id)->with('penjualan_detail', 'kasir', 'meja')->get()->last();
        // return response()->json($penjualan);
        if ($penjualan) {
            return view('penjualan.printSmall', compact(['penjualan', 'user', 'toko']))->with('title', 'Print Penjualan');
        } else {
            abort(404, 'belum ada data');
        }
    }

    public function print($penjualan)
    {
        $id = Auth::id();
        $user = User::find($id);
        $toko = Setting::first();
        $penjualan = Penjualan::where('status', '=', 'Sudah Bayar')->with('penjualan_detail', 'kasir', 'meja')->find($penjualan);
        if ($penjualan) {
            return view('penjualan.printSmall', compact(['penjualan', 'user', 'toko']))->with('title', 'Print Penjualan');
        } else {
            abort(404, 'belum ada transaksi');
        }
    }

    public function transaksi()
    {
        $id = Auth::id();
        $user = User::find($id);
        $toko = Setting::first();
        $meja = Meja::orderByRaw('nama')->get();
        return view('penjualan.transaksi', compact(['user', 'toko', 'meja']))->with('title', 'Transaksi');
    }

    public function pembayaran(Request $request, $id)
    {
        $penjualan = Penjualan::where('status', '=', 'Belum Bayar')->with('meja')->find($id);
        if ($request->ajax()) {
            return DataTables::of(Penjualan_detail::select('produks.nama_prod', 'produks.harga_jual', 'jumlah', 'subtotal')
            ->join('produks', 'produks.id', '=', 'penjualan_details.produk_id')
            ->where('penjualan_details.penjualan_id', $id)->get())->toJson();
        }

        if(!$penjualan) return redirect()->route('penjualan.transaksi');

        $id = Auth::id();
        $user = User::find($id);
        $toko = Setting::first();
        return view('penjualan.pembayaran', compact(['user', 'toko', 'penjualan']))->with('title', 'Pembayaran Transaksi '.$penjualan->meja->nama);
    }
}
