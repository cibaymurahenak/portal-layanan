<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Providers\TokenServiceProvider;

class DashboardController extends Controller
{
    // protected $token;

    public function index()
    {
        $ssoData = session('sso_data');

        return view('dashboard', compact('ssoData'));
    }
}
