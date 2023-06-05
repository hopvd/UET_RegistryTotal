<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $certificate = Certificate::all();

        return response()->json([
            'data' => $certificate,
            'status' => 'success'
        ]);
    }

    public function store(Request $request)
    {
        $certificate = new Certificate();
        $certificate->start_date = $request->input('start_date');
        $certificate->expired_date = $request->input('expired_date');
        $certificate->vehicle_id = $request->input('vehicle_id');
        $certificate->user_id = $request->input('user_id');

        $certificate->save();

        return response()->json([
            'data' => $certificate,
            'status' => 'success'
        ]);
    }

    public function show($id)
    {
        $certificate = Certificate::find($id);

        if (!$certificate) {
            return response()->json([
                'message' => 'Certificate not found',
                'status' => 'error'
            ], 404);
        }

        return response()->json([
            'data' => $certificate,
            'status' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $certificate = Certificate::find($id);

        if (!$certificate) {
            return response()->json([
                'message' => 'Certificate not found',
                'status' => 'error'
            ], 404);
        }

        $certificate->start_date = $request->input('start_date');
        $certificate->expired_date = $request->input('expired_date');
        $certificate->vehicle_id = $request->input('vehicle_id');
        $certificate->user_id = $request->input('user_id');
        $certificate->save();

        return response()->json([
            'data' => $certificate,
            'status' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $certificate = Certificate::find($id);

        if (!$certificate) {
            return response()->json([
                'message' => 'Certificate not found',
                'status' => 'error'
            ], 404);
        }

        $certificate->delete();

        return response()->json([
            'message' => 'Certificate deleted',
            'status' => 'success'
        ]);
    }
}
