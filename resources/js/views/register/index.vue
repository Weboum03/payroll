<template>
    <div class="container1 d-flex max-width: 1616px;">
        <div class="image container">

            <div class="content">
                <h1 class="Unic">U</h1>
                <h2 class="Aven">aven.</h2>
            </div>
        </div>

        <div class="container d-flex flex-column justify-content-center align-items-start"
            style="gap: 1rem;padding: 117px;padding-top: 70px;">

            <div class="Welcome gy-20">
                <h1 class="hadding1">Welcome to Uaven</h1>
                <h6 class="hadding2">Aenean feugiat tempus nunc, a comodo tortor feugiat</h6>
                <h6 class="hadding3"> quis. Duis finis sodlar aliquam</h6>
            </div>

            <span class="singnIn">Signup</span>
            <Form @submit="submitRegister" :validation-schema="schema" v-slot="{ errors }">
                <div class="d-flex flex-column" style="gap: 1.5rem;">

                    <div class="row">
                        <div class="col input-group-fname">
                            <Field v-model="registerForm.name" placeholder="Name*" type="text" autocomplete="off"
                                name="name" class="input" id="Name" />
                            <label class="user-label">Name</label>
                            <!-- Validation Errors -->
                            <div class="text-danger mt-1">
                                {{ errors.name }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.name">
                                    {{ message }}
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col input-group-fname">
                            <Field v-model="registerForm.email" placeholder="Email*" type="email" autocomplete="off"
                                name="email" class="input" id="Email" />
                            <label class="user-label">Email*</label>
                            <!-- Validation Errors -->
                            <div class="text-danger mt-1">
                                {{ errors.email }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.email">
                                    {{ message }}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col input-group-fname">
                            <Field name="password" v-model="registerForm.password" placeholder="Password*"
                                autocomplete="current-password" required type="password" class="input" />
                            <label class="user-label">Password</label>
                            <!-- Validation Errors -->
                            <div class="text-danger mt-1">
                                {{ errors.password }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.password">
                                    {{ message }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col input-group-fname">
                            <Field name="password_confirmation" v-model="registerForm.password_confirmation"
                                placeholder="Password*" autocomplete="current-password" required type="password"
                                class="input" id="Password" />
                            <label class="user-label">Confirm Password</label>
                            <!-- Validation Errors -->
                            <div class="text-danger mt-1">
                                {{ errors.password_confirmation }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.password_confirmation">
                                    {{ message }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="remMe">
                            <label class="custom-control-label" for="remMe">Remember me</label>
                        </div>
                        <router-link style="font-size: small;" :to="{ name: 'auth.login' }">Login Now</router-link>
                    </div>
                </div>
                <button type="submit" :class="{ 'opacity-25': processing }" :disabled="processing"
                    class="btn btn-primary savenext">Sign Up</button>
            </Form>
        </div>

    </div>
</template>

<script setup>

import useAuth from '@/composables/auth'
import { Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";
const { registerForm, validationErrors, processing, submitRegister } = useAuth();

const schema = yup.object().shape({
    name: yup.string().required("Name is required!"),
    email: yup.string().required("Email is required!"),
    password: yup.string().required("Password is required!"),
    password_confirmation: yup.string().required("Password is required!"),
});
</script>

<style scoped>
@import '@/assets/css/Login.css';
</style>