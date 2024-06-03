<!-- src/components/ItemDetail.vue -->
<template>
    <div>
      <button @click="fetchOne(itemId)">Load Item</button>
      <div v-if="loading">Loading...</div>
      <div v-if="error">{{ error }}</div>
      <div v-if="item">
        <h2>{{ item.name }}</h2>
        <p>{{ item.description }}</p>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import useCrud from '@/composables/useCrud';
  
  const { item, loading, error, fetchOne } = useCrud('items');
  const itemId = ref(1);
  </script>
  