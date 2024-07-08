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
                <form @submit.prevent="onSubmit">
                <div class="row" >
                    <div class="col input-group-fname">
                        <input placeholder="New Password*" name="password" v-model="formValues.password" required="" :type="showToggle.password" autocomplete="off" class="input" id="newPassword">
                        <label class="user-label"> New Password*</label>
                        <i class="fas fa-eye fa-lg" @click="eyeIcon('password')" id="togglePassword2" style="color: #848484;position:relative;top: -38px;left: 416px;"></i>
                        <!-- <ErrorMessage name="password" /> -->
                    </div>
                    <div class="col input-group-fname">
                        <input placeholder="Conform Password*" name="cpassword" v-model="formValues.cpassword" :type="showToggle.cpassword" required="" autocomplete="off" class="input">
                        <label class="user-label">Conform Password*</label>
                    <i class="fas fa-eye fa-lg" @click="eyeIcon('cpassword')" id="togglePassword3" style="color: #848484;position:relative;top: -38px;left: 416px;"></i>
                    <ErrorMessage name="cpassword" />
                </div>
                    <div class="col input-group-fname">
                        <input placeholder="OTP*" required="" name="otp" type="number" v-model="formValues.otp" autocomplete="off" class="input">
                        <label class="user-label">OTP*</label>
                        <ErrorMessage name="otp" />
                    </div>

                </div>
                <button type="submit" class="btn btn-primary savenext" style=" margin-top: 20px;">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import useAuth from '@/composables/auth'
import { useForm, Field, ErrorMessage } from 'vee-validate';
import { ref } from 'vue';
import * as yup from "yup";
const { loginForm, validationErrors, processing, submitLogin } = useAuth();
const showToggle = ref({
    password : 'password',
    cpassword : 'password',
})

const formValues = ref({
    password:'',
    cpassword: '',
    otp:''
})
const schema =
    yup.object({
        password: yup.string().required("Password is required!"),
    });

const { validate, errors } = useForm({ validationSchema: schema });

// const { handleSubmit, values } = useForm();
    
const onSubmit = () => {
    
    validate().then(form => {
        console.log('values', form)
        if (form.valid) {
            alert('sfg');
        }
    })
};



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