<?php

namespace Salesfly\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class MultiWarehouseProductsTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //var_dump($next);
        //die();
        //return view('middleware');
        //return $next($request);
        $response = $next($request);
        //$request->session()->flash('nextResponseMiddleware', $response);
        //return $response;
        //return view('middleware');
        //return $request;
        //$request->all();
        //dd($request->path());

        if(count($request->all())>0){
            return $response;
        }else{
            return view('middleware',['request' => $request->path()]);
        }

        //return view('stores.index');
        //throw new HttpException(503);
    }
}
