<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;

class CreateCategory extends Component
{
    public $name;
    public $description;
    public $category_id;
    public $subcategory_id;

    public $categories = [];
    public $subcategories = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:500',
        'category_id' => 'required|exists:categories,id',
        'subcategory_id' => 'nullable|exists:subcategories,id',
    ];

    public function mount()
    {
        $this->categories = Category::all();
        $this->subcategories = collect(); // Inicializa como coleção vazia
    }

    public function updatedCategoryId($categoryId)
    {
        $this->subcategories = Subcategory::where('category_id', $categoryId)->get();
        $this->subcategory_id = null; // Reseta a subcategoria quando a categoria muda
    }

    public function storeProduct()
    {
        $this->validate();

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'subcategory_id' => $this->subcategory_id,
        ]);

        session()->flash('success', 'Produto adicionado com sucesso!');

        // Limpa os campos após o envio
        $this->reset(['name', 'description', 'category_id', 'subcategory_id', 'subcategories']);
    }

    public function render()
    {
        return view('livewire.create-category', [
            'products' => Product::with(['category', 'subcategory'])->latest()->paginate(10),
        ]);
    }
}
