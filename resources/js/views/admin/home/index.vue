<template>
    <!-- -----nav-dashboard-table start----- -->

    <div id="dashboard-table-info">
        <span>Dashboard</span>
        <span>Dashboard</span>
    </div>

    <div id="dashboard-table">
        <div id="Financial-year-dropdown">
            <span>Employee Data</span>
            <button type="button" class="btn btn-primary" id="compareData" @click="openModalCompare">
                Compare Data
            </button>
        </div>

        <nav aria-label="Page navigation example" class="d-flex flex-column"
            style="background-color: white;gap: 1rem;padding-top: 10px;">
            <div class="d-flex" style="gap: 15rem;">
                <div
                    style="font-size: 13px; margin-left: 15px; color: #212121;font-weight: 500;font-family: sans-serif;background-color: white;line-height: 19.5px;opacity: 50%;">
                    July 2024 payroll from 1st July 2024 to 31st July 2024</div>
            </div>
        </nav>


        <div class="d-flex flex-column align-items-center; " style="background-color: white;gap: 1rem; ">


            <div class="graph chartjs-div-payrolldata d-flex justify-content-between" style="gap: 175px;">
                <div class="payrolldata-graph d-flex flex-column justify-content-center">
                    <div class="programming-stats4">
                        <div class="payrollData-container">
                            <div class="payrolldata-chart">
                                <Doughnut :key="tableKey" id="counter" :data="data" :options="options" />
                            </div>
                        </div>

                        <div class="details">
                            <ul>
                                <li style="display: flex;">
                                    <div
                                        style="display: flex; width: 21px; background-color: rgb(4, 146, 245); height: 21px; border-radius: 28%;">
                                    </div>
                                    <div>Payroll Processed {{ employeeData?.batch_processed }}</div>
                                </li>
                                <li style="display: flex;">
                                    <div
                                        style="display: flex; width: 21px; background-color: rgb(218, 225, 243); height: 21px; border-radius: 28%;">
                                    </div>
                                    <div>Pending count {{ employeeData?.batch_pending }}</div>
                                </li>
                            </ul>
                        </div>

                        <div class="details" ref="detail">
                            <ul></ul>
                        </div>
                    </div>
                </div>


                <div class="FinencialTable" v-if="employeeData">
                    <table class="table table-bordered" style="margin-top: 14px;">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">{{ employeeData?.last_month?.name }}</th>
                                <th scope="col">{{ employeeData?.current_month?.name }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Employee Count</th>
                                <td @click="viewEmployeeData(6,'employees')">{{ employeeData?.last_month?.employees }}</td>
                                <td @click="viewEmployeeData(7,'employees')">{{ employeeData?.current_month?.employees }}</td>
                            </tr>
                            <tr>
                                <th scope="row">New Starter</th>
                                <td @click="viewEmployeeData(6,'new_starter')">{{ employeeData?.last_month?.new_starter }}</td>
                                <td @click="viewEmployeeData(7,'new_starter')">{{ employeeData?.current_month?.new_starter }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Leaver</th>
                                <td @click="viewEmployeeData(6,'leaver')">{{ employeeData?.last_month?.leaver }}</td>
                                <td @click="viewEmployeeData(7,'leaver')">{{ employeeData?.current_month?.leaver }}</td>
                            </tr>
                            <tr>
                                <th scope="row">On Notice Period</th>
                                <td @click="viewEmployeeData(6,'on_notice_period')">{{ employeeData?.last_month?.on_notice_period }}</td>
                                <td @click="viewEmployeeData(7,'on_notice_period')" id="noticPrd-Table" >
                                    {{ employeeData?.current_month?.on_notice_period }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="PayrollBatch-btn" class="d-flex justify-content-center align-items-center" style="gap: 1rem;">
                <button type="button" v-if="can('Generate Payroll')" class="btn btn-primary PayrollBatchbtn"
                    @click="openModal">Create Payroll
                    Batch</button>
                <button type="button" class="btn btn-primary JJAA"
                    style="padding: 8px; font-size: 13px;width: 80px;">80JJAA*</button>
            </div>

            <div
                style="font-size: 13px; margin-left: 10px; color:#212121;opacity: 50%; font-weight: 500; font-family: sans-serif;text-align: center;">
                *Check
                for deduction u/s 80JJAA for Hiring New Employee</div>

        </div>

        <!-- Modal -->
        <div v-if="isModalOpened" class="modal-mask">
            <div class="modal-dialog modal-dialog-centered">
                <Form @submit="storeBatch" :validation-schema="schema" v-slot="{ handleSubmit, values, errors }">
                    <div class="modal-content" ref="target">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Create New Payroll Batch</h5>
                            <button type="button" class="close" @click="closeModal">
                                <span aria-hidden="true"><i class="fa-solid fa-circle-xmark fa-2xl"
                                    style="color: #2DB9F8;opacity: 1;"></i></span>
                            </button>
                        </div>
                        <div
                            class="modal-body d-flex justify-content-center align-items-center Year-Payrool-Batch-modalLAbInp ">
                            <label for="Year-Payrool-Batch">{{ currentMonth }} {{ currentYear }}</label>
                            <Field v-slot="{ field, handleChange }" type="text" name="name" class="input"
                                autocomplete="off">
                                <input @change="handleChange" :value="field.value"
                                    :class="{ 'is-invalid': errors.name }" placeholder="Batch Name" type="text"
                                    autocomplete="off" class="input" required>
                            </Field>
                            <ErrorMessage name="name" class="text-danger mt-1" />
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-next btn-primary save" :disabled="isLoading"
                                type="submit">Save</button>
                            <a href="javascript:;" class="btn btn-outline-light cancle" @click="closeModal">Cancel</a>
                        </div>
                    </div>
                </Form>
            </div>
        </div>

        <!-- Modal compare-->
        <compareModel v-if="isModalCompare" @close="isModalCompare=false"></compareModel>

        <UserTable v-if="isModalTable" :data="selectedMonth" @close="isModalTable=false"></UserTable>

        <LeaverTable v-if="isLeaverModal" :data="selectedMonth" @close="isLeaverModal=false"></LeaverTable>
    </div>
</template>

<script setup>
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { ref, onMounted, watch } from 'vue';
import { Doughnut } from 'vue-chartjs'
import { Form, Field, ErrorMessage, useForm } from 'vee-validate';
import DataTable from '@/components/DataTable.vue';
import LeaverTable from './LeaverTable.vue';
import UserTable from './UserTable.vue';
import compareModel from './compareModel.vue';
import useBatch from "@/composables/useBatch";
import useDashboard from "@/composables/useDashboard";
import * as yup from 'yup';
import { onClickOutside } from '@vueuse/core'
import { useRouter } from "vue-router";
import $ from 'jquery';
import { useAbility } from '@casl/vue';
const searchQuery = ref("");
const table = ref(null)
const { batches, create: storeBatch, validationErrors, validationMessage, isLoading, success } = useBatch();
const { getDashboardDetails, loading } = useDashboard();
const { can } = useAbility()
const employeeData = ref(null);
const router = useRouter();
const selectedMonth = ref({});
const currentStep = ref(1);
const isModalOpened = ref(false);
const isModalCompare = ref(false);
const isModalTable = ref(false);
const isLeaverModal = ref(false);
const tableKey = ref(0)
// const storeData = async (values) => {
//     await storeBatch(values);
//     if(success) {

//     }
// }


const data = {
    labels: ['Total employee 253', 'Pending count 5'],
    datasets: [
        {
            backgroundColor: ['#0492F5', '#DAE1F3'],
            data: [253, 5],
            cutout: '70%'
        }
    ],
    cutout: '70%',
}


const options = {
    borderRadius: 2,
    hoverBorderWidth: 0,
    responsive: true,
    maintainAspectRatio: false,
    rotation: 90,
    plugins: {
        legend: {
            display: false,
        },
        tooltip: {
            callbacks: {
                label: function (context) {
                    return context.label; // Display only the label, without associated data
                },
            },
        },
    },
}

ChartJS.register(ArcElement, Tooltip, Legend)
const detail = ref(null);

onMounted(async () => {
    let response = await getDashboardDetails();
    employeeData.value = response.data;
    var processed = employeeData.value.batch_processed;
    var pending = employeeData.value.batch_pending;
    data.labels = ['Payroll Processed ' + processed, 'Pending count '+ pending]
    data.datasets[0].data = [processed, pending]
    tableKey.value++;
});


const myTable = ref(null);
const schema = yup.object({
    name: yup.string().required('Required'),
});

let currentMonth = '';
let currentYear = '';
// Get the current date
const currentDate = new Date();


// Get the current month (returns a number from 0 to 11)
const month = currentDate.getMonth();
// Array of month names
const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
// Set the current month name
currentMonth = monthNames[month];

// Get the current year
const year = currentDate.getFullYear();
// Set the current year
currentYear = year;

const openModal = () => {
    isModalOpened.value = true;
};
const closeModal = () => {
    isModalOpened.value = false;
};

const openModalCompare = () => {
    isModalCompare.value = true;
};
const closeModalCompare = () => {
    isModalCompare.value = false;
};

const viewEmployeeData = async (month, type) => {
    selectedMonth.value = {month: month, type: type}
    if(type == 'leaver' || type == 'on_notice_period') {
        isLeaverModal.value = true;
    } else {
        isModalTable.value = true;
    }
}

const target = ref(null)
onClickOutside(target, () => closeModal());

watch(success, (current, previous) => {
    router.push({ name: "admin.PayrollBatchform" });
});

</script>

<style scoped>
@import '@/assets/css/Home.css';
@import 'datatables.net-dt';

table.dataTable thead th,
table.dataTable thead td,
table.dataTable tfoot th,
table.dataTable tfoot td {
    text-align: left;
}

table.dataTable tbody tr td {
    text-align: left;
}

.dt-search {
    display: none;
}

.modal-mask {
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, .2);
    border-radius: .3rem;
    outline: 0;
    width: 100% !important;
}

input {
    display: block;
    width: 332px;
    padding: 0.75rem;
    border: 1px solid #ccc;
    border-radius: 0.25rem;
}
</style>