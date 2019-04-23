<template>
  <div class="list">
    <h2>Projekte</h2>

    <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="my-table"
    ></b-pagination>

    <p class="mt-3">Current Page: {{ currentPage }}</p>

    <b-table
      id="my-table"
      :items="items"
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
  data() {
    return {
      perPage: 3,
      currentPage: 1,
      items: [
        { id: 1, first_name: "Fred", last_aname: "Flintstone" },
        { id: 2, first_name: "Wilma", last_aname: "Flintstone" },
        { id: 3, first_name: "Barney", last_aname: "Rubble" },
        { id: 4, first_name: "Betty", last_aname: "Rubble" },
        { id: 5, first_name: "Pebbles", last_aname: "Flintstone" },
        { id: 6, first_name: "Bamm Bamm", last_aname: "Rubble" },
        { id: 7, first_name: "The Great", last_aname: "Gazzoo" },
        { id: 8, first_name: "Mr", last_aname: "Slate" },
        { id: 9, first_name: "Pearl", last_aname: "Slaghoople" }
      ]
    };
  },
  computed: {
    rows() {
      return this.items.length;
    }
  }
};
</script>
