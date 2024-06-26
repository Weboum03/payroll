<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table-info">
            <span>Payroll</span>
            <span>Payroll > Payroll Data</span>
    </div>

    <div id="dashboard-table" class="container-fluid">
        <div id="Financial-year-dropdown">
            <span>Financial Year</span>
            <span id="finYearDropdown"></span>
        </div>

        <nav aria-label="Page navigation example" class="d-flex flex-column"
            style="background-color: white; gap: 1rem;">
            <ul class="pagination" id="pagination">
                <li class="page-item ">
                    <a class="page-link page-item-prev" href="#" aria-label="Previous">
                        <span aria-hidden="true"><i class="fa-solid fa-angle-left fa-2xl"
                                style="color: #000000;"></i></span>
                    </a>
                </li>
                <div class="months-years"></div>
                <li class="page-item">
                    <a class="page-link page-item-next" href="#" aria-label="Next">
                        <span aria-hidden="true"><i class="fa-solid fa-angle-left fa-flip-horizontal fa-2xl"
                                style="color: #000000;"></i></span>
                    </a>
                </li>
            </ul>
            <div class="d-flex justify-content-between" style="flex-wrap: wrap;">
                        <div style="font-size: 13px;margin-left: 10px;color: #212121;font-weight: 500;font-family: sans-serif;background-color: white;opacity: 50%;line-height: 19.5px;">
                            March 2024 payroll from 1st March 2024 to 31st march 2024</div>
                         <a href="#" style="font-size: 13px; margin-right:20px; color:#2DB9F8; font-weight: 500; font-family: sans-serif;text-decoration: none;line-height: 19.5px;">Check
                            for deduction u/s 80JJAA for Hiring New Employee
                        </a>

            </div>
        </nav>


        <div class="d-flex flex-column align-items-center; " style="background-color: white;gap: 1rem;">


            <div class="graph chartjs-div-payrolldata d-flex justify-content-between" style="gap: 175px;">
                <div class="payrolldata-graph d-flex flex-column justify-content-center align-items-center">
                    <div class="programming-stats4">
                        <div class="payrollData-container">
                            <canvas class="payrolldata-chart"></canvas>
                        </div>

                        <div class="details">
                            <ul></ul>
                        </div>
                    </div>
                </div>


                <div class="FinencialTable">
                    <table class="table table-bordered" style="margin-top: 14px;">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">February 2024</th>
                                <th scope="col">March 2024</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Employee Count</th>
                                <td>251</td>
                                <td>253</td>
                            </tr>
                            <tr>
                                <th scope="row">New Starter</th>
                                <td>3</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <th scope="row">Leaver</th>
                                <td>1</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <th scope="row">On Notice Period</th>
                                <td>0</td>
                                <td>3</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="PayrollBatch-btn" class="d-flex justify-content-center align-items-center" style="gap: 1rem;">
                <button type="button" v-if="can('Generate Payroll')" class="btn btn-primary PayrollBatchbtn"
                    @click="openModal">Create Payroll
                    Batch</button>
                <button type="button" class="btn btn-secondary PayrollDocbtn" data-toggle="modal"
                    data-target="#PayrollBatch-modal" disabled>Download Documents</button>
                
                    <button type="button" class="btn btn-primary JJAA" data-toggle="modal" style="padding: 8px; font-size: 13px;width: 80px;">80JJAA*</button>
            </div>

            <div style="font-size: 14px;padding: 12px;font-weight: 500;">Payroll Batch</div>

            <DataTable :key="tableKey" v-if="batches?.data" :headers="tableHeaders" :rows="batches" @filter="filterData"
                @rowclick="navigateToDetailPage" ref="table">
                <template v-slot:cell-sn="{ row }">
                    {{ row.id }}
                </template>
                <template v-slot:cell-payout="{ row }">
                    0
                </template>
                <template v-slot:cell-action="{ row }">
                    <i class="fa-solid fa-ellipsis-vertical fa-sm" style="color: #000000;"></i>
                </template>
            </DataTable>
        </div>
    </div>



    <div v-if="isModalOpened" class="modal-mask" ref="target">
        <div class="modal-dialog modal-dialog-centered">
            <Form @submit="storeBatch" :validation-schema="schema" v-slot="{ handleSubmit, values, errors }">
                <div class="modal-content" ref="target">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Create New Payroll Batch</h5>
                        <button type="button" class="close" @click="closeModal">
                            <span aria-hidden="true" style="margin-bottom: 5px;">&times;</span>
                        </button>
                    </div>
                    <div
                        class="modal-body d-flex justify-content-center align-items-center Year-Payrool-Batch-modalLAbInp ">
                        <label for="Year-Payrool-Batch">{{ currentMonth }} {{ currentYear }}</label>
                        <Field v-slot="{ field, handleChange }" type="text" name="name" class="input"
                            autocomplete="off">
                            <input @change="handleChange" :value="field.value" :class="{ 'is-invalid': errors.name }"
                                placeholder="Batch Name" type="text" autocomplete="off" class="input" required>
                        </Field>
                        <ErrorMessage name="name" class="text-danger mt-1" />
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-next btn-primary save" :disabled="isLoading" type="submit">Save</button>
                        <a href="javascript:;" class="btn btn-outline-light cancle" @click="closeModal">Cancel</a>
                    </div>
                </div>
            </Form>
        </div>
    </div>
</template>

<script setup>

import { ref, onMounted, defineProps, watch } from 'vue';
import * as yup from 'yup';
import DataTable from '@/components/DataTable.vue';
import useBatch from "@/composables/useBatch";
const { items: batches, fetchAll: getBatches, create: storeBatch, loading: isLoading, success } = useBatch();
import { Form, Field, ErrorMessage, useForm } from 'vee-validate';
import { useRouter } from "vue-router";
import { onClickOutside } from '@vueuse/core'
import { useAbility } from '@casl/vue';
const { can } = useAbility()

const router = useRouter();
const isModalOpened = ref(false);

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

watch(success, (current, previous) => {
    if (current == true) {
        isModalOpened.value = false;
        success.value = false;
    }
})

const openModal = () => {
    isModalOpened.value = true;
};
const closeModal = () => {
    isModalOpened.value = false;
};

onMounted(() => {
    const script = document.createElement('script');
    script.src = '../../resources/js/Payroll.js';
    document.head.appendChild(script);
    getBatches();
});

const emit = defineEmits(["modal-close"]);
const target = ref(null)
onClickOutside(target, () => emit('modal-close'));

const tableHeaders = [
    { key: 'sn', label: 'Sr No.' },
    { key: 'name', label: 'Batch Name', sorting: true },
    { key: 'employee_count', label: 'Employee Count', sorting: true },
    { key: 'created_at', label: 'Created On', sorting: true },
    { key: 'status', label: 'Status', sorting: true },
    { key: 'wages', label: 'Gross Wages', sorting: true },
    { key: 'deduction', label: 'Deduction', sorting: true },
    { key: 'payout', label: 'Payout', sorting: true },
    { key: 'salary_slip', label: 'Salary slip', sorting: true },
    { key: 'download', label: 'Download' },
];

const navigateToDetailPage = (data) => {
    console.log('navigate', data)
    router.push({ name: 'admin.PayrollBatchList', params: { id: data.id } });
};

</script>

<style scoped>
@import '@/assets/css/onBoard.css';
@import '@/assets/css/Payroll.css';

.JJAA {

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
</style>