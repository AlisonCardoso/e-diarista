<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Category; // Para buscar as categorias
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::with('category')->paginate(10); // Pagina subcategorias com suas categorias
        return view('subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all(); 
        $subcategories = SubCategory::with('category')->paginate(10); 
        return view('subcategories.create', compact('categories', 'subcategories')); // Passa categorias para a view
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:sub_categories,name',
            'category_id' => 'required|exists:categories,id', // Valida se a categoria existe
        ]);

        SubCategory::create($request->all()); // Cria nova subcategoria
        return redirect()->route('subcategories.create')->with('success', 'Subcategoria criada com sucesso.');
    }

    public function edit(SubCategory $subcategory)
    {
        $categories = Category::all(); // Obtém todas as categorias para o dropdown
        $subcategories = SubCategory::with('category')->paginate(10); // Pagina as subcategorias
        return view('subcategories.create', compact('subcategories', 'categories', 'subcategory')); // Retorna a view para edição
    }
    

    public function update(Request $request, SubCategory $subcategory)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:sub_categories,name,' . $subcategory->id, // Permite o nome da subcategoria atual
            'category_id' => 'required|exists:categories,id', // Valida o ID da categoria
        ]);
    
        $subcategory->update($request->only(['name', 'category_id'])); // Atualiza apenas os campos necessários
        return redirect()->route('subcategories.index')->with('success', 'Subcategoria atualizada com sucesso.');
    }
    

    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return redirect()->route('subcategories.index')->with('success', 'Subcategoria excluída com sucesso.');
    }
}
