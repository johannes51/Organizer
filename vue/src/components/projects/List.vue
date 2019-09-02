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
      @row-clicked="showProject"
    >
      <template slot="created_at" slot-scope="row">{{ row.item.created_at | formatDate }}</template>
      <template slot="updated_at" slot-scope="row">{{ row.item.updated_at | formatDate }}</template>
    </b-table>
      <!-- :per-page="perPage"
      :current-page="currentPage" -->
  </div>
</template>

<style>
  .table-hover tbody tr:hover > td {
    cursor: pointer;
  }
</style>

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
        name: {
          label: "Name",
          sortable: true
        },
        customer: {
          label: "Auftraggeber",
          sortable: true
        },
        status: {
          label: "Status",
          sortable: true
        },
        created_at: {
          label: "Beginn",
          sortable: true
        },
        updated_at: {
          label: "Letzte Änderung",
          sortable: true
        }
      };
    }
  },
  methods:{
    showProject(item) {
      this.$emit("project-selected", item.id);
    }    
  }
};
</script>
