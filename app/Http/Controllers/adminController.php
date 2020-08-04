<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Order;
use App\Product;

class adminController extends Controller
{
    public function getStatics () {
        $onlineVisitor = Visitor()->onlineVisitors(User::class)->count();
        $toDayVisits = DB::table('visits')->select('ip','created_at')->whereDate('created_at', date('y.m.d'))->count(DB::raw('DISTINCT ip'));
        $monthVisits = DB::table('visits')->select('ip','created_at')->whereMonth('created_at', date('m'))->count(DB::raw('DISTINCT ip'));
        return response()->json( [$onlineVisitor,$toDayVisits,$monthVisits], 200 );
    }

    public function getOrderDataChart () {
        $chartName = 'نمودار فروش ماهانه ' . date("Y");
        $backgroundColor = '#4080ff';
        $data = Order::whereYear('created_at', 2020)->orderBy('created_at','asc')->get('created_at');


        return response()->json( [
            'status' => 'success',
            'chartName' => $chartName,
            'backgroundColor' => $backgroundColor,
            'datasets' => $data
        ],200);
    }


    public function getOrders () {
        return response()->json(Order::with(['product','user'])->paginate(10),200);
    }


    public function getUsers () {
        return response()->json(User::paginate(10),200);
    }


    public function getProducts () {
        return response()->json(Product::paginate(10),200);
    }

    public function addProduct (Request $r) {

        $validatedData = $r->validate([
            'name' => 'required|string|max:250|min:5|unique:products,name',
            'describe' => 'required|string|max:1200|min:20',
            'quanity' => 'required|numeric',
            'price' => 'required|numeric',
            'imageName' => 'required|string|max:60|min:3'
        ]);
        if ( $validatedData ) {
            $product = new Product;

            $product->name = $r->name;
            $product->description = $r->describe;
            $product->units = $r->quanity;
            $product->price = $r->price;
            $product->image = 'images/' . $r->imageName;
            $product->size = 'medium' ;
            $product->category = 'men' ;

            $product->save();
            return response()->json('ok',200);
        }
    }

    public function updateProduct (Request $r) {
        $validatedData = $r->validate([
            'id' => 'required|exists:products,id',
            'name' => 'required|string|max:250|min:5|unique:products,name',
            'describe' => 'required|string|max:1200|min:20',
            'quanity' => 'required|numeric',
            'price' => 'required|numeric',
            'imageName' => 'required|string|max:60|min:3'
        ]);
        if ( $validatedData ) {
            $product = Product::find($r->id);
            $product->name = $r->name;
            $product->description = $r->describe;
            $product->units = $r->quanity;
            $product->price = $r->price;
            $product->update();
            return response()->json('ok',200);
        }
    }

    public function destroyProduct(Request $r) {
        $validatedData = $r->validate([
            'productID' => 'required|integer',
        ]);
        if ( $validatedData ) {
            $product = Product::findOrFail($r->productID);
            $product->delete();
            return response()->json('ok',200);
        }
    }

}
