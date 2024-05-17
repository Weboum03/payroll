import { inject } from "vue";
import axios from "axios";
import store from "../store";
let baseURL = import.meta.env.VITE_AXIOS_BASE_URL;
if (baseURL) {
    baseURL = baseURL + "/api/";
} else {
    baseURL = "/api/";
}

const apiClient = axios.create({
    baseURL,
    headers: { Accept: "application/json" },
    timeout: 10000,
});

apiClient.interceptors.request.use(
    (config) => {
        const isLogin = store.state.auth.authenticated;
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

apiClient.interceptors.response.use(
    (response) => {
        return Promise.resolve(response);
    },
    (error) => {
        if (error.response.status === 401) {
            window.location.href = "/login";
        }
        return Promise.reject(error);
    }
);

export default apiClient;
