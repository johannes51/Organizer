<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\DiaryResource;
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
    return DiaryEntryResource::collection(Diary::find(1)->entries()->select('id', 'created_at')->get());
  }

  public function show(DiaryEntry $diaryEntry)
  {
    $payload = array();
    $payload['entry'] = array();
    $payload['entry']['created'] = $diaryEntry->created_at->timezone('Europe/Berlin');
    $payload['entry']['updated'] = $diaryEntry->updated_at->timezone('Europe/Berlin');
    $payload['entry']['text'] = $diaryEntry->Text;

    $payload['entry']['referrer'] = '/diary';

    return view('diary.show', $payload);
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
