<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InventarisController extends Controller
{
    public function index()
    {
        $datas = Inventaris::with('user', 'lokasi', 'satuan', 'aset')->get();

        return view('inventaris.index', compact('datas'));
    }

    public function create()
    {
        $data = Inventaris::orderBy('id', 'desc')->first();

        $no = 1;

        if ($data) {
            $no = $data->no_urut + 1;
        }

        return view('inventaris.create', compact('no'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        $trans = Inventaris::create([
            "no_urut" => $request->no_urut,
            "tgl_opname" => $request->tgl_opname,
            "user_id" => Auth::user()->id,
            "lokasi_id" => $request->lokasi,
            "latitude" => $request->latitude,
            "longitude" => $request->longitude,
            "aset_id" => $request->aset,
            "satuan_id" => $request->satuan,
            "jumlah" => $request->jumlah,
            "tgl_perolehan" => $request->tgl_perolehan,
            "no_dokumen_pembelian" => $request->no_dokumen_pembelian,
            "nilai_perolehan" => $request->nilai_perolehan,
        ]);

        if (!$trans) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message'     => $trans
            ], 400);
        }

        DB::commit();
        return response()->json([
            'status'     => true,
            'message'   => 'mantap',
            'url'     => route('inventaris.index'),
        ], 200);
    }
}
