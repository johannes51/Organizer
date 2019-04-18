@extends('layouts.app')

@section('content')

<form action="/filmliste" method="POST" name="filmform">
  {{ csrf_field() }}
  <fieldset style="width: 45%; float: left">
    <legend>Suche</legend>
    <div>
      <label for="search_string">Titelsuche</label>
      <input type="search" name="search_string" id="search_string"
        value="{{$search_string or ""}}" />
    </div>
    <div>
      <label for="director_string">Regie-Suche</label>
      <input type="search" name="director_string" id="director_string"
      value="{{$director_string or ""}}" />
    </div>
    <div>
      <label for="max_number">Max. Anzahl Filme (0=unbeg.)</label>
      <input type="search" name="max_number" id="max_number" value="{{$max_number or ""}}">
    </div>
  </fieldset>
  <button>Suchen</button>
  <input type="hidden" name="app" value="filme" />
  <fieldset style="width: 20%;float: left">
    <legend>Gesehen</legend>
    <div>
      <input type="radio" name="gesehen" value="ja" id="ja"
        @if ($gesehen == "ja") checked="true" @endif
        />
      <label for="ja">Ja</label>
    </div>
    <div>
      <input type="radio" name="gesehen" value="nein" id="nein"
        @if ($gesehen == "nein") checked="true" @endif
        />
      <label for="nein">Nein</label>
    </div>
    <div>
      <input type="radio" name="gesehen" value="beide" id="beide"
        @if ($gesehen == "beide") checked="true" @endif
        />
      <label for="beide">Beide</label>
    </div>
  </fieldset>
</form>
<div name="table">
  @include('filmliste.table')
</div>
<script src="{{ asset('js/filmliste.js') }}" type="text/javascript"></script>
 @endsection
