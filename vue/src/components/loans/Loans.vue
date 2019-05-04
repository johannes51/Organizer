<template>
  <div class="content">
    <div class="row justify-content-center">
      <form v-if="currentItem == null" @submit.prevent="add">
        <div class="form row">
          <input type="submit" class="form-control" value="Neu">
        </div>
      </form>
      <Edit v-if="currentItem != null" :item="currentItem" @done="done" />
    </div>
    <List/>
  </div>
</template>

<script>
import List from "./List";
import Edit from "./Edit";

export default {
  name: "Loans",
  components: {
    Edit,
    List
  },
  data() {
    return {
      currentItem: null
    };
  },
  methods: {
    add() {
      this.$data.currentItem = { id: null, item: '', with: '', direction: 'from' };
    },
    done() {
      this.$data.currentItem = null;
    }
  }
};
</script>
