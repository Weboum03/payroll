<!-- src/components/UserCreate.vue -->
<template>
    <div>
      <form @submit.prevent="handleSubmit">
        <div>
          <label for="name">Name:</label>
          <Field name="name" type="text" />
          <ErrorMessage name="name" />
        </div>
        <div>
          <label for="email">Email:</label>
          <Field name="email" type="email" />
          <ErrorMessage name="email" />
        </div>
        <button type="submit" :disabled="isSubmitting">Create User</button>
      </form>
      <div v-if="loading">Creating user...</div>
      <div v-if="error" class="error">{{ error.message }}</div>
      <div v-if="successMessage" class="success">{{ successMessage }}</div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useField, useForm, Field, ErrorMessage } from 'vee-validate';
  import * as yup from 'yup';
  import useCrud from '@/composables/useCrud';
  
  const { create, loading, error } = useCrud('users');
  
  const validationSchema = yup.object({
    name: yup.string().required('Name is required'),
    email: yup.string().email('Invalid email').required('Email is required')
  });
  
  const { handleSubmit, isSubmitting } = useForm({
    validationSchema
  });
  
  const successMessage = ref('');
  
  const onSubmit = handleSubmit(async (values) => {
    successMessage.value = '';
    error.value = null;
    try {
      await create(values);
      successMessage.value = 'User created successfully!';
    } catch (err) {
      error.value = err;
    }
  });
  </script>
  
  <style>
  .error {
    color: red;
  }
  .success {
    color: green;
  }
  </style>
  