<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Moto;
use App\Http\Controllers\MotoController;


Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return redirect()->route('login')->with('error', 'Credenciales inválidas');
    }

    session(['user_id' => $user->id]);
    return redirect('/');
});

Route::post('/logout', function () {
    session()->forget('user_id');
    return redirect('/login');
})->name('logout');

// Grupo protegido con tu middleware de sesión
Route::middleware('auth.blade')->group(function () {
    // Listado
    Route::get('/', function () {
        $user  = \App\Models\User::find(session('user_id'));
        $motos = Moto::all();
        return view('home', compact('user','motos'));
    })->name('motos.index');

    // Crear
    Route::get('/motos/create', fn() => view('motos.create'))
         ->name('motos.create');
    Route::post('/motos', function(Request $r){
        $data = $r->validate([
            'modelo'     => 'required|string',
            'matricula'  => 'required|string',
            'kilometros' => 'required|integer',
            'fecha_itv'  => 'required|date',
            'estado'     => 'required|in:Libre,Alquilada,Averiada,Otros',
            'comentarios'=> 'nullable|string',
        ]);
        Moto::create($data);
        return redirect()->route('motos.index');
    })->name('motos.store');

    // ✏️ Editar
    Route::get('/motos/{moto}/edit', function(Moto $moto){
        return view('motos.edit', compact('moto'));
    })->name('motos.edit');

    // Actualizar
    Route::put('/motos/{moto}', function(Request $r, Moto $moto){
        $data = $r->validate([
            'modelo'     => 'required|string',
            'matricula'  => 'required|string',
            'kilometros' => 'required|integer',
            'fecha_itv'  => 'required|date',
            'estado'     => 'required|in:Libre,Alquilada,Averiada,Otros',
            'comentarios'=> 'nullable|string',
        ]);
        $moto->update($data);
        return redirect()->route('motos.index');
    })->name('motos.update');

    // Eliminar
    Route::delete('/motos/{moto}', [MotoController::class, 'destroy'])
         ->name('motos.destroy');

    // Logout
    Route::post('/logout', function () {
        session()->forget('user_id');
        return redirect('/login');
    })->name('logout');
});