<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiaryController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request)
  {
    $payload = array();

    $result = \App\Models\Diary::find(1)->entries()->select('id', 'created_at');
    
    $payload['result'] = $result->orderBy('created_at', 'DESC')->get();
    $payload['diaryId'] = 1;
    foreach ($payload['result'] as $value) {
      $value->created_at = $value->created_at->timezone('Europe/Berlin');
    }

    return view('diary.index', $payload);
  }

  public function show(\App\Models\DiaryEntry $diaryEntry)
  {
    $payload = array();
    $payload['entry'] = array();
    $payload['entry']['created'] = $diaryEntry->created_at->timezone('Europe/Berlin');
    $payload['entry']['updated'] = $diaryEntry->updated_at->timezone('Europe/Berlin');
    $payload['entry']['text'] = $diaryEntry->Text;

    $payload['entry']['referrer'] = '/diary';

    return view('diary.show', $payload);
  }

  public function showAdd(Request $request)
  {
    $diaryId = $request->input('diaryId', NAN);
    $referrer = $request->input('referrer', '');
    return view('diary.add', ['diaryId' => $diaryId, 'referrer' => $referrer]);
  }

  public function add(Request $request)
  {
    $diaryId = $request->input('diaryId', NAN);
    if (is_numeric($diaryId)) {
      $diary = \App\Models\Diary::find($diaryId);
      if (isset($diary)) {
        $entry = new \App\Models\DiaryEntry;
        $entry->text = $request->input('text', '');
        if ($entry->text != '') {
          $diary->entries()->save($entry);
        }
      }
    }
    return redirect($request->input('referrer', '/diary'));
  }
}
