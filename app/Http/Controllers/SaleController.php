<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::all();

        return view('admin.sales.list', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = User::all();
        $products = Product::all();

        return view('admin.sales.form', compact('clients', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        $data['delivery_time'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->delivery_time)->format('Y-m-d');

        if (isset($request->id)) {
            // Update
            $sale = Sale::findOrFail($request->id);

            $sale->update($data);

            $this->syncProducts($sale, $request->products);

            $message = 'Venda editada com sucesso';
        } else {
            // Create
            $sale = Sale::create($data);

            $this->attachProducts($sale, $request->products);

            $message = 'Venda criada com sucesso';
        }

        return redirect()->route('sales.index')->with('message', $message);
    }

    protected function syncProducts(Sale $sale, array $products)
    {
        $productsToSync = [];

        foreach ($products as $product) {
            $productsToSync[$product['product_id']] = [
                'quantity' => $product['quantity'],
                'unit_value' => $this->getProductPrice($product['product_id']),
            ];
        }

        $sale->products()->sync($productsToSync);
    }

    protected function attachProducts(Sale $sale, array $products)
    {
        foreach ($products as $product) {
            $sale->products()->attach($product['product_id'], [
                'quantity' => $product['quantity'],
                'unit_value' => $this->getProductPrice($product['product_id']),
            ]);
        }
    }

    protected function getProductPrice($productId)
    {
        return Product::find($productId)->unit_value;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $sale = Sale::findOrFail($id);
        $clients = User::all();
        $products = Product::all();

        return view('admin.sales.form', compact('sale', 'clients', 'products'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $Sale = Sale::findOrFail($id);

        $Sale->delete();

        return redirect()->route('sales.index')->with('message', 'Venda excluída com sucesso');
    }
}
