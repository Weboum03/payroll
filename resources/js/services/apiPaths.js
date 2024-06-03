// src/constants/apiPaths.js

import apiService from '@/services/apiService';

const getApiPath = {
    getRoles() { return apiService.get(`admin/roles`); },

    getRoleById(id) { return apiService.get(`admin/roles/${id}`); },

    createRole(params) { return apiService.post(`admin/roles`, params); },

    updateRoleById(id, params) { return apiService.update(`admin/roles/${id}`, params); },

    deleteRoleById(id) { return apiService.delete(`admin/roles/${id}`); },
};

export default getApiPath;
