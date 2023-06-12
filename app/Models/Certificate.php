<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Certificate extends Model
{
    use HasFactory;

    public function getData($request)
    {
        $certificate = DB::table('certificates')
            ->join('users', 'certificates.user_id', '=', 'users.id')
            ->join('vehicles', 'certificates.vehicle_id', '=', 'vehicles.id')
            ->select('certificates.*', 'users.name', 'users.address', 'vehicles.license_plate', 'vehicles.location', 'vehicles.brand', 'vehicles.model', 'vehicles.version', 'vehicles.purpose_of_use');
        if (!empty($request['start_date'])) {
            list($start_date_from, $start_date_to) = explode('/', $request['start_date']);

            $certificate->where([
                ['start_date', '>=', $start_date_from],
                ['start_date', '<=', $start_date_to]
            ]);
        }
        if (!empty($request['expired_date'])) {
            list($expired_date_from, $expired_date_to) = explode('/', $request['expired_date']);

            $certificate->where([
                ['expired_date', '>=', $expired_date_from],
                ['expired_date', '<=', $expired_date_to]
            ]);
        }
        if (!empty($request['user_id'])) {
            $certificate->where('user_id', '=', $request['user_id']);
        }
        if (!empty($request['location'])) {
            $certificate->where('location', '=', $request['location']);
        }
        if (!empty($request['month_of_expried'])) {
            $certificate->whereMonth('expired_date', $request['month_of_expired']);
        }
        if (!empty($request['year_of_expired'])) {
            $certificate->whereYear('expired', $request['year_of_expired']);
        }


//        dd($certificate->get());
        return $certificate->get();
    }

    public function findById($id)
    {
        $certificate = DB::table('certificates')
            ->join('users', 'certificates.user_id', '=', 'users.id')
            ->join('vehicles', 'certificates.vehicle_id', '=', 'vehicles.id')
            ->select('certificates.*', 'users.name', 'users.address', 'vehicles.license_plate', 'vehicles.location', 'vehicles.brand', 'vehicles.model', 'vehicles.version', 'vehicles.purpose_of_use', 'vehicles.owner_id')
            ->where('certificates.id', '=', $id)
            ->get();
        return $certificate;
    }
}
