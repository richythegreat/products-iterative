<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
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
    public function increaseQuantity(Product $product)
{
    $product->increase();
    $product->save();

    if (request()->ajax()) {
        return response()->json([
            'success' => true,
            'quantity' => $product->quantity,
        ]);
    }

    return back()->with('success', 'Produkta daudzums palielināts!');
}

public function decreaseQuantity(Product $product)
{
    $ok = $product->decrease();

    if ($ok) {
        $product->save();
    }

    if (request()->ajax()) {
        return response()->json([
            'success' => $ok,
            'quantity' => $product->quantity,
        ]);
    }

    return back()->with(
        $ok ? 'success' : 'error',
        $ok ? 'Produkta daudzums samazināts!' : 'Daudzumu vairs nevar samazināt — nav atlikumu!'
    );
}
public function addTag(Request $request, Product $product)
{
    $request->validate([
        'tag' => 'required|string|max:255'
    ]);

    $tag = Tag::firstOrCreate([
        'name' => strtolower($request->tag)
    ]);

    $product->tags()->syncWithoutDetaching([$tag->id]);

    return back()->with('success', 'Birka pievienota!');
}
public function searchTags(Request $request)
{
    $tags = Tag::where('name', 'like', '%' . $request->q . '%')
                ->take(10)
                ->get();

    return response()->json($tags);
}
public function updateTags(Request $request, Product $product)
{
    $tagNames = $request->tags; // array of tag strings

    // Convert names → Tag IDs (create missing tags)
    $tagIds = collect($tagNames)->map(function ($name) {
        return Tag::firstOrCreate(['name' => strtolower($name)])->id;
    });

    // Sync final tag IDs
    $product->tags()->sync($tagIds);

    return back()->with('success', 'Birkas atjauninātas!');
}



}