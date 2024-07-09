<template>
    <div class="container1 d-flex">
        <div class="container d-flex flex-column justify-content-center align-items-center"
            style="background-color: #D9D9D9;gap: 7rem;height: 100vh;">

            <div class="content">
                <h1 class="Unic"></h1>
                <h2 class="Aven"></h2>
            </div>
            <div class="image"></div>
        </div>

        <div class="container d-flex flex-column justify-content-center align-items-start"
            style="gap: 1rem;padding: 0px 117px;">
            <div class="Welcome gy-20">
                <h1 class="hadding1">Welcome to Uaven</h1>
                <h6 class="hadding2">Aenean feugiat tempus nunc, a comodo tortor feugiat quis. Duis finis sodlar aliquam
                </h6>
            </div>

            <span class="singnIn">Find your account</span>
            <Form @submit="submitForgotPassword" :validation-schema="schema" v-slot="{ validate, errors }">
                <div class="flex-column" id="emailFields" style="gap: 1.5rem;">
                    <div class="row">
                        <div class="col input-group-fname">
                            <Field type="text" name="email" :class="{ 'is-invalid': errors.last_name }"
                                placeholder="Email*" class="input" autocomplete="off" required />
                            <label class="user-label">Email*</label>
                            <ErrorMessage name="email" class="text-danger mt-1" />
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.name">
                                    {{ message }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <router-link
                            style="font-size: 16px;font-weight: 500;line-height: 24px;font-family:Poppins,sans-serif; color: #03A9F3;"
                            :to="{ name: 'auth.login' }">Log In?</router-link>
                    </div>

                </div>
                <button class="btn btn-primary go" type="submit">Go</button>
            </Form>
        </div>
    </div>
</template>

<script setup>
import useAuth from '@/composables/auth'
import { useForm, Form, Field, ErrorMessage } from 'vee-validate';
const { submitForgotPassword, validationErrors, processing, submitLogin } = useAuth();
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import * as yup from "yup";
const showToggle = ref('password')

const route = useRoute();

const schema =
    yup.object({
        email: yup.string().required("Email is required!"),
    });

const { validate, errors } = useForm({ validationSchema: schema });

async function submitForm(values) {
    Object.assign(values, {
        email: route.params.email
    });
    await submitForgotPassword(values)

}
</script>

<style scoped>
@import '@/assets/css/Forgetpassword.css';

.signup {
    font-size: small !important;
    width: 403px;
    padding: 10px !important;
    display: block;
    text-decoration: none;
    text-align: center;
    outline: none;
    border-radius: 0.25rem;
    cursor: pointer;
    transition: 0.3s;
    border-color: rgb(193, 188, 188) !important;
    background-color: #278d27e6 !important;
}
</style>