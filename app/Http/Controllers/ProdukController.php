<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class ProdukController extends Controller
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
            return DataTables::of(Produk::with('kategori')->get())->toJson();
        }
        if($user->hasRole('admin')){
            return view('produk.data', compact(['user', 'toko']))->with('title', 'Data Produk');
        }else{
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

    public function stokLimit(Request $request)
    {

        if ($request->ajax()) {
            $data = Produk::where('stok', '<', 5)->orderBy('stok')->limit(5)->get();
            return response()->json(['status' => true, 'message' => '', 'data' => $data]);
        } else {
            abort(404);
        }
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
            'nama'          => 'required|max:50|min:2|unique:produks,nama_prod',
            'harga_jual'    => 'required',
            'kategori'      => 'required',
        ]);
        $produk = Produk::latest()->first() ?? new Produk();
        $produk = Produk::create([
            'nama_prod'     => $request->nama,
            'harga_jual'    => $request->harga_jual,
            'ket'           => $request->keterangan,
            'kategori_id'   => $request->kategori,
        ]);
        if ($produk) {
            return response()->json(['status' => true, 'message' => 'Success Insert Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Insert Data']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Produk $produk)
    {
        //
        if ($request->ajax()) {
            $produk = Produk::with('kategori')->find($produk->id);
            return response()->json(['status' => true, 'message' => '', 'data' => $produk]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        //
        $this->validate($request, [
            'nama'      => 'required|max:50|min:2|unique:produks,nama_prod,' . $produk->id,
            'harga_jual'  => 'required',
            'kategori'  => 'required',
        ]);
        $produk = Produk::findOrFail($produk->id);
        $produk->update([
            'nama_prod'     => $request->nama,
            'harga_jual'    => $request->harga_jual,
            'ket'           => $request->keterangan,
            'kategori_id'   => $request->kategori,
        ]);

        if ($produk) {
            return response()->json(['status' => true, 'message' => 'Success Insert Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Insert Data']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        //
        $produk = Produk::findOrFail($produk->id);
        $produk->delete();
        if ($produk) {
            return response()->json(['status' => true, 'message' => 'Success Delete Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Delete Data']);
        }
    }

    public function destroyBatch(Request $request)
    {
        if ($request->id) {
            foreach ($request->id as $id) {
                $produk = Produk::findOrFail($id);
                $produk->delete();
            }
            return response()->json(['status' => true, 'message' => 'Success Delete Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'No Selected Data']);
        }
    }

    public function cetakBarcode(Request $request)
    {
        if ($request->id) {
            $data = [];
            foreach ($request->id as $id) {
                $produk = Produk::find($id);
                $data[] = $produk;
            }
            $no  = 1;
            $pdf = PDF::loadView('produk.barcode', compact('data', 'no'));
            $pdf->setPaper('a4', 'potrait');
            return $pdf->download('produk_' . date('ymdHis') . '.pdf');
            // $no  = 1;
            // return view('produk.barcode', compact('data', 'no'))->with('title', 'Cetak Barcode');
            // return response()->json(['status' => true, 'message' => '', 'data' => $data]);
        } else {
            return response()->json(['status' => false, 'message' => 'No Selected Data']);
        }
    }
}
