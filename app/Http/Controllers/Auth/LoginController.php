<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Stub mínimo para evitar ReflectionException.
    public function __invoke(Request $request)
    {
        abort(404);
    }
}