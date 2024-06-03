<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container">
        <div id="dashboard-table-info">
            <span>Approval history</span>
            <span>Leaves > Approval History</span>
        </div>

        <div id="Approvedleave-historyTable_filter" class="dataTables_filter"><label>Search:<input type="search"
                    v-model="search_global" class="" placeholder=""
                    aria-controls="Approvedleave-historyTable"></label><select id="dropdown1" class="lastActivities"
                style="height: 30.83px;  width: 225px;  font-size: 13px;  font-weight: bold;  font-family: sans-serif;  padding-left: 13px;  border: none; border-radius: 5px; float: left;">
                <option value="BulkAction">10 Last activities</option>
                <option value="value2">Option 2</option>
            </select></div>
        <table class="table text-center" ref="myTable">
            <thead>
                <tr>

                    <th id="LogTime">Log Time</th>
                    <th id="Reference">Reference</th>
                    <th id="Date">Date</th>
                    <th id="Name">Employee</th>
                    <th id="Description">Description</th>
                    <th id="Remark">Remarks</th>
                    <th id="Status">Status</th>
                    <th id="Action">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="leave in leaves?.data" :key="leave.id">
                    <td>{{ leave.created_at }}</td>
                    <td>{{ leave.user.name }}</td>
                    <td>{{ leave.from }}</td>
                    <td>{{ leave.user.name }}</td>
                    <td>{{ leave.reason }}</td>
                    <td>{{ leave.remarks ?? '---' }}</td>
                    <td> <button type="button" class="btn" id="ApprovedBtn" style="font-size: 14px;" :style="{
                        color: getStatusColor(leave.status),
                    }">{{ leave.status }}</button></td>
                    <td @click="selectUser(leave)"><i class="fa-solid fa-ellipsis-vertical fa-sm"
                            style="color: #000000;"></i></td>
                </tr>
            </tbody>
        </table>
        <user-detail v-if="isModalOpened" :user="selectedUser" @close="closeModal"></user-detail>
    </div>
</template>

<script setup>
import { ref, onMounted, onUpdated, watch } from 'vue';
import '@/assets/css/Approvals.css'
import 'datatables.net'; // Import DataTables.js library
import 'datatables.net-bs4/css/dataTables.bootstrap4.css'; // Import DataTables.css
import $ from 'jquery';
import useLeaves from "@/composables/leaves";
import UserDetail from './UserDetail.vue'
const { leaves, getLeaves, deleteLeave } = useLeaves()

let dataTable = ref(null);
const myTable = ref(null);
const isDataTableInitialized = ref(false)
const search_global = ref('')
const selectedUser = ref({})
const isModalOpened = ref(false)

onMounted(() => {
    getLeaves();
});

onUpdated(() => {
    loadDataTable();
})

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
    console.log('edfef');
    selectedUser.value = user;
    isModalOpened.value = true;
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

<style>
@import 'datatables.net-dt';

.dataTables_filter {
    margin-bottom: -15px;
}

.dt-search {
    display: none;
}
</style>