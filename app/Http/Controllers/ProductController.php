<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subcategory; // Se precisar da subcategoria
use App\Models\Category; // Se precisar da subcategoria
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $subcategories;
    private $categories;



    public function index()
{
    $products = Product::with('subcategory')->paginate(10);
    return view('products.index', compact('products'));
}

    public function create()
    {
        $categories = Category::all(); // Para o formulário de criação
        $subcategories = Subcategory::all(); // Para o formulário de criação
        return view('products.create', compact('subcategories', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'sub_category_id' => 'required|exists:sub_categories,id',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $subcategories = Subcategory::all(); // Para o formulário de edição
        return view('products.create', compact('subcategories','product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'sub_category_id' => 'required|exists:sub_categories,id',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
