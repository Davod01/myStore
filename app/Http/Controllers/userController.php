<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function index()
    {
        return response()->json(User::with(['orders'])->get());
    }


    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
        }

        return response()->json(['error' => 'login_error'], 401);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userName' => 'required|string|min:3|max:30',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'password_confirmation' => 'confirmed'

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = new User;
        $user['name'] = $request['userName'];
        $user['email'] = $request['email'];
        $user['password'] = Hash::make($request['password']);
        $user['role'] = 1;
        $user->save();

        return response()->json(['status' => 'success','user' => $user], 200);
    }

    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }


    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }


    private function guard()
    {
        return Auth::guard();
    }



    public function show(User $user)
    {
        return response()->json($user);
    }





    public function showOrders(User $user)
    {
        return response()->json($user->orders()->with(['product'])->get());
    }


    public function dashboard()
    {
        return response()->json([
            'this is dashboard'
        ], 200);
    }
}
