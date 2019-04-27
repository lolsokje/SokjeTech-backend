<?php

namespace App\Http\Controllers;

use App\Services\TeamService;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function createTeam(Request $request, TeamService $teamService)
    {
        $result = $teamService->createTeam($request);

        return response()->json($result);
    }

    public function editTeam(Request $request, TeamService $teamService)
    {
        $result = $teamService->editTeam($request);

        return response()->json($result);
    }

    public function deleteTeam(Request $request, TeamService $teamService)
    {
        $result = $teamService->deleteTeam($request);

        return response()->json($result);
    }

    public function getTeams(Request $request, TeamService $teamService)
    {
        $result = $teamService->getTeams($request);

        return response()->json($result);
    }
}
