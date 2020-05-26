<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\DiaryEntryResource;
use App\Models\Diary;
use App\Models\DiaryEntry;

class DiaryController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request)
  {
    return DiaryEntryResource::collection(Diary::find(1)->entries()->oldest()->select('id', 'created_at')->get());
  }

  public function store(Request $request)
  {
    $entry = new DiaryEntry;
    $entry->text = $request->input('text', '');

    $diaryId = $request->input('diaryId', NAN);
    if (!is_numeric($diaryId) || $entry->text == '') {
      return response('Error 400', 400);
    }
    $diary = Diary::find($diaryId);
    if (!isset($diary) || !$diary->entries()->save($entry)) {
      return response('Error 500', 500);
    } else {
      return "Reload";
    }
  } 
}
