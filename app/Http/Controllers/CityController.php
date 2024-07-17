<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['list']);
        $this->middleware('api')->only(['store','update','destroy']);
    }

    public function list()
    {
        return view('admin.city.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $city=City::all();
        return response()->json([
            'data' => $city
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
            'name' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,webp'
        ]);
        if($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }
        $input = $request->all();
        if ($request->has('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . rand(1,9) . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('uploads' , $nama_gambar);
            $input['gambar'] = $nama_gambar;
        }
        $City = City::create($input);
        return response() -> json([
            'success' => 'true',
            'data' => $City
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $City
     * @return \Illuminate\Http\Response
     */
    public function show(City $City)
    {
        return response()->json([
            'data' => $City
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $City
     * @return \Illuminate\Http\Response
     */
    public function edit(City $City)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $City
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $City)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'deskripsi' => 'required',
            
        ]);
        if($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        
        }
        $input = $request->all();
        if ($request->has('gambar')) {
            File::delete('uploads/' . $City->gambar);

            $gambar = $request->file('gambar');
            $nama_gambar = time() . rand(1,9) . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('uploads' , $nama_gambar);
            $input['gambar'] = $nama_gambar;
        }else {
            unset($input['gambar']);
        }
        $City->update($input);
        return response() -> json([
            'success' => true,
            'message' => 'success',
            'data' => $City
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $City
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $City)
    {
        
        File::delete('uploads/ . $City->gambar');
        $City->delete();
        return response() -> json([
            'success' => true,
            'message' => 'success',
        ]);
    }
}
