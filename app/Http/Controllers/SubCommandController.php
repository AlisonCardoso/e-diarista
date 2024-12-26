<?php

namespace App\Http\Controllers;

use App\Models\SubCommand;
use App\Models\RegionalCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class SubCommandController extends Controller
{
    public function index()
    {
        $subCommands = SubCommand::with('regional_command')->get();
        return view('admin.sub_commands.index', compact('subCommands'));
    }

    public function create()
    {
        $regionalCommands = RegionalCommand::all();
        return view('admin.sub_commands.create', compact('regionalCommands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name' => 'required|string|max:20',
            'regional_command_id' => 'required|exists:regional_commands,id',
            'image' => 'nullable|mimes:png,jpeg,jpg|max:2048',
        ]);

        $subCommand = SubCommand::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'regional_command_id' => $request->regional_command_id,
            'image' => $request->file('image') ? $this->storeImage($request->file('image')) : null,
           
        ]);

        return redirect()->route('admin.sub_commands.index')->with('success', 'Sub Command created successfully!');
    }

    public function edit(SubCommand $subCommand)
    {
        $regionalCommands = RegionalCommand::all();
        return view('admin.sub_commands.edit', compact('subCommand', 'regionalCommands'));
    }

   
    

public function update(Request $request, SubCommand $subCommand)
{
    // Validação dos dados
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:25',
        'regional_command_id' => 'required|exists:regional_commands,id',
        'image' => 'nullable|mimes:png,jpeg,jpg|max:2048', // Validação da imagem
    ]);

    // Atualiza o nome e o slug (garante que o slug nunca seja null)
   // $slug = Str::slug($request->name);  // Gera o slug a partir do nome

    // Atualiza o subcomando
    $subCommand->update([
        'name' => $request->name,
        'slug' =>$request->slug,  // Adiciona o slug gerado
        'regional_command_id' => $request->regional_command_id,
    ]);

    // Se houver uma nova imagem
    if ($request->hasFile('image')) {
        // Remove a imagem antiga
        if ($subCommand->image && File::exists(public_path('uploads/sub_commands/' . $subCommand->image))) {
            File::delete(public_path('uploads/sub_commands/' . $subCommand->image));
        }

        // Processa a nova imagem
        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/sub_commands'), $fileName);

        // Atualiza a imagem
        $subCommand->image = $fileName;
        $subCommand->save();
    }

    // Redireciona para a lista de SubCommands
    return redirect()->route('admin.sub_commands.index')->with('success', 'Sub Command atualizado com sucesso.');
}



    public function destroy(SubCommand $subCommand)
    {
        $subCommand->delete();
        return redirect()->route('admin.sub_commands.index')->with('success', 'Sub Command deleted successfully!');
    }

    protected function storeImage($image)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/sub_commands'), $imageName);
        return $imageName;
    }
}


