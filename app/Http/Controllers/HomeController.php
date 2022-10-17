<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Member;
use App\Models\Produk;
use App\Models\Setting;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $toko = Setting::first();
        $kategori = Kategori::count();
        $produk = Produk::count();
        $supplier = Supplier::count();
        $member = Member::count();
        if ($user->hasRole('admin')) {
            return view('dashboard.admin', compact(['user', 'toko', 'kategori', 'produk', 'supplier', 'member']))->with('title', 'Dashboard');
        } else {
            return view('dashboard.kasir', compact(['user', 'toko']))->with('title', 'Dashboard');
        }
    }

    public function indexKasir()
    {
        $id = Auth::id();
        $user = User::find($id);
        $toko = Setting::first();
        return view('dashboard.kasir', compact(['user', 'toko']))->with('title', 'Dashboard');
    }
}
