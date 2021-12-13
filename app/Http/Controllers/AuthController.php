<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;


class AuthController extends Controller
{
    // /**
    //  * Create a new AuthController instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login']]);
    // }

    // /**
    //  * Get a JWT via given credentials.
    //  *
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function login()
    // {
    //     $credentials = request(['email', 'password']);

    //     if (! $token = auth()->attempt($credentials)) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }

    //     return $this->respondWithToken($token);
    // }

    // /**
    //  * Get the authenticated User.
    //  *
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function me()
    // {
    //     return response()->json(auth()->user());
    // }

    // /**
    //  * Log the user out (Invalidate the token).
    //  *
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function logout()
    // {
    //     auth()->logout();

    //     return response()->json(['message' => 'Successfully logged out']);
    // }

    // /**
    //  * Refresh a token.
    //  *
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function refresh()
    // {
    //     return $this->respondWithToken(auth()->refresh());
    // }

    // /**
    //  * Get the token array structure.
    //  *
    //  * @param  string $token
    //  *
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // protected function respondWithToken($token)
    // {
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => auth()->factory()->getTTL() * 60
    //     ]);
    // }
    
    public function register(Request $request)
    {
        
        $validated = Validator::make($request->all(), [
            'deviceId' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        if($validated->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validated->errors()]);
        }

        $user = User::where('deviceId',$request->deviceId)->first();

        if(!$user) {
            try {
                $user = new User();
                $user->deviceId = $request->deviceId;
                // $user->email = $request->email;
                $user->password = app('hash')->make($request->password);
    
                if ($user->save()) {
                    return $this->login($request);
                }
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }

        return $this->login($request);

        // return $user;

        // $name = $request->name;
        // $deviceId = $request->deviceId;
        // $email = $request->email;
        // $password = $request->password;

        // // Check if field is empty
        // if (empty($name) or empty($email) or empty($password)) {
        //     return response()->json(['status' => 'error', 'message' => 'You must fill all the fields']);
        // }

        // // Check if email is valid
        // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //     return response()->json(['status' => 'error', 'message' => 'You must enter a valid email']);
        // }

        // // Check if password is greater than 5 character
        // if (strlen($password) < 6) {
        //     return response()->json(['status' => 'error', 'message' => 'Password should be min 6 character']);
        // }

        // // Check if user already exist
        // if (User::where('email', '=', $email)->exists()) {
        //     return response()->json(['status' => 'error', 'message' => 'User already exists with this email']);
        // }

        // Create new user
        // try {
        //     $user = new User();
        //     $user->name = $request->name;
        //     $user->deviceId = $request->deviceId;
        //     $user->email = $request->email;
        //     $user->password = app('hash')->make($request->password);

        //     if ($user->save()) {
        //         return $this->login($request);
        //     }
        // } catch (\Exception $e) {
        //     return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        // }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['status' => 'success', 'message' => 'Successfully logged out']);
    }

    public function login(Request $request)
    {
        $credentials = request(['deviceId', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);

        
        // $email = $request->email;
        // $password = $request->password;

        // // Check if field is empty
        // if (empty($email) or empty($password)) {
        //     return response()->json(['status' => 'error', 'message' => 'You must fill all the fields']);
        // }

        // $credentials = request(['email', 'password']);

        // if (!$token = auth()->attempt($credentials)) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        // return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}