import { ref, inject, computed } from "vue";
import { useRouter } from "vue-router";
import apiClient from "./apiClient";
import getApiPath from "@/services/apiPaths";

export default function useUsers() {
    const users = ref([]);
    const user = ref({});
    const success = ref(false);
    const router = useRouter();
    const validationErrors = ref({});
    const validationMessage = ref("");
    const isLoading = ref(false);
    const swal = inject("$swal");

    const getUsers = async (filters=[]) => {
        let queryString = new URLSearchParams(filters).toString();
        if(queryString) { queryString = '?'+ queryString }
        return apiClient
            .get(
                "/admin/users"+queryString)
            .then((response) => {
                users.value = response.data;
                return response.data;
            });
    };

    const getUsersPaginate = async (filters=[]) => {
        let queryString = new URLSearchParams(filters).toString();
        if(queryString) { queryString = '?'+ queryString }
        return apiClient
            .get(
                "/admin/user/pagination"+queryString)
            .then((response) => {
                users.value = response.data;
                return response.data;
            });
    };

    const getUserUnverified = async (filters=[]) => {
        let queryString = new URLSearchParams(filters).toString();
        if(queryString) { queryString = '?'+ queryString }
        return apiClient
            .get(
                "/admin/user/unverified"+queryString)
            .then((response) => {
                users.value = response.data;
                return response.data;
            });
    };

    const checkDuplicacy = async (type, data) => {
        return apiClient
            .post(
                "/admin/document/" + type, data)
            .then((response) => {
                users.value = response.data;
                return response.data;
            });
    };

    const getReportingUsers = async (filters=[]) => {
        let queryString = new URLSearchParams(filters).toString();
        if(queryString) { queryString = '?'+ queryString }
        return apiClient
            .get(
                "/admin/user/reporting"+queryString)
            .then((response) => {
                users.value = response.data;
            });
    };

    const getUser = async (id) => {
        apiClient.get("/admin/users/" + id).then((response) => {
            user.value = response.data.data;
        });
    };

    const storeUser = async (user) => {
        if (isLoading.value) return;

        isLoading.value = true;
        validationErrors.value = {};

        return apiClient
            .post("/admin/users", user)
            .then((response) => {
                user.value = response.data;
                swal({
                    icon: "success",
                    title: "User saved successfully",
                });
                return Promise.resolve(response);
            })
            .catch((error) => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors;
                    validationMessage.value = error.response.data.message;
                    swal({
                        icon: "error",
                        title: error.response.data.message,
                    });
                }
                return Promise.reject(error);
            })
            .finally(() => (isLoading.value = false));
    };

    const importUser = async (data) => {
        isLoading.value = true;
        success.value = false;
        try {
            let serializedPost = new FormData();
            for (let item in data) {
                if (data.hasOwnProperty(item)) {
                    serializedPost.append(item, data[item]);
                }
            }
            let response =  await getApiPath.importUsers(serializedPost);
            success.value = true;
            return response;
        } catch (error) {
            if (error.response?.data) {
                validationErrors.value = error.response.data.errors;
                validationMessage.value = error.response.data.message;
                swal({
                    icon: "error",
                    title: error.response.data.message,
                });
            }
            return Promise.reject(error);
        } finally {
            isLoading.value = false;
        }
    };

    const exportUser = async (data) => {
        isLoading.value = true;
        try {
            return await getApiPath.exportUsers(data);
        } catch (error) {
            if (error.response?.data) {
                validationErrors.value = error.response.data.errors;
                validationMessage.value = error.response.data.message;
                swal({
                    icon: "error",
                    title: error.response.data.message,
                });
            }
            return Promise.reject(error);
        } finally {
            isLoading.value = false;
        }
    };

    const exportCustomUser = async (data) => {
        isLoading.value = true;
        try {
            return await getApiPath.exportCustomUser(data);
        } catch (error) {
            if (error.response?.data) {
                validationErrors.value = error.response.data.errors;
                validationMessage.value = error.response.data.message;
                swal({
                    icon: "error",
                    title: error.response.data.message,
                });
            }
            return Promise.reject(error);
        } finally {
            isLoading.value = false;
        }
    };

    const updateUser = async (user) => {
        if (isLoading.value) return;

        isLoading.value = true;
        validationErrors.value = {};

        return apiClient
            .put("/admin/users/" + user.id, user)
            .then((response) => {
                swal({
                    icon: "success",
                    title: "User updated successfully",
                });
                return Promise.resolve(response);
            })
            .catch((error) => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors;
                    validationMessage.value = error.response.data.message;
                    swal({
                        icon: "error",
                        title: error.response.data.message,
                    });
                }
                return Promise.reject(error);
            })
            .finally(() => (isLoading.value = false));
    };

    const deleteUser = async (id, user) => {
        if (isLoading.value) return;
        isLoading.value = true;
        validationErrors.value = {};
        return apiClient
            .delete("/admin/users/" + id, {
                data: user,
            })
            .then((response) => {
                swal({
                    icon: "success",
                    title: "De-board successfully",
                });
                return Promise.resolve(response);
            })
            .catch((error) => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors;
                    validationMessage.value = error.response.data.message;
                    swal({
                        icon: "error",
                        title: error.response.data.message,
                    });
                }
                return Promise.reject(error);
            })
            .finally(() => (isLoading.value = false));
    };

    return {
        users,
        user,
        getUsers,
        getUsersPaginate,
        getUserUnverified,
        getReportingUsers,
        getUser,
        storeUser,
        updateUser,
        deleteUser,
        checkDuplicacy,
        exportUser,
        importUser,
        exportCustomUser,
        validationErrors: computed(() => validationErrors.value),
        validationMessage,
        isLoading,
        success
    };
}
