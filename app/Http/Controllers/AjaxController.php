<?php

namespace App\Http\Controllers;

use App\Corona;
use App\StoredPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class AjaxController extends Controller
{
    public function getCorona(Request $request)
    {
        $success = false;
        $corona = Corona::all();

        return response()->
        json($response = array(
            'success' => $success,
            'data' => $corona,
        ));
    }
}
