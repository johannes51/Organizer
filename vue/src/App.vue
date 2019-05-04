<template>
  <div id="app">
    <Header/>
    <router-view/>
  </div>
</template>

<script>
import Header from "@/components/layout/Header";
import {loadData} from "@/util/util"

export default {
  name: "App",
  components: {
    Header
  },
  mounted: function() {
    this.$store.dispatch("loadUser")
    .then(() => {
      loadData(this.$store);
      if ("serverRoute" in Window) {
        this.$router.push({ path: Window.serverRoute });
      } else {
        this.$router.push({ path: '/' });
      }
    });
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
