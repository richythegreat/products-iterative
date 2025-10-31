<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create($request->all());

        // Flash ziņojums par veiksmīgu saglabāšanu
        return redirect()->route('products.index')->with('success', 'Produkts veiksmīgi pievienots!');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
        ]);

        $product->update($request->all());

        // Flash ziņojums par veiksmīgu atjaunināšanu
        return redirect()->route('products.index')->with('success', 'Produkts veiksmīgi atjaunināts!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        // Flash ziņojums par dzēšanu
        return redirect()->route('products.index')->with('success', 'Produkts dzēsts!');
    }
}