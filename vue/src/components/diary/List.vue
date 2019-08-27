<template>
  <b-table :items=items :fields="fields"></b-table>
</template>

<script>
export default {
  name: "List",
  props: ['items'],
  data() {
    return {
      fields: {
        text: { label: "Text" },
        created_at: { label: "Datum" }
      }
    }
  }
}
</script>