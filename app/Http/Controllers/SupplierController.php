<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
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
            return DataTables::of(Supplier::query())->toJson();
        }

        return view('supplier.data', compact(['user', 'toko']))->with('title', 'Data Supplier');
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
            'nama'    => 'required|max:50|min:2|unique:suppliers,nama',
            'alamat'  => 'required',
            'telp'    => 'required',
        ]);
        $supplier = Supplier::create([
            'nama'            => $request->nama,
            'alamat'          => $request->alamat,
            'telp'            => $request->telp,
        ]);
        if ($supplier) {
            return response()->json(['status' => true, 'message' => 'Success Insert Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Insert Data']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Supplier $supplier)
    {
        //
        if ($request->ajax()) {
            $supplier = Supplier::find($supplier->id);
            return response()->json(['status' => true, 'message' => '', 'data' => $supplier]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
        $this->validate($request, [
            'nama'      => 'required|max:50|min:2|unique:suppliers,nama,' . $supplier->id,
            'alamat'  => 'required',
            'telp'    => 'required',
        ]);
        $supplier = Supplier::findOrFail($supplier->id);
        $supplier->update([
            'nama'            => $request->nama,
            'alamat'          => $request->alamat,
            'telp'            => $request->telp,
        ]);

        if ($supplier) {
            return response()->json(['status' => true, 'message' => 'Success Insert Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Insert Data']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
        $supplier = Supplier::findOrFail($supplier->id);
        $supplier->delete();

        if ($supplier) {
            return response()->json(['status' => true, 'message' => 'Success Delete Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Delete Data']);
        }
    }

    public function destroyBatch(Request $request)
    {
        if ($request->id) {
            foreach ($request->id as $id) {
                $supplier = Supplier::findOrFail($id);
                $supplier->delete();
            }
            return response()->json(['status' => true, 'message' => 'Success Delete Data']);
        } else {
            return response()->json(['status' => false, 'message' => 'No Selected Data']);
        }
    }
}
