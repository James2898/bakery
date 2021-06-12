<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use File;
use Illuminate\Support\Facades\Storage;

class BasketController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::orderBy('id','ASC')->get();
        return view('products', compact('products'));
    }

    public function create()
    {
        return view('products-create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'product_photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $photo = $request->file('product_photo');

        $name = uniqid() . $photo->getClientOriginalName();
        // $path = $photo->storeAs('public/img', $name);
        $path = Storage::putFileAs('public/img',  $photo, $name);

        Product::create([
            'name'      => $request->product_name,
            'qty'       => $request->product_qty,
            'price'     => $request->product_price,
            'photo'     => $name,
        ]);

        return redirect(route('products'))->with('alert', 'Products Added!');
    }

    public function view($id)
    {
        $product = Product::find($id);
        return view('products-view', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('products-edit', compact('product'));
    }

    public function update(Request $request)
    {

        $validatedData = $request->validate([
            'product_photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $product = Product::find($request->product_id);
        
        if($request->file('product_photo')) {
            Storage::delete('public/img/'.$product->photo);
            $photo = $request->file('product_photo');
            $name = uniqid() . $photo->getClientOriginalName();
            $path = Storage::putFileAs('public/img',  $photo, $name);
            $product->update(['photo' => $name]);
        }

        $product->update([
            'name'      => $request->product_name,
            'qty'       => $request->product_qty,
            'price'     => $request->product_price,
        ]);
        
        return redirect(route('products.edit',$request->product_id))->with('alert', 'Product Updated!');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        Storage::delete('public/img/'.$product->photo);

        $product->delete();

        return redirect(route('products'))->with('alert', 'Product Deleted!');
    }
}
?>