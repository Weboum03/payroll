import { ref, inject, computed } from "vue";
import getApiPath from "@/services/apiPaths";

export default function useAttendance() {
    const items = ref([]);
    const item = ref(null);
    const error = ref(null);
    const loading = ref(false);
    const success = ref(false);
    const validationErrors = ref({});
    const swal = inject("$swal");

    const getUserAttendanceCount = async (id, data=[]) => {
        loading.value = true;
        try {
            return await getApiPath.getAttendance(id, data);
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
        getUserAttendanceCount,
        success
    };
}
