import apiClient from "../composables/apiClient"
import axios from "axios"

export default {
    namespaced: true,
    state: {
        authenticated: false,
        user: {}
    },
    getters: {
        authenticated(state) {
            return state.authenticated
        },
        user(state) {
            return state.user
        }
    },
    mutations: {
        SET_AUTHENTICATED(state, value) {
            state.authenticated = value
        },
        SET_USER(state, value) {
            state.user = value
        }
    },
    actions: {
        login({commit}) {
            return apiClient.get('/api/auth/user').then(({data}) => {
                console.log('actions login');
                commit('SET_USER', data)
                commit('SET_AUTHENTICATED', true)
            }).catch(({res}) => {
                console.log('actions fail');
                commit('SET_USER', {})
                commit('SET_AUTHENTICATED', false)
            })
        },
        getUser({commit}) {
            return axio.get('/api/auth/user').then(({data}) => {
                console.log('actions getUser');
                if (data.success) {
                    commit('SET_USER', data.data)
                    commit('SET_AUTHENTICATED', true)
                    // router.push({name: 'dashboard'})
                }
                // else {
                //     commit('SET_USER', {})
                //     commit('SET_AUTHENTICATED', false)
                // }
            }).catch(({res}) => {
                console.log('actions getUser error');
                commit('SET_USER', {})
                commit('SET_AUTHENTICATED', false)
            })
        },
        logout({commit}) {
            commit('SET_USER', {})
            commit('SET_AUTHENTICATED', false)
        }
    }
}
