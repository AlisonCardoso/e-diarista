<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use App\Models\Address;
use App\Http\Requests\WorkshopRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Exception;

class WorkshopController extends Controller
{
    public function index(Request $request)
    {
        $title = "Lista de Oficinas";
        $workshops = Workshop::with('address')->when($request->has('razao_social'), function ($whenQuery) use ($request) {
            $whenQuery->where('razao_social', 'like', '%' . $request->razao_social . '%');
        })->paginate(2);

        return view('workshop.index', compact('workshops', 'title'));
    }

    public function create()
    {
        $workshops = Workshop::all();
        $address = Address::all();
        return view('workshop.create', compact('workshops','address'));
    }

    public function store(WorkshopRequest $request)
    {

      try {
            DB::beginTransaction();


          $workshop = Workshop::create($request->all());
          $workshop->address()->create($request->all());

            DB::commit();


            return redirect()->route('workshops.index')->with('success', 'Oficina registrada com sucesso');

        }
        catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao registrar a oficina: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Oficina não registrada!');

        }
    }



    public function show(Workshop $workshop)
    {
        return view('workshop.show', compact('workshop'));
    }

    public function edit(Workshop $workshop)
    {
        $workshop->load('address'); // Carregar o endereço relacionado
        return view('workshop.create', compact('workshop'));
    }

public function update(WorkshopRequest $request, Workshop $workshop)
{
    try {
        DB::beginTransaction();

        // Atualizar dados do workshop
        $workshop->update($request->all());

        // Atualizar ou criar o endereço relacionado
        $workshop->address()->updateOrCreate(
            ['workshop_id' => $workshop->id],
            $request->only(['cep', 'state', 'city', 'neighborhood', 'street', 'number', 'complement'])
        );

        DB::commit();

        return redirect()->route('workshops.index')->with('success', 'Oficina atualizada com sucesso');
    }
    catch (Exception $e) {
        DB::rollBack();
        Log::error('Erro ao atualizar a oficina: ' . $e->getMessage());
        return back()->withInput()->with('error', 'Erro ao atualizar a oficina.');
    }
}



    public function destroy(Workshop $workshop)
    {
        try {
            DB::beginTransaction();

            // Excluir o endereço associado, se existir
            if ($workshop->address) {
                $workshop->address()->delete();
            }

            // Excluir a oficina
            $workshop->delete();

            DB::commit();

            Session::flash('success', 'Oficina excluída com sucesso');
            return redirect()->route('workshops.index');
        } catch (Exception $e) {
            DB::rollBack();
            Log::warning('Erro ao excluir a oficina', ['error' => $e->getMessage()]);
            return back()->with('error', 'Erro ao excluir a oficina!');
        }
    }

}
