<?php

namespace App\Http\Controllers;

use App\Services\UniverseService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UniverseController extends Controller
{
    /**
     * Create a new universe.
     *
     * @param Request $request
     * @param UniverseService $universeService
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createUniverse(Request $request, UniverseService $universeService)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required|unique:universes'
        ]);

        $result = $universeService->createUniverse($request);

        return response()->json($result);
    }

    /**
     * Edit universe.
     *
     * @param Request $request
     * @param UniverseService $universeService
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editUniverse(Request $request, UniverseService $universeService)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => [
                'required',
                Rule::unique('universes')->ignore($request->id)
            ]
        ]);

        $result = $universeService->editUniverse($request);

        return response()->json($result);
    }

    /**
     * Return all universes belonging to user.
     *
     * @param Request $request
     * @param UniverseService $universeService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUniverses(Request $request, UniverseService $universeService)
    {
        $result = $universeService->getUniverses($request);

        return response()->json($result);
    }

    /**
     * Delete a universe.
     *
     * @param Request $request
     * @param UniverseService $universeService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUniverse(Request $request, UniverseService $universeService)
    {
        $result = $universeService->deleteUniverse($request);

        return response()->json($result);
    }
}
