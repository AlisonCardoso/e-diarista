<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $title = "Novo usuário";
        $roles = Role::all();
        return view('admin.users.edit', compact('roles', 'title'));
    }


    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'image' => 'nullable|mimes:png,jpeg,jpg|max:2048',  // Validação para a imagem
        'roles' => 'nullable|array',
        'roles.*' => 'exists:roles,id',
    ]);

    // Caminho onde as imagens serão armazenadas
    $filePath = public_path('uploads');

    // Criação do usuário
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // Verifica se papéis foram selecionados e atribui os nomes dos papéis
    if ($request->has('roles')) {
        // Obtém os papéis pelo ID e pega os nomes dos papéis
        $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
        
        // Atribui os papéis ao usuário
        $user->assignRole($roleNames);  // Usar os nomes dos papéis, não os IDs
    }

    // Verifica se uma imagem foi enviada
    if ($request->hasFile('image')) {
        // Obtém o arquivo
        $file = $request->file('image');
        
        // Gera um nome único para o arquivo (evita conflito)
        $file_name = time() . '.' . $file->getClientOriginalExtension();
        
        // Move o arquivo para o diretório especificado
        $file->move($filePath, $file_name);
        
        // Armazena o nome da imagem no banco de dados
        $user->image = $file_name;
        $user->save();
    }

    return redirect()->route('admin.users.index')->with('success', 'Usuário criado com sucesso.');
}

    public function show(User $user)
    {
        $roles = $user->roles;
        return view('admin.users.show', compact('user', 'roles'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $assignedRoles = $user->roles->pluck('id')->toArray();
        return view('admin.users.edit', compact('user', 'roles', 'assignedRoles'));
    }

    // public function update(Request $request, User $user)
    // {
    //     // Validate incoming request
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
    //         'password' => 'nullable|string|min:8|confirmed',
    //         'image' => 'mimes:png,jpeg,jpg|max:2048',
    //         'roles' => 'nullable|array',
    //         'roles.*' => 'exists:roles,id', // Validate role IDs
    //     ]);

    //     // Update user details
    //     $user->update([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => $request->password ? bcrypt($request->password) : $user->password,
    //     ]);

    //     // Map role IDs to role names
    //     $roleIds = $request->roles;
    //     $validRoleNames = Role::whereIn('id', $roleIds)->pluck('name')->toArray();

    //     // Sync roles by name
    //     $user->syncRoles($validRoleNames);

    //     return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    // }

    public function update(Request $request, User $user)
{
    // Validação dos dados de entrada
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed',
        'image' => 'nullable|mimes:png,jpeg,jpg|max:2048',  // Validação para a imagem
        'roles' => 'nullable|array',
        'roles.*' => 'exists:roles,id',
    ]);

    // Atualiza os dados do usuário
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password ? bcrypt($request->password) : $user->password, // Se a senha foi fornecida, atualiza
    ]);

    // Verifica se papéis foram selecionados e atribui os papéis usando os nomes
    if ($request->has('roles')) {
        // Obtém os papéis pelo ID e pega os nomes dos papéis
        $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
        
        // Atualiza os papéis do usuário
        $user->syncRoles($roleNames);  // Usar os nomes dos papéis, não os IDs
    }

    // Verifica se uma nova imagem foi enviada
    if ($request->hasFile('image')) {
        // Apaga a imagem antiga, se houver
        if ($user->image && File::exists(public_path('uploads/' . $user->image))) {
            File::delete(public_path('uploads/' . $user->image));
        }

        // Obtém o arquivo da imagem
        $file = $request->file('image');
        
        // Gera um nome único para o arquivo (evita conflito)
        $file_name = time() . '.' . $file->getClientOriginalExtension();
        
        // Move o arquivo para o diretório especificado
        $file->move(public_path('uploads'), $file_name);
        
        // Atualiza o nome da imagem no banco de dados
        $user->image = $file_name;
    }

    // Salva as alterações feitas no usuário
    $user->save();

    // Retorna para a lista de usuários com uma mensagem de sucesso
    return redirect()->route('admin.users.index')->with('success', 'Usuário atualizado com sucesso.');
}



    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}