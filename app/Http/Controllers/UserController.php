<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $users = User::all();

        return response()->json($users);
    }

    public function store(Request $request)
    {
        if($request->user()->usertype!=1){
            return response()->json(['message'=>'You do not have permission'],403);
        }
        try {
            $data = $request->only([
                'name',
                'username',
                'password',
                'address',
                'phone',
                'manager',
                'usertype'
            ]);

            $user = User::create($data);

            return response()->json([
                'message' => 'User created successfully',
                'user' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create user',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'status' => 'error'
            ], 404);
        }

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        if($request->user()->usertype!=1){
            return response()->json(['message'=>'You do not have permission'],403);
        }
        try {
            $data = $request->only([
                'name',
                'username',
                'password',
                'address',
                'phone',
                'manager',
                'usertype'
            ]);

            $user = User::findOrFail($id);
            $user->update($data);

            return response()->json([
                'message' => 'User updated successfully',
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Request $request,$id)
    {
        if($request->user()->usertype!=1){
            return response()->json(['message'=>'You do not have permission'],403);
        }
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'status' => 'error'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'message' => 'User deleted',
            'status' => 'success'
        ]);
    }
}
