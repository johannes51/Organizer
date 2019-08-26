<template>
  <div class="container">
    <form @submit.prevent="submit">
      <b-form-group label="Name">
        <input
          type="text"
          v-model="form.name"
          class="form-control"
          id="nameText"
        >
      </b-form-group>
      <b-form-group label="Autor">
        <input
          type="text"
          v-model="form.author"
          class="form-control"
          id="authorText"
        >
      </b-form-group>
      <b-form-group label="Typ">
        <b-form-radio-group v-model="form.type">
          <b-form-radio value="Film">Film</b-form-radio>
          <b-form-radio value="Buch">Buch</b-form-radio>
          <b-form-radio value="Serie">Serie</b-form-radio>
          <b-form-radio value="Spiel">Spiel</b-form-radio>
        </b-form-radio-group>
      </b-form-group>
      <b-button type="submit" class="btn btn-success">Ok</b-button>
      <b-button variant="warning" @click="cancel">Cancel</b-button>
    </form>
  </div>
</template>

<script>
export default {
  name: "Add",
  data() {
    return {
      form: {
        name: '',
        author: '',
        type: null
      }
    }
  },
  methods: {
    submit() {
      this.$emit("done", this.$data.form);
    },
    cancel() {
      this.$emit("done", null);
    }
  }
}
</script>