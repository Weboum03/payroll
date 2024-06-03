<!-- src/components/UserForms.vue -->
<template>
    <div>
        <!-- Form 1 -->
        <form @submit.prevent="handleSubmitForm1(onSubmitForm1)">
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
            <button type="submit" :disabled="isSubmittingForm1">Submit Form 1</button>
        </form>
        <div v-if="successMessageForm1" class="success">{{ successMessageForm1 }}</div>
        <div v-if="errorForm1" class="error">{{ errorForm1.message }}</div>

        <!-- Form 2 -->
        <form @submit.prevent="handleSubmitForm2(onSubmitForm2)">
            <div>
                <label for="address">Address:</label>
                <Field name="address" type="text" />
                <ErrorMessage name="address" />
            </div>
            <div>
                <label for="phone">Phone:</label>
                <Field name="phone" type="text" />
                <ErrorMessage name="phone" />
            </div>
            <button type="submit" :disabled="isSubmittingForm2">Submit Form 2</button>
        </form>
        <div v-if="successMessageForm2" class="success">{{ successMessageForm2 }}</div>
        <div v-if="errorForm2" class="error">{{ errorForm2.message }}</div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useField, useForm, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import useCrud from '@/composables/useCrud';
import { useRoute } from 'vue-router';

const route = useRoute();
const userId = route.params.id;

const { fetchOne, update, item, loading, error } = useCrud(`admin/users/${userId}`);

// Form 1 validation schema
const validationSchemaForm1 = yup.object({
    name: yup.string().required('Name is required'),
    email: yup.string().email('Invalid email').required('Email is required')
});

// Form 2 validation schema
const validationSchemaForm2 = yup.object({
    address: yup.string().required('Address is required'),
    phone: yup.string().required('Phone is required')
});

// Form 1 setup
const { handleSubmit: handleSubmitForm1, isSubmitting: isSubmittingForm1, setValues: setValuesForm1 } = useForm({
    validationSchema: validationSchemaForm1,initialValues: {
    name: 'efe',
    email: ''
  }
});

const successMessageForm1 = ref('');
const errorForm1 = ref(null);

// Form 2 setup
const { handleSubmit: handleSubmitForm2, isSubmitting: isSubmittingForm2, setValues: setValuesForm2 } = useForm({
    validationSchema: validationSchemaForm2
});

const successMessageForm2 = ref('');
const errorForm2 = ref(null);

onMounted(async () => {
    await fetchOne(userId);
    console.log('Vipan', item.value)
    if (item) {
        setValuesForm1({
            name: item.value.name,
            email: item.value.email
        });
        setValuesForm2({
            address: item.value.address,
            phone: item.value.phone
        });
    }
});

const onSubmitForm1 = handleSubmitForm1(async (values) => {
    successMessageForm1.value = '';
    errorForm1.value = null;
    try {
        await update(userId, values);
        successMessageForm1.value = 'User details updated successfully!';
    } catch (err) {
        errorForm1.value = err;
    }
});

const onSubmitForm2 = handleSubmitForm2(async (values) => {
    successMessageForm2.value = '';
    errorForm2.value = null;
    try {
        await update(userId, values);
        successMessageForm2.value = 'User address updated successfully!';
    } catch (err) {
        errorForm2.value = err;
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