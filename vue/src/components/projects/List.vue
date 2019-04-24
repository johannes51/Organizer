<template>
  <div class="list">
    <h2>Projekte</h2>

    <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="projects-table"
    ></b-pagination>

    <p class="mt-3">Current Page: {{ currentPage }}</p>

    <b-table
      id="projects-table"
      :items="items"
      :fields="fields"
      :per-page="perPage"
      :current-page="currentPage"
      small
      class="table"
    >
      <thead class="thead-dark">
        <tr>
          <th style="width: 300px">Name</th>
          <th style="width: 300px">Auftraggeber</th>
          <th style="width: 300px">Status</th>
          <th style="width: 300px">Beginn</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <!-- if (key % 2 = 0) class="alt"  endif id="row_key" -->
          <td>
            <a href="/projects/show">value 'Name'</a>
          </td>
          <td>value['Auftraggeber']</td>
          <td>$value['Status']</td>
          <td>$value['created_at']</td>
        </tr>
      </tbody>
    </b-table>
  </div>
</template>

<script>
export default {
  name: "List",
  computed: {
    user () {
      return (this.$store.getters.currentUser);
    },
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
