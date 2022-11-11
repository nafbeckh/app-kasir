<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Penjualan_detail;
use App\Models\Produk;
use App\Models\Notifikasi;
use App\Events\NotificationEvent;
use App\Models\Meja;
use App\Models\Setting;
use App\Models\User;
use Pusher\Pusher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
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
        $meja = Meja::where('status', '=', 'Meja Kosong')->get();
        
        $data = '';

        if ($request->ajax()) {
            $produk = Produk::where('nama_prod', 'LIKE', '%'.$request->search.'%')->get();

            if ($request->kategori != '') {
                $produk = Produk::join('kategoris', 'produks.kategori_id', '=', 'kategoris.id')
                ->where('nama_kat', '=', ''.$request->kategori.'')
                ->where('nama_prod', 'LIKE', '%'.$request->search.'%')
                ->get();
            }

            foreach ($produk as $item) {
                $data .= '<div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                            <div class="info-box-content">
                                <span class="info-box-text"><b>'.$item->nama_prod.'</b></span>
                                <span class="info-box-text">Rp '.format_uang($item->harga_jual).'</span>
                            </div>
                            <button type="button" data-id="'.$item->id.'" data-name="'.$item->nama_prod.'" data-price="'.$item->harga_jual.'" class="btn btn-success btn-xs mr-2" onclick="addToCart(this)" style="height: 32px; margin-top: 18px">Tambah</button>
                            </div>
                        </div>';
            }

            if ($data == '') $data = '<h5 class="col text-center">Data tidak ditemukan.</h5>';

            return $data;
        }

        return view('menu.data', compact(['user', 'toko', 'meja']))->with('title', 'Pemesanan Menu');
       
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
        $penjualan = Penjualan::latest()->first() ?? new Penjualan();
        $penjualan = Penjualan::create([
            'kasir_id'      => 1,
            'meja_id'       => $request->input('meja_id'),
            'waiters_id'    => Auth::id(),
            'total_item'    => $request->input('total_item'),
            'total_harga'   => $request->input('total_harga'),
        ]);

        if ($penjualan) {
            $meja = Meja::where(['id' => $penjualan->meja_id]);
            $meja->update([
                'penjualan_aktif'  => $penjualan->id,
                'status'           => 'Belum Bayar'
            ]);

            foreach ($request->input('produk') as $p) {
                $penjualandt = Penjualan_detail::create([
                    'penjualan_id' => $penjualan->id,
                    'produk_id'    => $p['id'],
                    'jumlah'       => $p['count'],
                    'subtotal'     => $p['price'] * $p['count'],
                ]);
            }

            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                ['cluster' => 'ap1', 'useTLS' => true],
            );
            
            $nama_meja = $meja->get('nama');
            $user = User::where(['is_login' => 1])
                ->whereHas(
                    'roles', function($q){
                        $q->where('name', '!=', 'waiters');
                    }
                )->get();
            $data = [];
            foreach ($user as $item) {
                $notif = Notifikasi::create([
                    'user_id'       => $item->id,
                    'penjualan_id'  => $penjualan->id,
                    'pesan'         => 'Pesanan dari ' .$nama_meja[0]->nama,
                ]);

                $data[] = ['count' => ($this->countNotif($item->id) - 1) + 1, 'for' => $item->id];
            }

            $pusher->trigger('notification', 'NotificationEvent', $data);
            
            return response()->json(['status' => true, 'message' => 'Pemesanan Menu Berhasil']);
        } else {
            return response()->json(['status' => false, 'message' => 'Pemesanan Menu Gagal!']);
        }
    }

    private function countNotif($id)
    {
        $notif = Notifikasi::where(['user_id' => 1, 'status' => '0'])->count();
        return $notif ? $notif : '0';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $Menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $Menu)
    {
        //
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $Menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Menu $Menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $Menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $Menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $Menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $Menu)
    {
        //
    }
}
