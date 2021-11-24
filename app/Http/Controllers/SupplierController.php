<?php

namespace App\Http\Controllers;


use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class SupplierController extends Controller
{

    // public function index()
    // {
    //     $data = Supplier::all();
    //     return response()->json($data);
    // }
    public function index(Request $request)
    {
        // $data = Supplier::orderBy('id', 'desc')->get();
        $data = Supplier::all();
        // return response()->json($data);
        if ($request->ajax()) {
            return Datatables::of($data)
                // ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $button = '<button class="btn btn-primary edit" id="' . $data->id . '" name="edit">Edit</button>';
                    $button .= '<button class="btn btn-danger hapus ml-2" id="' . $data->id . '" name="hapus">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('owner.supplier.main');
    }

    public function store(Request $request)
    {
        dd($request->all());
        $post = Supplier::create($request->all());
        if ($post) {
            return response()->json(['message' => 'data sukses disimpan'], 200);
        } else {
            return response()->json(['message' => 'data gagal disimpan'], 400);
        }
    }

    public function edit(Request $request)
    {
        $data = Supplier::find($request->id);
        return response()->json([
            'message' => 'Berhasil diambil',
            'data' => $data,
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $data = Supplier::find($request->id);
        $post = $data->update($request->all());
        if ($post) {
            return response()->json([
                'Message' => 'berhasil update data',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Gagal update data'
            ], 400);
        }
    }

    public function delete(Request $request)
    {
        $data = Supplier::find($request->id);
        $post = $data->delete($request->all());
        if ($post) {
            return response()->json([
                'Message' => 'berhasil hapus data',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Gagal hapus data'
            ], 400);
        }
    }
}
