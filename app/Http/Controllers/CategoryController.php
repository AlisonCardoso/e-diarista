<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        $categories = Category::with()->paginate(10);
        return view('categories.create', compact('categories')); // Retorna a view para criar uma nova categoria
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:categories,name', // Validação para nome único
        ]);

        Category::create($request->all()); // Cria uma nova categoria
        return redirect()->route('categories.create')->with('success', 'Categoria criada com sucesso.');
    }

    public function edit(Category $category)
    {
        $categories = Category::paginate(10);; 
        return view('categories.create', compact('category', 'categories')); // Retorna a view para editar a categoria
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:categories,name,' . $category->id, // Permite o nome da categoria atual
        ]);

        $category->update($request->all()); // Atualiza a categoria existente
        return redirect()->route('categories.create')->with('success', 'Categoria atualizada com sucesso.');
    }

    public function destroy(Category $category)
    {
        $category->delete(); // Deleta a categoria
        return redirect()->route('categories.index')->with('success', 'Categoria excluída com sucesso.');
    }
}
