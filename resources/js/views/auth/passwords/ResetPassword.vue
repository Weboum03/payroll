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
                <Form @submit="onSubmit" :validation-schema="schema" v-slot="{ validate, errors }" @invalid-submit="onInvalidSubmit">
                <div class="row" >
                    <div class="col input-group-fname">
                        <Field :type="showToggle.password" name="password" :class="{ 'is-invalid': errors.last_name }"
                                placeholder="New Password*" class="input" autocomplete="off" required />
                        <label class="user-label"> New Password*</label>
                        <i v-if="showToggle.password == 'password'" class="fas fa-eye fa-lg" @click="eyeIcon('password')" id="togglePassword2" style="color: #848484;position:relative;top: -38px;left: 416px;"></i>
                        <i v-if="showToggle.password == 'text'" class="fas fa-eye-slash fa-lg" @click="eyeIcon('password')" id="togglePassword2" style="color: #848484;position:relative;top: -38px;left: 416px;"></i>
                        
                    </div>
                    <div class="col input-group-fname">
                        <Field :type="showToggle.cpassword" name="cpassword" :class="{ 'is-invalid': errors.last_name }"
                                placeholder="Confirm Password*" class="input" autocomplete="off" required />
                        <label class="user-label">Confirm Password*</label>
                    <i v-if="showToggle.cpassword == 'password'" class="fas fa-eye fa-lg" @click="eyeIcon('cpassword')" id="togglePassword3" style="color: #848484;position:relative;top: -38px;left: 416px;"></i>
                    <i v-if="showToggle.cpassword == 'text'" class="fas fa-eye-slash fa-lg" @click="eyeIcon('cpassword')" id="togglePassword3" style="color: #848484;position:relative;top: -38px;left: 416px;"></i>
                        
                </div>
                    <div class="col input-group-fname">
                        <Field type="text" name="otp" :class="{ 'is-invalid': errors.last_name }"
                                placeholder="OTP*" class="input" autocomplete="off" required />
                        <label class="user-label">OTP*</label>
                        
                    </div>
                </div>
                <button type="submit" class="btn btn-primary savenext" style=" margin-top: 20px;">Submit</button>
                <template>
                        <div v-if="valErrors = errors"></div>
                    </template>
                </Form>
            </div>
        </div>
    </div>
</template>

<script setup>
import useAuth from '@/composables/auth'
import { Form, useForm, Field, ErrorMessage } from 'vee-validate';
import { inject, ref } from 'vue';
import * as yup from "yup";
const { submitResetPassword, validationErrors, processing, submitLogin } = useAuth();
const valErrors = ref({});
const swal = inject('$swal')

import { useRoute } from 'vue-router'

const route = useRoute()

const showToggle = ref({
    password : 'password',
    cpassword : 'password',
})

function capitalize(s)
{
    return s[0].toUpperCase() + s.slice(1);
}

function onInvalidSubmit({ values, errors, results }) {
    let current = valErrors.value;
    if (Object.keys(current).length > 0) {
        swal({
            icon: "error",
            title: capitalize(Object.values(current)[0]),
        });
    }
}

const formValues = ref({
    password:'',
    cpassword: '',
    otp:''
})
const schema =
    yup.object({
        password: yup.string()
        .min(6, 'Password must be at least 6 characters')
        .required('Password is required'),
        cpassword: yup.string()
            .oneOf([yup.ref('password'), null], 'Passwords must match')
            .required('Confirm Password is required'),
        otp: yup.string().required("OTP is required!"),
    });

const { validate, errors } = useForm({ validationSchema: schema });

// const { handleSubmit, values } = useForm();

const onSubmit = async (values) => {
    Object.assign(values, {
        email: route.query.email
    });
    await submitResetPassword(values)
};


const handleSubmit = async (values, { resetForm }) => {
  const result = await validate(); // Assuming you have a validation function

  console.log('result', result)
  if (!result.valid) {
    // Find the first invalid field and focus on it
    for (const key in result.errors) {
      if (result.errors[key]) {
        if (key === "password" && emailInput.value) {
          emailInput.value.focus();
          break;
        }
      }
    }
  } else {
    // Form is valid, proceed with submission
    console.log("Form submitted successfully!", values);
    resetForm();
  }
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

.text-danger {
    float: left;
}
.is-invalid {
    border-color: red;
}
</style>