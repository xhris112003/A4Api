<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    // Esta ruta devuelve la información del usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::middleware('checkApiAuth')->group(function () {
    // Estas rutas requieren autenticación mediante token válido
    Route::apiResource('providers', 'App\Http\Controllers\ProviderController');
    Route::apiResource('products', 'App\Http\Controllers\ProductController');
});

Route::post('/login', function (Request $request) {
    // Esta ruta permite iniciar sesión mediante email y password, y devuelve un token de acceso válido
    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($validated)) {
        $user = Auth::user();
        $token = $user->createToken('MyApp')->plainTextToken;
        return response()->json([
            'access_token' => $token
        ]);
    }else{
        // Si las credenciales son incorrectas, devuelve un error 401 Unauthorized
        return response()->json(['error' => 'Unauthorized'], 401);
    }
});

Route::post('/register', 'App\Http\Controllers\RegisterController@register');
// Esta ruta permite registrar un nuevo usuario
