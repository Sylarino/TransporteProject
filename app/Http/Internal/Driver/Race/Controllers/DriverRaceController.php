<?php

namespace App\Http\Internal\Driver\Race\Controllers;

use App\Domain\Internal\Driver\Driver;
use App\Domain\Internal\Races\RaceLog;
use App\Exports\Internal\Admin\AllTransportExport;
use App\Http\Internal\Driver\Race\Requests\DriverRaceRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\App\Controllers\Controller;
use Excel;


class DriverRaceController extends Controller
{
    public function createRace(DriverRaceRequest $request,$id)
    {
        $start_time = $request->start_time_hour.':'.$request->start_time_minutes;
        $end_time = $request->end_time_hour.':'.$request->end_time_minutes;
        if(strtotime(Carbon::now()->toDateString().' '.$start_time.':00' > strtotime(Carbon::now()->toDateString().' '.$end_time.':00'))) {
            return response()->json(['errors',['start_time_hour' => 'La hora de inicio debe ser menor que la de termino.']],422);
        }
        if ($request->from_id == '' && $request->from_text == '') {
           return response()->json(['errors',['from_id' => 'Debe Seleccionar origen o escribir el origen.']],422);
        }
        if ($request->to_id == '' && $request->to_text == '') {
            return response()->json(['errors',['to_id' => 'Debe Seleccionar destino o escribir el destino.']],422);
        }
        $driver = Driver::find($id);
        $driver_shift = $driver->hasShiftCreated();
        if ($driver_shift) {
            if(RaceLog::create([
                'driver_shift_id' => $driver_shift->id,
                'patent' => $driver_shift->mobile->patent,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'from_id' => $request->from_id,
                'from_text' => $request->from_text,
                'to_id' => $request->to_id,
                'to_text' => $request->to_text,
                'passengers_count' => $request->passengers_count,
                'passengers' => $request->passengers,
                'start_mileage' => $request->start_mileage,
                'end_mileage' => $request->end_mileage,
                'observations' => $request->observations
            ])) {
                return $this->getResponse('success.store');
            } else{
                return $this->getResponse('error.store');
            }
        } else {
            return response()->json(['error' => 'No puede crear carreras fuera del turno.'],401);
        }
    }

    public function index()
    {

        return view('internal.driver.races.admin');
    }

    public function export()
    {
        return Excel::download(new AllTransportExport, 'Transportes_listado_'.Carbon::now()->toDateString().'.xlsx');
    }
}
