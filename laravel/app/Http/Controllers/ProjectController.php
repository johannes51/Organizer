<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        return ProjectResource::collection(Project::where('status', '!=', 'Beendet')->where('status', '!=', 'Abgebrochen')->get());
    }

    public function show(Project $project)
    {
        return new ProjectResource($project->load(['diary', 'diary.entries', 'wps']));
    }

    // public function store(Request $request)
    // {
    // }

    // public function update(Request $request, Project $project)
    // {
    // }
}
