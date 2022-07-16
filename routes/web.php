<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\RolesPermission\Model\Role;
use App\RolesPermission\Model\Permission;
use Illuminate\Support\Facades\Gate;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/role', 'RoleController')->names('role');    //names porque es controlador de recursos
Route::resource('/user', 'UserController', ['except' => [
    'create','store'] ])->names('user');

Route::get('admin', function () {
    return view('admin.dashboard');
});

Route::get('/test', function () {

    $user = User::find(2);

    //$user->roles()->sync([2]);                 //Se utilizo para asignarle el rol 2 al usuario
    Gate::authorize('haveaccess', 'role.show');
    return $user;
    //return $user->havePermission('role.index');

});
