<template>
  <div id="formbox">
  <form method="POST" action="/diary/add">
  	{{ csrf_field() }}
  	<input type="hidden" name="diaryId" value="{{ $diaryId }}">
  	<input type="hidden" name="referrer" value="/diary">
  	<button type="submit">Neu</button>
  </form>
</div>
</template>
