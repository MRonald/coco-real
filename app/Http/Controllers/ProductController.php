<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.products.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (isset($request->id)) {
            // Edit
            $product = Product::findOrFail($request->id);

            $product->update($request->all());

            $message = 'Produto editado com sucesso';
        } else {
            // Create
            Product::create($request->all());

            $message = 'Produto criado com sucesso';
        }

        return redirect()->route('products.index')->with('message', $message);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.form', compact('product'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('products.index')->with('message', 'Produto excluído com sucesso');
    }
}
