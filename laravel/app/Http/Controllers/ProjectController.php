<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request)
  { 
    $payload = array();

    $result = \App\Models\Project::select('id', 'Name', 'Auftraggeber', 'Status', 'created_at');
    
    $payload['result'] = $result->orderBy('created_at', 'DESC')->get();
    foreach ($payload['result'] as $value) {
      $value->created_at = $value->created_at->timezone('Europe/Berlin');
    }

    return view('projects.index', $payload);
  }

  public function show(Request $request, \App\Models\Project $project)
  {
  	$payload = array();
  	$payload['diaryPayload'] = array();
  	$payload['summaryPayload'] = array();

  	$payload['summaryPayload']['Name'] = $project->Name;
  	$payload['summaryPayload']['Auftraggeber'] = $project->Auftraggeber;
  	$payload['summaryPayload']['Status'] = $project->Status;
  	$payload['summaryPayload']['created'] = $project->created_at->timezone('Europe/Berlin');
  	$payload['summaryPayload']['updated'] = $project->updated_at->timezone('Europe/Berlin');

    $diary = $project->diary()->with('entries')->get()[0];
    
    $payload['diaryPayload']['projectId'] = $project->id;
    $payload['diaryPayload']['diaryId'] = $diary->id;
  	$payload['diaryPayload']['result'] = $diary->entries()->orderBy('created_at', 'DESC')->get();
    foreach ($payload['diaryPayload']['result'] as $value) {
      $value->created_at = $value->created_at->timezone('Europe/Berlin');
    }

  	return view('projects.show', $payload);
  }
 
  public function diary(\App\Models\DiaryEntry $diaryEntry)
  {
    $payload = array();
    $payload['entry'] = array();
    $payload['entry']['created'] = $diaryEntry->created_at->timezone('Europe/Berlin');
    $payload['entry']['updated'] = $diaryEntry->updated_at->timezone('Europe/Berlin');
    $payload['entry']['text'] = $diaryEntry->Text;

    $payload['entry']['referrer'] = '/projects/show/' . $diaryEntry->diary->project->id;;

    return view('diary.show', $payload);
  }
}
