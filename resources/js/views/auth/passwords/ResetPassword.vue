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

            <div class="flex-column" id="passwordFields" style="gap: 1.5rem;">
                <div class="row" >
                    <div class="col input-group-fname">
                        <input placeholder="New Password*" required="" :type="showToggle.password" autocomplete="off" class="input" id="newPassword">
                        <label class="user-label"> New Password*</label>
                        <i class="fas fa-eye fa-lg" @click="eyeIcon('password')" id="togglePassword2" style="color: #848484;position:relative;top: -38px;left: 416px;"></i>
                    </div>
                    <div class="col input-group-fname">
                        <input placeholder="Conform Password*" :type="showToggle.cpassword" required="" autocomplete="off" class="input" id="confirmPassword">
                        <label class="user-label">Conform Password*</label>
                    <i class="fas fa-eye fa-lg" @click="eyeIcon('cpassword')" id="togglePassword3" style="color: #848484;position:relative;top: -38px;left: 416px;"></i>
                    </div>
                    <div class="col input-group-fname">
                        <input placeholder="OTP*" required="" type="number" autocomplete="off" class="input" id="confirmPassword">
                        <label class="user-label">OTP*</label>
                    </div>

                </div>
                <a href="Login.html" class="btn btn-primary savenext" data-toggle="modal" data-target="#SuccessBackdrop" style=" margin-top: 20px;">Submit</a>
            </div>
        </div>
    </div>
</template>

<script setup>
import useAuth from '@/composables/auth'
import { Form, Field, ErrorMessage } from "vee-validate";
import { ref } from 'vue';
import * as yup from "yup";
const { loginForm, validationErrors, processing, submitLogin } = useAuth();
const showToggle = ref({
    password : 'password',
    cpassword : 'password',
})

const schema = yup.object().shape({
    email: yup.string().required("Email is required!"),
    password: yup.string().required("Password is required!"),
});

const eyeIcon = (value) => {
    if(showToggle.value[value] == 'password') { showToggle.value[value] = 'text'; } else { showToggle.value[value] = 'password' }
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