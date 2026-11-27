<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // add Input
    public function index()
    {
        return view('products.index');
    }

    public function apiData()
    {
        $products = Product::latest()->get();

        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('products', 'public');

        }

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product successfully added!');
    }

    // add Edit

public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')
            ->store('products', 'public');
    } else {
        unset($validated['image']);
    }

    $product->update($validated);

    return redirect()
        ->route('products.index')
        ->with('success', 'Product successfully updated!');
}

// add Destroy

public function destroy(Product $product)
{
    $product->delete();

    return redirect()
        ->route('products.index')
        ->with('success', 'Product successfully deleted!');
}

}