@extends('layouts.app')

@section('content')

<form action="/watchlist/add" method="POST">
  {{ csrf_field() }}
  <fieldset style="width: 45%; float: left">
    <legend>Hinzufügen zu Watchlist</legend>
    <div>
      <label for="name">Name</label>
      <input type="search" name="name" id="name" />
    </div>
    <div>
      <label for="autor">Autor</label>
      <input type="search" name="autor" id="autor" />
    </div>
    <div>
       <select name="typ" size="4">
         <option>Film</option>
         <option>Buch</option>
         <option>Serie</option>
         <option>Spiel</option>
       </select>
    </div>
    <button>Hinzufügen</button>
</form>

@endsection
