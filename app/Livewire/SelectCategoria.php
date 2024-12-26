<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class SelectCategoria extends Component
{
    public $category;
    public $category_id;
    public $sub_category_id;
    public $sub_categories = [];

    public function mount()
    {     

        
        $this->category =Category::all();
        $this->sub_categories = collect();


    }

    public function filterSubCategory()
    {
        // Carregar subcategorias com base na categoria selecionada
        if ($this->category_id) {
           $this->sub_categories = Category::find($this->category_id)?->subCategories ?? collect();
       
        } else {
            $this->sub_categories = collect();
        }
    }


    public function render()
    {
        
        return view('livewire.select-categoria');
    }
}
