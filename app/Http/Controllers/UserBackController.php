<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Exception;
class UserBackController extends Controller
{
    //function use to operate function on user back session
	function userBack()
	{
		try
		{
			$back=session('user_back');
			$pre=$back[count($back)-2];
			unset($back[count($back)-1]);unset($back[count($back)-1]);
			session(['user_back'=> $back ]);
			return redirect($pre);
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
}
