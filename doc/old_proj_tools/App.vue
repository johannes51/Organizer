<template>
  <div id="app">
    <WBS v-if="!wpdView && dataReady" />
    <Gantt v-if="!wpdView && dataReady" />
    <WPD v-if="wpdView && dataReady" />
  </div>
</template>

<script>
import WBS from "./components/WBS.vue";
import WPD from "./components/WPD.vue";
import Gantt from "./components/Gantt.vue";

import { mapGetters } from "vuex";

export default {
  name: "app",
  components: {
    WBS,
    WPD,
    Gantt
  },
  methods: {
    showWpd(event) {
      var number = -1;
      if (event.target.tagName == "P") {
        number = event.target.parentNode.id;
      } else {
        number = event.target.id;
      }
      var payload = this.$store.getters.wpdData.find(el => {
        return el.number == number;
      });
      this.$store.commit("wpd", payload);
    }
  },
  computed: {
    ...mapGetters(["dataReady"]),
    wpdView() {
      return this.$store.getters.wpd != null;
    }
  },
  mounted() {
    this.$store.dispatch("loadTable", this.showWpd);
  }
};
</script>

<style>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
