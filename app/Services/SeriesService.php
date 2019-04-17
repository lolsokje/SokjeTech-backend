<?php

namespace App\Services;

use App\Series;
use App\Universe;
use App\User;
use Illuminate\Http\Request;

class SeriesService
{
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

        if ($request->universe) {
            $universe = Universe::find($request->universe);

            if (!$universe) {
                return [
                    'success' => false,
                    'message' => 'Universe not found'
                ];
            }
        }

        $series = Series::create([
            'name' => $request->name
        ]);

        $series->user()->associate($user);

        if ($universe) {
            $series->universe()->associate($universe);
        }

        $series->save();

        return [
            'success' => true
        ];
    }

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
}
