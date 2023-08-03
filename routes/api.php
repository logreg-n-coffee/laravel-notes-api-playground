<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\NoteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Auth routes
 * The post method in routes file creates a route that corresponds to the login action.
 * The delete method in routes file creates a route that corresponds to the logout action.
 * The post method in routes file creates a route that corresponds to the register action.
 */
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

/**
 * Proected Routes - Routes that require authentication
 * The middleware method in routes file adds the auth:sanctum middleware to the routes.
 * In order to authenticate, your users will need to include their API token as a Bearer token in the Authorization header of their requests.
 *
 * @example Add the following header to your request: `Authorization: <Bearer token>`
 *
 */
Route::middleware('auth:sanctum')->group(function () {
    /**
     * Notes routes
     * The apiResource method in routes file creates a series of routes that correspond to standard RESTful actions:
     * GET /notes for retrieving a list of notes (index).
     * POST /notes for creating a new note (store).
     * GET /notes/{note} for retrieving a specific note (show).
     * PUT/PATCH /notes/{note} for updating a specific note (update).
     * DELETE /notes/{note} for deleting a specific note (destroy).
     */
    Route::apiResource('notes', NoteController::class);
});


/**
 * Route for listing all routes
 */
Route::get('routes', function () {
    $routes = collect(Route::getRoutes())->map(function ($route) {
        return [
            'uri' => $route->uri,
            'methods' => $route->methods,
            'name' => $route->getName(),
            'action' => $route->getActionName(),
            'middleware' => $route->middleware(),
        ];
    });

    return $routes;
});
