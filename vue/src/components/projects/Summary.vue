<template>
  <div class="border border-primary">
    <h3>Zusammenfassung</h3>
    <p>
      <b>Name:</b> {{ data.name }}
    </p>
    <p>
      <b>Auftraggeber:</b> {{ data.customer }}
    </p>
    <p>
      <b>Status:</b> {{ data.status }}
    </p>
    <p>
      <b>Beginn:</b> {{ data.created_at }}
    </p>
    <p>
      <b>Letzte Änderung:</b> {{ data.updated_at }}
    </p>
  </div>
</template>

<script>
export default {
  name: "Summary",
  props: ["data"]
}
</script>