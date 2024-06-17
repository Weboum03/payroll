import apiClient from '@/composables/apiClient';

const apiService = {
  get(resource) {
    return apiClient.get(resource).then(response => Promise.resolve(response.data)).catch(error => Promise.reject(error));
  },
  post(resource, params) {
    return apiClient.post(resource, params).then(response => Promise.resolve(response.data)).catch(error => Promise.reject(error));
  },
  update(resource, params) {
    return apiClient.put(resource, params).then(response => Promise.resolve(response.data)).catch(error => Promise.reject(error));
  },
  delete(resource) {
    return apiClient.delete(resource).then(response => Promise.resolve(response.data)).catch(error => Promise.reject(error));
  }
};

export default apiService;
