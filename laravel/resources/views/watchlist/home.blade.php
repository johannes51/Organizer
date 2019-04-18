@extends('layouts.app')

@section('content')

<form action="/watchlist/list" method="POST">
  {{ csrf_field() }}
  <div style="float: left">
    <input type="checkbox" name="typen[]" value="Film" id="film"
           @if (in_array('Film', $typen)) checked="checked" @endif
           />
    <label for="film">Filme</label>
  </div>
  <div style="float: left">
    <input type="checkbox" name="typen[]" value="Serie" id="serie"
           @if (in_array('Serie', $typen)) checked="checked" @endif
           />
    <label for="serie">Serien</label>
  </div>
  <div style="float: left">
    <input type="checkbox" name="typen[]" value="Buch" id="buch"
           @if (in_array('Buch', $typen)) checked="checked" @endif
           />
    <label for="buch">Bücher</label>
  </div>
  <div style="float: left">
    <input type="checkbox" name="typen[]" value="Spiel" id="spiel"
           @if (in_array('Spiel', $typen)) checked="checked" @endif
           />
    <label for="spiel">Spiele</label>
  </div>
  <button>Filter</button>
</form>
<a href="/watchlist/add">Neu</a>

<div id="table">
@include('watchlist.table')
</div>

<script src="{{ asset('js/watchlist.js') }}" type="text/javascript"></script>

@endsection
