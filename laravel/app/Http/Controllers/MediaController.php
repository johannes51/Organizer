<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Film;
use App\Http\Resources\FilmResource;

class MediaController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request)
  {
      return FilmResource::collection(Film::all());
  }

  public function update(Request $request, $filmId)
  {
    $film = Film::find($filmId);
    if (!isset($film)) {
      return response('Error 500', 500);
    }
    $film->Status = $request->input('Status', '');
    if (!$film->save()) {
        return response('Error 500', 500);
    }
    return "Reload";
  }
}
