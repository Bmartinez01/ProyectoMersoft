<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
// Route::get('/users/{users}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::resource('users',  App\Http\Controllers\UserController::class)->middleware('auth');
Route::resource('clientes',  App\Http\Controllers\ClienteController::class)->middleware('auth');
Route::resource('categorias',  App\Http\Controllers\CategoriaController::class)->middleware('auth');
Route::resource('compras',  App\Http\Controllers\CompraController::class)->middleware('auth');
Route::get('/compras/{compra}/pdf', [App\Http\Controllers\CompraController::class, 'pdf'])->name('compras.pdf');
Route::get('excelcompra', [App\Http\Controllers\CompraController::class, 'excel'])->name('compras.excel');
Route::POST('excelcompra', [App\Http\Controllers\CompraController::class, 'Excel'])->name('compras_excel');
Route::post('excel2compra', [App\Http\Controllers\CompraController::class, 'excel2'])->name('compras.excel2');
Route::get('compras.graficas', ['as' => 'compras.charts', 'uses' => 'App\Http\Controllers\CompraController@charts'])->middleware('auth');
Route::resource('compras_detalle',  App\Http\Controllers\Compra_DetalleController::class)->middleware('auth');
Route::resource('proveedores',  App\Http\Controllers\ProveedoreController::class)->middleware('auth');
Route::resource('roles',  App\Http\Controllers\RoleController::class)->middleware('auth');
Route::resource('pedidos',  App\Http\Controllers\PedidoController::class)->middleware('auth');
Route::get('excelpedido', [App\Http\Controllers\PedidoController::class, 'excel'])->name('pedidos.excel');
Route::POST('excelpedido', [App\Http\Controllers\PedidoController::class, 'Excel'])->name('pedidos_excel');
Route::resource('pedidos_detalles',  App\Http\Controllers\Pedido_detalleController::class)->middleware('auth');
Route::get('/pedidos/{pedido}/pdf', [App\Http\Controllers\PedidoController::class, 'pdf'])->name('pedidos.pdf');
Route::post('excel2pedido', [App\Http\Controllers\PedidoController::class, 'excel2'])->name('pedidos.excel2');

// Route::resource('homes', App\Http\Controllers\HomeController::class)->middleware('auth');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('productos',  App\Http\Controllers\ProductoController::class)->middleware('auth');

Route::get('excel', [App\Http\Controllers\ProductoController::class, 'excel'])->name('productos.excel');
Route::POST('excelproducto', [App\Http\Controllers\ProductoController::class, 'Excel'])->name('productos_excel');
Route::post('excel2', [App\Http\Controllers\ProductoController::class, 'excel2'])->name('productos.excel2');
Route::resource('ventas',  App\Http\Controllers\ventaController::class)->middleware('auth');
Route::get('/ventas/{venta}/pdf', [App\Http\Controllers\ventaController::class, 'pdf'])->name('ventas.pdf');
Route::get('ventas.graficas', ['as' => 'ventas.charts', 'uses' => 'App\Http\Controllers\ventaController@charts'])->middleware('auth');
