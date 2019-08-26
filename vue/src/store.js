import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  strict: true,
  state: {
    currentUser: null,
    loading: false,
    auth_error: null,
    projects: [],
    currentProject: null,
    loans: []
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
    },
    currentProject(state) {
      return state.currentProject;
    },
    loans(state) {
      return state.loans;
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
      window.axios.defaults.headers.common["Authorization"] = `Bearer ${payload.access_token}`;
    },
    loginFail(state, payload) {
      state.currentUser = null;
      state.loading = false;
      if (payload == null) {
        state.auth_error = '';
      } else if ('error' in payload && payload.error.response.status == 401) {
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
      window.axios.defaults.headers.common["Authorization"] = '';
    },
    projects(state, payload) {
      state.projects = payload.data;
    },
    currentProject(state, payload) {
      state.currentProject = payload.data;
    },
    loans(state, payload) {
      state.loans = payload.data;
    },
    setLoan(state, payload) {
      var index = state.loans.findIndex((element) => {
        return (element['id'] == payload.data['id']);
      });
      if (index >= 0) {
        Vue.set(state.loans, index, payload.data);
      } else {
        state.loans.push(payload.data);
      }
    }
  },
  actions: {
    loadUser({ commit }) {
      if (localStorage.getItem('access_token') != null) {
        var localToken = localStorage.getItem('access_token');
        return window.axios.post("/api/me", {}, { headers: { 'Authorization': `Bearer ${localToken}` } })
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
      window.axios.get("/api/projects")
        .then((response) => {
          commit('projects', response.data)
        })
        .catch(error => {
          if (error.response != null && error.response.status == 401) {
            commit('loginFail');
          }
        })
    },
    loadProject({ commit }, id) {
      window.axios.get("/api/projects/".concat(id))
        .then((response) => {
          commit('currentProject', response.data)
        })
        .catch(error => {
          if (error.response != null && error.response.status == 401) {
            commit('loginFail');
          }
        })
    },
    loadLoans({ commit }) {
      window.axios.get("/api/loans")
        .then((response) => {
          commit('loans', response.data);
        })
        .catch(error => {
          if (error.response != null && error.response.status == 401) {
            commit('loginFail');
          }
        })
    },
    saveLoan({ commit, dispatch }, payload) {
      var method = "";
      var url = "/api/loans";
      if (payload.id == null) {
        method = "post";
      } else {
        method = "put";
        url = url.concat("/".concat(payload.id));
      }
      window.axios({
        method: method,
        url: url,
        data: payload
      }).then((response) => {
        if (response.data == "Reload") {
          dispatch('loadLoans');
        } else {
          commit('setLoan', response.data);
        }
      }).catch((error) => {
        error;
      })
    }
  }
})
