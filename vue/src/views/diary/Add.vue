<template>
  
<form action="/diary/processAdd" method="POST">
  csrf_field()
  <input type="hidden" name="diaryId" value="$diaryId">
  <input type="hidden" name="referrer" value="$referrer">
  <fieldset style="width: 45%; float: left">
    <legend>Privater Tagebucheintrag</legend>
    <textarea name="text"></textarea>
    <button>Eintragen</button>
</form>
</template>
