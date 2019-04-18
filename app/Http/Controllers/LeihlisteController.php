<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeihlisteController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request)
  {
  	$payload = array();

    $result = 
    	\App\Models\Leihgabe::select('id', 'Item', 'Gegner', 'Richtung', 'created_at')->where('deleted_at', '=', NULL);
    $payload['result'] = $result->orderBy('created_at', 'DESC')->get();
    foreach ($payload['result'] as $key => $value) {
      $value->created_at = $value->created_at->timezone('Europe/Berlin');
    }

    return view('leihliste.index', $payload);
  }

  public function edit(\App\Models\Leihgabe $leihgabe = NULL)
  {
  	$payload = array();

  	if ($leihgabe != NULL) {
  		$payload['id'] = $leihgabe->id;
  		$payload['Item'] = $leihgabe->Item;
  		$payload['Gegner'] = $leihgabe->Gegner;
  		$payload['Richtung'] = $leihgabe->Richtung;
    	$payload['created'] = $leihgabe->created_at->timezone('Europe/Berlin');
    	$payload['Erledigt'] = ($leihgabe->deleted_at != NULL);
  	} else {
  		$payload['Item'] = '';
  		$payload['Gegner'] = '';
  		$payload['Richtung'] = 'verliehen';
  	}
  	return view('leihliste.edit', $payload);
  }

  public function save(Request $request, \App\Models\Leihgabe $leihgabe = NULL)
  {
  	if ($leihgabe == NULL) {
  		$leihgabe = new \App\Models\Leihgabe;
  	}
  	$leihgabe->Item = $request->input('Item', '');
  	$leihgabe->Gegner = $request->input('Gegner', '');
  	$leihgabe->Richtung = $request->input('Richtung', '');
  	if ($leihgabe->Item != '' && $leihgabe->Gegner != '' && $leihgabe->Richtung != '') {
  		$leihgabe->save();
  		if ($request->input('Erledigt', FALSE)) {
  			$leihgabe->delete();
  		}
  	}
  	return redirect('/leihliste');
  }
}
