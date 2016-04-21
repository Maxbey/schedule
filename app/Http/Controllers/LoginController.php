<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'Could not create token'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->success(['token' => $token]);
    }

    public function authorizedUser()
    {
      try
      {
          $user = JWTAuth::parseToken()->authenticate();
      }
      catch(JWTException $e)
      {
          return response()->json(['error' => 'Invalid token'], Response::HTTP_UNAUTHORIZED);
      }

      return response()->json(['data' => $user], 200);
    }
}
