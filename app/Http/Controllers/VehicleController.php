<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;


class VehicleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $vehicle = Vehicle::all();

        return response()->json([
            'data' => $vehicle,
            'status' => 'success'
        ]);
    }

    public function store(Request $request)
    {
        $vehicle = new Vehicle();
        $vehicle->license_plate = $request->input('license_plate');
        $vehicle->location = $request->input('location');
        $vehicle->brand = $request->input('brand');
        $vehicle->model = $request->input('model');
        $vehicle->version = $request->input('version');
        $vehicle->purpose_of_use = $request->input('purpose_of_use');
        $vehicle->owner_id = $request->input('owner_id');

        $vehicle->save();

        return response()->json([
            'data' => $vehicle,
            'status' => 'success'
        ]);
    }


    public function show($id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json([
                'message' => 'Vehicle not found',
                'status' => 'error'
            ], 404);
        }

        return response()->json([
            'data' => $vehicle,
            'status' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json([
                'message' => 'Vehicle not found',
                'status' => 'error'
            ], 404);
        }

        $vehicle->license_plate = $request->input('license_plate');
        $vehicle->location = $request->input('location');
        $vehicle->brand = $request->input('brand');
        $vehicle->model = $request->input('model');
        $vehicle->version = $request->input('version');
        $vehicle->purpose_of_use = $request->input('purpose_of_use');
        $vehicle->owner_id = $request->input('owner_id');
        $vehicle->save();

        return response()->json([
            'data' => $vehicle,
            'status' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json([
                'message' => 'Vehicle not found',
                'status' => 'error'
            ], 404);
        }

        $vehicle->delete();

        return response()->json([
            'message' => 'Vehicle deleted',
            'status' => 'success'
        ]);
    }
}
