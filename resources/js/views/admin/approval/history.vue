<template>
    <!-- -----nav-dashboard-table start----- -->

    <div id="dashboard-table-info">
            <span>Approval history</span>
            <span>Leaves > Approval History</span>
    </div>

    <div id="dashboard-table">
        
        <div id="EmpTable_wrapper" class="dataTables_wrapper no-footer">
        <div id="Approvedleave-historyTable_filter" class="dataTables_filter">
            <label>Search:<input type="search" v-model="searchQuery" @input="filterRows" class="" placeholder="" aria-controls="Approvedleave-historyTable"></label>
            <div class="container1" style="display: flex; gap: 1rem;">
                <select id="dropdown2" class="allActivity" v-model="pagelength">
                <option value="10">10 Activity</option>
                <option value="25">25 Activity</option>
                <option value="50">50 Activity</option>
            </select>
                <select name="SelectBydate" id="SelectBydate" v-model="dateFilter">
                    <option value="" selected>All</option>
                    <option value="date">By Date</option>
                </select>
                <input v-show="showDate" type="date" v-model="dateValue" name="" id="Date">
                <button @click="refreshData" type="button" id="reset">Reset</button>
            </div>
        </div>

        <DataTable :key="tableKey" v-if="leaves?.data" :headers="tableHeaders" :rows="leaves" @filter="filterData" ref="table">
            <template v-slot:cell-name="{ row }">
                <img alt="dp" v-if="row.user?.user_profile_picture" :src="row.user?.user_profile_picture" width="20px"
                    height="20px" style="border-radius: 50%;">
                {{ row.user.name }}
            </template>
            <template v-slot:cell-type="{ row }">
                {{ row.type.type }}
            </template>
            <template v-slot:cell-duration="{ row }">
                {{ row.duration }} Days
            </template>

            <template v-slot:cell-status="{ row }">
                <button type="button" class="btn"
                    :class="{ 'btn-outline-primary': row.status == 'Pending', 'btn-outline-danger': row.status == 'Rejected', 'btn-outline-success': row.status == 'Approved' }"
                    id="pendingBtn">{{ row.status }}</button>
            </template>



            <template v-slot:cell-action="{ row }">
                <i class="fa-solid fa-ellipsis-vertical fa-sm" @click="selectUser(row)" style="color: #000000;"></i>
            </template>
        </DataTable>

    </div>
        <user-detail v-if="isModalOpened" :user="selectedUser" @close="closeModal" @showHistory="showHistory"></user-detail>
        <singleHistory v-if="isActive" :user="selectedUser" :active="isActive" @showHistory="showHistory"></singleHistory>
    </div>
</template>

<script setup>
import { ref, onMounted, onUpdated, watch } from 'vue';
import DataTable from '@/components/DataTable.vue';
import '@/assets/css/Approvals.css'
import 'datatables.net'; // Import DataTables.js library
import 'datatables.net-bs4/css/dataTables.bootstrap4.css'; // Import DataTables.css
import $ from 'jquery';
import {useAbility} from '@casl/vue';
import useLeaves from "@/composables/leaves";
import UserDetail from './UserDetail.vue'
import singleHistory from './singleHistory.vue'
const { leaves, getLeaves, deleteLeave } = useLeaves()

const {can} = useAbility()
const pagelength = ref(10);
let dataTable = ref(null);
const table = ref(null)
const showDate = ref(false)
const searchQuery = ref("");
const myTable = ref(null);
const isDataTableInitialized = ref(false)
const search_global = ref('')
const selectedUser = ref({})
const isModalOpened = ref(false)
const isActive = ref(false)
const tableKey = ref(0)
const dateFilter = ref('')
const dateValue = ref('')

const filterData = (filterValues) => {
    getLeaves(filterValues)
}

onMounted(() => {
    getLeaves();
});

onUpdated(() => {
    loadDataTable();
})

const filterRows = () => {
    table.value.filterData.filter.push({
        key: "search",
        value: searchQuery.value.toLowerCase(),
    })
    table.value.filterPayload();
};

const showHistory = (value) => {
    isActive.value = value;
}

const tableHeaders = [
        { key: 'created_at', label: 'Log Time', sorting: true },
        { key: 'name', label: 'Reference' },
        { key: 'from', label: 'From', sorting: true },
        { key: 'name', label: 'Employee' },
        { key: 'reason', label: 'Description', sorting: true },
        { key: 'remarks', label: 'Remarks', sorting: true },
        { key: 'status', label: 'Status', sorting: true },
        { key: 'action', label: 'Action'},
];

watch(dateFilter, (current, previous) => {
    dateValue.value = '';
    showDate.value = !showDate.value;
});

watch(dateValue, (current, previous) => {
    table.value.filterData.filter.push({
        key: "date",
        value: current,
    })
    table.value.filterPayload();
})

function refreshData() {
    tableKey.value++;
    getLeaves();
    dateFilter.value = '';
    searchQuery.value = '';
    pagelength.value = 10;
}

watch(pagelength, (current, previous) => {
    table.value.pageLength = current;
    table.value.page = 1;
    table.value.filterPayload();
});

const getStatusColor = (status) => {
    if (status == 'Pending') { return 'blue'; }
    if (status == 'Rejected') { return 'red'; }
    return 'green';
}
const loadDataTable = () => {
    const dataTableOptions = {
        "pagingType": "full_numbers",
        "bLengthChange": false,
        "columnDefs": [
            { "className": "text-center", "targets": "_all" } // Center-align all columns
        ],
        processing: true,
    }
    if (!isDataTableInitialized.value) {
        dataTable = $(myTable.value).DataTable(dataTableOptions);
        console.log(dataTable)
        isDataTableInitialized.value = true;
    }
}
const selectUser = (user) => {
    if(can('Leave Approval')) {
        selectedUser.value = user;
        isModalOpened.value = true;
    }
};

const openModal = () => {
    isModalOpened.value = true;
};
const closeModal = () => {
    isModalOpened.value = false;
};

watch(search_global, (current, previous) => {
    dataTable.search(search_global.value).draw();
});

</script>

<style scoped>
@import '@/assets/css/ApprovalHistory.css';
@import '@/assets/css/onBoard.css';
@import 'datatables.net-dt';

table.dataTable thead th,
table.dataTable thead td,
table.dataTable tfoot th,
table.dataTable tfoot td {
    text-align: center;
}

.text-center {
    text-align: center !important;
}

table.dataTable tbody tr td {
    text-align: center;
}

.dataTables_filter input {
    border: 1px solid #aaa;
    border-radius: 3px;
    padding: 5px;
    background-color: transparent;
    margin-left: 3px;
}

#SelectBydate, .allActivity {
    height: 40px;
    width: 136px;
    font-size: 16px;
    font-weight: 500;
    font-family: Poppins, sans-serif;
    padding-left: 8px;
    border: none;
    border-radius: 8px;
}

#reset {
    border: none;
    border-radius: 10px;
    font-size: 16px;
    height: 40px;
    line-height: 24px;
    font-weight: 500;
    background-color: #2DB9F8;
    color: white;
    width: 81px;
}

#Date {
    height: 40px;
    width: 220px;
    font-size: 16px;
    font-weight: 500;
    font-family: Poppins, sans-serif;
    padding-left: 8px;
    border: none;
    border-radius: 8px;
    background-color: white;
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

.dataTables_filter {
    margin-bottom: -15px;
}

.dt-search {
    display: none;
}
</style>