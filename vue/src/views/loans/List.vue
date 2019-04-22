<template>
  <div>
    <form method="GET" action="/leihliste/edit">
      <button type="submit">+</button>
    </form>

    <table id="filme">
      <tr>
        <th style="width: 300px">Gegenstand</th>
        <th style="width: 300px">Leihgeber/nehmer</th>
        <th style="width: 300px">Datum</th>
      </tr>@foreach ($result as $key => $value)
      <tr>
        if ($key % 2 === 0) class="alt" endif id="row_$key">
        <td>
          <a>href="/leihliste/edit/ $value['id'] "> $value['Item']</a>
        </td>
        <td>$value['Gegner']</td>
        <td>$value['created_at']</td>
      </tr>@endforeach
    </table>
  </div>
</template>
