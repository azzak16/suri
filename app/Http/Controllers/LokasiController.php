<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $datas = Lokasi::get();

        return view('lokasi.index', compact('datas'));
    }

    public function select(Request $request)
    {
        $search = $request->name;

        $data = [];

        $data = Lokasi::Where('name', 'LIKE', "%$search%")
            ->get();

        return response()->json([
            'items'         => $data,
            'total_count'   => $data->count()
        ]);
    }
}
