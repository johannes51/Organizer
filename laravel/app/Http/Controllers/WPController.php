<?php

namespace App\Http\Controllers;

use App\Http\Resources\WPResource;
use App\Models\Project;
use App\Models\WP;
use Illuminate\Http\Request;

class WPController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateWp($request, true);

        $pro = Project::find($validatedData["project_id"]);
        $wp = new WP();

        $wp->number = $validatedData["number"];
        if (array_key_exists("name", $validatedData)) {$wp->name = $validatedData["name"];}
        if (array_key_exists("start", $validatedData)) {$wp->start = $validatedData["start"];}
        if (array_key_exists("duration", $validatedData)) {$wp->duration = $validatedData["duration"];}
        if (array_key_exists("objectives", $validatedData)) {$wp->objectives = $validatedData["objectives"];}
        if (array_key_exists("inputs", $validatedData)) {$wp->inputs = $validatedData["inputs"];}
        if (array_key_exists("outputs", $validatedData)) {$wp->outputs = $validatedData["outputs"];}
        if (array_key_exists("tasks", $validatedData)) {$wp->tasks = $validatedData["tasks"];}
        if (array_key_exists("results", $validatedData)) {$wp->results = $validatedData["results"];}

        if ($pro->wps()->save($wp)) {
            return new WPResource($wp);
        } else {
            return response('Error 500', 500);
        }
    }

    public function show($id)
    {
        return WPResource::collection(Project::find($id)->wps()->get());
    }

    public function update(Request $request, WP $wp)
    {
        $validatedData = $this->validateWp($request);

        if (array_key_exists("name", $validatedData)) {$wp->name = $validatedData["name"];}
        if (array_key_exists("start", $validatedData)) {$wp->start = $validatedData["start"];}
        if (array_key_exists("duration", $validatedData)) {$wp->duration = $validatedData["duration"];}
        if (array_key_exists("objectives", $validatedData)) {$wp->objectives = json_encode($validatedData["objectives"]);}
        if (array_key_exists("inputs", $validatedData)) {$wp->inputs = json_encode($validatedData["inputs"]);}
        if (array_key_exists("outputs", $validatedData)) {$wp->outputs = ($validatedData["outputs"]);}
        if (array_key_exists("tasks", $validatedData)) {$wp->tasks = json_encode($validatedData["tasks"]);}
        if (array_key_exists("results", $validatedData)) {$wp->results = json_encode($validatedData["results"]);}

        if ($wp->save()) {
            return new WPResource($wp);
        } else {
            return response('Error 500', 500);
        }
    }

    public function destroy(WP $wp)
    {
        //
    }

    private function validateWp($request, $withProjectId = false)
    {
        return $request->validate([
            "project_id" => "integer" . ($withProjectId ? "|required" : ""),
            "number" => "required|integer|between:1000,9999",
            "name" => "string",
            "start" => "date",
            "duration" => "numeric|between:0.5,99.5",
            "objectives" => "json",
            "inputs" => "json",
            "outputs" => "json",
            "tasks" => "json",
            "results" => "json",
        ]);
    }
}
