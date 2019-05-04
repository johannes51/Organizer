<template>
  <div class="list">
    <h2>Projekte</h2>

    <!-- <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="projects-table"
    ></b-pagination> -->

    <b-table
      id="projects-table"
      :items="items"
      :fields="fields"
      small
      striped
      hover
    ></b-table>
      <!-- :per-page="perPage"
      :current-page="currentPage" -->
  </div>
</template>

<script>
export default {
  name: "List",
  computed: {
    items() {
      return this.$store.getters.projects;
    },
    rows() {
      return this.items.length;
    },
    fields() {
      return {
        Name: {
          label: "Name",
          sortable: true
        },
        Customer: {
          label: "Auftraggeber",
          sortable: true
        },
        Status: {
          label: "Status",
          sortable: true
        },
        created_at: {
          label: "Beginn",
          sortable: true
        }
      };
    }
  }
};
</script>
