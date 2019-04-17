<?php

namespace App\Services;

use App\Universe;
use App\User;
use Illuminate\Http\Request;

class UniverseService
{
    /**
     * Creates a new universe.
     *
     * @param Request $request
     *
     * @return array
     */
    public function createUniverse(Request $request)
    {
        $user = User::find($request->id);

        if (!$user) {
            return [
                'success' => false,
                'message' => 'User doesn\'t exist'
            ];
        }

        $universe = Universe::create([
            'name' => $request->name
        ]);

        $universe->user()->associate($user);

        $universe->save();

        return [
            'success' => true
        ];
    }

    /**
     * Edit universe.
     *
     * @param Request $request
     *
     * @return array
     */
    public function editUniverse(Request $request)
    {
        $universe = Universe::find($request->id);

        if (!$universe) {
            return [
                'success' => false,
                'message' => 'Couldn\'t find universe'
            ];
        }

        $universe->name = $request->name;

        $universe->save();

        return [
            'success' => true
        ];
    }

    /**
     * Returns all universes belonging to user.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function getUniverses(Request $request)
    {
        $universes = Universe::where('user_id', $request->user_id)->get();

        return $universes;
    }

    /**
     * Deletes a universe.
     *
     * @param Request $request
     *
     * @return array
     */
    public function deleteUniverse(Request $request)
    {
        $universe = Universe::find($request->id);

        if (!$universe) {
            return [
                'success' => false,
                'message' => 'Universe not found.'
            ];
        }

        $universe->delete();

        return [
            'success' => true
        ];
    }
}
