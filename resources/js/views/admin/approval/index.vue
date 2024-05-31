<template>
   <!-- -----nav-dashboard-table start----- -->
   <div id="dashboard-table" class="container">
                <div id="dashboard-table-info">
                    <span>Leaves</span>
                    <span>Employee > Leaves</span>
                </div>

                <div id="datatable-Emp-info" class="container">


                </div>
                <div id="leavesEmpTable_filter" class="dataTables_filter" style="display: flex; justify-content: space-between;"><label>Search:<input type="search" class="" placeholder="" v-model="search_global" aria-controls="leavesEmpTable"></label><select id="dropdown1" class="bulkAction" style="height: 30.83px;width: 150px;font-size: 13px;font-weight: 500;font-family: sans-serif;padding-left: 9px;border: none;border-radius: 5px;"><option value="BulkAction">Select Bulk Action</option><option value="value2">Option 2</option></select><select id="dropdown2" class="allActivity" style="height: 30.83px;width: 150px;font-size: 13px;font-weight: 500;font-family: sans-serif;padding-left: 9px;border: none;border-radius: 5px;"><option value="AllActivity">All Activities</option><option value="value1">Option 1</option><option value="value2">Option 2</option></select><select id="dropdown1" class="empWise" style="height: 30.83px;width: 150px;font-size: 13px;font-weight: 500;font-family: sans-serif;padding-left: 9px;border: none;border-radius: 5px;"><option value="Empwise">Employee wise</option><option value="value2">Option 2</option></select><button type="button" @click="refreshTable" class="btn refresh"><i class="fa-solid fa-rotate-right fa-flip-horizontal fa-sm" style="color: #ffffff;" aria-hidden="true"></i></button></div>
                <table id="leavesEmpTable" class="table text-center" ref="myTable" style="width: 100%;">
                    <thead>
                        <tr>

                            <th id="Name">Employee</th>
                            <th id="EmpId">Leave Type</th>
                            <th id="Email">From</th>
                            <th id="Mob">To</th>
                            <th id="Role">No of Days</th>
                            <th id="Role">Status</th>
                            <th id="Role">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="leave in leaves?.data" :key="leave.id">
                            <td><img alt="dp" v-if="leave.user?.user_profile_picture" :src="leave.user?.user_profile_picture" width="20px"
                                    height="20px" style="border-radius: 50%;">
                                {{ leave.user.name }}</td>
                            <td>{{ leave.type.type }}</td>
                            <td>{{ leave.from }}</td>
                            <td>{{ leave.to }}</td>
                            <td>{{ leave.duration }} Days</td>
                            <td>
                                <button type="button" class="btn" :class="{'btn-outline-primary': leave.status == 'Pending','btn-outline-danger': leave.status == 'Rejected','btn-outline-success': leave.status == 'Approved' }" id="pendingBtn">{{ leave.status }}</button>
                                <!-- <button type="button" class="btn btn-outline-success d-none" id="approvedBtn">Approved</button>
                            <button type="button" class="btn btn-outline-danger d-none" id="rejectedBtn">Rejected</button> -->
                            </td>

                            <td @click="selectUser(leave)"><i class="fa-solid fa-ellipsis-vertical fa-sm" style="color: #000000;"></i></td>

                        </tr>

                        <!-- <tr data-toggle="modal" data-target="#leaveModal" >
                            <td><img alt="dp" :src="apiPath + '/resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'" width="20px"
                                    height="20px" style="border-radius: 50%;">
                                Devansh</td>
                            <td>Medical Leave</td>
                            <td>Feb 20,2024</td>
                            <td>Feb 20,2024</td>
                            <td>2 Days</td>
                            <td><button type="button" class="btn btn-outline-primary " id="pendingBtn">Pending</button></td>
                            <td><i class="fa-solid fa-ellipsis-vertical fa-sm" style="color: #000000;"></i></td>
                        </tr> -->


                    </tbody>
                </table>

                <user-detail v-if="isModalOpened" :user="selectedUser" @close="closeModal"></user-detail>
                <div v-if="isModalOpened4" class="modal-mask" id="leaveModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="leaveModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content" style="height: 500px;">
                            <div class="modal-header">
                                <div id="Leave-approve-profile">
                                    <nav class="navbar navbar-light ">
                                        <img :src="apiPath + '/resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'"
                                            id="admin-image" class="d-inline-block align-top" alt="">
                                        <div class="admin-Leave-approve-profile d-flex flex-column">
                                            <p class="admin-Leave-approve-name">Devansh</p>
                                            <p class="admin-Leave-approve-role">Supervisor</p>
                                        </div>
                                    </nav>
                                </div>
                                <button type="button" class="close" @click="closeModal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="leavedetails-popupModal">
                                    <div class="form-row">
                                        <div class="col d-flex flex-column">
                                            <label for="Leavename" class="Leave-Type">Leave type</label>
                                            <span id="Leavename" class="leave-type">Medical Leave</span>
                                        </div>
                                        <div class="col d-flex flex-column">
                                            <label for="LeaveAppliedon" class="Leave-Appliedon">Applied on</label>
                                            <span id="LeaveAppliedon" class="leave-appliedon">Feb 19,2024</span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col d-flex flex-column">
                                            <label for="LeaveFrom" class="Leave-From">From</label>
                                            <span id="LeaveFrom" class="leave-from">Feb 20,2024</span>
                                        </div>
                                        <div class="col d-flex flex-column">
                                            <label for="Leave-To" class="Leave-To">To</label>
                                            <span id="Leave-To" class="leave-to">Feb 22,2024</span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col d-flex flex-column">
                                            <label for="Leave-Days" class="Leave-Days">Leave Days</label>
                                            <span id="Leave Days" class="leave-days">2 Days</span>
                                        </div>
                                        <div class="col d-flex flex-column">
                                            <label for="Leave-Balance" class="Leave-Balance">Leave Balance</label>
                                            <span id="Leave-Balance" class="leave-balance">5</span>
                                        </div>
                                    </div>

                                    <button type="button" @click="viewHistory=true" id="View-employee-leave-history"  data-toggle="modal" data-target="#modalLeave-list">
                                        View employee leave history
                                      </button>

                                    <div class="row">
                                        <div class="col input-group-leaveStatus">
                                            <select class="form-control input" id="Leave-Status" autocomplete="off">
                                                <!-- <option value="" selected disabled>Leave Status</option> -->
                                                <option value="Pending">Pending</option>
                                                <option value="Approved">Approved</option>
                                                <option value="Rejected">Rejected</option>
                                            </select>
                                            <label class="user-leaveStatus">Leave Status</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col input-group-remarks">
                                            <input placeholder="Remarks" required="" type="text" name="text"
                                                autocomplete="off" class="input">
                                            <label class="user-remarks">Remarks</label>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal"
                                    id="save">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <singleHistory /> -->

            </div>
            
</template>

<script setup>

import { ref, onMounted, onUpdated, watch } from 'vue';
import '@/assets/css/Approvals.css'
import 'datatables.net'; // Import DataTables.js library
import 'datatables.net-bs4/css/dataTables.bootstrap4.css'; // Import DataTables.css
import $ from 'jquery';
import useLeaves from "@/composables/leaves";
const { leaves, getLeaves, deleteLeave } = useLeaves()
import singleHistory from './singleHistory.vue';
import UserDetail from './UserDetail.vue'

const isModalOpened = ref(false);
const viewHistory = ref(false);
let dataTable = ref(null);
const myTable = ref(null);
const isDataTableInitialized = ref(false)
const search_global = ref('');
const selectedUser = ref({});

onMounted(() => {
    getLeaves();
});

onUpdated(() => {
    loadDataTable();
})

const loadDataTable = () => {
    const dataTableOptions = {
        "pagingType": "full_numbers",
        "bLengthChange": false,
        processing: true,
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

watch(search_global, (current, previous) => {
    dataTable.search(search_global.value).draw();
});
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
    console.log('edfef');
    selectedUser.value = user;
    isModalOpened.value = true;
};
const refreshTable = () => {
    getLeaves();
};
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
</style>

<style>
@import 'datatables.net-dt';


.dt-search {
    display: none;
}
</style>
