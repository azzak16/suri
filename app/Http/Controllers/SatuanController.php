<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SatuanController extends Controller
{
    public function index()
    {
        $datas = Satuan::get();

        return view('satuan.index', compact('datas'));
    }

    public function select(Request $request)
    {
        $search = $request->name;

        $data = [];

        $data = Satuan::Where('name', 'LIKE', "%$search%")
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
        $trans = Satuan::create([
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
            'url'     => route('satuan.index'),
        ], 200);
    }
}
