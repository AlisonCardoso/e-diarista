<?php

namespace App\Http\Controllers;

use App\Models\ProductOrder;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductOrderRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;



class ProductOrderController extends Controller
{
    public readonly User $user;
    public Product $products ;

    public readonly ProductOrder $productOrders;
    public function __construct( User $user, Product $products, ProductOrder $productOrders)
    {
        $this->user = new User();

        $this->productOrders = new ProductOrder();

        $this->products = new Product();


    }
    public function index()
    {
       // Paginação dos registros de ordem de serviço
        // Exibe 10 ordens de serviço por página
        //$productOrders = ProductOrder::latest()->paginate(5);
        $productOrders = $this->productOrders->latest()->paginate(5);

        // Retorna a view com as ordens de serviço paginadas
        return view('product_orders.index', compact('productOrders'))
        ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = $this->products->all();

        return view('product_orders.create', compact('products'));
    }

    // Armazena uma nova ordem de produto no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'product_price' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction(); // Inicia a transação

            // Criação da ordem de produto
            $productOrder = ProductOrder::create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'product_price' => $request->product_price,
                // 'total_product_value' será calculado automaticamente
            ]);

            DB::commit(); // Confirma a transação

            return redirect()->route('product_orders.index')->with('success', 'Ordem de produto criada com sucesso!');
        } catch (Exception $e) {
            DB::rollBack(); // Reverte a transação em caso de erro
            Log::error('Erro ao criar ordem de produto: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Erro ao criar ordem de produto!');
        }
    }

    // Exibe os detalhes de uma ordem de produto específica
    public function show(ProductOrder $productOrder)
    {
        $productOrder->load('product');
        return view('product_orders.show', compact('productOrder'));
    }

    // Exibe o formulário para editar uma ordem de produto
    public function edit(ProductOrder $productOrder)
    {
        $products = Product::all();
        return view('product_orders.edit', compact('productOrder', 'products'));
    }

    // Atualiza os dados de uma ordem de produto existente
    public function update(Request $request, ProductOrder $productOrder)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'product_price' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction(); // Inicia a transação

            // Atualiza a ordem de produto
            $productOrder->update([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'product_price' => $request->product_price,
                // O valor total será recalculado automaticamente
            ]);

            DB::commit(); // Confirma a transação

            return redirect()->route('product_orders.index')->with('success', 'Ordem de produto atualizada com sucesso!');
        } catch (Exception $e) {
            DB::rollBack(); // Reverte a transação em caso de erro
            Log::error('Erro ao atualizar ordem de produto: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Erro ao atualizar ordem de produto!');
        }
    }

    // Exclui uma ordem de produto
    public function destroy(ProductOrder $productOrder)
    {
        try {
            $productOrder->delete();
            return redirect()->route('product_orders.index')->with('success', 'Ordem de produto excluída com sucesso!');
        } catch (Exception $e) {
            Log::error('Erro ao excluir ordem de produto: ' . $e->getMessage());
            return back()->with('error', 'Erro ao excluir ordem de produto!');
        }
    }
}
