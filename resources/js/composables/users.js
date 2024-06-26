import { ref, inject, computed } from "vue";
import { useRouter } from "vue-router";
import apiClient from "./api-client";

export default function useUsers() {
    const users = ref([]);
    const user = ref({});

    const router = useRouter();
    const validationErrors = ref({});
    const validationMessage = ref("");
    const isLoading = ref(false);
    const swal = inject("$swal");

    const getUsers = async (
        page = 1,
        search_id = "",
        search_title = "",
        search_global = "",
        order_column = "created_at",
        order_direction = "desc"
    ) => {
        apiClient
            .get(
                "/admin/users?page=" +
                    page +
                    "&search_id=" +
                    search_id +
                    "&search_title=" +
                    search_title +
                    "&search_global=" +
                    search_global +
                    "&order_column=" +
                    order_column +
                    "&order_direction=" +
                    order_direction
            )
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

        let serializedPost = new FormData();
        for (let item in user) {
            if (user.hasOwnProperty(item)) {
                serializedPost.append(item, user[item]);
            }
        }

        return apiClient
            .post("/admin/users", serializedPost)
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
        getUser,
        storeUser,
        updateUser,
        deleteUser,
        validationErrors: computed(() => validationErrors.value),
        validationMessage,
        isLoading,
    };
}
