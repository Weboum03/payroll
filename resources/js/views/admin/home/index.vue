<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container">
        <div id="dashboard-table-info">
            <span>Dashboard</span>
            <span>Dashboard</span>
        </div>

        <div id="Financial-year-dropdown">
            <span>Employee Data</span>
            <button type="button" class="btn btn-primary" @click="openModalCompare">
                Compare Data
            </button>
        </div>

        <nav aria-label="Page navigation example" class="d-flex flex-column"
            style="background-color: white;gap: 1rem;padding-top: 10px;">
            <div class="d-flex" style="gap: 15rem;">
                <div
                    style="font-size: 10px; margin-left: 10px; color: #4D4D4D; font-weight: 600; font-family: sans-serif;background-color: white;">
                    March 2024 payroll from 1st March 2024 to 31st march 2024</div>
            </div>
        </nav>


        <div class="d-flex flex-column align-items-center; " style="background-color: white;gap: 1rem; height: 275px;">


            <div class="graph chartjs-div-payrolldata d-flex" style="gap: 175px;">
                <div class="payrolldata-graph d-flex flex-column">
                    <div class="programming-stats4">
                        <div class="payrollData-container">
                            <div class="payrolldata-chart">
                                <Doughnut id="counter" :data="data" :options="options" />
                            </div>
                        </div>

                        <div class="details">
                            <ul>
                                <li style="display: flex;">
                                    <div
                                        style="display: flex; width: 21px; background-color: rgb(4, 146, 245); height: 21px; border-radius: 28%;">
                                    </div>
                                    <div>Payroll Processed 253</div>
                                </li>
                                <li style="display: flex;">
                                    <div
                                        style="display: flex; width: 21px; background-color: rgb(218, 225, 243); height: 21px; border-radius: 28%;">
                                    </div>
                                    <div>Pending count 5</div>
                                </li>
                            </ul>
                        </div>

                        <div class="details" ref="detail">
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
                                <td id="noticPrd-Table" @click="openModalTable">
                                    3</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="PayrollBatch-btn" class="d-flex justify-content-center align-items-center" style="gap: 1rem;">
                <button type="button" v-if="can('Generate Payroll')" class="btn btn-primary PayrollBatchbtn" @click="openModal">Create Payroll
                    Batch</button>
                <button type="button" class="btn btn-primary JJAA"
                    style="padding: 8px; font-size: 13px;width: 80px;">80JJAA*</button>
            </div>

            <div
                style="font-size: 10px; margin-left: 10px; color:#A8A8A8; font-weight: 600; font-family: sans-serif;text-align: center;">
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
                                <span aria-hidden="true" style="margin-bottom: 5px;">&times;</span>
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
        <div v-if="isModalCompare" class="modal-mask" id="Compare">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="CompareLabel">Compare Employee Data</h5>
                        <button type="button" class="close" @click="closeModalCompare">
                            <span aria-hidden="true"><i class="fa-solid fa-circle-xmark fa-2xl"
                                    style="color: #2DB9F8;opacity: 1;"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container d-flex flex-column" id="Compare-Date-Format" style="gap: 1rem;">
                            <div id="Compare-Date-Type" class="d-flex">
                                <div class="d-flex justify-content-center align-items-center">
                                    <input type="radio" name="CompareDateType" id="Financial-Year" value="FinancialYear"
                                        style="width: 25px;" onclick="radioshow(event)" checked>
                                    <label for="Financial-Year"
                                        style="font-size: 13px;width: 115px;margin-bottom: 0px;">By
                                        Financial
                                        Year</label>
                                </div>
                                <div class="d-flex justify-content-center align-items-center">
                                    <input type="radio" name="CompareDateType" id="ByYear" value="ByYear"
                                        style="width: 25px;" onclick="radioshow(event)">
                                    <label for="ByYear" style="font-size: 13px;width: 115px;margin-bottom: 0px;">By
                                        Calender
                                        Year</label>
                                </div>
                                <div class="d-flex justify-content-center align-items-center">
                                    <input type="radio" name="CompareDateType" id="ByMonth" value="ByMonth"
                                        style="width: 25px;" onclick="radioshow(event)">
                                    <label for="ByMonth" style="font-size: 13px;width: 115px;margin-bottom: 0px;">By
                                        Month</label>
                                </div>
                            </div>
                            <div id="Compare-Data-Input">
                                <div id="Compare-Data-FinanInput" class="d-flex flex-column " style="gap: 1rem;">

                                    <div class="row d-flex">
                                        <div class="col input-group-fname">
                                            <select class="form-control input" id="FinancialYear1" autocomplete="off"
                                                style="color: black; height: 40px;" required="">
                                                <option value="" disabled selected>Financial Year-1*</option>
                                                <option value="Option1">Option1</option>
                                                <option value="Option2">Option2</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <label class="user-label">Financial Year-1*</label>
                                        </div>
                                    </div>


                                    <div class="row d-flex">
                                        <div class="col input-group-fname">
                                            <select class="form-control input" id="FinancialYear2" autocomplete="off"
                                                style="color: black; height: 40px;" required="">
                                                <option value="" disabled selected>Financial Year-2*</option>
                                                <option value="Option1">Option1</option>
                                                <option value="Option2">Option2</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <label class="user-label">Financial Year-2*</label>
                                        </div>
                                    </div>


                                    <div class="row d-flex">
                                        <div class="col input-group-fname">
                                            <select class="form-control input1" id="FinancialYear3" autocomplete="off"
                                                style="color: black; height: 40px;">
                                                <option value="" disabled selected>Financial Year-3</option>
                                                <option value="Option1">Option1</option>
                                                <option value="Option2">Option2</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <label class="user-label1">Financial Year-3</label>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <router-link :to="{ name: 'admin.FinancialYearCompareTable' }" custom
                                            v-slot="{ navigate }">
                                            <button @click="navigate" id="Compare-Data-Months-Year"
                                                class="btn btn-primary"
                                                style="background-color: #2DB9F8;border: none;">Compare</button>
                                        </router-link>
                                    </div>

                                </div>
                                <div id="Compare-Data-YearInput" class="d-flex flex-column " style="gap: 1rem;">
                                    <div class="row d-flex">
                                        <div class="col input-group-fname">
                                            <select class="form-control input" id="Year1" autocomplete="off"
                                                style="color: black; height: 40px;" required="">
                                                <option value="" disabled selected>Select Year-1*</option>
                                                <option value="Option1">Option1</option>
                                                <option value="Option2">Option2</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <label class="user-label">Select Year-1*</label>
                                        </div>
                                    </div>


                                    <div class="row d-flex">
                                        <div class="col input-group-fname">
                                            <select class="form-control input" id="Year2" autocomplete="off"
                                                style="color: black; height: 40px;" required="">
                                                <option value="" disabled selected>Select Year-2*</option>
                                                <option value="Option1">Option1</option>
                                                <option value="Option2">Option2</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <label class="user-label">Select Year-2*</label>
                                        </div>
                                    </div>


                                    <div class="row d-flex">
                                        <div class="col input-group-fname">
                                            <select class="form-control input1" id="Year3" autocomplete="off"
                                                style="color: black; height: 40px;">
                                                <option value="" disabled selected> Select Year-3</option>
                                                <option value="Option1">Option1</option>
                                                <option value="Option2">Option2</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <label class="user-label1">Select Year-3</label>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <router-link :to="{ name: 'admin.FinancialYearCompareTable' }" custom
                                            v-slot="{ navigate }">
                                            <button @click="navigate" id="Compare-Data-Months-Year"
                                                class="btn btn-primary"
                                                style="background-color: #2DB9F8;border: none;">Compare</button>
                                        </router-link>
                                    </div>
                                </div>
                                <div id="Compare-Data-MonthInput" class="d-flex flex-column " style="gap: 1rem;">
                                    <div class="row d-flex">
                                        <div class="col input-group-fname">
                                            <select class="form-control input3" id="Month1" autocomplete="off"
                                                style="color: black; height: 40px;" required="">
                                                <option value="" disabled selected>Select Month-1*</option>
                                                <option value="Option1">Option1</option>
                                                <option value="Option2">Option2</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <label class="user-label">Select Month-1*</label>
                                        </div>
                                        <div class="col input-group-fname">
                                            <select class="form-control input3" id="Year1" autocomplete="off"
                                                style="color: black; height: 40px;" required="">
                                                <option value="" disabled selected>Select Year-1*</option>
                                                <option value="Option1">Option1</option>
                                                <option value="Option2">Option2</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <label class="user-label">Select Year-1*</label>
                                        </div>
                                    </div>
                                    <div class="row d-flex">
                                        <div class="col input-group-fname">
                                            <select class="form-control input3" id="Month2" autocomplete="off"
                                                style="color: black; height: 40px;" required="">
                                                <option value="" disabled selected>Select Month-2*</option>
                                                <option value="Option1">Option1</option>
                                                <option value="Option2">Option2</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <label class="user-label">Select Month-2*</label>
                                        </div>
                                        <div class="col input-group-fname">
                                            <select class="form-control input3" id="Year2" autocomplete="off"
                                                style="color: black; height: 40px;" required="">
                                                <option value="" disabled selected>Select Year-2*</option>
                                                <option value="Option1">Option1</option>
                                                <option value="Option2">Option2</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <label class="user-label">Select Year-2*</label>
                                        </div>
                                    </div>
                                    <div class="row d-flex">
                                        <div class="col input-group-fname">
                                            <select class="form-control input3" id="Month3" autocomplete="off"
                                                style="color: black; height: 40px;" required="">
                                                <option value="" disabled selected>Select Month-3*</option>
                                                <option value="Option1">Option1</option>
                                                <option value="Option2">Option2</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <label class="user-label">Select Month-3*</label>
                                        </div>
                                        <div class="col input-group-fname">
                                            <select class="form-control input3" id="Year3" autocomplete="off"
                                                style="color: black; height: 40px;" required="">
                                                <option value="" disabled selected>Select Year-3*</option>
                                                <option value="Option1">Option1</option>
                                                <option value="Option2">Option2</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <label class="user-label">Select Year-3*</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <router-link :to="{ name: 'admin.FinancialYearCompareTable' }" custom
                                            v-slot="{ navigate }">
                                            <button @click="navigate" id="Compare-Data-Months-Year"
                                                class="btn btn-primary"
                                                style="background-color: #2DB9F8;border: none;">Compare</button>
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Notice period list2 -->
        <div v-if="isModalTable" class="modal-mask" id="noticPrd-Table-list2">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content" style=" width: 900px !important; height: auto ">
                    <div class="modal-header" style="align-items: center; gap: 3rem;">
                        <button type="button" class="close1" data-dismiss="modal" aria-label="Close"
                            style=" margin: 0px; padding: 0px; font-size: medium; color: black !important">
                            <span><i class="fa-solid fa-arrow-right fa-flip-horizontal fa-sm"
                                    style="color: #000000;"></i></span>
                            <span style="cursor: pointer;">Back</span>
                        </button>
                        <button type="button" class="close" @click="closeModalTable">
                            <span aria-hidden="true"><i class="fa-solid fa-circle-xmark fa-lg"
                                    style="color: #2DB9F8;opacity: 1;"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table id="noticeperiod-table1" ref="myTable">
                            <thead>
                                <tr>
                                    <th id="EmpId">Employee Id</th>
                                    <th id="EmpName">Employee Name</th>
                                    <th id="DoResg">Date of Resignation</th>
                                    <th id="LstPDMAster">Last Notice Period Date as per master</th>
                                    <th id="NPbyEmp">Notice Period Date Selected by Employee</th>
                                    <th id="NPbyDepthead">Notice Period Date Approved Department Head</th>
                                    <th id="SrtNP">Short Notice Pay in Days</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>DFH51324</td>
                                    <td>Austin Hodges</td>
                                    <td>March 12,2024</td>
                                    <td>April 11,2024</td>
                                    <td>March 27,2024</td>
                                    <td>March 27,2024</td>
                                    <td>15</td>
                                </tr>
                                <tr>
                                    <td>SDG54635</td>
                                    <td>Randy Johnson</td>
                                    <td>March 4,2024</td>
                                    <td>April 3,2024</td>
                                    <td>April 3,2024</td>
                                    <td>April 3,20244</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>YTJ62463</td>
                                    <td>MAtthew Luckett</td>
                                    <td>March 2,2024</td>
                                    <td>May 1,2024</td>
                                    <td>April 1,2024</td>
                                    <td>April 1,2024</td>
                                    <td>30</td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- <DataTable class="display">
    <thead>
        <tr>
            <th>First</th>
            <th>Second</th>
        </tr>
    </thead>
</DataTable> -->

    <!-- <DataTable :data="tableData" class="display" width="100%">
      <thead>
        <tr>
          <th>A</th>
          <th>B</th>
        </tr>
      </thead>
    </DataTable> -->
    <!-- -----nav-dashboard-table end----- -->
</template>

<script setup>
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { ref, onMounted, watch } from 'vue';
import { Doughnut } from 'vue-chartjs'
import { Form, Field, ErrorMessage, useForm } from 'vee-validate';
import useBatches from "@/composables/payrollBatch";
import * as yup from 'yup';
import { onClickOutside } from '@vueuse/core'
import { useRouter } from "vue-router";
import $ from 'jquery';
import 'datatables.net';
import 'datatables.net-bs4/css/dataTables.bootstrap4.css'; // Use the appropriate CSS file for your project
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
// import Select from 'datatables.net-select';

// DataTable.use(DataTablesCore);
import {useAbility} from '@casl/vue';

const { batches, storeBatch, validationErrors, validationMessage, isLoading, success } = useBatches();
const {can} = useAbility()

const router = useRouter();

const tableData = [
    [1, 2],
    [3, 4],
];

const data = {
    labels: ['Total employee 253', 'Pending count 5'],
    datasets: [
        {
            backgroundColor: ['#0492F5', '#DAE1F3'],
            data: [253, 5],
            cutout:'70%'
        }
    ],
    cutout: '70%',
}


const counter3 = {
    id: "counter",
    beforeDraw(chart, args, options) {
        const {
            ctx,
            chartArea: { top, right, bottom, left, width, height },
        } = chart;
        ctx.save();
        const yCenter = height / 2 + top + 15;
        ctx.font = "15px monospace";
        ctx.fillStyle = "black";
        ctx.fillText("258", "61", yCenter);
    },
};
const counter4 = {
    id: "counter",
    beforeDraw(chart, args, options) {
        const {
            ctx,
            chartArea: { top, right, bottom, left, width, height },
        } = chart;
        ctx.save();
        const yCenter = height / 2 + top - 7;
        ctx.font = "10px monospace";
        ctx.fillStyle = "black";
        ctx.fillText("Total Employee", "35", yCenter);
    },
};

// const data = [253, 5];
const payrollchartData = {
    labels: [`Payroll Processed 253`, `Pending count 5`],
    data: [253, 5],
};

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
// const options = {
//     type: "doughnut",
//     data: {
//         labels: payrollchartData.labels,
//         datasets: [
//             {
//                 data: payrollchartData.data,
//                 backgroundColor: [
//                     // Set background color for each label
//                     "#0492F5", // Background color for "5 days absence"
//                     "#DAE1F3", // Background color for "900 working days"
//                 ],
//                 cutout: "70%",
//             },
//         ],
//     },
//     options: {
//         borderRadius: 2,
//         hoverBorderWidth: 0,
//         plugins: {
//             legend: {
//                 display: false,
//             },
//             tooltip: {
//                 callbacks: {
//                     label: function (context) {
//                         return context.label; // Display only the label, without associated data
//                     },
//                 },
//             },
//         },
//         rotation: 90,
//     },
//     plugins: [counter4, counter3],
// }

ChartJS.register(ArcElement, Tooltip, Legend)
const detail = ref(null);

onMounted(() => {
    $(myTable.value).DataTable();
});

const isModalOpened = ref(false);
const isModalCompare = ref(false);
const isModalTable = ref(false);
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

const openModalTable = () => {
    isModalTable.value = true;
};
const closeModalTable = () => {
    isModalTable.value = false;
};

const target = ref(null)
onClickOutside(target, () => emit('modal-close'));

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