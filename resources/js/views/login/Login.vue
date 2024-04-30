<template>
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <div class="border-0 shadow-sm">
                    <div class="card-body">
                        <Form @submit="handleLogin" :validation-schema="schema" v-slot="{ errors }">
                            <div class="">
                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ $t('email') }}</label>
                                    <Field  v-model="loginForm.email" id="email" type="email" name="email" :class="{ 'is-invalid': errors.email }" class="form-control" autofocus autocomplete="username" />
                                    <!-- Validation Errors -->
                                    <div class="text-danger mt-1">
                                        {{errors.email}}
                                    </div>
                                    <!-- <ErrorMessage name="email" class="error-feedback" /> -->
                                </div>
                                <!-- Password -->
                                <div class="mb-4">
                                    <label for="password" class="form-label">
                                        {{ $t('password') }}
                                    </label>
                                    <Field name="password" :class="{ 'is-invalid': errors.password }" v-model="loginForm.password" id="password" type="password" class="form-control" required autocomplete="current-password" />
                                    <!-- Validation Errors -->
                                    <div class="text-danger mt-1">
                                        {{errors.password}}
                                    </div>
                                </div>
                                <!-- Remember me -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" v-model="loginForm.remember" id="flexCheckIndeterminate">
                                    <label class="form-check-label" for="flexCheckIndeterminate">
                                        {{ $t('remember_me') }}
                                    </label>
                                </div>

                                <!-- Buttons -->
                                <div class="flex items-center justify-end mt-4">
                                    <button class="btn btn-primary" :class="{ 'opacity-25': processing }" :disabled="processing">
                                        {{ $t('login') }}
                                    </button>
                                </div>
                            </div>
                            <router-link :to="{name: 'auth.forgot-password'}">{{ $t('forgot_password')}}</router-link>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import useAuth from '@/composables/auth'
import { Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";
const { loginForm, validationErrors, processing, submitLogin } = useAuth();
import store from '../../store';
import { useRouter } from "vue-router";

let loading = false;
const message = "";
const schema = yup.object().shape({
        email: yup.string().required("Email is required!"),
        password: yup.string().required("Password is required!"),
    });

    const router = useRouter()

    const handleLogin = (user) => {
        loading = true;
        store.dispatch("auth/login", user).then(
        () => {
            router.push({ name: 'admin.index' })
        },
        (error) => {
          loading = false;
          message =
            (error.response &&
              error.response.data &&
              error.response.data.message) ||
            error.message ||
            error.toString();
        }
      );
    }

</script>
