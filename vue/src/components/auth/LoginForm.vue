<template>
  <div class="login row justify-content-center">
    <div class="card">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form @submit.prevent="authenticate">
          <div class="form group row">
            <label for="email">E-Mail:</label>
            <input
              type="email"
              v-model="form.email"
              class="form-control"
              placeholder="Email-Adresse"
            >
          </div>
          <div class="form group row">
            <label for="password">Passwort:</label>
            <input
              type="password"
              v-model="form.password"
              class="form-control"
              placeholder="Passwort"
            >
          </div>
          <div class="form group row">
            <input type="submit" value="Login">
          </div>
          <div class="form-group row" v-if="authError">
            <div class="alert alert-warning" role="alert">{{ authError }}</div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>

import {loadData} from "@/util/util"

export default {
  name: "LoginForm",
  data() {
    return {
      form: {
        email: "",
        password: ""
      }
    };
  },
  methods: {
    authenticate() {
      this.$store.commit("login");

      axios
        .post("/api/login", this.$data.form)
        .then(response => {
          this.$store.commit("loginSuccess", response.data);
          loadData(this.$store);
          this.$router.push({ path: "/" });
        })
        .catch(error => {
          this.$store.commit("loginFail", { error });
        });
    }
  },
  computed: {
    authError() {
      return this.$store.getters.authError;
    }
  }
};
</script>
