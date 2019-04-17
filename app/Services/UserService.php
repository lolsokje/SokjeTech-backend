<?php

namespace App\Services;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Lcobucci\JWT\Parser;

class UserService
{
    /**
     * Registers a new user.
     *
     * @param Request $request
     *
     * @return array
     */
    public function register(Request $request)
    {
        $user = User::create([
            'username' => $request->username,
            'password' => app('hash')->make($request->password),
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name
        ]);

        if ($user) {
            return [
                'success' => true
            ];
        }
        return [
            'success' => false,
            'message' => 'Something went wrong during registration, please try again.'
        ];
    }

    /**
     * Logs user in.
     *
     * @param Request $request
     *
     * @return array
     */
    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return [
                'success' => false,
                'message' => 'A user with these credentials doesn\'t exist'
            ];
        }

        if (!Hash::check($request->password, $user->password)) {
            return [
                'success' => false,
                'message' => 'Wrong password'
            ];
        }

        $token = $user->createToken('Laravel Password Grand Client')->accessToken;
        return [
            'success' => true,
            'token' => $token,
            'user_id' => $user->id
        ];
    }

    /**
     * Logs user out.
     *
     * @param Request $request
     */
    public function logout(Request $request)
    {
        $value = $request->bearerToken();
        $id = (new Parser())->parse($value)->getHeader('jti');
        $token = $request->user()->tokens->find($id);
        $token->revoke();
    }
}
