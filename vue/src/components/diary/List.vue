<template>
  <table id="filme">
    <tr>
      <th style="width: 300px">Datum</th>
    </tr>foreach ($result as $key => $value)
    <tr>
      <!-- @if ($key % 2 === 0) class="alt" @endif id="row_$key">-->
      <td>
        <a href="/diary/show/$value['id']">$value['created_at']</a>
      </td>
    </tr>endforeach
  </table>
</template>
