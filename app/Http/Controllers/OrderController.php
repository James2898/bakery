<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Basket;
use App\Models\Order;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon;

class OrderController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // $basket = Basket::where('user_id',Auth::id())
        $orders_db;
        if (session('auth') == 3) {
            $orders_db = DB::table('orders')
                ->select('orders.*','users.*','products.name as product_name')
                ->where('user_id',Auth::id())
                ->orderBy('orders.id','ASC')
                ->join('users', 'orders.user_id','=','users.id')
                ->join('products','orders.product_id','=','products.id')
                ->get();
        } else {
            $orders_db = DB::table('orders')
                ->select('orders.*','users.*','products.name as product_name')
                ->orderBy('orders.id','DESC')
                ->join('users', 'orders.user_id','=','users.id')
                ->join('products','orders.product_id','=','products.id')
                ->get();
        }

        $orders = array();
        $length = count($orders_db);
        $products = array();
        $order_no = 0;
        $name = '';
        $date = '';
        $status = '';
        $x = 1;
        $total = 0;
        $xs = array();
        foreach ($orders_db as $item) {
            if ($order_no == 0) {
                $order_no = $item->order_no;
                $name = $item->name;
                $date = $item->order_date_checkout;
                $status = $item->order_status;
            }

            if ($order_no == $item->order_no) {
                array_push($products, $item->order_qty."x ".$item->product_name);
                $total += $item->order_total;
            }

            if ($order_no != $item->order_no){
                array_push($orders,
                array(
                    'order_no' => $order_no,
                    'order_date' => $date,
                    'products' => $products,
                    'name'     => $name,
                    'total'    => $total,
                    'status'   => $status
                ));
                $order_no = $item->order_no;
                $name = $item->name;
                $date = $item->order_date_checkout;
                $total = $item->order_total;
                $status = $item->order_status;
                $products = array();
                array_push($products, $item->order_qty."x ".$item->product_name);
            }

            if ($x == $length) {
                $order_no = $item->order_no;
                $name = $item->name;
                $status = $item->order_status;
                array_push($orders,
                array(
                    'order_no' => $order_no,
                    'order_date' => $item->order_date_checkout,
                    'products' => $products,
                    'name'     => $name,
                    'total'    => $total,
                    'status'   => $item->order_status
                ));
            }
            $x++;
        }

        return view('orders', compact('orders'));
    }

    public function create()
    {
        return view('products-create');
    }

    public function checkout()
    {
        $basket = DB::table('baskets')
            ->select(
                'baskets.id as id','baskets.qty', 'baskets.user_id', 'baskets.product_id',
                'products.name','products.price','products.qty as product_qty',
                'users.name as user_name', 'users.address', 'users.mobile', 'users.email'
            )
            ->where('user_id',Auth::id())
            ->orderBy('id','ASC')
            ->join('products', 'baskets.product_id','=','products.id')
            ->join('users', 'baskets.user_id','=','users.id')
            ->get();

        $order_id = uniqid();
        $mytime = Carbon\Carbon::now();

        foreach ($basket as $item) {
            Order::create([
                'order_no'      => $order_id,
                'user_id'       => $item->user_id,
                'product_id'    => $item->product_id,
                'order_address' => $item->address,
                'order_qty'     => $item->qty,
                'order_price'   => $item->price,
                'order_payment' => '1',
                'order_total'    => $item->qty * $item->price,
                'order_status'  => '0',
                'order_date_checkout' => $mytime->toDateTimeString(),
            ]);
        }
        Basket::where('user_id', Auth::id())->delete();

        return redirect(route('orders'))->with('alert', 'Order Placed!');
    }

    public function update(Request $request)
    {

        $order = DB::table('orders')
            ->where([['order_no','=',$request->order_no]]);
        
        $order->update([
                'order_status'   => $request->order_status
            ]);

        return redirect(route('orders.view',$order->first()->order_no))->with('alert', 'Order Updated!');
    }

    public function view($id) {
        
        $orders = DB::table('orders')
                ->select('orders.*','users.*','products.name as product_name')
                ->where([['order_no','=',$id]])
                ->orderBy('orders.id','ASC')
                ->join('users', 'orders.user_id','=','users.id')
                ->join('products','orders.product_id','=','products.id')
                ->get();
        
        return view('orders-view', compact('orders'));
    }

    public function down($id) {
        
        $basket = Basket::find($id);

        if ($basket->qty == 1) {
            $basket->delete();
            return redirect(route('basket'))->with('alert', 'Item Deleted!');
        }else {
            $basket->update(['qty' => $basket->qty - 1]);
            return redirect(route('basket'))->with('alert', 'Item Updated!');
        }


    }

}
?>