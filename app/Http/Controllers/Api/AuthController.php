<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    use HasApiTokens;

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    //  public function __construct(){
    //     $this->login_max_attempt = config('config.login_max_attempt');
    //     $this->token_expiry = config('config.token_expiry');
    //   }
  
    //   private function generate_access_token($query){
    //     $access = $query->createToken(date('Y-m-d h:i:s').'-'.$query->email);
    //     // Manually set the expiration time
    //     // $newExpiration = now()->addSeconds(30);
    //     $newExpiration = now()->addDays($this->token_expiry);
    //     $access->token->expires_at = $newExpiration;
    //     $access->token->save();
    //     // returns array_object to use arrow operator -> instead of accessing it by keys.
    //     return (object) array('access_token' => $access->accessToken, 'token_expiry' => $access->token->expires_at);
    //   }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            // throw ValidationException::withMessages([
            //     'email' => __('auth.failed'),
            // ]);
            return response()->json([
                'status' => 'failed',
                'message' => 'Login failed',
                'access_token' => $token,
                'user' => $user,
            ], 500);
        }

        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;


        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'access_token' => $token,
            'user' => $user,
        ], 200);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $user_id = $request->user_id;
        $temp =  DB::table('personal_access_tokens')
        ->where('tokenable_id', $user_id)
        ->update(['expires_at' => date("Y/m/d H:i:s")]);

        if ($temp > 0) {
            return response()->json([
                'status' => 'success',
                'message' => 'Logged out successfully.',
            ], 200);
        }else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Logged out failed.',
            ], 200);
        }
    }
}
