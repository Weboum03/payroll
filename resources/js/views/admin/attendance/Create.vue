<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container">
        <div id="dashboard-table-info">
            <span>Attendance</span>
            <span>Create New Attendance</span>
        </div>

        <div class="container header d-flex flex-column" style="gap: 1.5rem;">
            <div class="sec d-flex flex-column">
                <p>Attendance</p>
            </div>
            <form>
                <div class="container d-flex flex-column" style="gap: 2rem;">
                    <div class="btns-Update-cancle">
                        <button v-if="text" type="submit" :disabled="isLoading" @click="makeAttendance" class="btn btn-primary savenext">{{ text }}</button>
                        <router-link :to="{name: 'admin.home'}" class="btn btn-outline-light cancle">Cancel</router-link>
                    </div>

                </div>

            </form>
        </div>


    </div>
</template>


<script setup>
import { inject, onMounted } from "vue";
import useLeaves from "@/composables/leaves";
import { useRouter } from "vue-router";
import * as yup from 'yup';
import { Form, Field, ErrorMessage } from "vee-validate";
import { ref } from "vue";
const swal = inject("$swal");
const router = useRouter();
// Define a validation schema
const text = ref('Check In')
const { checkIn, checkOut, getAttendanceStatus, validationErrors, isLoading } = useLeaves();

const makeAttendance = async () => {
    if(text.value == 'Check In') { await checkIn(); text.value = 'Check Out' } 
    else if(text.value == 'Check Out') { await checkOut(); text.value = ''  }
}

onMounted( async () => {
    let response = await getAttendanceStatus();
    console.log('response', response)
    if(response.in) {
        text.value = 'Check Out';
    }
    if(response.out) {
        text.value = 'Already Checkout';
    }
})
</script>

<style scoped>
@import '@/assets/css/EmployeeRoleEdit.css';

.input-group-fname>.input1 {
    width: 780px !important;
    height: 110px;
    width: 332px;
    border: solid 1px #9e9e9e;
    padding: 8px !important;
    border-radius: 11px;
    background-color: white !important;
    font-size: .95rem;
    color: #000000;
    transition: border 150ms cubic-bezier(0.4, 0, 0.2, 1);
}
</style>