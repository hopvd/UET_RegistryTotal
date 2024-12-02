<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    protected $_data;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->_data = new Certificate();
    }

    public function index()
    {
        $certificate = $this->_data->select(
            ['certificates.id',
            'certificates.start_date',
            'certificates.expired_date',
            'vehicles.model',
            'users.name',
            'certificates.created_at',
            'certificates.updated_at']
        )
            ->join('vehicles', 'certificates.vehicle_id', '=', 'vehicles.id')
            ->join('users', 'certificates.user_id', '=', 'users.id')
            ->get();

        return response()->json($certificate);
    }

    public function getList(Request $request)
    {
        $certificate = $this->_data->getData($request->input());
//        dd($certificate);

        return response()->json($certificate);
    }

    public function store(Request $request)
    {
        $certificate = new Certificate();
        $certificate->start_date = $request->input('start_date');
        $certificate->expired_date = $request->input('expired_date');
        $certificate->vehicle_id = $request->input('vehicle_id');
        $certificate->user_id = $request->input('user_id');

        $certificate->save();

        return response()->json($certificate);
    }

    public function show($id)
    {
        $certificate = $this->_data->findById($id);

        if (!$certificate) {
            return response()->json([
                'message' => 'Certificate not found',
                'status' => 'error'
            ], 404);
        }

        return response()->json($certificate);
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

        return response()->json($certificate);
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
