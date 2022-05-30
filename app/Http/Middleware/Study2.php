<?php

namespace App\Http\Middleware;

use App\Models\Article;
use Closure;
use http\Env\Response;
use Illuminate\Http\Request;


class Study2
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        //$request->session()->flush();
        /*if ($request->input('token') === 'my-secret-token') {
            return response('work/api/article',2024);
        }*/

        $response = $next($request);

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
