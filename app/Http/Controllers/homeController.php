<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class homeController extends Controller
{
    public function shop(Request $request){
        return response()->json(Product::all('id','name','size','category','price','image','created_at'),200);;
    }

    public function getProduct(Product $product) {
        return response()->json([
            'id'=> $product['id'],
            'name' => $product['name'],
            'description'=> $product['description'],
            'size'=> $product['size'],
            'category'=> $product['category'],
            'price'=> $product['price'],
            'image'=> $product['image'],
            'haveIt'=> $product['units'] >= 1,
            'created_at'=> $product['created_at']
        ],200);
    }
}
