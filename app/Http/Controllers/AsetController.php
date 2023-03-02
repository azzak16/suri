<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Http\Request;

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
}
