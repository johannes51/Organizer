<template>
  <b-container>
    <legend>Suche</legend>
    <b-row>
      <b-form-group label="Titel" labelFor="titleFilter">
        <input type="search" v-model="filter.title" class="form-control" id="titleFilter" />
        <b-input-group-append>
          <b-button :disabled="!filter" @click="filter.title = ''">Clear</b-button>
        </b-input-group-append>
      </b-form-group>
      <b-form-group label="Regie" labelFor="directorFilter">
        <input type="search" v-model="filter.director" class="form-control" id="directorFilter" />
        <b-input-group-append>
          <b-button :disabled="!filter" @click="filter.director = ''">Clear</b-button>
        </b-input-group-append>
      </b-form-group>
      <b-form-group label="Gesehen">
        <b-form-radio-group v-model="filter.seen">
          <b-form-radio value="seen">Ja</b-form-radio>
          <b-form-radio value="unseen">Nein</b-form-radio>
          <b-form-radio value="both">Beide</b-form-radio>
        </b-form-radio-group>
      </b-form-group>
    </b-row>
    <b-row>
      <b-col>
        <b-form-select v-model="perPage" id="perPageSelect" size="sm" :options="pageOptions" ></b-form-select>
      </b-col>
      <b-col>
        <b-pagination
          v-model="currentPage"
          :total-rows="rows"
          :per-page="perPage"
          aria-controls="media-table"
        ></b-pagination>
      </b-col>
    </b-row>
    <b-table
      id="media-table"
      :items="media"
      :filter="filter"
      :filter-function="filterItems"
      :fields="fields"
      :per-page="perPage"
      :current-page="currentPage"
      striped
      hover
      @filtered="onFiltered"
    >
       <template slot="Status" slot-scope="row">
        <b-button size="md" class="mr-1" @click="changeStatus(row.item)">{{ (row.item.Status == "seen") ? '☑' : '☐' }}</b-button>
      </template>
    </b-table>
  </b-container>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: "List",
  data() {
    return {
      perPage: 20,
      currentPage: 1,
      rows: 1,
      pageOptions: [ 10, 20, 50, 100 ],
      filter: {
        title: '',
        director: '',
        seen: 'both'
      },
      fields: {
        Name: { label: "Titel", sortable: true },
        Regie: { label: "Regie", sortable: true },
        Jahr: { label: "Jahr", sortable: true },
        Sprachen: { label: "Sprachen" },
        Genre: { label: "Genres" },
        Status: { label: "Gesehen" }
      }
    }
  },
  computed: mapGetters(['media']),
  watch: {
    media: function() {
      if (this.media) {
        this.$data.rows = this.media.length;
      }
    }
  },
  mounted() {
    if (this.media) {
      this.$data.rows = this.media.length;
    }
  },
  methods: {
    filterItems(row, filter) {
      var visible = true;
      if (filter.title) {
        var s1 = row.Name.toLowerCase();
        var s2 = filter.title.toLowerCase();
        if (!s1.includes(s2)) {
          visible = false;
        }
      }
      if (filter.director) {
        var s1 = row.Regie.toLowerCase();
        var s2 = filter.director.toLowerCase();
        if (!s1.includes(s2)) {
          visible = false;
        }
      }
      if (filter.seen && filter.seen != "both") {
        if (filter.seen != row.Status) {
          visible = false;
        }
      }
      if (row.Status == 'crap') {
        visible = false;
      }
      return visible;
    },
    onFiltered(filteredItems) {
      this.$data.rows = filteredItems.length;
    },
    changeStatus(item) {
      this.$store.dispatch('toggleMediaSeen', item);
    }
  }
}
</script>