<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\SituationVehicle;
use App\Models\SubCommand;
use App\Models\RegionalCommand;
use App\Models\Vehicle;
use App\Models\TypeVehicle;
use Illuminate\Http\Request;
use App\Http\Requests\VehicleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;

class VehicleController extends Controller
{
    private $vehicle;

    public function __construct()
    {
        $this->vehicle = new Vehicle();
    }

   
    public function buildQuery(Request $request)
{
    // Obtendo os filtros da requisição
    $vehiclePlate = $request->input('vehicle'); 
    $vehicleTypeId = $request->input('type_vehicle'); 
    $situationVehicleId = $request->input('situation_vehicle');

    Log::info('Filtros recebidos: ', [
        'vehiclePlate' => $vehiclePlate,
        'vehicleTypeId' => $vehicleTypeId,
        'situationVehicleId' => $situationVehicleId,
    ]);

    // Iniciando a consulta base
    $query = Vehicle::latest();

    // Filtro por placa do veículo
    if ($vehiclePlate) {
        $query->where('plate', 'like', '%' . $vehiclePlate . '%');  // Agora a consulta está diretamente em 'vehicles'
    }

    // Filtro por tipo de veículo
    if ($vehicleTypeId) {
        $query->where('type_vehicle_id', $vehicleTypeId);  // Filtro direto na coluna 'type_vehicle_id' da tabela 'vehicles'
    }

    // Filtro por situação do veículo
    if ($situationVehicleId) {
        $query->where('situation_vehicle_id', $situationVehicleId);  // Filtro direto na coluna 'situation_vehicle_id'
    }

    return $query;
}

public function index(Request $request)
{
    
    $perPage = $request->input('per_page', 10); 
    // Validação para garantir que o valor de 'per_page' seja um número válido.
$perPage = is_numeric($perPage) && $perPage > 0 && $perPage <= 100 ? (int)$perPage : 10;


 
    $query = $this->buildQuery($request);

    // Executando a consulta e obtendo os veículos com paginação
    $vehicles = $query->with(['subCommand', 'typeVehicle', 'situationVehicle'])->paginate($perPage);

   
    $title = "Listas de Veículos";
    $sub_command = SubCommand::all();
    $situation_vehicle = SituationVehicle::all();
    $type_vehicles = TypeVehicle::all();

    // Retornando a view com os dados
    return view('vehicle.index', compact('sub_command', 'vehicles', 'type_vehicles', 'title', 'situation_vehicle'))
        ->with('i', (request()->input('page', 1) - 1) * $perPage);
}



public function veiculoPdf($id)
{
    // Recupera o veículo, suas ordens de serviço e a oficina associada
    $vehicle = Vehicle::with('serviceOrders.situation')->findOrFail($id);
    
    // Calcula o total das ordens de serviço
    $totalOrders = $vehicle->serviceOrders->sum('total_service_order');
    
    // Pega as ordens de serviço
    $serviceOrders = $vehicle->serviceOrders;
    
    // Passa os dados para a view e gera o PDF
    $pdf = PDF::loadView('vehicle.gerar_pdf', compact('vehicle', 'serviceOrders', 'totalOrders'));

    // Retorna o PDF para download com nome baseado na placa do veículo
    return $pdf->stream("relatorio_veiculo_{$vehicle->plate}.pdf");
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
    $data = []; // Dados dinâmicos para o template
    
    $pdf = PDF::loadView('vehicle.gerar_pdf', compact($data , 'totalValor' )) ->setPaper('a4', 'portrait' );

    return $pdf->stream('relatorio_de_viatura_.pdf');

   
}

   
    public function create()
    {
       $title = "Novo veículo";
       $type_vehicle = TypeVehicle::all();
       $situation_vehicle = SituationVehicle::all();
       $regional_command = RegionalCommand::all();
       $sub_command = SubCommand::all();
       return view('vehicle.create', compact('type_vehicle','sub_command', 'regional_command','title','situation_vehicle'));

    }
    public function store(VehicleRequest $request)
    {
         try {
        DB::beginTransaction();
        $vehicle= Vehicle::create($request->all());

        $vehicle->save();
        DB::Commit();

        Session::flash('success', 'Veiculo cadastrado com successo');
        return redirect()->route('vehicles.index');
            }
             catch (Exception $e) {

        // Salvar log
        Log::warning('Veiculo não ecadastrado', ['error' => $e->getMessage()]);

        // Redirecionar o usuário, enviar a mensagem de erro
        return back()->withInput()->with('error', 'Veiculo não cadastrado!');
    }
    }

    public function show(Vehicle $vehicle)
    {
        // Recupera todas as ordens de serviço associadas ao veículo
        $serviceOrders = $vehicle->serviceOrders;
        // Soma o valor de todas as ordens de serviço
        $totalOrders = $serviceOrders->sum('total_service_order');
    
        return view('vehicle.show', compact('vehicle', 'serviceOrders', 'totalOrders'));
    }
      

    public function edit(Vehicle $vehicle)
    {
        $title = "Atualizar veículo";
        $type_vehicle = TypeVehicle::all();
        $situation_vehicle = SituationVehicle::all();
        $regional_command = RegionalCommand::all();
        $sub_command = SubCommand::all();

        return view('vehicle.create', compact('type_vehicle', 'sub_command', 'regional_command', 'title', 'situation_vehicle', 'vehicle'));
    }

    public function update(VehicleRequest $request, Vehicle $vehicle)
    {
        try {
            DB::beginTransaction();
            $vehicle->update($request->all());
            DB::commit();

           
            return redirect()->route('vehicles.index')
            ->with('success', 'Veículo atualizado com sucesso');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao atualizar oveículo: ' . $e->getMessage());
    return back()->withInput()->with('error', 'Erro ao atualizaro veículo.'); }
    }
    
    public function destroy($id)
    {
        try {
            $vehicle = Vehicle::findOrFail($id);
            $vehicle->delete();
    
            return redirect()->route('vehicles.index')->with('success', 'Veículo excluido com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('vehicles.index')->with('error', 'Erro ao excluir o veículo.');
        }
    }
  


   
       
}
