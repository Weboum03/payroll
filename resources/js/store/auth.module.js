import AuthService from "../services/auth.service";

const initialState = {
    authenticated: false,
    user: {},
};

export const auth = {
    namespaced: true,
    state: initialState,
    getters: {
        authenticated(state) {
            return state.authenticated;
        },
        user(state) {
            return state.user;
        },
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
        userSuccess(state, user) {
            state.authenticated = true;
            state.user = user;
        },
        userFailure(state) {
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
        },
    },
    actions: {
        login({ commit }, user) {
            return AuthService.login(user).then(
                (user) => {
                    commit("loginSuccess", user);
                    return Promise.resolve(user);
                },
                (error) => {
                    commit("loginFailure");
                    return Promise.reject(error);
                }
            );
        },
        logout({ commit }) {
            AuthService.logout();
            commit("logout");
        },
        register({ commit }, user) {
            return AuthService.register(user).then(
                (response) => {
                    commit("registerSuccess");
                    return Promise.resolve(response.data);
                },
                (error) => {
                    commit("registerFailure");
                    return Promise.reject(error);
                }
            );
        },
        getUser({ commit }) {
            return AuthService.getUser().then(
                (response) => {
                    // commit("userSuccess", response.data);
                    return Promise.resolve(response);
                },
                (error) => {
                    // commit("userFailure");
                    return Promise.reject(error);
                }
            );
        },
    },
};
