<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 17/03/16
 * Time: 05:05 PM
 */

namespace Salesfly\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CashierMiddleware
{
    public function handle($request, Closure $next)
    {

        if(Auth()->user()->role_id == 2){
            return $next($request);
        }
        return response([
            'error' => [
                'code' => 'INSUFFICIENT_ROLE',
                'description' => 'No estas autorizado para acceder a este recurso.'
            ]
        ], 401);
    }
}
