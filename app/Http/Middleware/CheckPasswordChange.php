<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\Paciente;
use RealRashid\SweetAlert\Facades\Alert;

class CheckPasswordChange
{
public function handle(Request $request, Closure $next): Response
{
    $user = Auth::user();
    return $next($request);
}

}
