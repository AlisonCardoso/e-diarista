<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\RegionalCommand;
use App\Models\SubCommand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private $sub_command;
    private $company;

    public function __construct()
    {
        $this->sub_command = new SubCommand();
        $this->company = new Company();
    }

    public function index()
    {
        $title = "Lista de companhias";
        $command = RegionalCommand::orderBy('name', 'ASC')->get();
        $sub_command = SubCommand::orderBy('name', 'ASC')->get();
        $companies = Company::orderBy('name', 'ASC')->get();

        return view('company.index', compact('title', 'command', 'sub_command', 'companies'));
    }

    public function create()
    {
        $title = 'Nova Sub Unidade';
        $commands = RegionalCommand::all();
        $sub_commands = SubCommand::all();

        return view('company.create', compact('title', 'commands', 'sub_commands'));
    }

    public function store(CompanyRequest $request)
    {
        DB::beginTransaction();

        try {
            $company = Company::create($request->validated());
            DB::commit();
            Session::flash('success', 'Companhia registrada com sucesso');
            return redirect()->route('companies.index');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao registrar companhia: ' . $e->getMessage());
            Session::flash('error', 'Erro ao registrar companhia');
            return redirect()->back()->withInput();
        }
    }

    public function show(Company $company)
    {
        $title = "Detalhes da Companhia";
        return view('company.show', compact('title', 'company'));
    }

    public function edit(Company $company)
    {
        $title = 'Editar Companhia';
        $commands = RegionalCommand::all();
        $sub_commands = SubCommand::all();

        return view('company.edit', compact('title', 'company', 'commands', 'sub_commands'));
    }

    public function update(CompanyRequest $request, Company $company)
    {
        DB::beginTransaction();

        try {
            $company->update($request->validated());
            DB::commit();
            Session::flash('success', 'Companhia atualizada com sucesso');
            return redirect()->route('companies.index');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao atualizar companhia: ' . $e->getMessage());
            Session::flash('error', 'Erro ao atualizar companhia');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(Company $company)
    {
        DB::beginTransaction();

        try {
            $company->delete();
            DB::commit();
            Session::flash('success', 'Companhia excluída com sucesso');
            return redirect()->route('companies.index');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao excluir companhia: ' . $e->getMessage());
            Session::flash('error', 'Erro ao excluir companhia');
            return redirect()->back();
        }
    }
}

