<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilmlisteController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function show(Request $request, $sort_field = 'Rand', $sort_direction = 'ASC', $ajax = FALSE)
  {
    $payload = array();
    $payload['gesehen'] = $request->input('gesehen', 'beide');
    $payload['search_string'] = $request->input('search_string', '');
    $payload['director_string'] = $request->input('director_string', '');
    $payload['max_number'] = $request->input('max_number', '');
    if (!is_numeric($payload['max_number'])) { $payload['max_number'] = 20; }

    return $this->build($payload, $sort_field, $sort_direction, $ajax);
  }

  public function showAjax(Request $request, $sort_field = 'Rand', $sort_direction = 'ASC')
  {
    return $this->show($request, $sort_field, $sort_direction, TRUE);
  }

  public function check(Request $request)
  {
    $id = $request->input('id', 'NULL');
    if (is_numeric($id))
    {
      $new_value = (\App\Models\Film::find($id)['Gesehen'] == 1) ? 0 : 1;
      \App\Models\Film::where('id', $id)->update(['Gesehen' => $new_value]);
    }

    $sort_field = ''; $sort_direction = '';
    switch (substr($request->input('sort_param', 'N'), 0, 1))
    {
      case 'N':
      default:
        $sort_field = 'Name';
        break;
      case 'R':
        $sort_field = 'Regie';
        break;
      case 'J':
        $sort_field = 'Jahr';
        break;
    }
    if (substr($request->input('sort_param', 'NA'), 1, 1) == 'D')
    { $sort_direction = 'Desc'; }
    else { $sort_direction = 'Asc'; }

    return $this->showAjax($request, $sort_field, $sort_direction);
  }

  public function csrfAjax(Request $request)
  {
    return csrf_token();
  }

  private function build($payload, $sort_field, $sort_direction, $ajax)
  {
    $result = \App\Models\Film::select()->take($payload['max_number']);

    if (substr_compare($sort_field, "Rand", 0, 3, TRUE) === 0)
    { $result = $result->orderByRaw("RAND()"); }
    else { $result = $result->orderBy($sort_field, $sort_direction); }

    if (!empty($payload['director_string']))
    { $result = $result->where('Regie', 'LIKE', '%' . $payload['director_string'] . '%'); }

    if (!empty($payload['search_string']))
    { $result = $result->where('Name', 'LIKE', '%' . $payload['search_string'] . '%'); }

    if ($payload['gesehen'] !== 'beide')
    {
      if ($payload['gesehen'] == 'ja') { $result = $result->where('Gesehen', '=', 1); }
      else if ($payload['gesehen'] == 'nein') { $result = $result->where('Gesehen', '=', 0); }
    }

    $payload['result'] = $result->get();
    $payload['sort_param'] = substr($sort_field, 0, 1) . substr($sort_direction, 0, 1);

    return (($ajax) ? view('filmliste.table', $payload) : view('filmliste.index', $payload));
  }
}
