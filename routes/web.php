<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminFilliereController;
use App\Http\Controllers\AffectationController;
use App\Http\Controllers\ChefFilliereController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});
/******************************************************************* */
Route::get("languageConverter/{locale}",function($locale){
    if(in_array($locale,['fr','en'])){
        session()->put("locale",$locale);
    }
return redirect()->back();
})->name("languageConverter");
/******************************************************************* */

/******************************************************************* */
// Route fellback
Route::fallback(function () {
    return view('404');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

/******************************************************************* */
Route::get("/dashboard",[HomeController::class,"index"])->middleware(['auth'])->name('dashboard');

/******************************************************************* */

Route::middleware(['auth','user-role:administrateur'])->group(function()
{

    Route::resource("/dashboard/admin",AdminController::class);
    Route::match(['get', 'post'], '/admin-utilisateurs', [AdminController::class,'getUtilisateur'])->name("admin-utilisateurs");
    Route::resource("/admin-filliere",AdminFilliereController::class);
    Route::get("/dashboard/admin",[DashboardController::class,'index'])->name("admin.dashboard");
    Route::post("import-filliere",[ImportController::class,'import'])->name("import-filliere");

});
/******************************************************************* */
Route::middleware(['auth','user-role:chef_filliere'])->group(function()
{
    Route::get("/dashboard/chef-filiere",[DashboardController::class,'index'])->name("chef-filiere.dashboard");
    Route::resource("chef-filliere/groupe",GroupeController::class);
    Route::resource("/chef-filliere/module",ModuleController::class);
    Route::resource("chef-filliere/affectation",AffectationController::class);
    Route::resource("/chef-filliere/Etudiant",EtudiantController::class);
    Route::post("import-groupe",[ImportController::class,'import'])->name("import-groupe");
    Route::post("import-module",[ImportController::class,'import'])->name("import-module");
    Route::post("import-etudiant",[ImportController::class,'import'])->name("import-etudiant");
});
/******************************************************************* */
Route::middleware(['auth','user-role:fourmateur'])->group(function()
{
    Route::get("/dashboard/fourmateur",[DashboardController::class,'index'])->name("fourmateur.dashboard");
    Route::resource("fourmateur-groupe",GroupeController::class);
    Route::resource("fourmateur-notes",NotesController::class);

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
