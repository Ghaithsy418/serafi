<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function AddingProducts(Request $request){
        $data = $request->validate([
            "name" => "required|unique:products,name"
        ]);

        return Product::create([
            "name" => $data["name"],
            "email" => Auth::user()->email,
        ]);
    }

    public function DeleteProduct(string $id){
        $userEmail = Auth::user()->email;

        $product = Product::find($id);
        if(!($product->email === $userEmail)){
            return response([
                "message" => "You can't delete this product",
            ],400);
        }

        $product->delete();

        return response([
            "message" => "deleted Successfully",
        ]);

    }
}
