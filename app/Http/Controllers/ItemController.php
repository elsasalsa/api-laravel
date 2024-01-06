<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // != bisa juga <>
            if ($request->name != "") {
                $data = Item::where('name', 'LIKE', '%' . $request->name . '%')->get();
            } else {
                $data = Item::all();
            }
            return ApiFormatter::success(200, 'Berhasil mengambil semua data', $data);
        } catch (\Throwable $err) {
            return ApiFormatter::error(400, 'Error pengembalian data', $err->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //coba jalanin yg di try, kalo ditry ada bagian yg gagal/err dilempar ke catch
        try {
        // validasi
        $request->validate([
            'name' => 'required|min:3',
            'category' => 'required',
            'price' => 'required',
            'date_entry' => 'required',
        ]);
        //tambah data
        $proses = Item::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'date_entry' => $request->date_entry,
        ]);
        //ambil data terbaru yg baru masuk
        $data = Item::orderBy('created_at', 'DESC')->first();
        return ApiFormatter::success(200, 'Berhasil menambahkan data baru', $data);
    } catch(\Throwable $err) {
        //throwable : mengambil err terkait
        // getCode : mengambil http response status code
        // toString : mengambil http response status code versi string text nya
        // getMessage : mengambil desc error
        return ApiFormatter::error(400, 'Error validasi', $err->getMessage());
    } 
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $data = Item::find($id);
            return ApiFormatter::success(200, 'Berhasil mengambil satu data', $data);
        } catch (\Throwable $err) {
            return ApiFormatter::error(500, 'Error pengambilan data', $err->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
