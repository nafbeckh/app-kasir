<?php

namespace App\Http\Controllers;

use App\Models\Penjualan_detail;
use App\Models\User;
use App\Models\Setting;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class NotifikasiController extends Controller
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
        $notifikasi = Notifikasi::where('user_id', '=', $user->id)->get();
        
        return view('notifikasi.data', compact(['user', 'toko', 'notifikasi']))->with('title', 'Semua Notifikasi');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notifikasi  $Notifikasi
     * @return \Illuminate\Http\Response
     */
    public function show(Notifikasi $Notifikasi)
    {
        //
        $user = Auth::user();
        $toko = Setting::first();
        $notif = Notifikasi::where([
            'id' => $Notifikasi->id,
            'user_id' => $user->id
        ])->firstOrFail();

        $updateNotif = Notifikasi::where([
            'id' => $notif->id,
        ])->update(['status' => 1]);

        $penjualan_detail = Penjualan_detail::with('produk')->where(['penjualan_id' => $notif->penjualan_id])->get();

        if ($notif) {
            return view('notifikasi.show', compact(['user', 'toko', 'notif', 'penjualan_detail']))->with('title', 'Detail Notifikasi');
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notifikasi  $Notifikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Notifikasi $Notifikasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notifikasi  $Notifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notifikasi $Notifikasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notifikasi  $Notifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notifikasi $Notifikasi)
    {
        //
        $notif = Notifikasi::findOrFail($Notifikasi->id);
        $notif->delete();

        if ($notif) {
            return response()->json(['status' => true, 'message' => 'Success Delete Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Delete Data']);
        }
    }

    public function destroyBatch(Request $request)
    {
        if ($request->id) {
            foreach ($request->id as $id) {
                $notif = Notifikasi::findOrFail($id);
                $notif->delete();
            }
            return response()->json(['status' => true, 'message' => 'Success Delete Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'No Selected Data']);
        }
    }

    public function readBatch(Request $request)
    {
        if ($request->id) {
            foreach ($request->id as $id) {
                $notif = Notifikasi::findOrFail($id);
                $notif->update(['status' => 1]);
            }
            return response()->json(['status' => true, 'message' => 'Data Has Been Read']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed!']);
        }
    }

    public function cekNotif(Request $request)
    {
        $user = Auth::user();
        if ($request->ajax()) {
            $notif = Notifikasi::where(['user_id' => $user->id, 'status' => '0'])->count();
            return $count = $notif ? $notif : '';
        }
    }

    public function fetchNotif(Request $request)
    {
        $user = Auth::user();
        if ($request->ajax()) {
            $notif = Notifikasi::where(['user_id' => $user->id])->orderByDesc('created_at')->limit(3)->get();
            $data = '';
            foreach ($notif as $item) {
                $color = ($item->status) ? 'background:#edeff1': '';
                $data .= '<a href="'.route('notifikasi.show', $item->id).'" class="dropdown-item" style="'.$color.'">
                    <i class="fas fa-shopping-cart mr-2"></i> '.$item->pesan.'
                    <span class="float-right text-muted text-sm">'.timeAgo($item->created_at).'</span>
                </a>
                <div class="dropdown-divider"></div>';
            }

            return $data;
        }
    }
}
