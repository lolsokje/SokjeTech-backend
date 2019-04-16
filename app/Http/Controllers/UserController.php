<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Lcobucci\JWT\Parser;

class UserController extends Controller
{
    /**
     * Register a new user.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users',
            'password' => 'required',
            'password_repeat' => 'required|same:password',
            'email' => 'required'
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => app('hash')->make($request->password),
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name
        ]);

        if ($user) {
            return response()->json([
                'success' => true
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong during registration, please try again.'
        ]);
    }

    /**
     * Logs user in.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'A user with these credentials doesn\'t exist'
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Wrong password'
            ]);
        }

        $token = $user->createToken('Laravel Password Grand Client')->accessToken;
        return response()->json([
            'success' => true,
            'token' => $token,
            'user_id' => $user->id
        ]);
    }

    /**
     * Logs user out.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function logout(Request $request)
    {
        $value = $request->bearerToken();
        $id = (new Parser())->parse($value)->getHeader('jti');
        $token = $request->user()->tokens->find($id);
        $token->revoke();

        return response('You\'ve successfully been logged out.', 200);
    }

    public function getUser(Request $request)
    {
        $id = $request->id;

        $user = User::find($id);

        if ($user) {
            return response()->json([
                'id' => $id,
                'username' => $user->username,
                'email' => $user->email
            ], 200);
        }
        return response()->json([
            'message' => 'User not found.'
        ], 404);
    }
}
