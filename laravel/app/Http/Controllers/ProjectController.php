<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Project::select('id', 'Name', 'Customer', 'Status', 'created_at')->orderBy('created_at', 'DESC')->get();

        return response()->json(["projects" => $result]);
    }

    public function show(Project $project)
    {
        $payload = array();
        $payload['diary'] = array();
        $payload['project'] = array();

        $payload['project']['id'] = $project->id;
        $payload['project']['Name'] = $project->Name;
        $payload['project']['Customer'] = $project->Auftraggeber;
        $payload['project']['Status'] = $project->Status;
        $payload['project']['created'] = $project->created_at->timezone('Europe/Berlin');
        $payload['project']['updated'] = $project->updated_at->timezone('Europe/Berlin');

        $diary = $project->diary()->with('entries')->get()[0];

        $payload['diary']['id'] = $diary->id;
        $payload['diary']['result'] = $diary->entries()->orderBy('created_at', 'DESC')->get();

        return response()->json($payload);
    }

    // public function store(Request $request)
    // {
    // }

    // public function update(Request $request, Project $project)
    // {
    // }
}
