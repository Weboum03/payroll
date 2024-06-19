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

    getBadgeUsers(id,params = '') { return apiService.get(`admin/batches/${id}/users${params}`); },

    deleteBatchUser(id, userId) { return apiService.delete(`admin/batches/${id}/users/${userId}`); },

    getBadgeById(id) { return apiService.get(`admin/batches/${id}`); },

    createBadge(params) { return apiService.post(`admin/batches`, params); },
    
    storeBadgeEmployee(id, params) { return apiService.update(`admin/batches/${id}/users`, params); },

    processBatch(id) { return apiService.update(`admin/batches/${id}/process`); },

    exportBatch(id,params) { return apiService.update(`admin/batches/${id}/export`, params); },

    downloadBatch(id,params) { return apiService.update(`admin/batches/${id}/download`, params); },

    importBatch(id, params) { return apiService.post(`admin/batches/${id}/import`,params); },

    updateBadgeById(id, params) { return apiService.update(`admin/batches/${id}`, params); },

    deleteBadgeById(id) { return apiService.delete(`admin/batches/${id}`); },
};

export default getApiPath;
