<template>
  <div class="container">
    <div class="col-md-4">
      <Summary :data="summary" />
    </div>
    <div class="col-lg-7">
      <Diary :entries="diary" />
    </div>
  </div>
</template>

<script>
import Summary from "./Summary"
import Diary from "../diary/Diary"

export default {
  name: "Show",
  components: {
    Summary,
    Diary
  },
  props: ["project"],
  computed: {
    summary() {
      return this.$props.project;
    },
    diary() {
      return this.$props.project.diary;
    }
  }
};
</script>