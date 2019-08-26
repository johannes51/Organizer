<template>
  <div class="row content-justify-center">
    <div class="card">
      <div class="card-header">Leihgabe {{ createUpdateVerb() }}</div>
      <div class="card-body">
        <form @submit.prevent="submit">
          <div class="form group row">
            <label for="itemText">Gegenstand</label>
            <input
              type="text"
              v-model="form.item"
              class="form-control"
              placeholder="Gegenstand"
              id="itemText"
            >
          </div>
          <div class="form group row">
            <label for="whitWHOMText">Leihgeber/nehmer</label>
            <input
              type="text"
              v-model="form.whitWHOM"
              class="form-control"
              placeholder="Leihgeber/nehmer"
              id="whitWHOMText"
            >
          </div>
          <div class="form group row">
            <label for="directionSelect">Richtung</label>
            <select class="form-control" id="directionSelect" v-model="form.direction">
              <option value="to">verliehen</option>
              <option value="from">ausgeliehen</option>
            </select>
          </div>
          <div class="form group row" v-if="form.done != null">
            <label for="doneCheckbox">Erledigt</label>
            <input type="checkbox" v-model="form.done" class="form-control" id="doneCheckbox">
          </div>
          <input type="submit" value="Ok" class="btn btn-success">
          <button class="btn btn-warning" @click="cancel">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Edit",
  data() {
    return {
      form: {
        id: null,
        item: "",
        whitWHOM: "",
        direction: "",
        done: null
      }
    };
  },
  props: ["item"],
  methods: {
    submit() {
      this.$store.dispatch("saveLoan", this.$data.form);
      this.$emit("done");
    },
    cancel() {
      this.$emit("done");
    },
    createUpdateVerb() {
      if (this.$props.item != null && this.$props.item.id != null) {
        return "editieren";
      } else {
        return "erstellen";
      }
    }
  },
  mounted() {
    if (this.$props.item != null) {
      this.$data.form = this.$props.item;
    }
  }
};
</script>
