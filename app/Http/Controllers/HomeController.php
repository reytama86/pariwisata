<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\City;
use App\Models\About;
use App\Models\Order;
use App\Models\Slider;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use App\Models\Testimoni;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $cities = City::all();
        $testimonies = Testimoni::all();
        $packages = Package::skip(0)->take(8)->get();
        return view('home.index', compact('sliders', 'cities', 'testimonies', 'packages'));
    }

    public function products($id_subcategory)
    {
        $products = Package::where('id_subkategori', $id_subcategory)->get();
        return view('home.products', compact('products'));
    }

    public function search_button()
    {
        return view('home.search');
    }

    public function searchProducts(Request $request)
    {
        $searchTerm = $request->input('search');
        $products = Package::where('nama_barang', 'like', "%$searchTerm%")->get();

        return response()->json(['products' => $products]);
    }

    public function searchPackages(Request $request)
    {
        $searchTerm = $request->input('search');
        $searchDate = $request->input('date');

        // Validasi input
        $validator = Validator::make($request->all(), [
            'search' => 'required|string|max:255',
            'date' => 'required|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Lakukan pencarian
        $packages = DB::table('packages')
            ->where('nama_package', 'like', '%' . $searchTerm . '%')
            ->whereDate('available_time_start', '<=', $searchDate)
            ->whereDate('available_time_end', '>=', $searchDate)
            ->get();

        return response()->json(['packages' => $packages]);
    }



    public function showResults(Request $request)
    {
        $searchTerm = $request->query('search');
        $searchDate = $request->query('date');
        $packages = $this->searchPackages($request)->original['packages'];

        return view('home.results', compact('searchTerm', 'searchDate', 'packages'));
    }

    // public function add_to_cart(Request $request)
    // {
    //     $input = $request->all();
    //     Cart::create($input);
    // }

    public function delete_from_cart(Cart $cart)
    {
        $cart->delete();
        return redirect('/cart');
    }

    public function product($id_product)
    {
        $package = Package::find($id_product);
        $latest_packages = Package::orderByDesc('created_at')->offset(0)->limit(10)->get();
        return view('home.product', compact('product', 'latest_packages'));
    }

    // public function product_search(Request $request)
    // {
    //     // Gunakan $products sesuai kebutuhan dalam pencarian
    //     $productName = $request->input('name');
    //     $searchedProducts = Product::where('name', 'like', "%$productName%")->get();

    //     return response()->json(['products' => $searchedProducts]);
    // }
    // public function showSearchForm()
    // {
    //     return view('home.search'); // Sesuaikan dengan nama file view Anda
    // }
    public function cart()
    {
        if (!Auth::guard('webmember')->user()) {
            return redirect('/login_member');
        }
        $carts = Cart::where('id_member', Auth::guard('webmember')->user()->id)->where('is_checkout', 0)->get();
        $cart_total = Cart::where('id_member', Auth::guard('webmember')->user()->id)->where('is_checkout', 0)->sum('total');
        return view('home.cart', compact('carts', 'cart_total'));
    }

    // public function get_kota($id)
    // {
    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $id,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 30,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "GET",
    //         CURLOPT_HTTPHEADER => array(
    //             "key: 1adb8efa384245ff3bc71d4d2429518a"
    //         ),
    //     ));

    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);

    //     curl_close($curl);

    //     if ($err) {
    //         echo "cURL Error #:" . $err;
    //     } else {
    //         echo $response;
    //     }
    // }

    // public function get_ongkir($destination, $weight)
    // {
    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 30,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "POST",
    //         CURLOPT_POSTFIELDS => "origin=369&destination=" . $destination . "&weight=" . $weight . "&courier=jne",
    //         CURLOPT_HTTPHEADER => array(
    //             "content-type: application/x-www-form-urlencoded",
    //             "key: 1adb8efa384245ff3bc71d4d2429518a"
    //         ),
    //     ));

    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);

    //     curl_close($curl);

    //     if ($err) {
    //         echo "cURL Error #:" . $err;
    //     } else {
    //         echo $response;
    //     }
    // }

    public function add_to_cart(Request $request)
    {
        $input = $request->all();
        Cart::create($input);
    }

    public function package($id_package)
    {
        $package = Package::find($id_package);
        $latest_package = Package::orderByDesc('created_at')->offset(0)->limit(10)->get();
        return view('home.package', compact('package', 'latest_package'));
    }

    public function packages($id_city)
    {
        $packages = Package::where('id_city', $id_city)->get();
        return view('home.packages', compact('packages'));
    }


    public function checkout_orders(Request $request)
    {
        $id = DB::table('orders')->insertGetId([
            'id_member' => $request->id_member,
            'invoice' => date('ymds'),
            'grand_total' => $request->cart_total,
            'status' => 'Baru',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        for ($i = 0; $i < count($request->id_package); $i++) {
            DB::table('orders_details')->insert([
                'id_order' => $id,
                'id_package' => $request->id_package[$i],
                'jumlah' => $request->jumlah[$i],
                'total' => $request->total[$i],
            ]);
        }

        Cart::where('id_member', Auth::guard('webmember')->user()->id)->update([
            'is_checkout' => 1
        ]);;
    }



    public function checkout()
    {
        $orders = Order::where('id_member', Auth::guard('webmember')->user()->id)->latest()->first();

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $orders->id,
                'gross_amount' => $orders->grand_total,
            ),
            'customer_details' => array(
                'first_name' => $orders->member->nama_member,
                'last_name' => '',
                'email' => $orders->member->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('home.checkout', compact('orders', 'snapToken'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $order = Order::find($request->order_id);
                $order->update(['status' => 'Paid']);
            } elseif ($request->transaction_status == 'settlement') {
                $order = Order::find($request->order_id);
                $order->update(['status' => 'Settled']);
            } elseif ($request->transaction_status == 'cancel' || $request->transaction_status == 'deny' || $request->transaction_status == 'expire') {
                $order = Order::find($request->order_id);
                $order->update(['status' => 'Failed']);
            }
        }
        return response()->json(['message' => 'Transaction processed']);
    }

    public function payments(Request $request)
    {
        Payment::create([
            'id_order' => $request->id_order,
            'id_member' => Auth::guard('webmember')->user()->id,
            'jumlah' => $request->jumlah,
            'status' => 'Pending',
        ]);
        return redirect('/orders');
    }

    public function orders()
    {
        $orders = Order::where('id_member', Auth::guard('webmember')->user()->id)->get();
        $payments = Payment::where('id_member', Auth::guard('webmember')->user()->id)->get();
        return view('home.orders', compact('orders', 'payments'));
    }

    public function about()
    {
        // $about = About::first();
        // $testimonies = Testimoni::all();
        // return view('home.about', compact('about', 'testimonies'));
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function faq()
    {
        return view('home.faq');
    }
}
