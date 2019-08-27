<template>
  <div class="container">
    <form @submit.prevent="submit">
      <b-form-group label="Tagebucheintrag">
        <input
          type="textarea"
          v-model="entry.text"
          class="form-control"
        >
      </b-form-group>
      <b-button type="submit" class="btn btn-success">Ok</b-button>
      <b-button variant="warning" @click="cancel">Cancel</b-button>
    </form>
  </div>
</template>

<script>
export default {
  name: 'Add',
  props: ['entry'],
  methods: {
    submit() {
      this.$emit("done", this.$props.entry);
    },
    cancel() {
      this.$emit("done");
    }
  }
}
</script>