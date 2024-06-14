import { ref, inject, computed } from "vue";
import { useRouter } from "vue-router";
import apiClient from "./apiClient";

export default function useUsers() {
    const users = ref([]);
    const user = ref({});

    const router = useRouter();
    const validationErrors = ref({});
    const validationMessage = ref("");
    const isLoading = ref(false);
    const swal = inject("$swal");

    const getUsers = async (filters=[]) => {
        let queryString = new URLSearchParams(filters).toString();
        if(queryString) { queryString = '?'+ queryString }
        apiClient
            .get(
                "/admin/users"+queryString)
            .then((response) => {
                users.value = response.data;
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
                console.log("api", "success");
                swal({
                    icon: "success",
                    title: "User deleted successfully",
                });
                return Promise.resolve(response);
            })
            .catch((error) => {
                console.log("api", "failed");
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
        getReportingUsers,
        getUser,
        storeUser,
        updateUser,
        deleteUser,
        validationErrors: computed(() => validationErrors.value),
        validationMessage,
        isLoading,
    };
}
