<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $owner = Owner::all();

        return response()->json([
            'data' => $owner,
            'status' => 'success'
        ]);
    }

    public function store(Request $request)
    {
        $owner = new Owner();
        $owner->name = $request->input('name');
        $owner->address = $request->input('address');
        $owner->phone = $request->input('phone');
        $owner->email = $request->input('email');
        $owner->owner_type = $request->input('owner_type');
        $owner->location = $request->input('location');

        $owner->save();

        return response()->json([
            'data' => $owner,
            'status' => 'success'
        ]);
    }

    public function show($id)
    {
        $owner = Owner::find($id);

        if (!$owner) {
            return response()->json([
                'message' => 'Owner not found',
                'status' => 'error'
            ], 404);
        }

        return response()->json([
            'data' => $owner,
            'status' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $owner = Owner::find($id);

        if (!$owner) {
            return response()->json([
                'message' => 'Owner not found',
                'status' => 'error'
            ], 404);
        }

        $owner->name = $request->input('name');
        $owner->address = $request->input('address');
        $owner->phone = $request->input('phone');
        $owner->email = $request->input('email');
        $owner->owner_type = $request->input('owner_type');
        $owner->location = $request->input('location');
        $owner->save();

        return response()->json([
            'data' => $owner,
            'status' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $owner = Owner::find($id);

        if (!$owner) {
            return response()->json([
                'message' => 'Owner not found',
                'status' => 'error'
            ], 404);
        }

        $owner->delete();

        return response()->json([
            'message' => 'Owner deleted',
            'status' => 'success'
        ]);
    }

}
