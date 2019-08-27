<template>
  <b-container>
    <h3>Tagebuch</h3>
    <List v-if="currentEntry == null" :items="diary.entries" />
    <Add v-if="currentEntry != null" :entry="currentEntry" @done="add" />
    <b-button v-if="currentEntry == null" @click="currentEntry = { text : '' }">Neu</b-button>
  </b-container>
</template>

<script>
import List from "./List"
import Add from "./Add"

export default {
  name: "Diary",
  props: ['diary'],
  components: {
    Add,
    List
  },
  data() {
    return {
      currentEntry: null
    }
  },
  methods: {
    add(entry) {
      if (entry) {
        entry.diaryId = this.$props.diary.id;
        this.$store.dispatch("saveDiaryEntry", entry);
      }
      this.$data.currentEntry = null;
    }
  }
}
</script>