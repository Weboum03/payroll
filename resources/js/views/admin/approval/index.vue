<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container">
        <div id="dashboard-table-info">
            <span>Leaves</span>
            <span>Employee > Leaves</span>
        </div>

        <div id="datatable-Emp-info" class="container">


        </div>
        <div id="leavesEmpTable_filter" class="dataTables_filter"
            style="display: flex; justify-content: space-between;"><label>Search:<input type="search" class=""
                    placeholder="" v-model="search_global" aria-controls="leavesEmpTable"></label><select id="dropdown1"
                class="bulkAction"
                style="height: 30.83px;width: 150px;font-size: 13px;font-weight: 500;font-family: sans-serif;padding-left: 9px;border: none;border-radius: 5px;">
                <option value="BulkAction">Select Bulk Action</option>
                <option value="value2">Option 2</option>
            </select>
            <select id="dropdown2" class="allActivity" v-model="pagelength"
                style="height: 30.83px;width: 150px;font-size: 13px;font-weight: 500;font-family: sans-serif;padding-left: 9px;border: none;border-radius: 5px;">
                <option value="AllActivity">All Activities</option>
                <option value="10">10 Activity</option>
                <option value="25">25 Activity</option>
                <option value="50">50 Activity</option>
            </select>
            <select id="dropdown1" class="empWise" v-model="filterUser"
                style="height: 30.83px;width: 150px;font-size: 13px;font-weight: 500;font-family: sans-serif;padding-left: 9px;border: none;border-radius: 5px;">
                <option disabled value="">Employee wise</option>
                <option  v-for="user in users?.data" :key="user.id" :value="user.id">{{ user.name }}</option>
            </select><button type="button" @click="refreshTable" class="btn refresh"><i
                    class="fa-solid fa-rotate-right fa-flip-horizontal fa-sm" style="color: #ffffff;"
                    aria-hidden="true"></i></button></div>
        <table id="leavesEmpTable" class="table text-center" ref="myTable" style="width: 100%;">
            <thead>
                <tr>
                    <th id="Name">Employee</th>
                    <th id="EmpId">Leave Type</th>
                    <th id="Email">From</th>
                    <th id="Mob">To</th>
                    <th id="Role">No of Days</th>
                    <th id="Role">Status</th>
                    <th v-if="can('Leave Approval')" id="Role">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="isLoading">
                    <td colspan="7">Loading</td>
                </tr>
                <tr v-else-if="leaves?.data?.length == 0">
                    <td colspan="7">No record Found</td>
                </tr>
                <tr v-else v-for="leave in leaves?.data" :key="leave.id" @click="selectUser(leave)">
                    <td><img alt="dp" v-if="leave.user?.user_profile_picture" :src="leave.user?.user_profile_picture"
                            width="20px" height="20px" style="border-radius: 50%;">
                        {{ leave.user.name }}</td>
                    <td>{{ leave.type.type }}</td>
                    <td>{{ leave.from }}</td>
                    <td>{{ leave.to }}</td>
                    <td>{{ leave.duration }} Days</td>
                    <td>
                        <button type="button" class="btn"
                            :class="{'btn-outline-primary': leave.status == 'Pending','btn-outline-danger': leave.status == 'Rejected','btn-outline-success': leave.status == 'Approved' }"
                            id="pendingBtn">{{ leave.status }}</button>
                    </td>
                    <td v-if="can('Leave Approval')"><i class="fa-solid fa-ellipsis-vertical fa-sm"
                            style="color: #000000;"></i></td>
                </tr>
            </tbody>
        </table>

        <user-detail v-if="isModalOpened" :user="selectedUser" @close="closeModal"
            @showHistory="showHistory"></user-detail>

        <singleHistory v-if="isActive" :user="selectedUser" @showHistory="showHistory"></singleHistory>

    </div>
</template>

<script setup>

import { ref, onMounted, onUpdated, watch } from 'vue';
import '@/assets/css/Approvals.css'
import 'datatables.net'; // Import DataTables.js library
import 'datatables.net-bs4/css/dataTables.bootstrap4.css'; // Import DataTables.css
import $ from 'jquery';
import { useAbility } from '@casl/vue';
import useLeaves from "@/composables/leaves";
import useUsers from "@/composables/users";
const { leaves, getLeaves, isLoading } = useLeaves()
const { users, getUsers } = useUsers()
import singleHistory from './singleHistory.vue';
import UserDetail from './UserDetail.vue'

const { can } = useAbility()
const isModalOpened = ref(false);
const viewHistory = ref(false);
let dataTable = ref(null);
const myTable = ref(null);
const isDataTableInitialized = ref(false)
const search_global = ref('');
const filterUser = ref('');
const pagelength = ref(10);
const selectedUser = ref({});
const isActive = ref(false)

onMounted(() => {
    getLeaves();
    getUsers();
});

onUpdated(() => {
    setTimeout(() => {
        loadDataTable();
    }, 1000);
})


const loadDataTable = () => {
    const dataTableOptions = {
        pagingType: "full_numbers",
        bLengthChange: false,
        processing: true,
        pageLength: 10, // Set the default page length
        lengthMenu: [10, 25, 50, 100], // Set available page lengths
        columnDefs: [
            { "className": "text-center", "targets": "_all", "defaultContent": "-" } // Center-align all columns
        ],
        processing: true,
    }
    if (!isDataTableInitialized.value) {
        dataTable = $(myTable.value).DataTable(dataTableOptions);
        isDataTableInitialized.value = true;
    }
}

const showHistory = (value) => {
    isActive.value = value;
}

watch(search_global, (current, previous) => {
    dataTable.search(search_global.value).draw();
});

// watch(pagelength, (current, previous) => {
//     const newLength = parseInt(event.target.value);
//     dataTable.page.len(newLength).draw();
// });

// watch(search_global, (current, previous) => {
//     dataTable.search(search_global.value).draw();
// });

const openModalHistory = () => {
    viewHistory.value = true;
};

const openModal = () => {
    isModalOpened.value = true;
};
const closeModal = () => {
    isModalOpened.value = false;
};

const selectUser = (user) => {
    if (can('Leave Approval')) {
        selectedUser.value = user;
        isModalOpened.value = true;
    }
};

watch(filterUser, (current, previous) => {
    setTimeout(() => {
        getLeaves(
        search_global.value,
        current,
    )
    }, 1000);
    
});
const refreshTable = () => {
    getLeaves();
};
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

#leavesEmpTable_filter {
    margin-bottom: -15px;
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

.dt-search {
    display: none;
}
</style>
