<template>
  <div>
    <div id="formbox">
      <form method="POST" action="/projects/diary/add">
        csrf_field()
        <input type="hidden" name="diaryId" value="$diaryId">
        <input type="hidden" name="referrer" value="/projects/show/$projectId">
        <button type="submit">Neu</button>
      </form>
    </div>
    <table id="filme">
      <tr>
        <th style="width: 300px">Datum</th>
      </tr>@foreach ($result as $key => $value)
      <tr>
        <!-- @if ($key % 2 === 0) class="alt" @endif id="row_$key">-->
        <td>
          <a href="/projects/diary/$value['id']">$value['created_at']</a>
        </td>
      </tr>@endforeach
    </table>
  </div>
</template>
