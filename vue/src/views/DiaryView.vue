<template>
  <Diary v-if="diary != null" :diary="diary" />
</template>

<script>
import Diary from "@/components/diary/Diary"
import { mapGetters } from "vuex"

export default {
  name: "DiaryView",
  components: { Diary },
  computed: mapGetters(['diary'])
}
</script>
