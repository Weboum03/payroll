import { ref, inject } from "vue";
import getApiPath from "@/services/apiPaths";

export default function useBatch() {
    const items = ref([]);
    const item = ref(null);
    const error = ref(null);
    const loading = ref(false);
    const success = ref(false);
    const validationErrors = ref({});
    const swal = inject("$swal");

    const fetchAll = async () => {
        loading.value = true;
        try {
            items.value = await getApiPath.getBadges();
        } catch (err) {
            error.value = err;
        } finally {
            loading.value = false;
        }
    };

    const getBatchUsers = async (id, filters=[]) => {
        loading.value = true;
        try {
            let queryString = new URLSearchParams(filters).toString();
            if(queryString) { queryString = '?'+ queryString }
            console.log('vipan',queryString)
            items.value = await getApiPath.getBadgeUsers(id, queryString);
        } catch (err) {
            error.value = err;
        } finally {
            loading.value = false;
        }
    };

    const fetchOne = async (id) => {
        loading.value = true;
        try {
            item.value = await getApiPath.getBadgeById(id);
        } catch (err) {
            error.value = err;
        } finally {
            loading.value = false;
        }
    };

    const create = async (data) => {
        loading.value = true;
        success.value = false;
        validationErrors.value = {};
        try {
            await getApiPath.createBadge(data);
            await fetchAll(); // Refresh the list
            swal({
                icon: "success",
                title: "Role saved successfully",
            });
            success.value = true;
        } catch (err) {
            error.value = err;
            if (error.response?.data) {
                validationErrors.value = error.response.data.errors;
            }
        } finally {
            loading.value = false;
        }
    };

    const update = async (id, data) => {
        loading.value = true;
        try {
            await getApiPath.updateBadgeById(id, data);
            await fetchAll(); // Refresh the list
            swal({
                icon: "success",
                title: "Updated successfully",
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

    const addEmployee = async (id, data) => {
        loading.value = true;
        try {
            await getApiPath.storeBadgeEmployee(id, data);
            swal({
                icon: "success",
                title: "Updated successfully",
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

    const deleteBatchUser = async (id, userId) => {
        await swal({
            title: "Are you sure?",
            text: "You won't be able to revert this action!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            confirmButtonColor: "#ef4444",
            timer: 20000,
            timerProgressBar: true,
            reverseButtons: true,
        }).then(async (result) => {
            if (result.isConfirmed) {
                loading.value = true;
                try {
                    await getApiPath.deleteBatchUser(id, userId);
                    // await fetchAll(); // Refresh the list
                    success.value = true;
                } catch (err) {
                    if (error.response?.data) {
                        validationErrors.value = error.response.data.errors;
                    }
                    error.value = err;
                } finally {
                    loading.value = false;
                }
            }
        });
    };

    const remove = async (id) => {
        await swal({
            title: "Are you sure?",
            text: "You won't be able to revert this action!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            confirmButtonColor: "#ef4444",
            timer: 20000,
            timerProgressBar: true,
            reverseButtons: true,
        }).then(async (result) => {
            if (result.isConfirmed) {
                loading.value = true;
                try {
                    await getApiPath.deleteBadgeById(id);
                    // await fetchAll(); // Refresh the list
                    success.value = true;
                } catch (err) {
                    if (error.response?.data) {
                        validationErrors.value = error.response.data.errors;
                    }
                    error.value = err;
                } finally {
                    loading.value = false;
                }
            }
        });
    };

    return {
        items,
        item,
        error,
        validationErrors,
        loading,
        fetchAll,
        getBatchUsers,
        deleteBatchUser,
        fetchOne,
        create,
        addEmployee,
        update,
        remove,
        success,
    };
}
