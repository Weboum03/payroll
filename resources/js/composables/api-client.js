import axios from "axios";
import { useStore } from "vuex";
import store from "../store";
// const baseURL = import.meta.env.VITE_BASE_API;
const baseURL = "http://localhost:8000/api/";

const apiClient = axios.create({
    baseURL,
    headers: { Accept: "application/json" },
    timeout: 10000,
});

apiClient.interceptors.request.use(
    (config) => {
        isLogin = store.state.auth.authenticated;
        if (isLogin) {
            const user = store.state.auth.user;
            if (user && user.access_token) {
                config.headers.Authorization = `Bearer ${user.access_token}`;
            }
        }

        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

export default apiClient;
