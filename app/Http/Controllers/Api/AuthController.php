<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));

        /*$authData = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($authData)) {
            return [
                'success' => true,
            ];
        }
        return [
            'success' => false,
        ];*/
    }

    /**
     * РђРІС‚РѕСЂРёР·РѕРІР°РЅ Р»Рё РїРѕР»СЊР·РѕРІР°С‚РµР»СЊ.
     *
     * @return Response
     */
    public function logged(Request $request)
    {
      try {
    		if (!$user = JWTAuth::parseToken()->authenticate()) {
    			return response()->json(['user_not_found'], 404);
    		}
    	} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
    		return response()->json(['token_expired'], $e->getStatusCode());
    	} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
    		return response()->json(['token_invalid'], $e->getStatusCode());
    	} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
    		return response()->json(['token_absent'], $e->getStatusCode());
    	}
    	// the token is valid and we have found the user via the sub claim
    	return response()->json(compact('user'));
    }
}