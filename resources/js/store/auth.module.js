import AuthService from '../services/auth.service';

const user = JSON.parse(localStorage.getItem('user'));
const initialState = user
  ? { authenticated: true, user }
  : { authenticated: false, user: null };

export const auth = {
  namespaced: true,
  state: initialState,
  actions: {
    login({ commit }, user) {
      return AuthService.login(user).then(
        user => {
          commit('loginSuccess', user);
          return Promise.resolve(user);
        },
        error => {
          commit('loginFailure');
          return Promise.reject(error);
        }
      );
    },
    logout({ commit }) {
      AuthService.logout();
      commit('logout');
    },
    register({ commit }, user) {
      return AuthService.register(user).then(
        response => {
          commit('registerSuccess');
          return Promise.resolve(response.data);
        },
        error => {
          commit('registerFailure');
          return Promise.reject(error);
        }
      );
    }
  },
  mutations: {
    loginSuccess(state, user) {
      state.authenticated = true;
      state.user = user;
    },
    loginFailure(state) {
      state.authenticated = false;
      state.user = null;
    },
    logout(state) {
      state.authenticated = false;
      state.user = null;
    },
    registerSuccess(state) {
      state.authenticated = false;
    },
    registerFailure(state) {
      state.authenticated = false;
    }
  }
};