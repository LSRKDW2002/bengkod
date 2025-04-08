<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Fungsi redirectTo() akan mengarahkan user berdasarkan role-nya.
    protected function redirectTo()
{
    $role = Auth::user()->role;

    if ($role === 'dokter') {
        return '/dokter/dashboard';
    } elseif ($role === 'pasien') {
        return '/pasien/dashboard';
    }

    return '/dashboard'; // fallback
}


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
