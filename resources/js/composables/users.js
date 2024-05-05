import { ref, inject, computed } from 'vue'
import { useRouter } from 'vue-router'
import apiClient from './api-client';

export default function useUsers() {
    const users = ref([])
    const user = ref({
        name: '',
        first_name: '',
        last_name: ''
    })

    const router = useRouter()
    const validationErrors = ref({})
    const validationMessage = ref('')
    const isLoading = ref(false)
    const swal = inject('$swal')

    const getUsers = async (
        page = 1,
        search_id = '',
        search_title = '',
        search_global = '',
        order_column = 'created_at',
        order_direction = 'desc'
    ) => {
        apiClient.get('/admin/users?page=' + page +
            '&search_id=' + search_id +
            '&search_title=' + search_title +
            '&search_global=' + search_global +
            '&order_column=' + order_column +
            '&order_direction=' + order_direction)
            .then(response => {
                users.value = response.data;
            })
    }

    const getUser = async (id) => {
        apiClient.get('/admin/users/' + id)
            .then(response => {
                user.value = response.data.data;
            })
    }

    const storeUser = async (user) => {
        if (isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}

        let serializedPost = new FormData()
        for (let item in user) {
            if (user.hasOwnProperty(item)) {
                serializedPost.append(item, user[item])
            }
        }

        return apiClient.post('/admin/users', serializedPost)
            .then(response => {
                user.value = response.data;
                swal({
                    icon: 'success',
                    title: 'User saved successfully'
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
            .finally(() => isLoading.value = false)
    }

    const updateUser = async (user) => {
        if (isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}

        apiClient.put('/admin/users/' + user.id, user)
            .then(response => {
                router.push({ name: 'users.index' })
                swal({
                    icon: 'success',
                    title: 'User updated successfully'
                })
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => isLoading.value = false)
    }

    const deleteUser = async (id) => {
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
                    return apiClient.delete('/admin/users/' + id)
                        .then(response => {
                            // getUsers()
                            //router.push({ name: 'admin/dashboard' })
                            swal({
                                icon: 'success',
                                title: 'User deleted successfully'
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
        users,
        user,
        getUsers,
        getUser,
        storeUser,
        updateUser,
        deleteUser,
        validationErrors: computed(() => validationErrors.value),
        validationMessage,
        isLoading
    }
}
