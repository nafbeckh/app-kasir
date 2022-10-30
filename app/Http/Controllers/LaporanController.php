<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pengeluaran;
use App\Models\Terlaris;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            if ($request->awal && $request->akhir) {
                $awal = $request->awal;
                $akhir = $request->akhir;
                $data = array();
                $pendapatan = 0;
                $total_pendapatan = 0;

                while (strtotime($awal) <= strtotime($akhir)) {
                    $tanggal = $awal;
                    $awal = date('Y-m-d', strtotime("+1 day", strtotime($awal)));

                    $total_penjualan = Penjualan::where('created_at', 'LIKE', "%$tanggal%")->sum('bayar');
                    $total_pengeluaran = Pengeluaran::where('created_at', 'LIKE', "%$tanggal%")->sum('nominal');

                    $pendapatan = $total_penjualan - $total_pengeluaran;
                    $total_pendapatan += $pendapatan;

                    $row = array();
                    $row['tanggal'] = $tanggal;
                    $row['penjualan'] = $total_penjualan;
                    $row['pengeluaran'] = $total_pengeluaran;
                    $row['pendapatan'] = $pendapatan;
                    $data[] = $row;
                }
                return response()->json(['status' => true, 'message' => '', 'data' => $data]);
            } else {
                return response()->json(['status' => false, 'message' => 'Tanggal Awal dan akhir tidak ada/tidak sesuai', 'data' => '']);
            }
        }
        //  else {
        //     return response()->json('null');
        // }
        $user = Auth::user();
        $toko = Setting::first();
        return view('laporan.pendapatan', compact(['user', 'toko']))->with('title', 'Laporan Pendapatan');
    }

    public function terlaris(Request $request)
    {

        if ($request->ajax()) {
            return DataTables::of(Terlaris::select('produk_id', 'nama_kat', 'nama_prod', DB::raw('SUM(jumlah) as jumlah'))
                    ->groupBy('produk_id')
                    ->orderByDesc('jumlah')->get())->toJson();
        }
      
        $user = Auth::user();
        $toko = Setting::first();
        return view('laporan.terlaris', compact(['user', 'toko']))->with('title', 'Laporan Menu Terlaris');
    }

    public function bulan(Request $request)
    {

        if ($request->awal && $request->akhir) {
            $awal = Carbon::parse($request->awal);
            $akhir = Carbon::parse($request->akhir);
            $tgl = Carbon::now();

            // $penj = Penjualan::whereBetween('created_at', [$awal, $akhir])
            //     ->get();
            //     ->groupBy(function ($date) {
            //         return Carbon::parse($date->created_at)->format('m');
            //     });
            $penj =  Penjualan::whereBetween(DB::raw('DATE(created_at)'), array($awal, $akhir))->get();
        }

        // echo"<pre>";
        // return response()->json($penj);
        // dd($penj);
        // echo"</pre>";

        return response()->json($tgl);
        //
        // if ($request->ajax()) {
        // if ($request->awal && $request->akhir) {
        //     $awal = $request->awal;
        //     $akhir = $request->akhir;
        //     $data = array();
        //     $pendapatan = 0;
        //     $total_pendapatan = 0;

        //     while (strtotime($awal) <= strtotime($akhir)) {
        //         $bulan = $awal;
        //         $awal = date('Y-m-d', strtotime("+30 day", strtotime($awal)));

        //         $total_penjualan = Penjualan::where('created_at', 'LIKE', "%$bulan%")->sum('bayar');
        //         $total_pembelian = Pembelian::where('created_at', 'LIKE', "%$bulan%")->sum('bayar');
        //         $total_pengeluaran = Pengeluaran::where('created_at', 'LIKE', "%$bulan%")->sum('nominal');

        //         $pendapatan = $total_penjualan - $total_pembelian - $total_pengeluaran;
        //         $total_pendapatan += $pendapatan;

        //         $row = array();
        //         $row['bulan'] = $bulan;
        //         $row['penjualan'] = $total_penjualan;
        //         $row['pembelian'] = $total_pembelian;
        //         $row['pengeluaran'] = $total_pengeluaran;
        //         $row['pendapatan'] = $pendapatan;
        //         $data[] = $row;
        //     }
        //     return response()->json(['status' => true, 'message' => '', 'data' => $data]);
        // } else {
        //     return response()->json(['status' => false, 'message' => 'Tanggal Awal dan akhir tidak ada/tidak sesuai', 'data' => '']);
        // }
        // }
    }

    public function penjualanKasir(Request $request)
    {
        $id = Auth::id();
        if ($request->ajax()) {
            if ($request->awal && $request->akhir) {
                $kasir = $id;
                $awal = $request->awal;
                $akhir = $request->akhir;
                $data = array();

                while (strtotime($awal) <= strtotime($akhir)) {
                    $tanggal = $awal;
                    $awal = date('Y-m-d', strtotime("+1 day", strtotime($awal)));

                    $total_penjualan = Penjualan::where('user_id', $kasir)->where('created_at', 'LIKE', "%$tanggal%")->sum('bayar');
                    $total_item = Penjualan::where('user_id', $kasir)->where('created_at', 'LIKE', "%$tanggal%")->sum('total_item');

                    $row = array();
                    $row['tanggal'] = $tanggal;
                    $row['penjualan'] = $total_penjualan;
                    $row['item'] = $total_item;
                    $data[] = $row;
                }
                return response()->json(['status' => true, 'message' => '', 'data' => $data]);
            } else {
                return response()->json(['status' => false, 'message' => 'Tanggal Awal dan akhir tidak ada/tidak sesuai', 'data' => '']);
            }
        }else{
            abort(404);
        }
    }
}
