<?php

namespace App\Http\Controllers;

use App\Models\ProductOrder;
use App\Models\ServiceOrder;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\TypeVehicle;
use App\Models\Workshop;
use App\Models\Situation;
use App\Models\SituationVehicle;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceOrderRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Exception;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Container\Attributes\Auth;

class ServiceOrderController extends Controller
{
    public readonly User $user;
    public ServiceOrder $serviceOrder;
    public Vehicle $vehicle;
    public TypeVehicle $type_vehicle;
    public Workshop $workshop;
    public Situation $situation;
    public SituationVehicle $situation_vehicle;
    public Product $product;

    public function __construct(User $user, ProductOrder $productOrder, ServiceOrder $serviceOrder, Vehicle $vehicle, Workshop $workshop, 
   Situation $situation,  SituationVehicle $situation_vehicle)
    {
        $this->user = new User();
        $this->vehicle = new Vehicle();
        $this->type_vehicle = new TypeVehicle();
        $this->workshop = new Workshop();
        $this->situation = new Situation();
        $this->situation_vehicle = new SituationVehicle();
        $this->product = new Product();
    }

    // Função auxiliar para construir a consulta com filtros
    private function buildQuery(Request $request)
    {
        $vehiclePlate = $request->input('vehicle');
        $vehicleTypeId = $request->input('type_vehicle');
        $dataInicio = $request->input('data_inicio');
        $dataFim = $request->input('data_fim');
        $workshopId = $request->input('workshop');
        $situationId = $request->input('situation');
        $situationVehicleId = $request->input('situation_vehicle');
        $productId = $request->input('product');

        // Verifique os parâmetros de entrada para depuração
        Log::info('Filtros recebidos: ', [
            'vehiclePlate' => $vehiclePlate,
            'vehicleTyteId' => $vehicleTypeId,
            'dataInicio' => $dataInicio,
            'dataFim' => $dataFim,
            'workshopId' => $workshopId,
            'situationId' => $situationId,
            'situationVehicleId' => $situationVehicleId,
            'productId' => $productId
        ]);

        $query = ServiceOrder::latest();

        if ($vehiclePlate) {
            $query->whereHas('vehicle', function ($query) use ($vehiclePlate) {
                $query->where('plate', 'like', '%' . $vehiclePlate . '%');
            });
        }
  
        if ($vehicleTypeId) {
            $query->whereHas('vehicle', function ($query) use ($vehicleTypeId) {
                $query->where('type_vehicle_id', $vehicleTypeId);  // A chave estrangeira 'type_vehicle_id' está em 'vehicles'
            });
        }

    // Filtro por situação do veículo
    if ($situationVehicleId) {
        $query->whereHas('situation_vehicle', function ($query) use ($situationVehicleId) {
            $query->where('id', $situationVehicleId); // Ajustado para buscar pelo ID da situação do veículo
        });
    }


     // Filtro por data de início
     if ($dataInicio) {
        $query->where('service_date', '>=', \Carbon\Carbon::parse($dataInicio)->toDateString());
    }

    // Filtro por data de fim
    if ($dataFim) {
        $query->where('service_date', '<=', \Carbon\Carbon::parse($dataFim)->toDateString());
    }
        // if ($dataInicio) {
        //     $query->where('service_date', '>=', \Carbon\Carbon::parse($dataInicio)->format('Y-m-d'));
        // }

        // if ($dataFim) {
        //     $query->where('service_date', '<=', \Carbon\Carbon::parse($dataFim)->format('Y-m-d'));
        // }

        if ($workshopId) {
            $query->whereHas('workshop', function ($query) use ($workshopId) {
                $query->where('razao_social', 'like', '%' . $workshopId . '%');
            });
        }

        if ($situationId) {
            $query->whereHas('situation', function ($query) use ($situationId) {
                $query->where('situation_id',$situationId );
            });
        }

        if ($productId) {
            $query->whereHas('products', function ($query) use ($productId) {
                $query->where('product_id', $productId);
            });
        }

        return $query;
    }

 public function gerarPdf(Request $request)
 {

     $query = $this->buildQuery($request);
     $serviceOrders = $query
     ->orderByDesc('created_at')
     ->get();
 //Configuração do Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true); 
$options->set('isRemoteEnabled', true); // Permite carregar imagens externas
$dompdf = new Dompdf($options);

    $totalValor =$serviceOrders->sum('total_service_order');

    $pdf = PDF::loadView('service_orders.gerar_pdf', compact('serviceOrders', 'totalValor')) ->setPaper('a4', );
    return $pdf->stream('relatorio_de_servicos.pdf');
}

public function changeSituation(ServiceOrder $serviceOrder){


try {
    // Mapeia as mudanças de situação
    $nextSituation = match($serviceOrder->situation_id) {
        1 => 2,
        2 => 3,
        3 => 4,
        default => $serviceOrder->situation_id, // Não altera se estiver fora do esperado
    };

    // Atualiza a situação apenas se houver mudança
    if ($nextSituation !== $serviceOrder->situation_id) {
        $serviceOrder->update(['situation_id' => $nextSituation]);
        Log::info('Situação da ordem de serviço atualizada com sucesso', [
            'id' => $serviceOrder->id,
            'serviceOrder' => $serviceOrder
        ]);

        return back()->with('success', 'Ordem de Serviço atualizada com sucesso!');
    }

    return back()->with('info', 'A situação já está no estado final e não pode ser alterada.');

}
catch (Exception $e) {
    Log::error('Erro ao atualizar a situação da ordem serviço: ' . $e->getMessage());
    return back()->with('error', 'Houve um erro ao atualizar a situação da ordem serviço: ' . $e->getMessage());
}
}

     public function index(Request $request)
     {
         // Flexibilidade de paginação
         $perPage = $request->input('per_page', 10);
         $query = $this->buildQuery($request);
         $serviceOrders = $query->orderByDesc('created_at')->paginate($perPage);

         // Retornar a view com as ordens de serviço filtradas
         $situations = Situation::all();
         $situation_vehicles = SituationVehicle::all();
         $type_vehicles = TypeVehicle::all();
         $products = Product::all();

         return view('service_orders.index', compact('serviceOrders', 'situations', 'products', 'situation_vehicles' , 'type_vehicles'))
             ->with('i', (request()->input('page', 1) - 1) * $perPage);
     }

    // public function index(Request $request)
    // {
    //     $serviceOrders = $this->buildQuery($request)->paginate(10);
    //     return view('service_orders.index', compact('serviceOrders'));
    // }
    

    public function create()
    {
        $vehicles = Vehicle::all();
        $workshops = Workshop::all();
        $situations = Situation::all();
        $products = Product::all();

        return view('service_orders.create', compact('vehicles', 'workshops', 'situations', 'products'));
    }
    public function store(ServiceOrderRequest $request)
{
    $validated = $request->validated();

    try {
        // Calculando o total dos produtos
        $orderTotal = 0;
        if (isset($validated['product_id']) && count($validated['product_id']) > 0) {
            foreach ($validated['product_id'] as $key => $productId) {
                $product = Product::find($productId);
                $quantity = $validated['quantity'][$key];
                $orderTotal += $product->price * $quantity;
            }
        }

        // Calculando o total de mão de obra
        $laborTotal = $validated['labor_hourly_rate'] * $validated['labor_hours'];

        // Calculando o total geral da ordem de serviço
        $totalServiceOrder = $orderTotal + $laborTotal;

        // Criando a ordem de serviço
        $serviceOrder = ServiceOrder::create([
            'user_id' => $validated['user_id'],
            'vehicle_id' => $validated['vehicle_id'],
            'workshop_id' => $validated['workshop_id'],
            'situation_id' => $validated['situation_id'],
            'service_date' => $validated['service_date'],
            'labor_hourly_rate' => $validated['labor_hourly_rate'],
            'labor_hours' => $validated['labor_hours'],
            'labor_total' => $laborTotal,
            'order_total' => $orderTotal,
            'total_service_order' => $totalServiceOrder,
            'description' => $validated['description'],
        ]);

        // Associando os produtos à ordem de serviço
        if (isset($validated['product_id']) && count($validated['product_id']) > 0) {
            $products = [];
            foreach ($validated['product_id'] as $key => $productId) {
                $products[$productId] = [
                    'product_quantity' => $validated['quantity'][$key],
                    'product_price' => $validated['product_price'][$key],
                ];
            }

            $serviceOrder->products()->sync($products);
        }

        return redirect()->route('service_orders.index')->with('success', 'Ordem de Serviço criada com sucesso!');
    } catch (Exception $e) {
        Log::error('Erro ao salvar ordem de serviço: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Houve um erro ao salvar a ordem de serviço: ' . $e->getMessage());
    }
}


    public function edit(ServiceOrder $serviceOrder)
    {

        $this->serviceOrder = $serviceOrder;

        $vehicles = Vehicle::all();
        $workshops = Workshop::all();
        $situations = Situation::all();
        $products = Product::all();
        return view('service_orders.create', compact('serviceOrder', 'vehicles', 'workshops', 'situations', 'products'));
    }

    public function update(ServiceOrderRequest $request, ServiceOrder $serviceOrder)
    {
        $validated = $request->validated();

        $orderTotal = 0;
        if (isset($validated['product_id']) && count($validated['product_id']) > 0) {
            foreach ($validated['product_id'] as $key => $productId) {
                $product = Product::find($productId);
                $quantity = $validated['quantity'][$key];
                $orderTotal += $product->price * $quantity;
            }
        }

        $laborTotal = $validated['labor_hourly_rate'] * $validated['labor_hours'];

        $totalServiceOrder = $orderTotal + $laborTotal;

        $serviceOrder->update([
            'user_id' => $validated['user_id'],
            'vehicle_id' => $validated['vehicle_id'],
            'workshop_id' => $validated['workshop_id'],
            'situation_id' => $validated['situation_id'],
            'service_date' => $validated['service_date'],
            'labor_hourly_rate' => $validated['labor_hourly_rate'],
            'labor_hours' => $validated['labor_hours'],
            'labor_total' => $laborTotal,
            'order_total' => $orderTotal,
            'total_service_order' => $totalServiceOrder,
            'description' => $validated['description'],
        ]);

        // Associando os produtos à ordem de serviço
        if (isset($validated['product_id']) && count($validated['product_id']) > 0) {
            $products = [];
            foreach ($validated['product_id'] as $key => $productId) {
                $products[$productId] = [
                    'product_quantity' => $validated['quantity'][$key],
                    'product_price' => $validated['product_price'][$key],
                ];
            }

            // Atualizar os produtos na ordem de serviço
            $serviceOrder->products()->sync($products);
        }

        return redirect()->route('service_orders.index')->with('success', 'Ordem de Serviço atualizada com sucesso.');
    }
    public function show(ServiceOrder $serviceOrder)
    {
        $vehicles = Vehicle::all();
        $workshops = Workshop::all();
        $situations = Situation::all();
        $products = Product::all();
        return view('service_orders.show', compact('serviceOrder', 'vehicles', 'workshops', 'situations', 'products'));
    }


    public function destroy($id)
    {
        try {
            $serviceOrder = ServiceOrder::findOrFail($id);
            $serviceOrder->delete();
    
            return redirect()->route('service_orders.index')->with('success', 'Ordem de serviço excluída com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('service_orders.index')->with('error', 'Erro ao excluir a ordem de serviço.');
        }
    }

}
