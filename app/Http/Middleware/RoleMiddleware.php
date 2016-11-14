<?php

namespace Salesfly\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    protected $roles; //ADMIN !!

    //public function __construct($roles){
    //    $this->$roles = $roles;
    //}
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //print_r($this->roles); die();
        //$role = $request->input('prefix');
        //$roles = $this->getRequiredRoleForRoute($request->route());

        // Check if a role is required for the route, and
        // if so, ensure that the user has that role.
        //if($request->user()->hasRole($roles) || !$roles)
        //if($request->input('admin') == 'admin')
        //{
        if(Auth()->user()->role_id == 1){
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
