<?php

namespace App\Http\Controllers\Api;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
class ApiController extends Controller
{
    //
    public $loginAfterSignUp = true;
//    public function register(RegisterAuthRequest $request)
//    {
//        $user = new User();
//        $user->name = $request->name;
//        $user->email = $request->email;
//        $user->password = bcrypt($request->password);
//        $user->save();
//
//        if ($this->loginAfterSignUp) {
//            return $this->login($request);
//        }
//
//        return response()->json([
//            'success' => true,
//            'data' => $user
//        ], Response::HTTP_OK);
//    }

    public function register(Request $request)
    {
        $user = new User();
        $user->phone = $request->phone;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($this->loginAfterSignUp) {
            return $this->authenticate($request);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or Password',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }

    public function authenticate(Request $request)
    {
        // grab credentials from the request
        //$credentials = $request->only('email', 'password');
        // Change email to username
        $credentials = $request->only('phone', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
//        return response()->json(compact('token'));

        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function loggedUser(Request $request){

        $this->validate($request,[
            'token' => 'required'
        ]);
        $user = JWTAuth::authenticate($request->token);

        return response()-json([
                'user' => $user
            ]);
    }
}
