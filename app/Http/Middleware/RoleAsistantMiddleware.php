<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 17/03/16
 * Time: 05:49 PM
 */


namespace Salesfly\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleAsistantMiddleware
{
    public function handle($request, Closure $next)
    {
        $role = Auth()->user()->role_id;
        if($role == 1 || $role == 3){
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
