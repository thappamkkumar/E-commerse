<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
  
use App\Mail\sendOTP;
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


//Route send OTP
Route::post('/sendOTP', function (Request $request) {
			
			try
			{
				$user = User::where('email', $request->emailAddress)->first();
				if ($user) {
					$data = ['status' => 'false','message'=>"Email is already exist. Please enter another email."];
					return response()->json($data);
				}
				else
				{
					Mail::to($request->emailAddress)->send(new sendOTP($request->otpVal));	
					$data = ['status' => 'true','message'=>"Successfully send."];
					return response()->json($data);
				}
			}
			catch(Exception $e)
			{
				//$data = ['status' => 'false','message'=> 'Error occur during sending opt. Refresh and try again.'];
				$data = ['status' => 'false','message'=> $e->getMessage()];
				return response()->json($data);
			}
		});