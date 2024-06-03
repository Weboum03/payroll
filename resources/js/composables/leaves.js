import { ref, inject, computed } from "vue";
import apiClient from "./apiClient";

export default function useLeaves() {
    const leaves = ref([]);
    const leave = ref({});

    const validationErrors = ref({});
    const validationMessage = ref("");
    const isLoading = ref(false);
    const swal = inject("$swal");

    const getLeaves = async () => {
        apiClient.get("admin/leaves").then((response) => {
            leaves.value = response.data;
        });
    };

    const getLeave = async (id) => {
        apiClient.get("/admin/leaves/" + id).then((response) => {
            leave.value = response.data.data;
        });
    };

    const storeLeave = async (leave) => {
        if (isLoading.value) return;

        isLoading.value = true;
        validationErrors.value = {};

        let serializedPost = new FormData();
        for (let item in leave) {
            if (leave.hasOwnProperty(item)) {
                serializedPost.append(item, leave[item]);
            }
        }

        return apiClient
            .post("/admin/leaves", serializedPost)
            .then((response) => {
                leave.value = response.data;
                swal({
                    icon: "success",
                    title: "Leave saved successfully",
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

    const updateLeave = async (leave) => {
        if (isLoading.value) return;

        isLoading.value = true;
        validationErrors.value = {};

        return apiClient
            .put("/admin/leaves/" + leave.id, leave)
            .then((response) => {
                swal({
                    icon: "success",
                    title: "Leave updated successfully",
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

    const deleteLeave = async (id, leave) => {
        if (isLoading.value) return;
        isLoading.value = true;
        validationErrors.value = {};
        return apiClient
            .delete("/admin/leaves/" + id, {
                data: leave,
            })
            .then((response) => {
                console.log("api", "success");
                swal({
                    icon: "success",
                    title: "Leave deleted successfully",
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
        leaves,
        leave,
        getLeaves,
        getLeave,
        storeLeave,
        updateLeave,
        deleteLeave,
        validationErrors: computed(() => validationErrors.value),
        validationMessage,
        isLoading,
    };
}
