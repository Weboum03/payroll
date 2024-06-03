// src/composables/useCrud.js
import { ref } from 'vue';
import apiService from '@/services/apiService';

export default function useCrud(resource) {
  const items = ref([]);
  const item = ref(null);
  const error = ref(null);
  const loading = ref(false);

  const fetchAll = async () => {
    loading.value = true;
    try {
      items.value = await apiService.get(resource);
    } catch (err) {
      error.value = err;
    } finally {
      loading.value = false;
    }
  };

  const fetchOne = async (id) => {
    loading.value = true;
    try {
      let response =  await apiService.get(resource);
      item.value = response.data;
    } catch (err) {
      error.value = err;
    } finally {
      loading.value = false;
    }
  };

  const create = async (data) => {
    loading.value = true;
    try {
      await apiService.post(resource, data);
      await fetchAll(); // Refresh the list
    } catch (err) {
      error.value = err;
    } finally {
      loading.value = false;
    }
  };

  const update = async (id, data) => {
    loading.value = true;
    try {
      await apiService.update(resource, data);
      await fetchAll(); // Refresh the list
    } catch (err) {
      error.value = err;
    } finally {
      loading.value = false;
    }
  };

  const remove = async (id) => {
    loading.value = true;
    try {
      await apiService.delete(resource);
      await fetchAll(); // Refresh the list
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
    loading,
    fetchAll,
    fetchOne,
    create,
    update,
    remove
  };
}
