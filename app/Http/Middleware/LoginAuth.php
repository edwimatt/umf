<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Lang;

class LoginAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $obj = new Controller();
        $obj->call_mode; // call mode for admin ..
        if (in_array($obj->call_mode, ['admin', 'web'])) {
            return $next($request);
        }

        $user_token = $request->header('user-token');
        $language_id = (!empty($request->header("language"))) ? $request->header('language') : 1;

        $user = User::auth($user_token);
        if (empty($user)) {
            $code = 401;
            $response = [
                'code' => $code,
                //    'success' => false,
                'message' => Lang::get('passwords.user_token'),
                'data' => [['auth' => Lang::get('passwords.user_token')]],
            ];
            return response()->json($response, $code);
        }
        elseif (!empty($user) && $user->hospital_is_active == 0) {
            $code = 401;
            $response = [
                'code' => $code,
                //    'success' => false,
                'message' => "Hospital has been deactivated.",
                'data' => [['auth' => "Hospital has been deactivated."]],
            ];
            return response()->json($response, $code);

        }elseif (!empty($user) && $user->is_active == 0) {
            $code = 401;
            $response = [
                'code' => $code,
                //    'success' => false,
                'message' => "User has been deactivated.",
                'data' => [['auth' => "User has been deactivated."]],
            ];
            return response()->json($response, $code);
        }

        if(!empty($user_token)){
            User::where("token",$user_token)->update(["language_id"=>$language_id]);
        }

        $user->language_id = $language_id;
        $request['user_id'] = $user->id;
        $request['current_language_id'] = $user->id;
        $request['user'] = $user;
        $request['gateway_user_id'] = (empty($result->gateway_user_id)) ? '' : $result->gateway_user_id;

        return $next($request);
    }
}
