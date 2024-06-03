import apiClient from '@/composables/apiClient';

const apiService = {
  get(resource) {
    return apiClient.get(resource).then(response => response.data);
  },
  post(resource, params) {
    return apiClient.post(resource, params).then(response => response.data);
  },
  update(resource, params) {
    return apiClient.put(resource, params).then(response => response.data);
  },
  delete(resource) {
    return apiClient.delete(resource).then(response => response.data);
  }
};

export default apiService;
