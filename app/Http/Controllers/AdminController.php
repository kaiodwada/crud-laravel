<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.home', compact('products'));
    }

    public function edit(Product $product)
    {
        return view('admin.update', [
            'product' => $product
        ]);
    }

    public function update(Product $product ,ProductStoreRequest $request)
    {
        $input =  $request->validated();
        if (!empty($input['cover']) && $input['cover']->isValid()) {
            Storage::delete($product->cover ?? '');
            $file = $input['cover'];
            $path = $file->store('public/products');
            $input['cover'] = $path;
        }
        $product->fill($input);
        $product->save();
        return Redirect::route('admin.home');
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(ProductStoreRequest $request)
    {
        $input =  $request->validated();
        $input['slug'] = Str::slug($input['name']);

        if (!empty($input['cover']) && $input['cover']->isValid()) {
            $file = $input['cover'];
            $path = $file->store('public/products');
            $input['cover'] = $path;
        }

        Product::create($input);

        return Redirect::route('admin.home');
    }

    public function destroy(Product $product)
    {
        Storage::delete($product->cover ?? '');
        $product->delete();
        return Redirect::route('admin.home');
    }
    public function destroyImage(Product $product)
    {
        Storage::delete($product->cover ?? '');
        $product->cover = null;
        $product->save();
        return Redirect::back();
    }
}
