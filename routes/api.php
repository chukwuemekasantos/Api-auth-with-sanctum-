<?php

use App\User;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/logout', function()
{
	auth()->logout();

	return response([

		'message' => 'You r logount',
	], 400);

});

Route::post('/login',function(Request $request){

	$request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);


$user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response([
            'email' => ['The provided credentials are incorrect.'],
        ], 404);
    }

    return $user->createToken('my-token');


});


Route::post('/reg',function(Request $request){

	$user = new User;

	$user->name = 'emeka';

	$user->email = 'emeka22@gmail.com';

	$user->password = Hash::make('catandrat');

	$user->save();

    return $user->createToken('my-token');


});