<template>
  <b-table :items=items :fields="fields">
      <template slot="created_at" slot-scope="row">{{ row.item.created_at | formatDate }}</template>
  </b-table>
</template>

<script>
export default {
  name: "List",
  props: ['items'],
  data() {
    return {
      fields: {
        text: { label: "Text" },
        created_at: { label: "Datum", sortable: true }
      }
    }
  }
}
</script>