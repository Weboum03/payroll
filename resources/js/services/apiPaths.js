// src/constants/apiPaths.js

import apiService from '@/services/apiService';

const getApiPath = {
    getRoles() { return apiService.get(`admin/roles`); },

    getRoleById(id) { return apiService.get(`admin/roles/${id}`); },

    createRole(params) { return apiService.post(`admin/roles`, params); },

    updateRoleById(id, params) { return apiService.update(`admin/roles/${id}`, params); },

    deleteRoleById(id) { return apiService.delete(`admin/roles/${id}`); },

    //Batches

    getBadges() { return apiService.get(`admin/batches`); },

    getBadgeUsers(id) { return apiService.get(`admin/batches/${id}/users`); },

    deleteBatchUser(id) { return apiService.delete(`admin/batches/users/${id}`); },

    getBadgeById(id) { return apiService.get(`admin/batches/${id}`); },

    createBadge(params) { return apiService.post(`admin/batches`, params); },

    updateBadgeById(id, params) { return apiService.update(`admin/batches/${id}`, params); },

    deleteBadgeById(id) { return apiService.delete(`admin/batches/${id}`); },
};

export default getApiPath;
