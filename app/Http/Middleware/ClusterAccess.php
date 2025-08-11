<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClusterAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if ($user && $user->hasRole('cluster_admin')) {
            // inject cluster_id ke request input (mudah dipakai di controller)
            $request->merge(['cluster_id' => $user->cluster_id]);
        }
        return $next($request);
    }
}
