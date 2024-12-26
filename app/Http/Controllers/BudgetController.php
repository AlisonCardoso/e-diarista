<?php
namespace App\Http\Controllers;

use App\Http\Requests\BudgetRequest;
use App\Models\Budget;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Workshop;
use App\Models\Situation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Exception;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::with(['vehicle', 'workshop', 'situation'])->get();
        return view('budgets.index', compact('budgets'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        $workshops = Workshop::all();
        $situations = Situation::all();
        $products = Product::all();


        return view('budgets.create', compact('vehicles', 'workshops', 'situations', 'products'));
    }


public function store(BudgetRequest $request)
{
    try {
        DB::beginTransaction(); // Inicia a transação

        // Cria o orçamento
        $budget = Budget::create($request->only([
            'vehicle_id',
            'workshop_id',
            'situation_id',
            'service_date',
            'labor_hourly_rate',
            'labor_hours',
            'total_service_order'
        ]));

        // Cria a relação entre orçamento e produtos na tabela pivô
        if ($request->has('products')) {
            $productData = [];
            foreach ($request->products as $product) {
                // Calcula o valor total de cada produto
                $productData[$product['id']] = [
                    'product_quantity' => $product['quantity'],
                    'product_price' => $product['price'],
                    'total_product_value' => $product['quantity'] * $product['price']
                ];
            }

            // Associa os produtos ao orçamento usando a tabela pivô
            $budget->products()->attach($productData);
        }

        DB::commit(); // Confirma a transação

        return redirect()->route('budgets.index')->with('success', 'Orçamento criado com sucesso!');
    } catch (Exception $e) {
        DB::rollBack(); // Desfaz a transação em caso de erro
        Log::error('Erro ao registrar o orçamento: ' . $e->getMessage());
        return back()->withInput()->with('error', 'Orçamento não cadastrado!');
    }
}




    public function show(Budget $budget)
    {
        $budget->load('products', 'vehicle', 'workshop', 'situation');
        return view('budgets.show', compact('budget'));
    }

    public function edit(Budget $budget)
    {
        $vehicles = Vehicle::all();
        $workshops = Workshop::all();
        $situations = Situation::all();
        $products = Product::all();

        $budget->load('products');

        return view('budgets.edit', compact('budget', 'vehicles', 'workshops', 'situations', 'products'));
    }

    public function update(BudgetRequest $request, Budget $budget)
    {
 // Atualiza os dados do Budget
 $budget->update($request->only([
    'vehicle_id',
    'workshop_id',
    'situation_id',
    'service_date',
    'labor_hourly_rate',
    'labor_hours',
     'total_service_order'
]));

// Sincroniza os produtos na tabela pivô
$productData = [];
foreach ($request->products as $product) {
    $productData[$product['id']] = [
        'product_quantity' => $product['quantity'],
        'product_price' => $product['price'],
        'total_product_value' => $product['quantity'] * $product['price']
    ];
}
$budget->products()->sync($productData);

return redirect()->route('budgets.index')->with('success', 'Orçamento atualizado com sucesso!');
}

    public function destroy(Budget $budget)
    {
        $budget->delete();
        return redirect()->route('budgets.index')->with('success', 'Orçamento excluído com sucesso!');
    }
}

