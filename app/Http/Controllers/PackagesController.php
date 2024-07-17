<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PackagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['list']);
        $this->middleware('api')->only(['store','update','destroy']);
    }
    public function list()
    {
        $cities = City::all();
        return view('package.index', compact('cities'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Packages = Package::with('city')->get();
        return response()->json([
            'success' => true,
            'data' => $Packages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'id_city' => 'required|integer',
        'nama_package' => 'required|string|max:255',
        'gambar' => 'required|image|mimes:jpg,png,jpeg,webp',
        'deskripsi' => 'required|string',
        'harga' => 'required|integer',
        'diskon' => 'required|integer',
        'available_time_start' => 'required|date',
        'available_time_end' => 'required|date|after:available_time_start'
    ]);

    if ($validator->fails()) {
        return response()->json(
            $validator->errors(),
            422
        );
    }

    $input = $request->all();

    if ($request->has('gambar')) {
        $gambar = $request->file('gambar');
        $nama_gambar = time() . rand(1, 9) . '.' . $gambar->getClientOriginalExtension();
        $gambar->move('uploads', $nama_gambar);
        $input['gambar'] = $nama_gambar;
    }

    $package = Package::create($input);

    return response()->json([
        'success' => true,
        'data' => $package
    ]);
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $Package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $Package)
    {
        return response()->json([
            'success' => true,
            'data' => $Package
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $Package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $Package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $Package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $Package)
    {
    $validator = Validator::make($request->all(), [
        'id_city' => 'required|integer',
        'nama_package' => 'required|string|max:255',
        'gambar' => 'image|mimes:jpg,png,jpeg,webp',
        'deskripsi' => 'required|string',
        'harga' => 'required|integer',
        'diskon' => 'required|integer',
        'available_time_start' => 'required|date',
        'available_time_end' => 'required|date|after:available_time_start',
    ]);

    if ($validator->fails()) {
        return response()->json(
            $validator->errors(),
            422
        );
    }

    $input = $request->all();

    if ($request->has('gambar')) {
        File::delete('uploads/' . $Package->gambar);

        $gambar = $request->file('gambar');
        $nama_gambar = time() . rand(1, 9) . '.' . $gambar->getClientOriginalExtension();
        $gambar->move('uploads', $nama_gambar);
        $input['gambar'] = $nama_gambar;
    } else {
        unset($input['gambar']);
    }

    $Package->update($input);

    return response()->json([
        'success' => true,
        'message' => 'success',
        'data' => $Package
    ]);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $Package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $Package)
    {
        File::delete('uploads/ . $Package->gambar');
        $Package->delete();
        return response() -> json([
            'success' => true,
            'message' => 'success'
        ]);
    }
}
