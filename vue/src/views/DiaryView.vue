<template>
  <div id="formbox">
    <form method="POST" action="/diary/add">
      <input type="hidden" name="diaryId" value=" $diaryId ">
      <input type="hidden" name="referrer" value="/diary">
      <button type="submit">Neu</button>
    </form>
  </div>
</template>
