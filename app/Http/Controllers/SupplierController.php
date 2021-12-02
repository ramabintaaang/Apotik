<?php

namespace App\Http\Controllers;


use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


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
                    $button = '<div class="btn-group">
                        <button type="button" class="btn btn-primary edit" id=""  value="' . $data->id . '">
                            <i class="fas fa-pen-alt"></i>
                        </button>
                        <button type="button" class="btn btn-danger hapus" id="" value="' . $data->id . '">
                            <i class="fas fa-trash"></i>
                        </button>
                        </div>';
                    // $button = '<button class="btn btn-primary edit" id="' . $data->id . '" name="edit">Edit</button>';
                    // $button .= '<button class="btn btn-danger hapus ml-2" id="' . $data->id . '" name="hapus">Hapus</button>';
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

    public function fetchSupplier()
    {
        $data = Supplier::orderBy('created_at', 'desc')->get();
        return response()->json([
            'message' => 'Data succes fetched',
            'data' => $data,
        ], 200);
    }

    public function addSupplier(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required'],
            'telp' => ['required', 'numeric'],
            'email' => ['required', 'email'],
            'rekening' => ['required', 'numeric'],
            'alamat' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }

        try {
            $data = Supplier::create([
                'nama' => $request->nama,
                'telp' => $request->telp,
                'email' => $request->email,
                'rekening' => $request->rekening,
                'alamat' => $request->alamat,
            ]);
            return response()->json([
                'message' => 'Supplier berhasil ditambah',
                'data' => $data,
            ], 200);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Supplier gagal ditambah' . $e->errorInfo,

            ], 500);
        }
    }

    public function updateSupplier(Request $request, $id)
    {
        $data = Supplier::findOrFail($id);
        // $data = Supplier::where('id', $id)->update([
        //     'nama' => $request->nama,
        //     'telp' => $request->telp,
        //     'email' => $request->email,
        //     'rekening' => $request->rekening,
        //     'alamat' => $request->alamat,
        // ]);

        // return response()->json([
        //     'message' => 'berhasil',
        //     'data' => $data,
        // ]);
        $validator = Validator::make($request->all(), [
            'nama' => ['required'],
            'telp' => ['required', 'numeric'],
            'email' => ['required', 'email'],
            'rekening' => ['required', 'numeric'],
            'alamat' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }

        try {
            $data->update([
                'nama' => $request->nama,
                'telp' => $request->telp,
                'email' => $request->email,
                'rekening' => $request->rekening,
                'alamat' => $request->alamat,
            ]);
            return response()->json([
                'message' => 'Supplier berhasil diupdate',
                'data' => $data,
            ], 200);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Supplier gagal ditambah' . $e->errorInfo,

            ], 500);
        }
    }

    public function detailSupplier($id)
    {
        $data = Supplier::findOrFail($id);
        return response()->json([
            'message' => 'detail berhasil didapat',
            'data' => $data,
        ], 200);
    }

    public function deleteSupplier($id)
    {
        $data = Supplier::findOrFail($id);
        try {
            $data->delete();
            return response()->json([
                'message' => 'data berhasil dihapus',
            ], 200);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'failed' . $e->errorInfo
            ]);
        }
    }
}
