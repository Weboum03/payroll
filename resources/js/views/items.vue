<template>
    <div>
      <div v-if="itemsStore.loading">Loading...</div>
      <div v-if="itemsStore.error">{{ itemsStore.error }}</div>
      <ul v-if="!itemsStore.loading && !itemsStore.error">
        <li v-for="item in itemsStore.items" :key="item.id">{{ item.email }}</li>
      </ul>
      <p>Total Items: {{ itemsStore.itemCount }}</p>
    </div>
  </template>
  
  <script setup>
  import { onMounted } from 'vue';
  import { useItemsStore } from '@/stores/items';
  
  const itemsStore = useItemsStore();
  
  onMounted(() => {
    itemsStore.fetchItems();
  });
  </script>
  