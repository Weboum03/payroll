<template>
    <div>
      <p>Count: {{ counterStore.count }}</p>
      <p>Double Count: {{ counterStore.doubleCount }}</p>
      <button @click="counterStore.increment">Increment</button>
    </div>
  </template>
  
  <script setup>
  import { useCounterStore } from '@/stores/counter';
  
  // Access the store
  const counterStore = useCounterStore();
  </script>
  