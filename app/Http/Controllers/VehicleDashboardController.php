<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehicleDashboardController extends VehicleController
{

    public function tires(Request $request)
    {
        $tires = $this->vehicleRepo->getTireAndSensorData($request->all());
        return response()->json($tires);
    }

    public function localization(Request $request)
    {
        $data = $request->all();
        $localization = $this->vehicleRepo->getLocalizationData($data['vehicle_id']);
        return response()->json($localization);
    }

    public function fleet($update = null)
    {
        $fleetData = $this->vehicleRepo->getFleetData();
        $vehicles = $fleetData['vehicles'];
        $tireData = $fleetData['tireData'];
            
        $view = !empty($update) ? "fleet.vehicles" : "fleet.index";
        
        return view($view, compact('vehicles', 'tireData'));
    }
}