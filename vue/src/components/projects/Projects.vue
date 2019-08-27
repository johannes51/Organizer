<template>
  <div>
    <List v-if="currentProject == null" @project-selected="show" />
    <Show v-if="currentProject != null" :project="currentProject" @done="unShow" />
  </div>
</template>

<script>
import List from "./List";
import Show from "./Show";
import { mapGetters } from 'vuex';

export default {
  name: "Projects",
  components: {
    List,
    Show
  },
  computed: {
    ...mapGetters(["currentProject"])
  },
  methods: {
    show(itemId) {
      this.$store.dispatch("loadProject", itemId);
    },
    unShow() {
      this.$store.dispatch("unloadProject");
    }
  }
};
</script>
