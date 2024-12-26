<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
 
    public function index()
    {
        
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    public function create(Request $request)
    {

        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        Service::create($request->all());
        return redirect()->route('services.index')->with('success', 'Serviço criado com sucesso.');
    }

    public function edit(Service $service)
    {
        return view('services.create', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $service->update($request->all());
        return redirect()->route('services.index')->with('success', 'Serviço atualizado com sucesso.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Serviço excluído com sucesso.');
    }
}
