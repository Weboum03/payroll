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
                            July 2024 payroll from 1st July 2024 to 31st July 2024</div>
                         <a href="#" style="font-size: 13px; margin-right:20px; color:#2DB9F8; font-weight: 500; font-family: sans-serif;text-decoration: none;line-height: 19.5px;">Check
                            for deduction u/s 80JJAA for Hiring New Employee
                        </a>

            </div>
        </nav>


        <div class="d-flex flex-column align-items-center; " style="background-color: white;gap: 1rem;">


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
                <button type="button" class="btn btn-secondary PayrollDocbtn" data-toggle="modal"
                    data-target="#PayrollBatch-modal" disabled>Download Documents</button>
                
                    <button type="button" class="btn btn-primary JJAA" data-toggle="modal" style="padding: 8px; font-size: 13px;width: 80px;">80JJAA*</button>
            </div>

            <div style="font-size: 14px;padding: 12px;font-weight: 500;">Payroll Batch</div>
            <div data-v-5d5095b1="" id="EmpTable_wrapper" class="dataTables_wrapper no-footer">
        <div id="leavesEmpTable_filter" class="dataTables_filter" style="display: flex; justify-content: space-between;">
            <label>Search:<input type="search" v-model="searchQuery" @input="filterRows" class="" placeholder="" aria-controls="Approvedleave-historyTable"></label>
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

                <template v-slot:cell-salary_slip="{ row }" class="salSlip">
                    <span v-if="row.status == 'Processed'">released</span>
                    <span v-else>Not Released</span>
                </template>
          
                <template v-slot:cell-download="{ row }">
                    <router-link v-if="row.status == 'Processed'" :to="{ name: 'admin.PayrolldownloadProcess', params: {id: row.id}}" custom v-slot="{ navigate }">
                        <i @click="navigate" class="fa-solid fa-download fa-lg" style="color: #03A9F3;"></i>
                    </router-link>
                    <span v-else>-</span>
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

    <UserTable v-if="isModalTable" :data="selectedMonth" @close="isModalTable=false"></UserTable>

    <LeaverTable v-if="isLeaverModal" :data="selectedMonth" @close="isLeaverModal=false"></LeaverTable>
</template>

<script setup>

import { ref, onMounted, defineProps, watch, watchEffect } from 'vue';
import * as yup from 'yup';
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { Doughnut } from 'vue-chartjs'
import DataTable from '@/components/DataTable.vue';
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
const schema = yup.object({
    name: yup.string().required('Required'),
});

let currentMonth = '';
let currentYear = '';
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

const viewEmployeeData = async (month, type) => {
    selectedMonth.value = {month: month, type: type}
    if(type == 'leaver' || type == 'on_notice_period') {
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

const filterRows2 = () => {
    table2.value.filterData.filter.push({
        key: "search",
        value: searchQuery.value.toLowerCase(),
    })
    table2.value.filterPayload();
};

const filterData2 = async (filterValues) => {
    Object.assign(filterValues, selectedMonth.value)
    users.value = await getDashboardUsers(filterValues);
}

onMounted(async() => {
    getBatches();
    let response = await getDashboardDetails();
    employeeData.value = response.data;
});


watchEffect(() => {
    if(table.value) { table.value.pageLength = 5; }
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
    { key: 'salary_slip', label: 'Salary slip', sorting: true },
    { key: 'download', label: 'Download' },
];

const tableHeaders2 = [
    { key: 'employee_id', label: 'Employee ID', sorting: true },
    { key: 'name', label: 'Employee Name', sorting: true },
    { key: 'company', label: 'Date of Resignation' },
    { key: 'location', label: 'Last Notice Period Date as per master' },
    { key: 'department', label: 'Notice Period Date Selected by Employee' },
    { key: 'department', label: 'Notice Period Date Approved Department Head' },
    { key: 'department', label: 'Short Notice Pay in Days' },
];

const navigateToDetailPage = (data) => {
    console.log('navigate', data)
    router.push({ name: 'admin.PayrollBatchList', params: { id: data.id } });
};

watch(pagelength, (current, previous) => {
    table.value.pageLength = current;
    table.value.page = 1;
    table.value.filterPayload();
});

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