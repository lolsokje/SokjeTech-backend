<?php

namespace App\Http\Controllers;

use App\Services\SeriesService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SeriesController extends Controller
{
    /**
     * Creates a new series.
     *
     * @param Request $request
     * @param SeriesService $seriesService
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
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

    /**
     * Edits a series.
     *
     * @param Request $request
     * @param SeriesService $seriesService
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editSeries(Request $request, SeriesService $seriesService)
    {
        $this->validate($request, [
            'id' => 'required',
            'user_id' => 'required',
            'name' => [
                'required',
                Rule::unique('series')->ignore($request->id)
            ]
        ]);

        $result = $seriesService->editSeries($request);

        return response()->json($result);
    }

    /**
     * Returns all series.
     *
     * @param Request $request
     * @param SeriesService $seriesService
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getSeries(Request $request, SeriesService $seriesService)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $result = $seriesService->getSeries($request);

        return response()->json($result);
    }

    /**
     * Deletes a series.
     *
     * @param Request $request
     * @param SeriesService $seriesService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteSeries(Request $request, SeriesService $seriesService)
    {
        $result = $seriesService->deleteSeries($request);

        return response()->json($result);
    }
}
