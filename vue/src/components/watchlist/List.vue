<template>
  <div class="container">
    <form class="row">
      <div class="form-check form-control-lg">
        <input type="checkbox" class="form-check-input" value="Film" id="filmCheck" v-model="checkedCategories" />
        <label for="filmCheck" class="form-check-label">Filme</label>
      </div>
      <div class="form-check form-control-lg">
        <input type="checkbox" class="form-check-input" value="Serie" id="seriesCheck" v-model="checkedCategories" />
        <label for="seriesCheck" class="form-check-label">Serien</label>
      </div>
      <div class="form-check form-control-lg">
        <input type="checkbox" class="form-check-input" value="Buch" id="bookCheck" v-model="checkedCategories" />
        <label for="bookCheck" class="form-check-label">Bücher</label>
      </div>
      <div class="form-check form-control-lg">
        <input type="checkbox" class="form-check-input" value="Spiel" id="gameCheck" v-model="checkedCategories" />
        <label for="gameCheck" class="form-check-label">Spiele</label>
      </div>
    </form>

    <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="watchlist-table"
    ></b-pagination>

    <b-table
      id="watchlist-table"
      :items="items"
      :filter="checkedCategories"
      :filter-function="filterItems"
      :fields="fields"
      :per-page="perPage"
      :current-page="currentPage"
      striped
      hover
    >
       <template slot="actions" slot-scope="row">
        <b-button size="md" class="mr-1" @click="deleteMedium(row.item.id)">&#128465;</b-button>
      </template>
    </b-table>

  </div>
</template>

<script>
export default {
  name: "List",
  data() {
    return {
      fields: [
        { key: "Name", sortable: true },
        { key: "Autor", sortable: true },
        { key: "Typ", sortable: true },
        { key: "actions", label: "Löschen" }
      ],
      perPage: 30,
      currentPage: 1,
      checkedCategories: ["Film", "Buch", "Serie", "Spiel"]
    }
  },
  props: ["items"],
  computed: {
    rows() {
      return this.items.length;
    }
  },
  methods:{
    deleteMedium(itemId) {
      this.$store.dispatch("deletePlannedMedium", itemId)
    },
    filterItems(item) {
      var shown = false;
      this.$data.checkedCategories.forEach(category => {
        if (item.Typ == category) {
          shown = true;
        }
      });
      return shown;
    }
  }
};
</script>