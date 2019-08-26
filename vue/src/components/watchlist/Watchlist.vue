<template>
  <div>
    <h3>Watchlist</h3>
    <b-button v-if="!edit" size="md" class="mr-1" @click="add">Neu</b-button>
    <Add v-if="edit" @done="done" />
    <List v-if="!edit && plannedMedia != null" :items="plannedMedia" />
  </div>
</template>

<script>
import Add from "./Add";
import List from "./List";
import { mapGetters } from 'vuex';

export default {
  name: "Watchlist",
  components: {
    Add,
    List
  },
  data() {
      return {
          edit: false
      };
  },
  computed: mapGetters(["plannedMedia"]),
  methods: {
    add() {
        this.$data.edit = true;
    },
    done(item) {
        if (item) {
            this.$store.dispatch("addPlannedMedia", item);
        }
        this.$data.edit = false;
    }
  }
};
</script>
