<template>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <Summary :data="summary" />
        <b-button @click="back">Zurück</b-button>
      </div>
      <div class="col-lg-7">
        <Diary :diary="diary" />
      </div>
    </div>
    <div class="row">
      <div class="col-lg-7">
        <WBS :nodeStructure="wbs" />
      </div>
    </div>
  </div>
</template>

<script>
import Summary from "./Summary"
import Diary from "../diary/Diary"
import WBS from "./WBS"

export default {
  name: "Show",
  components: {
    Summary,
    Diary,
    WBS
  },
  props: ["project"],
  computed: {
    summary() {
      return this.$props.project;
    },
    diary() {
      return this.$props.project.diary;
    },
    wbs() {
      return this.$props.project.wps;
    }
  },
  methods: {
    back() {
      this.$emit('done')
    }
  }
};
</script>