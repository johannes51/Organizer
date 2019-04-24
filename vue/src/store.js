import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  strict: true,
  state: {
    currentUser: null,
    loading: false,
    auth_error: null,
    projects: []
  },
  getters: {
    isLoggedIn(state) {
      return state.currentUser != null;
    },
    currentUser(state) {
      return state.currentUser;
    },
    authError(state) {
      return state.auth_error;
    },
    projects(state) {
      return state.projects;
    }
  },
  mutations: {
    login(state) {
      state.currentUser = null;
      state.loading = true;
      state.auth_error = null;
    },
    loginSuccess(state, payload) {
      state.currentUser = Object.assign({}, payload.user, { token: payload.access_token });
      state.loading = false;
      state.auth_error = null;
      localStorage.setItem('access_token', payload.access_token);
      axios.defaults.headers.common["Authorization"] = `Bearer ${payload.access_token}`;
    },
    loginFail(state, payload) {
      state.currentUser = null;
      state.loading = false;
      if ('error' in payload && payload.error.response.status == 401) {
        state.auth_error = "Wrong email/password";
      } else {
      state.auth_error = payload;
    }
    },
    logout(state) {
      state.currentUser = null;
      state.loading = false;
      state.auth_error = null;
      localStorage.setItem('access_token', null);
      axios.defaults.headers.common["Authorization"] = '';
    },
    projects(state, payload) {
      state.projects = payload.projects
    }
  },
  actions: {
    loadUser({ commit }) {
      if (localStorage.getItem('access_token') != null) {
        var localToken = localStorage.getItem('access_token');
        return axios
          .post("/api/me", {}, { headers: { 'Authorization': `Bearer ${localToken}` } })
          .then(response => {
            var payload = Object.assign({}, { user: response.data, access_token: localToken });
            commit('loginSuccess', payload);
          })
          .catch(error => {
            commit('loginFail', error);
          });
      } else {
        commit('loginFail', 'No token saved locally.');
      }
    },
    loadProjects({ commit }) {
      axios.get("/api/projects")
        .then((response) => {
          commit('projects', response.data)
        })
        .catch(error => {
          if (error.response != null && error.response.status == 401) {
            commit('loginFail', null);
          }
        })
    }
  }
})
