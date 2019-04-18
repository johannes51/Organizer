@extends('layouts.app')

@section('content')

<h2>Projekte</h2>

<table id="filme">
  <tr>
    <th style="width: 300px">Name</th>
    <th style="width: 300px">Auftraggeber</th>
    <th style="width: 300px">Status</th>
    <th style="width: 300px">Beginn</th>
  </tr>
  @foreach ($result as $key => $value)
  <tr @if ($key % 2 === 0) class="alt" @endif id="row_{{ $key }}">
      <td><a href="/projects/show/{{ $value['id'] }}">{{ $value['Name'] }}</a></td>
      <td>{{ $value['Auftraggeber'] }}</td>
      <td>{{ $value['Status'] }}</td>
      <td>{{ $value['created_at'] }}</td>
  </tr>
  @endforeach
</table>

@endsection
