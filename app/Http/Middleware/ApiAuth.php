<?php

namespace App\Http\Middleware;

use App\Models\ApiUser;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;

class ApiAuth
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
        // get api user from header
        $token = $request->header('Token');
        $token = md5(Config::get('constants.APP_SALT').$token);

        if(!ApiUser::api_auth($token)){
            $code = 403;
            $response = [
                'code' => $code,
                //    'success' => false,
                'message' => Lang::get('auth.failed'),
                'data' => [['auth' => Lang::get('auth.failed')]],
            ];
            return response()->json($response, $code);
        }

        return $next($request);
    }
}