<template>
  <div class="content-justify-center row">
    <!-- <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="loans-table"
    ></b-pagination> -->
    <b-table
      id="loans-table"
      :items="items"
      :fields="fields"
      small
      striped
    ></b-table>
      <!-- :per-page="perPage"
      :current-page="currentPage" -->
    <div class="row">{{ this.bla }}</div>
  </div>
</template>

<script>
export default {
  name: "List",
  data() {
    return {
      perPage: 10,
      fields: {
        item: {
          label: "Gegenstand"
        },
        whitWHOM: {
          label: "von/an",
          sortable: true
        },
        direction: {
          label: "Richtung",
          sortable: true
        },
        created_at: {
          label: "Datum",
          sortable: true
        }
      }
    };
  },
  computed: {
    bla () {
      return this.$store.getters.bla;
    },
    items() {
      return this.$store.getters.loans;
    },
    rows() {
      return this.items.length;
    }
  }
};
</script>
