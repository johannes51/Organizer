<template>
  <div class="content">
    <div class="row justify-content-center">
      <form v-if="!currentItem.set" @submit.prevent="add">
        <div class="form row">
          <input type="submit" class="form-control" value="Neu">
        </div>
      </form>
      <Edit v-if="currentItem.set" :item="currentItem" @done="done" />
    </div>
    <List v-if="!currentItem.set" @loan-selected="edit" />
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
      currentItem: {
        set: false
      }
    };
  },
  methods: {
    add() {
      this.$data.currentItem = Object.assign({}, this.$data.currentItem, { id: null, item: '', with: '', direction: 'from', set: true});
    },
    done() {
      this.$data.currentItem = {set: false};
    },
    edit(item) {
      this.$data.currentItem = Object.assign({}, this.$data.currentItem, item);
      this.$data.currentItem.set = true;
      this.$data.currentItem.done = false;
    }
  }
};
</script>
