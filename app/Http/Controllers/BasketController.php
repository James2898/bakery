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
            ->select('baskets.id as id','products.name','products.price','baskets.qty')
            ->where('user_id',Auth::id())
            ->join('products', 'baskets.product_id','=','products.id')
            ->get();

        return view('basket', compact('basket'));
    }

    public function create()
    {
        return view('products-create');
    }

    public function store(Request $request)
    {

        return redirect(route('basket'))->with('alert', 'Item Added!');
    }

    public function up($id) {
        
        $basket = Basket::find($id);
        
        $basket->update(['qty' => $basket->qty + 1]);

        return redirect(route('basket'))->with('alert', 'Item Updated!'.$id);
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