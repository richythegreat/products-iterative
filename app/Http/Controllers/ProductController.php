<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Rāda visu produktu sarakstu
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Rāda formu jauna produkta izveidei
    public function create()
    {
        return view('products.create');
    }

    // Saglabā jaunu produktu
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Produkts veiksmīgi pievienots!');
    }

    // Rāda konkrētu produktu (ar route model binding)
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Rāda rediģēšanas formu
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Saglabā rediģētas izmaiņas
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Produkts veiksmīgi atjaunināts!');
    }

    // Dzēš produktu
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produkts izdzēsts!');
    }
}