<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['list','dikonfirmasi_list','dikemas_list','dikirim_list','diterima_list','selesai_list']);
        $this->middleware('api')->only(['store','update','destroy','ubah_status','baru','dikonfirmasi','dikemas','dikirim','diterima','selesai']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=Order::with('member')->get();
        return response()->json([
            'data' => $orders
        ]);
    }

    public function list()
    {
        return view('admin.pesanan.index');
    }

    public function dikonfirmasi_list()
    {
        return view('admin.pesanan.dikonfirmasi');
    }

    public function dikemas_list()
    {
        return view('admin.pesanan.dikemas');
    }

    public function dikirim_list()
    {
        return view('admin.pesanan.dikirim');
    }

    public function diterima_list()
    {
        return view('admin.pesanan.diterima');
    }

    public function selesai_list()
    {
        return view('admin.pesanan.selesai');
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
            'id_member' => 'required',
        ]);
        if($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        
        }
        $input = $request->all();
        $Order = Order::create($input);

        for($i = 0; $i < count($input['id_package']); $i++){
            OrderDetail::create([
                'id_order' => $Order['id'],
                'id_package' => $input['id_package'][$i],
                'jumlah' => $input['jumlah'][$i],
                'total' => $input['total'][$i],
            ]);
        }
        return response() -> json([
            'data' => $Order
        ]);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $Order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $Order)
    {
        return response()->json([
            'data' => $Order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $Order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $Order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $Order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $Order)
    {
        $validator = Validator::make($request->all(), [
            'id_member' => 'required',
            
        ]);
        if($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        
        }
        $input = $request->all();
        $Order = Order::create($input);
        
        $Order->update($input);
        OrderDetail::where('id_order', $Order['id'])->delete();

        for($i = 0; $i < count($input['id_package']); $i++){
            OrderDetail::create([
                'id_order' => $Order['id'],
                'id_package' => $input['id_package'][$i],
                'jumlah' => $input['jumlah'][$i],
                'total' => $input['total'][$i],
            ]);
        }
        return response() -> json([
            'message' => 'success',
            'data' => $Order
        ]);
    }
    public function ubah_status(Request $request,Order $order)
    {
        $order->update([
           'status' => $request->status 
        ]);

        return response() -> json([
            'message' => 'success',
            'data' => $order
        ]);
    }


    public function baru()
    {
        $orders = Order::with('member')->where('status', 'Baru')->get();
        return response()->json([
            'data' => $orders
        ]);
    }
    public function dikonfirmasi()
    {
        $orders = Order::with('member')->where('status', 'Dikonfirmasi')->get();
        return response()->json([
            'data' => $orders
        ]);
    }
    
    public function selesai()
    {
        $orders = Order::with('member')->where('status', 'Selesai')->get();
        return response()->json([
            'data' => $orders
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $Order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $Order)
    {
        
        $Order->delete();
        return response() -> json([
            'message' => 'success'
        ]);
    }

    public function tambahPesanan(Request $request)
    {
        // Validasi data yang diterima dari formulir jika diperlukan
        $validatedData = $request->validate([
            // Definisikan aturan validasi di sini sesuai kebutuhan
        ]);

        // Buat pesanan baru menggunakan model Order atau model yang sesuai
        $order = new Order();
        $order->id_member = $request->id_member; // Sesuaikan dengan atribut yang sesuai
        $order->invoice = 'GANTI_INI_DENGAN_LOGIKA_GENERATE_INVOICE'; // Anda perlu membuat logika untuk menghasilkan invoice
        $order->grand_total = $request->cart_total;
        $order->status = 'Baru'; // Atur status pesanan sesuai kebutuhan
        $order->save();

        // Jika Anda memiliki detail pesanan, tambahkan detail pesanan di sini
        // Contoh: foreach untuk setiap produk dalam pesanan dan simpan detailnya

        // Berikan respon JSON yang sesuai sebagai tanggapan ke klien
        return response()->json(['message' => 'Pesanan berhasil ditambahkan', 'data' => $order], 201);
    }
}
