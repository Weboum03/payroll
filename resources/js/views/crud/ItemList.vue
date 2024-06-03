<!-- src/components/ItemList.vue -->
<template>
    <div>
      <button @click="fetchAll">Load Items</button>
      <div v-if="loading">Loading...</div>
      <div v-if="error">{{ error }}</div>
      <ul v-if="items.length">
        <li v-for="item in items" :key="item.id">{{ item.name }}</li>
      </ul>
    </div>
  </template>
  
  <script setup>
  import { onMounted } from 'vue';
  import useCrud from '@/composables/useCrud';
  
  const { items, loading, error, fetchAll } = useCrud('items');
  
  onMounted(fetchAll);
  </script>
  