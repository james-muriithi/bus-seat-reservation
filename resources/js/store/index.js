import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        loading: false
    },
    getters: {
        loading(state) {
            return state.loading;
        }
    },
    mutations: {
        setLoading(state, loadingState) {
            state.loading = loadingState;
        }
    },
    actions: {
        startLoading({ commit }) {
            commit("setLoading", true);
        },
        stopLoading({ commit }) {
            commit("setLoading", false);
        }
    }
});
