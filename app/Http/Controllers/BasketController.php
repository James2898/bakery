<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Basket;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // $basket = Basket::where('user_id',Auth::id())
        $basket = DB::table('baskets')
            ->select('baskets.id as id','products.name','products.price','baskets.qty','products.qty as product_qty')
            ->where('user_id',Auth::id())
            ->orderBy('id','ASC')
            ->join('products', 'baskets.product_id','=','products.id')
            ->get();

        return view('basket', compact('basket'));
    }

    public function checkout()
    {
        $basket = DB::table('baskets')
            ->select(
                'baskets.id as id','baskets.qty',
                'products.name','products.price','products.qty as product_qty',
                'users.name as user_name', 'users.address', 'users.mobile', 'users.email'
            )
            ->where('user_id',Auth::id())
            ->orderBy('id','ASC')
            ->join('products', 'baskets.product_id','=','products.id')
            ->join('users', 'baskets.user_id','=','users.id')
            ->get();
        
        foreach ($basket as $item) {
            if ($item->product_qty == 0) {
                return redirect(route('basket'))->with('alert', 'Cannot checkout item, 0 in stocks!');
            }
        }

        return view('basket-checkout', compact('basket'));
    }

    public function store(Request $request)
    {

        $basket = DB::table('baskets')
            ->where([['user_id','=',Auth::id()],['product_id','=',$request->product_id]]);
        $x = '';
        if ($basket->exists()) {
            $qty = $basket->first()->qty;
            $basket->update([
                'qty'   => $qty + $request->product_qty
            ]);
            $x = 'update';
        } else {
            $user_id = Auth::id();
            Basket::create([
                'user_id'       => $user_id,
                'product_id'    => $request->product_id,
                'qty'           => $request->product_qty,
            ]);
        }


        return redirect(route('basket'))->with('alert', 'Item Added!');
    }

    public function up($id) {
        
        $basket = Basket::find($id);
        
        $product = Product::find($basket->product_id);

        if ( $basket->qty >= $product->qty) {
            return redirect(route('basket'))->with('alert', 'Max Item Reached!');    
        } else {
            $basket->update(['qty' => $basket->qty + 1]);
            return redirect(route('basket'))->with('alert', 'Item Updated!');
        }

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