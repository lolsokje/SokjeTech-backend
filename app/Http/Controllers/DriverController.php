<?php

namespace App\Http\Controllers;

use App\Services\DriverService;
use Illuminate\Http\Request;

class DriverController extends Controller
{

    public function createDriver(Request $request, DriverService $driverService)
    {
        $result = $driverService->createDriver($request);

        return response()->json($result);
    }

    public function editDriver(Request $request, DriverService $driverService)
    {
        $result = $driverService->editDriver($request);

        return response()->json($result);
    }

    public function deleteDriver(Request $request, DriverService $driverService)
    {
        $result = $driverService->deleteDriver($request);

        return response()->json($result);
    }

    public function getDrivers(Request $request, DriverService $driverService)
    {
        $result = $driverService->getDrivers($request);

        return response()->json($result);
    }
}
