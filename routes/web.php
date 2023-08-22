<?php

use App\Http\Livewire\Post\Show;
use App\Models\Comment;
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
    return view('welcome');
});
//Route::get('/comments', function (){
//    return view('livewire.comments');
//});
Route::get('/comments',[\App\Http\Livewire\Comments::class]);

