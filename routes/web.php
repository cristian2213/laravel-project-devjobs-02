<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => true]); // to-do lo que este protegido el usuario lo debe verificar primero

// Pagina de inicio
Route::get('/', 'InicioController')->name('inicio.index');

// todas las rutas que esten aca se protegeran bajo el middleware
Route::group(['middleware' => ['auth', 'verified']], function () {
    //***************** Vacantes **************************/
    Route::get('/vacantes', 'VacanteController@index')->name('vacantes.index');
    Route::get('/vacantes/create', 'VacanteController@create')->name('vacantes.create');
    Route::post('/vacantes', 'VacanteController@store')->name('vacantes.store');
    Route::get('/vacantes/{vacante}/edit', 'VacanteController@edit')->name('vacantes.edit');
    Route::put('/vacantes/{vacante}', 'VacanteController@update')->name('vacantes.update');

    //**************** Subir Y Eliminar Imagen **************/
    Route::post('/vacantes/imagen', 'VacanteController@imagen')->name('vacantes.imagen');
    Route::post('/vacantes/borrarimagen', 'VacanteController@borrarImagen')->name('vacantes.borrar');

    Route::post('/vacantes/{vacante}', 'VacanteController@estado')->name('vacantes.estado');

    Route::delete('/vacantes/{vacante}', 'VacanteController@destroy')->name('vacantes.destroy');

    //********************* Notificaciones **************/
    Route::get('/notificaciones', 'NotificacionesController')->name('notificaciones');
});

//**************************** Categorias ************** */
Route::get('/categorias/{categoria}', 'CategoriaController@show')->name('categorias.show');

//**************** Vacantes rutas sin autenticacion ******/
Route::post('/busqueda/buscar', 'VacanteController@buscar')->name('vacantes.buscar');
Route::get('/busqueda/buscar', 'VacanteController@resultados')->name('vacantes.resultados'); // el order de las rutas es indispensable, siempre colocar los comodines al final de las rutas

Route::get('/vacantes/{vacante}', 'VacanteController@show')->name('vacantes.show');


//******************** Candidato *****************/
Route::get('/candidatos/{id}', 'CandidatoController@index')->name('candidatos.index');
Route::post('/candidatos', 'CandidatoController@store')->name('candidatos.store');
