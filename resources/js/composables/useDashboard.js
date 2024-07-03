import { ref, inject, computed } from "vue";
import getApiPath from "@/services/apiPaths";

export default function useDashboard() {
    const items = ref([]);
    const item = ref(null);
    const error = ref(null);
    const loading = ref(false);
    const success = ref(false);
    const validationErrors = ref({});
    const swal = inject("$swal");

    const getDashboardDetails = async (data=[]) => {
        loading.value = true;
        try {
            return await getApiPath.getDashboardDetails(data);
        } catch (err) {
            error.value = err;
        } finally {
            loading.value = false;
        }
    };

    const getDashboardUsers = async (data=[]) => {
        loading.value = true;
        try {
            return await getApiPath.getDashboardUsers(data);
        } catch (err) {
            error.value = err;
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
        getDashboardDetails,
        getDashboardUsers,
        success
    };
}
