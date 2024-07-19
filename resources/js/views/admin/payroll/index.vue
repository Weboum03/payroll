<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table-info">
        <span>Payroll</span>
        <span>Payroll > Payroll Data</span>
    </div>

    <div id="dashboard-table" class="container-fluid">
        <div id="Financial-year-dropdown">
            <span>Financial Year</span>
            <span id="finYearDropdown"><select id="finYearDropdown1" class="FinanYear" v-model="financialYear" 
                    style="height: 44px;width: 254px;font-size: 16px;font-weight: 500;font-family: sans-serif;padding: 10px 20px;border: none;border-radius: 5px;">
                    <option value=2024>2024 - 2025</option>
                    <option value=2023>2023 - 2024</option>
                    <option value=2022>2022 - 2023</option>
                </select></span>
        </div>

        <nav aria-label="Page navigation example" class="d-flex flex-column"
            style="background-color: white; gap: 1rem;">
            <ul class="pagination" id="pagination">
                <li class="page-item">
                    <a @click="scrollLeft" class="page-link page-item-prev" href="#" aria-label="Previous">
                        <span aria-hidden="true"><i class="fa-solid fa-angle-left fa-2xl"
                                style="color: #000000;"></i></span>
                    </a>
                </li>
                <div class="months-years">
                    <li v-for="month in months" class="page-item"><a class="page-link" href="#" @click="getStatisticData(month.year,month.month)" style="color: rgb(168, 168, 168);">{{ `${month.monthName}-${month.year}` }}</a></li>
                </div>
                <li class="page-item">
                    <a @click="scrollRight" class="page-link page-item-next" href="#" aria-label="Next">
                        <span aria-hidden="true"><i class="fa-solid fa-angle-left fa-flip-horizontal fa-2xl"
                                style="color: #000000;"></i></span>
                    </a>
                </li>
            </ul>
            <div class="d-flex justify-content-between" style="flex-wrap: wrap;">
                <div
                    style="font-size: 13px;margin-left: 10px;color: #212121;font-weight: 500;font-family: sans-serif;background-color: white;opacity: 50%;line-height: 19.5px;">
                    {{ employeeData?.current_month?.name }} payroll from {{ moment(employeeData?.date?.from).format("dddd, MMMM Do YYYY") }} to {{ employeeData?.date?.to }}</div>
                <a href="https://cleartax.in/s/section-80jja-income-tax-act" target="_blank"
                    style="font-size: 13px; margin-right:20px; color:#2DB9F8; font-weight: 500; font-family: sans-serif;text-decoration: none;line-height: 19.5px;">Check
                    for deduction u/s 80JJAA for Hiring New Employee
                </a>

            </div>
        </nav>


        <div class="d-flex flex-column align-items-center; " style="background-color: white;gap: 1rem;">


            <div class="graph chartjs-div-payrolldata d-flex justify-content-between" style="gap: 175px;">
                <div class="payrolldata-graph d-flex flex-column justify-content-center">
                    <div class="programming-stats4">
                        <div class="payrollData-container">
                            <ChartGraph v-if="employeeData" :key="tableKey" :totalEmployee="totalEmployee" :data="payrollchartData"></ChartGraph>
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
                {{ moment(). subtract(1, 'months'). employeeData?.date?.from }}

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
                                <td @click="viewEmployeeData(getPreviousMonthDate(employeeData?.date?.from), 'employees')">{{ employeeData?.last_month?.employees }}
                                </td>
                                <td @click="viewEmployeeData(employeeData?.date?.from, 'employees')">{{ employeeData?.current_month?.employees
                                    }}</td>
                            </tr>
                            <tr>
                                <th scope="row">New Starter</th>
                                <td @click="viewEmployeeData(getPreviousMonthDate(employeeData?.date?.from), 'new_starter')">{{ employeeData?.last_month?.new_starter
                                    }}</td>
                                <td @click="viewEmployeeData(employeeData?.date?.from, 'new_starter')">{{
                                    employeeData?.current_month?.new_starter }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Leaver</th>
                                <td @click="viewEmployeeData(getPreviousMonthDate(employeeData?.date?.from), 'leaver')">{{ employeeData?.last_month?.leaver }}</td>
                                <td @click="viewEmployeeData(employeeData?.date?.from, 'leaver')">{{ employeeData?.current_month?.leaver }}</td>
                            </tr>
                            <tr>
                                <th scope="row">On Notice Period</th>
                                <td @click="viewEmployeeData(getPreviousMonthDate(employeeData?.date?.from), 'on_notice_period')">{{
                                    employeeData?.last_month?.on_notice_period }}</td>
                                <td @click="viewEmployeeData(employeeData?.date?.from, 'on_notice_period')" id="noticPrd-Table">
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
                <button type="button" class="btn btn-secondary PayrollDocbtn" data-toggle="modal"
                    data-target="#PayrollBatch-modal" disabled>Download Documents</button>

                <a href="https://cleartax.in/s/section-80jja-income-tax-act" target="_blank" type="button"
                    class="btn btn-primary JJAA" data-toggle="modal"
                    style="padding: 15px; font-size: 13px;width: 80px;">80JJAA*</a>
            </div>

            <div style="font-size: 14px;padding: 12px;font-weight: 500;">Payroll Batch</div>
            <div data-v-5d5095b1="" id="EmpTable_wrapper" class="dataTables_wrapper no-footer">
                <div id="leavesEmpTable_filter" class="dataTables_filter"
                    style="display: flex; justify-content: space-between;">
                    <label>Search:<input type="search" v-model="searchQuery" @input="filterRows" class="" placeholder=""
                            aria-controls="Approvedleave-historyTable"></label>
                    <div class="container1" style="display: flex; gap: 1rem;">
                        <select id="dropdown2" class="allActivity" v-model="pagelength">
                            <option value="5">5 Activity</option>
                            <option value="10">10 Activity</option>
                            <option value="25">25 Activity</option>
                            <option value="50">50 Activity</option>
                        </select>
                    </div>
                </div>
                <DataTable v-if="batches?.data" :headers="tableHeaders" :rows="batches" @filter="filterData"
                    @rowclick="navigateToDetailPage" ref="table">
                    <template v-slot:cell-sn="{ row }">
                        {{ row.id }}
                    </template>
                    <template v-slot:cell-wages="{ row }">
                        {{ row.wages || '0.00' }}
                    </template>
                    <template v-slot:cell-deduction="{ row }">
                        {{ row.deduction || '0.00' }}
                    </template>
                    <template v-slot:cell-payout="{ row }">
                        {{ row.payout || '0.00' }}
                    </template>

                    <template v-slot:cell-status="{ row }">
                        <span v-if="row.edited == true && row.status == 'Generated'" style="color: #03a9f3;">{{ row.status }}</span>
                        <span v-else >{{ row.status }}</span>
                    </template>

                    <template v-slot:cell-salary_slip="{ row }" class="salSlip">
                        <span v-if="row.status == 'Processed'">released</span>
                        <span v-else>Not Released</span>
                    </template>

                    <template v-slot:cell-download="{ row }">
                        <router-link v-if="row.status == 'Processed'"
                            :to="{ name: 'admin.PayrolldownloadProcess', params: { id: row.id } }" custom
                            v-slot="{ navigate }">
                            <i @click="navigate" class="fa-solid fa-download fa-lg" style="color: #03A9F3; padding: 15px 30px;"></i>
                        </router-link>
                        <span style="padding: 15px 30px;" v-else>-</span>
                    </template>
                </DataTable>
            </div>
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

    <UserTable v-if="isModalTable" :data="selectedMonth" @close="isModalTable = false"></UserTable>

    <LeaverTable v-if="isLeaverModal" :data="selectedMonth" @close="isLeaverModal = false"></LeaverTable>
</template>

<script setup>

import { ref, onMounted, defineProps, watch, watchEffect } from 'vue';
import * as yup from 'yup';
// import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { Doughnut } from 'vue-chartjs'
import $ from 'jquery';
import moment from 'moment';
import DataTable from '@/components/DataTable.vue';
import ChartGraph from './ChartGraph.vue';
import useBatch from "@/composables/useBatch";
import useDashboard from "@/composables/useDashboard";
import LeaverTable from '@/views/admin/home/LeaverTable.vue';
import UserTable from '@/views/admin/home/UserTable.vue';
const { items: batches, fetchAll: getBatches, create: storeBatch, loading: isLoading, success } = useBatch();
const { getDashboardDetails, getDashboardUsers, loading } = useDashboard();
import { Form, Field, ErrorMessage, useForm } from 'vee-validate';
import { useRoute, useRouter } from "vue-router";
import { onClickOutside } from '@vueuse/core'
import { useAbility } from '@casl/vue';
const { can } = useAbility()

const router = useRouter();
const route = useRoute();
const isModalOpened = ref(false);
const table = ref(null)
const table2 = ref(null)
const searchQuery = ref("");
const employeeData = ref(null);
const selectedMonth = ref({});
const isModalTable = ref(false);
const isLeaverModal = ref(false);
const users = ref([])
const tableKey = ref(0)
const schema = yup.object({
    name: yup.string().required('Required'),
});

const financialYear = ref(new Date().getFullYear())
let currentMonth = '';
let currentYear = '';
const months = ref([])
// Get the current date
const currentDate = new Date();
const pagelength = ref(5);


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

function getPreviousMonthDate(date) {
  // Create a moment object from the given date
  const givenDate = moment(date);

  // Subtract one month
  const previousMonthDate = givenDate.subtract(1, 'months');

  // Format the result to a readable string or return the Moment object
  return previousMonthDate.format('YYYY-MM-DD'); // You can format it as needed
}

watch(financialYear, (value) => {
    generateMonths(value);
})

const viewEmployeeData = async (month, type) => {
    selectedMonth.value = { month: month, type: type }
    if (type == 'leaver' || type == 'on_notice_period') {
        isLeaverModal.value = true;
    } else {
        isModalTable.value = true;
    }
}

const filterRows = () => {
    table.value.filterData.filter.push({
        key: "search",
        value: searchQuery.value.toLowerCase(),
    })
    table.value.filterPayload();
};

const openModal = () => {
    isModalOpened.value = true;
};
const closeModal = () => {
    isModalOpened.value = false;
};

const filterData = (filterValues) => {
    getBatches(filterValues)
}

let totalEmployee = 0;
const data = [253, 5];
const payrollchartData = {
    labels: [`Payroll Processed ${data[0]}`, `Pending count ${data[1]}`],
    data: data,
};

const getStatisticData = async (year, month) => {
    let response = await getDashboardDetails({year, month});
    employeeData.value = response.data;
    var processed = employeeData.value.batch_processed;
    var pending = employeeData.value.batch_pending;
    totalEmployee = employeeData.value.total_employee;
    payrollchartData.labels = ['Payroll Processed ' + processed, 'Pending count ' + pending]
    payrollchartData.data = [processed, pending]
    if(processed == 0 && pending == 0) {
        payrollchartData.data = [processed, 1]
    }
    tableKey.value++;
}

onMounted(async () => {
    getBatches();
    let response = await getDashboardDetails();
    employeeData.value = response.data;
    var processed = employeeData.value.batch_processed;
    var pending = employeeData.value.batch_pending;
    totalEmployee = employeeData.value.total_employee;
    payrollchartData.labels = ['Payroll Processed ' + processed, 'Pending count ' + pending]
    payrollchartData.data = [processed, pending]
    tableKey.value++;
});


watchEffect(() => {
    if (table.value) { table.value.pageLength = 5; }
})
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
    { key: 'salary_slip', label: 'Salary slip' },
    { key: 'download', label: 'Download' },
];

const navigateToDetailPage = (data) => {
    router.push({ name: 'admin.PayrollBatchList', params: { id: data.id } });
};

watch(pagelength, (current, previous) => {
    table.value.pageLength = current;
    table.value.page = 1;
    table.value.filterPayload();
});

const generateMonths = (value) => {
    months.value = [];
        const monthNames = [ 'Jan', 'Feb', 'Mar','Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',];
        value = Number(value);
        let currentYear = value + 1;
        for (let year = value; year <= currentYear; year++) {
            if (currentYear == year) {
                for (let month = 1; month <= 3; month++) {
                    months.value.push({ year, month, monthName : monthNames[month-1] });
                }
            } else {
                for (let month = 4; month <= 12; month++) {
                    months.value.push({ year, month, monthName : monthNames[month-1] });
                }
            }
        }
        return months;
    }


const scrollLeft = () => {
    let content = document.querySelector(".months-years");
    content.scrollLeft -= 50;
}
const scrollRight = () => {
    let content = document.querySelector(".months-years");
    content.scrollLeft += 40;
}
$(document).ready(function () {

    // Get the current date
    const currentDate = new Date();

    // Array of month names
    const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    // Get the current month (returns a number between 0 and 11)
    const currentMonthIndex = currentDate.getMonth();

    // Get the month abbreviation using the current month index
    const currentMonthAbbreviation = monthNames[currentMonthIndex];

    // Get the current year
    const currentYear = currentDate.getFullYear();

    // Combine the current month abbreviation and year
    const formattedDate = `${currentMonthAbbreviation} ${currentYear}`;

    // Append the formatted date to the label
    $('label[for="Year-Payrool-Batch"]').append(formattedDate);

    // Call the function to append months
    generateMonths(new Date().getFullYear());
});
</script>

<style scoped>
@import '@/assets/css/onBoard.css';
@import '@/assets/css/Payroll.css';

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

#leavesEmpTable_filter>label {
    display: inline-flex !important;
    align-items: center;
    font-weight: 500;
    font-family: Poppins, sans-serif;
    margin-bottom: 0;
    font-size: 16px;
    line-height: 24px;
}

#leavesEmpTable_filter {
    float: left;
    background-color: #dae1f3;
    width: 100%;
    padding: 18px 21px;
    align-items: center !important;
}

.allActivity {
    height: 40px;
    width: 136px;
    font-size: 16px;
    font-weight: 500;
    font-family: Poppins, sans-serif;
    padding-left: 8px;
    border: none;
    border-radius: 8px;
}
</style>