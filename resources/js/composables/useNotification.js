import { ref, inject } from "vue";
import getApiPath from "@/services/apiPaths";

export default function useNotification() {
    const items = ref([]);
    const item = ref(null);
    const error = ref(null);
    const loading = ref(false);
    const success = ref(false);
    const validationErrors = ref({});
    const swal = inject("$swal");

    const getNotifications = async () => {
        loading.value = true;
        try {
            items.value = await getApiPath.getNotifications();
        } catch (err) {
            error.value = err;
        } finally {
            loading.value = false;
        }
    };

    const getNotification = async (id) => {
        loading.value = true;
        try {
            item.value = await getApiPath.getNotificationById(id);
        } catch (err) {
            error.value = err;
        } finally {
            loading.value = false;
        }
    };

    const readNotifications = async (id, data) => {
        loading.value = true;
        try {
            await getApiPath.readNotifications(id, data);
            await fetchAll(); // Refresh the list
            swal({
                icon: "success",
                title: "Role updated successfully",
            });
        } catch (err) {
            error.value = err;
            if (error.response?.data) {
                validationErrors.value = error.response.data.errors;
            }
        } finally {
            loading.value = false;
        }
    };

    const readAllNotifications = async (id, data) => {
        loading.value = true;
        try {
            await getApiPath.readAllNotifications(id, data);
            await fetchAll(); // Refresh the list
            swal({
                icon: "success",
                title: "Role updated successfully",
            });
        } catch (err) {
            error.value = err;
            if (error.response?.data) {
                validationErrors.value = error.response.data.errors;
            }
        } finally {
            loading.value = false;
        }
    };

    return {
        items,
        item,
        error,
        validationErrors,
        loading,
        getNotifications,
        getNotification,
        readNotifications,
        readAllNotifications,
        success,
    };
}
