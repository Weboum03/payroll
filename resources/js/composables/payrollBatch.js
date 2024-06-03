import { ref, inject, computed } from 'vue'
import { useRouter } from 'vue-router'
import apiClient from './apiClient';

export default function useUsers() {
    const batches = ref([])
    const batche = ref({
        name: '',
    })

    const router = useRouter()
    const validationErrors = ref({})
    const validationMessage = ref('')
    const isLoading = ref(false)
    const success = ref(false)
    const swal = inject('$swal')

    const getBatches = async (
        page = 1,
        search_id = '',
        search_title = '',
        search_global = '',
        order_column = 'created_at',
        order_direction = 'desc'
    ) => {
        apiClient.get('/admin/payroll_batch?page=' + page +
            '&search_id=' + search_id +
            '&search_title=' + search_title +
            '&search_global=' + search_global +
            '&order_column=' + order_column +
            '&order_direction=' + order_direction)
            .then(response => {
                users.value = response.data;
            })
    }

    const getBatch = async (id) => {
        apiClient.get('/admin/payroll_batch/' + id)
            .then(response => {
                user.value = response.data.data;
            })
    }

    const storeBatch = async (user) => {
        if (isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}

        let serializedPost = new FormData()
        for (let item in user) {
            if (user.hasOwnProperty(item)) {
                serializedPost.append(item, user[item])
            }
        }

        return apiClient.post('/admin/payroll_batch', serializedPost)
            .then(response => {
                user.value = response.data;
                success.value = true
                swal({
                    icon: 'success',
                    title: 'Batch saved successfully'
                })
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                    validationMessage.value = error.response.data.message
                    swal({
                        icon: 'error',
                        title: error.response.data.message
                    }) 
                }
                return Promise.reject(error);
            })
            .finally(() => {
                isLoading.value = false
                success.value = false
            })
    }

    const updateBatch = async (user) => {
        if (isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}

        apiClient.put('/admin/payroll_batch/' + user.id, user)
            .then(response => {
                success.value = true
                router.push({ name: 'users.index' })
                swal({
                    icon: 'success',
                    title: 'Batch updated successfully'
                })
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => {
                isLoading.value = false
                success.value = false
            })
    }

    const deleteBatch = async (id) => {
        swal({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this action!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#ef4444',
            timer: 20000,
            timerProgressBar: true,
            reverseButtons: true
        })
            .then(result => {
                if (result.isConfirmed) {
                    return apiClient.delete('/admin/payroll_batch/' + id)
                        .then(response => {
                            success.value = true
                            // getUsers()
                            //router.push({ name: 'admin/dashboard' })
                            swal({
                                icon: 'success',
                                title: 'Batch deleted successfully'
                            })
                        })
                        .catch(error => {
                            swal({
                                icon: 'error',
                                title: 'Something went wrong'
                            })
                        })
                }
            })
    }

    return {
        batches,
        batche,
        getBatches,
        getBatch,
        storeBatch,
        updateBatch,
        deleteBatch,
        validationErrors: computed(() => validationErrors.value),
        validationMessage,
        isLoading,
        success
    }
}
