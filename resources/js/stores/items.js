// src/stores/items.js
import { defineStore } from 'pinia';
import axios from 'axios';

export const useItemsStore = defineStore('items', {
  state: () => ({
    items: [],
    loading: false,
    error: null,
  }),
  actions: {
    async fetchItems() {
      this.loading = true;
      this.error = null;
      try {
        const response = await axios.get('https://reqres.in/api/users?page=2');
         
        this.items = response.data.data;
        console.log(this.items)
      } catch (err) {
        this.error = 'Failed to fetch items';
      } finally {
        this.loading = false;
      }
    },
  },
  getters: {
    itemCount: (state) => state.items.length,
  },
});
