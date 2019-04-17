<?php

namespace App\Http\Controllers;

use App\Services\SeriesService;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function createSeries(Request $request, SeriesService $seriesService)
    {
        $this->validate($request, [
            'name' => 'required',
            'uid' => 'required',
            'universe' => 'nullable'
        ]);

        $result = $seriesService->createSeries($request);

        return response()->json($result);
    }

    public function getSeries(Request $request, SeriesService $seriesService)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $result = $seriesService->getSeries($request);

        return response()->json($result);
    }
}
