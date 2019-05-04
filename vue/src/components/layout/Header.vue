<template>
  <b-navbar fixed="top" toggleable="lg" type="light" variant="light">
    <div class="navbar-header">
      <b-navbar-toggle target="nav-collapse">
        <span class="sr-only">Toggle Navigation</span>
      </b-navbar-toggle>

      <!-- Branding Image -->
      <b-navbar-brand to="/">Mehrdraufhaber Productions</b-navbar-brand>
    </div>

    <b-collapse id="navbar-collapse" is-nav>
      <!-- Left Side Of Navbar -->
      <b-navbar-nav>
        <b-nav-item to="/projects">Projekte</b-nav-item>
        <b-nav-item to="/diary">Tagebuch</b-nav-item>
        <b-nav-item to="/media">Filmliste</b-nav-item>
        <b-nav-item to="/watchlist">Watchlist</b-nav-item>
        <b-nav-item to="/loans">Leihliste</b-nav-item>
      </b-navbar-nav>

      <!-- Right Side Of Navbar -->
      <b-navbar-nav class="ml-auto">
        <!-- Authentication Links -->
        <template v-if="!isLoggedIn">
          <li>
            <router-link to="/login" class="nav-link">Login</router-link>
          </li>
          <li>
            <router-link to="/register" class="nav-link">Register</router-link>
          </li>
        </template>
        <template v-else>
          <b-nav-item-dropdown :text="currentUser.name" right>
            <b-dropdown-item href="#!" @click.prevent="logout">
              <i class="fa fa-btn fa-sign-out"></i>Logout
            </b-dropdown-item>
          </b-nav-item-dropdown>
        </template>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</template>

<script>
export default {
  name: "Header",
  methods: {
    logout() {
      this.$store.commit("logout");
      this.$router.push({ path: "/" });
    }
  },
  computed: {
    isLoggedIn() {
      return this.$store.getters.isLoggedIn;
    },
    currentUser() {
      return this.$store.getters.currentUser;
    }
  }
};
</script>
