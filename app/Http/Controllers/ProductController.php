<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function create(Request $request) {

        $validated = $request->validate([
            "name" => ['required', 'unique:products', 'max:255'],
            "price" => ['required', 'numeric'],
            "image" => ['required', 'image'],
            "max_amount" => ['required', 'integer', 'min:0']
        ]);

        $image = $validated["image"];
        $name = $image->hashName();

        $validated["image"] = $name;

        $request->image->move(public_path('products'), $name);

        Product::create($validated);

        return to_route("products");
    }

    public function delete(Request $request) {
        Product::where('id', $request->id)->delete();
        return to_route("products");
    }

    public function update(Request $request) {

        $validated = $request->validate([
            "name" => ['max:255'],
            "price" => ['numeric'],
            "max_amount" => ['integer', 'min:0'],
        ]);

        $product = Product::where('id', $request->id)->firstOrFail()->fill($validated);
        $product->is_available = $request->has("is_available");
        $product->save();


        return back()->with('status', 'product-updated');
    }

}
