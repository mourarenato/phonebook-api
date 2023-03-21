<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function signup(Request $request)
    {
        try {
            $data = $request->only('email', 'password');

            $validator = Validator::make($data, [
                'email' => 'required|email',
                'password' => 'required|string|min:6|max:50'
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors());
            }

            $userEmail = User::where('email', $request->email)->get();

            if (!empty($userEmail[0])) {
                throw new Exception('User already exists!');
            }

            User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not created. Invalid data',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function signin(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            $validator = Validator::make($credentials, [
                'email' => 'required|email',
                'password' => 'required|string|min:6|max:50'
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors());
            }

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Login credentials are invalid',
                ], 400);
            }

            return response()->json([
                'success' => true,
                'token' => $token
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Could not create token',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function signout(Request $request)
    {
        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out',
                'errors' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
