<template>
    <div class="container1 d-flex max-width: 1616px;">
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
                <h6 class="hadding2">Aenean feugiat tempus nunc, a comodo tortor feugiat quis. Duis finibus sodales
                    aliquam</h6>
                <!-- <h6 class="hadding3"> quis. Duis finis sodlar aliquam</h6> -->
            </div>

            <span class="singnIn">Log In</span>
            <Form @submit="submitLogin" :validation-schema="schema" v-slot="{ errors }" class="d-flex flex-column"
                style="gap: 1.5rem;">
                <div class="row">
                    <div class="col input-group-fname">
                        <Field v-model="loginForm.email" :class="{ 'is-invalid': errors.email }" placeholder="Email*"
                            type="email" autocomplete="off" name="email" class="input" id="Email" />
                        <label class="user-label">Email*</label>
                        <!-- Validation Errors -->
                        <div class="text-danger mt-1">
                            {{ errors.email }}
                        </div>
                    </div>

                </div>
                <div class="row">

                    <div class="col input-group-fname">
                        <Field name="password" :class="{ 'is-invalid': errors.password }" v-model="loginForm.password"
                            placeholder="Password*" required type="password" autocomplete="off" class="input"
                            id="Password" />
                        <label class="user-label">Password*</label>
                        <!-- Validation Errors -->
                        <div class="text-danger mt-1">
                            {{ errors.password }}
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="remMe">
                        <label class="custom-control-label" for="remMe">Remember me</label>
                    </div>

                    <router-link
                        style="font-size: 16px;font-weight: 500;line-height: 24px;font-family:Poppins,sans-serif; color: #03A9F3;"
                        :to="{ name: 'auth.forgot-password' }">{{ $t('forgot_password') }}</router-link>
                </div>
                <button type="submit" :class="{ 'opacity-25': processing }" :disabled="processing"
                    class="btn btn-primary savenext">Login</button>
            </Form>
        </div>

    </div>

</template>

<script setup>
import useAuth from '@/composables/auth'
import { Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";
const { loginForm, validationErrors, processing, submitLogin } = useAuth();

const schema = yup.object().shape({
    email: yup.string().required("Email is required!"),
    password: yup.string().required("Password is required!"),
});
</script>

<style scoped>
@import '@/assets/css/Login.css';

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