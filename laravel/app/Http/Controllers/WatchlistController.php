<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PlannedMediumResource;
use App\Models\PlannedMedium;

use App\Http\Requests;

class WatchlistController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request)
  {
    return PlannedMediumResource::collection(PlannedMedium::all());
  }

  public function store(Request $request)
  {
    $plannedMedium = new PlannedMedium;
    $plannedMedium->Name = $request->input('name', '');
    $plannedMedium->Autor = $request->input('author', '');
    $plannedMedium->Typ = $request->input('type', 'Buch');
    if ($plannedMedium->Name != '' && $plannedMedium->Autor != '') {
        if ($plannedMedium->save()) {
            return "Reload";
        } else {
            return response('Error 500', 500);
        }
    } else {
        return response('Error 400', 400);
    }
  }

  public function destroy($id)
  {
    PlannedMedium::find($id)->delete();
    return "Reload";
  }
}
