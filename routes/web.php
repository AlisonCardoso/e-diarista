<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\SubCommandController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ServiceOrderController;
use App\Http\Controllers\ProductOrderController;


//routas liverire
use  App\Livewire\BuscarCep;
use App\Livewire\BuscarCnpj;
use App\Livewire\CreateCompany;
use App\Livewire\CreateProduct;
use App\Livewire\SelectCategoria;
use App\Livewire\BuscarVeiculo;



Route::get('/', function () {
    return view('welcome');


});

Route::get('/dashboard', function () {
    return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/buscar-cep',BuscarCep::class)->name('buscar-cep');
Route::get('/buscar-cnpj', BuscarCnpj::class)->name('buscar-cnpj');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');




    Route::resource('services', ServiceController::class);
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');


    Route::get('/buscar-cep',BuscarCep::class)->name('buscar-cep');
    Route::get('/buscar-cnpj', BuscarCnpj::class)->name('buscar-cnpj');
    Route::get('/create-company', CreateCompany::class)->name('create-company');
    Route::get('/select', SelectCategoria::class)->name('select');
    Route::get('/buscar-carro', BuscarVeiculo::class)->name('buscar-carro');

    Route::get('/create-product', CreateProduct::class)->name('create-product');


    Route::resource('categories', CategoryController::class);
    Route::resource('subcategories', SubCategoryController::class);


    Route::resources(['budgets'=> BudgetController::class]);
    Route::resources(['categories'=> CategoryController::class]);
    Route::resources(['companies'=> CompanyController::class]);
    Route::resources(['products'=> ProductController::class]);
    Route::resources(['service_orders'=> ServiceOrderController::class]);
    Route::resources(['product_orders'=> ProductOrderController::class]);
    Route::resources(['vehicles'=> VehicleController ::class]);
    Route::resources(['workshops'=> WorkshopController::class]);

   // Definindo as rotas padrão para o controlador ServiceOrderController
Route::resources(['service_orders' => ServiceOrderController::class]);

// Rota personalizada para gerar o PDF de Service Orders
//Route::get('gerar_pdf', [ServiceOrderController::class, 'gerarPdf'])->name('service_orders.gerar_pdf');
Route::get('gerar_pdf', [ServiceOrderController::class, 'gerarPdf'])->name('service_orders.gerar_pdf');
Route::get('veiculo-gerar_pdf', [VehicleController::class, 'gerarPdf'])->name('vehicle.gerar_pdf');
// Route::get('veiculo-gerar_pdf', [VehicleController::class, 'veiculoPdf'])->name('vehicle.gerar_pdf');

// Route::get('veiculo-gerar_pdf', [VehicleController::class, 'veiculoPdf'])->name('vehicle.gerar_pdf');
Route::get('vehicle/{id}/pdf', [VehicleController::class, 'veiculoPdf'])->name('vehicle.pdf');



Route::get('/change-situation-service/{serviceOrder}', [ServiceOrderController::class, 'changeSituation'])->name('service_orders.change-situation');






});

Route::group(['middleware' => ['role:admin']], function () {
     Route::get('/admin', function () { return view('admin.dashboard');})->name('admin.dashboard');
     Route::resources(['vehicles'=> VehicleController ::class]);

});



Route::group(['middleware' => ['permission:publish articles']], function () {

});

// Rotas restritas apenas para adm autenticado
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('sub_commands', SubCommandController::class);
    Route::resource('permissions', PermissionController::class);
});




require __DIR__.'/auth.php';

