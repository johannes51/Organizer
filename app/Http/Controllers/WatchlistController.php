<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class WatchlistController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request, $sort_field = 'Name', $sort_direction = 'Asc', $ajax = FALSE)
  {
    $payload = array();
    $payload['typen'] = $request->input('typen', [ 'Buch', 'Serie', 'Film', 'Spiel']);

    $payload['sort_param'] = $sort_field . '/' . $sort_direction;

    $result = \App\Models\PlannedMedium::select();
    foreach ($payload['typen'] as $key => $value) {
      $result = $result->orWhere('Typ', 'LIKE', '%' . $value . '%');
    }
    $payload['result'] = $result->orderBy('Typ')->orderBy($sort_field, $sort_direction)->get();

    $payload['request'] = $request;

    return ($ajax) ? view('watchlist.table', $payload) : view('watchlist.home', $payload);
  }

  public function indexAjax(Request $request, $sort_field = 'Name', $sort_direction = 'Asc')
  {
    return $this->index($request, $sort_field, $sort_direction, TRUE);
  }

  public function addProcess(Request $request)
  {
    if ( $request->has('name') && $request->has('autor') && $request->has('typ') )
    {
      \App\Models\PlannedMedium::insert([ 'Name' => $request->input('name'),
                            'Autor' => $request->input('autor'),
                            'Typ' => $request->input('typ')
                          ]);
    }
    return redirect('/watchlist/list');
  }

  public function delete(Request $request, $sort_field = 'Name', $sort_direction = 'ASC')
  {
    if (is_numeric($request->input('id', NAN)))
    {
      $set = \App\Models\PlannedMedium::find($request->input('id', NAN));
      if (isset($set)) { $set->delete(); }
    }
    return redirect('/watchlistAj/list/' . $sort_field . '/' . $sort_direction);
  }
}
