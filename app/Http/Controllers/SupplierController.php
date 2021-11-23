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

    // public function getSupplier(Request $request)
    // {
    //     $data = Supplier::all();
    //     if ($request->ajax()) {
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('aksi', function ($data) {
    //                 $button = '<button class="btn btn-primary edit " id="' . $data->id . '" name="edit">Edit</button>';
    //                 $button .= '<button class="btn btn-danger hapus ml-2" id="' . $data->id . '" name="hapus">Hapus</button>';
    //                 return $button;
    //             })
    //             ->rawColumns(['aksi'])
    //             ->make(true);
    //     }
    //     return view('owner.v_supplierhome');
    // }
    public function store(Request $request)
    {
        $post = Supplier::create($request->all());
        if ($post) {
            return response()->json(['message' => 'data sukses disimpan'], 200);
        } else {
            return response()->json(['message' => 'data gagal disimpan'], 400);
        }
    }
}
