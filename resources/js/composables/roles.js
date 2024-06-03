import {ref, inject} from 'vue'
import {useRouter} from 'vue-router'
import apiClient from "./apiClient";

export default function useRoles() {
    const roles = ref([])
    const role = ref({
        name: '',
        permissions: {}
    })
    const roleList = ref([])
    const rolePermissionList = ref([])
    const router = useRouter()
    const validationErrors = ref({})
    const isLoading = ref(false)
    const isSuccess = ref(false)
    const swal = inject('$swal')

    const getRoles = async (
        page = 1,
        search_id = '',
        search_title = '',
        search_global = '',
        order_column = 'created_at',
        order_direction = 'desc'
    ) => {
        apiClient.get('/admin/roles?page=' + page +
            '&search_id=' + search_id +
            '&search_title=' + search_title +
            '&search_global=' + search_global +
            '&order_column=' + order_column +
            '&order_direction=' + order_direction)
            .then(response => {
                roles.value = response.data;
            })
    }

    const getRole = async (id) => {
        apiClient.get('/admin/roles/' + id)
            .then(response => {
                role.value = response.data.data;
            })
    }
    const getRolePermissions = async (id) => {

        apiClient.get('/admin/role-permissions/' + id)
            .then(response => {
                rolePermissionList.value = response.data.data;
            })
    }
    const storeRole = async (role) => {
        if (isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}

        apiClient.post('/admin/roles', role)
            .then(response => {
                router.push({name: 'admin.EmployeeRole'})
                swal({
                    icon: 'success',
                    title: 'Role saved successfully'
                })
                
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => isLoading.value = false)
    }

    const updateRole = async (role) => {
        
        if (isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}

        apiClient.put('/admin/roles/' + role.id, role)
            .then(response => {
                // router.push({name: 'admin.EmployeeRole'})
                window.location.href = '/admin/EmployeeRole'
                swal({
                    icon: 'success',
                    title: 'Role updated successfully'
                })
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => isLoading.value = false)
    }

    const updateRolePermissions = async (role, permissions) => {
        if (isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}
        apiClient.put('/admin/role-permissions', {permissions: JSON.stringify(permissions), role_id: role.id})
            // .then(response => {
            //     router.push({name: 'roles.index'})
            //     swal({
            //         icon: 'success',
            //         title: 'Role updated successfully'
            //     })
            // })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => {
                isLoading.value = false
                updateRole(role)
            })
    }


    const deleteRole =  (id) => {
        isSuccess.value = false;
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
                    apiClient.delete('/admin/roles/' + id)
                        .then(response => {
                            isSuccess.value = true;
                            swal({
                                icon: 'success',
                                title: 'Role deleted successfully'
                            })
                        })
                }
            })
    }

    const getRoleList = async () => {
        apiClient.get('/admin/role-list')
            .then(response => {
                roleList.value = response.data.data;
            })
    }

    return {
        roles,
        role,
        roleList,
        getRoleList,
        getRoles,
        rolePermissionList,
        getRolePermissions,
        getRole,
        storeRole,
        updateRole,
        updateRolePermissions,
        deleteRole,
        validationErrors,
        isLoading,
        isSuccess
    }
}
