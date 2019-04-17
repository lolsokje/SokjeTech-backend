<?php

namespace App\Http\Controllers;

use App\Services\UserService;
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
     * @param UserService $userService
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request, UserService $userService)
    {
        $this->validate($request, [
            'username' => 'required|unique:users',
            'password' => 'required',
            'password_repeat' => 'required|same:password',
            'email' => 'required'
        ]);

        $result = $userService->register($request);

        return response()->json($result);
    }

    /**
     * Logs user in.
     *
     * @param Request $request
     *
     * @param UserService $userService
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request, UserService $userService)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $result = $userService->login($request);

        return response()->json($result);
    }

    /**
     * Logs user out.
     *
     * @param Request $request
     *
     * @param UserService $userService
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function logout(Request $request, UserService $userService)
    {
        $userService->logout($request);

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
