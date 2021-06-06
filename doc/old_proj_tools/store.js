import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

import { parse_response } from "@/data/parser.js";

export default new Vuex.Store({
  strict: true,
  state: {
    nodeStructure: null,
    wpdData: null,
    taskData: null,
    numberIdTable: null,
    wpd: null,
    dataReady: false
  },
  getters: {
    nodeStructure(state) {
      return state.nodeStructure;
    },
    wpdData(state) {
      return state.wpdData;
    },
    taskData(state) {
      return state.taskData;
    },
    numberIdTable(state) {
      return state.numberIdTable;
    },
    wpd(state) {
      return state.wpd;
    },
    dataReady(state) {
      return state.dataReady;
    }
  },
  mutations: {
    nodeStructure(state, payload) {
      state.nodeStructure = payload;
    },
    wpdData(state, payload) {
      state.wpdData = payload;
    },
    taskData(state, payload) {
      state.taskData = payload;
    },
    numberIdTable(state, payload) {
      state.numberIdTable = payload;
    },
    wpd(state, payload) {
      state.wpd = payload;
    },
    dataReady(state) {
      state.dataReady = true;
    },
    updateWpTime(state, payload) {
      var index = state.taskData.data.findIndex(element => {
        return element.id == payload.data.number;
      });
    }
  },
  actions: {
    loadTable({ commit }, fn) {
      axios
        .get("/api/wps/6")
        .then(response => {
          var parsedData = parse_response(response.data, fn);
          commit("nodeStructure", parsedData.wbs);
          commit("wpdData", parsedData.wpdData);
          commit("taskData", parsedData.taskData);
          commit("numberIdTable", parsedData.numberIdTable);
          commit("dataReady");
        })
        .catch(error => {
          console.log(error);
        });
    },
    updateWpTime(context, payload) {
      var equivalence = context.state.numberIdTable.find(element => {
        return element.number == payload.number;
      });
      if (equivalence != null) {
        axios
          .put("/api/wps/" + equivalence.id, payload)
          .then(response => {
            context.commit("updateWpTime", response.data);
          })
          .catch(error => {
            console.log(error);
          });
      }
    }
  }
});
