<template>
  <div>
    <div class="project-box">
      <h3>Zusammenfassung</h3>@component('projects.summary', $summaryPayload) @endcomponent
    </div>

    <div class="project-box">
      <h3>Tagebuch</h3>@component('projects.diary', $diaryPayload) @endcomponent
    </div>
  </div>
</template>
