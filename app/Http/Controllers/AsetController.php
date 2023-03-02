<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsetController extends Controller
{
    public function index()
    {
        $datas = Aset::get();

        return view('aset.index', compact('datas'));
    }

    public function select(Request $request)
    {
        $search = $request->name;

        $data = [];

        $data = Aset::Where('name', 'LIKE', "%$search%")
            ->get();

        return response()->json([
            'items'         => $data,
            'total_count'   => $data->count()
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        $trans = Aset::create([
            "name" => $request->name
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
            'url'     => route('aset.index'),
        ], 200);
    }
}
