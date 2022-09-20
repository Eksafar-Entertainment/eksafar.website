<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AccessLog;

class AccessLogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $access_log = new AccessLog();
        $access_log->serve = $request->server('SERVER_ADDR') ?? "";
        $access_log->host = $request->getHost() ?? "";
        $access_log->uri = $request->getPathInfo()?? "";
        $access_log->method = $request->getMethod()??"";
        $access_log->request = serialize($request->all())??"";
        $access_log->save();
        return $next($request);
    }
}
