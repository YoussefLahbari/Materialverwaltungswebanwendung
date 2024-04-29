<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SiteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/adminonly', function () {return view('adminonly');})->middleware(['auth', 'admin']);

Route::get('/stepone', function (){return abort('401');});
Route::post('/stepone', [MaterialController::class, 'create'])->middleware(['auth'])->name('materiel.create');
Route::delete('/stepone/{id}', [MaterialController::class, 'destroy'])->middleware(['auth'])->name('materiel.delete');
Route::put('/stepone/{id}/edit', [MaterialController::class, 'update'])->middleware(['auth'])->name('materiel.update');
Route::put('/stepone/{id}', [MaterialController::class, 'edit'])->middleware(['auth'])->name('materiel.edit');



// Route::update('/stepone', [MaterialController::class, 'update'])->middleware(['auth'])->name('materiel.update');
Route::put('/stepone', [MaterialController::class, 'store'])->middleware(['auth'])->name('materiel.store');

Route::post('/steptwo', [RepairController::class, 'create'])->middleware(['auth'])->name('request.create');

Route::get('/steptwo', function (){if(session()->has('success')) return view("steps/steptwo");})->middleware(['auth'])->name('request.create');
// Route::get('/steptwo', [RepairController::class, 'create'])->middleware(['auth'])->name('request.create');
Route::put('/steptwo/{id}', [RepairController::class, 'store'])->middleware(['auth'])->name('request.store');


Route::post('stepthree', [RequestController::class, 'create'])->middleware(['auth'])->name('besoin.create');
Route::put('stepthree', [RequestController::class, 'store'])->middleware(['auth'])->name('besoin.store');

Route::post('home/', [SearchController::class, 'search'])->middleware(['auth'])->name('search');
Route::get('home/{search}/{key?}', [SearchController::class, 'indexredirector'])->middleware(['auth', 'admin'])->name('updateview');
Route::get('/home/Cancel/{id}/{search}/{key?}', [RepairController::class, 'destroy'])->middleware(['auth', 'admin'])->name('request.destroy');
Route::post('/home/UpdateRepair/{id}', [RepairController::class, 'update'])->middleware(['auth', 'admin'])->name('request.update');
Route::get('stepzero', [SiteController::class, 'index'])->middleware(['auth', 'admin'])->name('step.zero');
Route::put('stepzero', [SiteController::class, 'store'])->middleware(['auth', 'admin'])->name('step.zero-post');
Route::get('Ajoutercompte' , [SiteController::class, 'userinterface'])->name('ajouteruserUI');
Route::post('Ajoutercompte' , [SiteController::class, 'createuser'])->name('ajouteruser');
Route::get('DemandeReparation/{id}/{search}/{key?}', [RepairController::class, 'store'])->middleware(['auth', 'admin'])->name('demanderrep');
Route::get('SupprimerMat/{id}/{search}/{key?}', [MaterialController::class, 'destroy'])->middleware(['auth', 'admin'])->name('supprimerMat');

Route::get('test', function(){return view('test');});