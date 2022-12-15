<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FicheVTController;
use App\Http\Controllers\ChatController;

use App\Notifications\TaskDoneNotification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProjectController;

use Spatie\GoogleCalendar\Event;

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
    return redirect()->route('login');
});

Auth::routes([
    'verify' => true,
    'register' => false
]);


Route::middleware(['auth:web', 'verified'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::resource('/dashboard/clients', ClientController::class);
    Route::post('/dashboard/clients/search', [ClientController::class, "search"])->name("client.search");
    Route::get('/dashboard/documents/{client_id}', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/dashboard/documents/readFiles', [DocumentController::class, 'readFiles'])->name('readFiles');
    Route::post('/dashboard/documents/uploadFile', [DocumentController::class, 'uploadFile'])->name('uploadFile');
    Route::post('/dashboard/documents/delete', [DocumentController::class, 'deleteFile'])->name('deleteFile');

    Route::get('/dashboard/createfvt/{client_id}', [FicheVTController::class, 'index'])->name('fichevt.index');
    Route::get('/dashboard/editfvt/{fiche_id}', [FicheVTController::class, 'edit'])->name('fichevt.edit');
    Route::get('/dashboard/pdf/{fiche_id}', [FicheVTController::class, 'pdf'])->name('fichevt.pdf');
    Route::post('/dashboard/createfvt/create', [FicheVTController::class, 'create'])->name('fichevt.create');
    Route::post('/dashboard/editfvt/{fiche_id}', [FicheVTController::class, 'update'])->name('fichevt.update');

    Route::get('/dashboard/todo-lists', [TodoListController::class, 'index'])->name("todos.index");
    Route::post('/dashboard/todo-lists/updatenotifiables', [TodoListController::class, 'updateNotifiables'])->name('updatenotifiables');
    Route::post('/dashboard/todo-lists/updatedelais', [TodoListController::class, 'updateDelais'])->name('updatedelais');
    Route::post('/dashboard/todo-lists/updatefiles', [TodoListController::class, 'updateFiles'])->name('updatefiles');
    Route::post('/dashboard/todo-lists/updatetaskstatut', [TodoListController::class, 'updateStatut'])->name('updatetaskstatut');

    Route::get('/dashboard/notifications', [UserController::class, 'notificationsList'])->name("user.notifications");
    Route::post('/dashboard/notifications/markasread', [UserController::class, 'markNotificationAsRead'])->name("notificationsmarkasread");

});

Route::middleware(['auth:web', 'verified', 'role:administrator'])->group(function () {
    Route::resource('/dashboard/users', UserController::class)
        ->except('show');

    Route::get('/dashboard/users/{user_id}/set-clients', [UserController::class, 'setClients'])
        ->name('users.set_clients');
    Route::post('/dashboard/users/set-clients', [UserController::class, 'post_setClients'])
        ->name('users.post_set_clients');
});

Route::middleware(['auth:web', 'verified', 'role:commercial'])->group(function () {
    Route::get('/dashboard/todo-list/{client_id}/formulaire-visite-1', [TodoListController::class, 'FormulaireVisite1'])->name('todo-list.formulaire-visite-1');
    Route::post('/dashboard/todo-list/formulaire-visite-1', [TodoListController::class, 'FormulaireVisite1Submit'])->name('todo-list.formulaire-visite-1.submit');
    Route::get('/dashboard/todo-list/{client_id}', [TodoListController::class, 'TodoListTable'])->name('todo-list.todo-list-table');

});


Route::middleware(['auth:web', 'verified', 'role:direction_technique'])->group(function () {
    Route::get('/dashboard/todo-list/{client_id}/formulaire-visite-2', [TodoListController::class, 'FormulaireVisite2'])
        ->name('todo-list.formulaire-visite-2');
});

// GOOGLE CALENDAR TEST 
Route::get('/eventscalendar', function(){
    $e = Event::get();
    dd($e);
});

Route::get('/notify', function(){
    $user = User::find(2);
    $user->notify(new TaskDoneNotification());
});

Route::resource('chat', ChatController::class);

Route::post('/chat/getchat', [ChatController::class, 'getChat'])->name('getchat');

Route::get('/dashboard/usersclients', [ProjectController::class, 'usersClients'])->name('usersclients');
    
