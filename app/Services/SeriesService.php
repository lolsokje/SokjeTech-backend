<?php

namespace App\Services;

use App\Series;
use App\Universe;
use App\User;
use Illuminate\Http\Request;

class SeriesService
{
    /**
     * Creates a new series.
     *
     * @param Request $request
     *
     * @return array
     */
    public function createSeries(Request $request)
    {
        $user = User::find($request->uid);
        $universe = null;

        if (!$user) {
            return [
                'success' => false,
                'message' => 'User not found'
            ];
        }

        $series = Series::create([
            'name' => $request->name
        ]);

        $series->user()->associate($user);

        if ($request->universe) {
            $universe = Universe::find($request->universe);

            if (!$universe) {
                return [
                    'success' => false,
                    'message' => 'Universe not found'
                ];
            } else {
                $series->universe()->associate($universe);
            }
        }

        $series->save();

        return [
            'success' => true
        ];
    }

    /**
     * Edits a series.
     *
     * @param Request $request
     *
     * @return array
     */
    public function editSeries(Request $request)
    {
        $series = Series::find($request->id);

        if (!$series) {
            return [
                'success' => false,
                'message' => 'Series not found.'
            ];
        }

        $series->name = $request->name;
        $series->save();

        return [
            'success' => true
        ];
    }

    /**
     * Returns all series
     *
     * @param Request $request
     *
     * @return array
     */
    public function getSeries(Request $request)
    {
        $user = User::find($request->id);

        if (!$user) {
            return [
                'success' => false,
                'message' => 'User not found'
            ];
        }

        $series = $user->series;

        // TODO Return required extra data such as universe information.
        return $series;
    }

    /**
     * Deletes a series.
     *
     * @param Request $request
     *
     * @return array
     */
    public function deleteSeries(Request $request)
    {
        $series = Series::find($request->id);

        if (!$series) {
            return [
                'success' => false,
                'message' => 'Series not found.'
            ];
        }

        $series->delete();

        return [
            'success' => true
        ];
    }
}
