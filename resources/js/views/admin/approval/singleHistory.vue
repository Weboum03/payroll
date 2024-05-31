<template>

    <!-- Modal -->
    <div v-if="viewHistory" class="modal-mask" id="modalLeave-list" data-backdrop="false" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style=" width: 870px; height: 500px ">
                <div class="modal-header" style="align-items: center; gap: 3rem;">
                    <button @click="viewHistory = false" type="button" class="close" data-dismiss="modal"
                        aria-label="Close"
                        style=" margin: 0px; padding: 0px; font-size: medium; color: black !important">
                        <span><i class="fa-solid fa-arrow-right fa-flip-horizontal fa-sm"
                                style="color: #000000;"></i></span>
                        <span style="cursor: pointer;">Back</span>
                    </button>
                    <div class="data-leave-modal">
                        <select id="dropdown1" class="data-leave-modal"
                            style="height: 30.83px;width: 260px;font-size: 13px;font-weight: 500;font-family: sans-serif;padding-left: 9px;border-radius: 5px;">
                            <option value="Last 3 Months">Last 3 Months</option>
                            <option value="value2">Option 2</option>
                        </select>
                    </div>
                    <button type="button" @click="viewHistory = false" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="dataleave-table-modal" ref="myTable">
                        <thead>
                            <tr>
                                <th id="EmpId">Leave Type</th>
                                <th id="Email">From</th>
                                <th id="Mob">To</th>
                                <th id="Days">Days/Hours</th>
                                <th id="AppliedOn">Applied On</th>
                                <th id="Status">Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Medical Leave</td>
                                <td>Feb 20,2024</td>
                                <td>Feb 22,2024</td>
                                <td>2 Days</td>
                                <td>Feb 19, 2024</td>
                                <td>
                                    <button type="text" class="btn" id="pendingBtn"
                                        style="color:#2DB9F8;">Pending</button>
                                    <!-- <button type="button" class="btn btn-outline-success d-none" id="approvedBtn">Approved</button>
                                            <button type="button" class="btn btn-outline-danger d-none" id="rejectedBtn">Rejected</button> -->
                                </td>
                            </tr>

                            <tr data-toggle="modal" data-target="#leaveModal">
                                <td>Medical Leavde adsfedag</td>
                                <td>Feb 20,2024</td>
                                <td>Feb 22,2024</td>
                                <td>2 Days</td>
                                <td>Feb 19, 2024</td>
                                <td>
                                    <button type="text" class="btn" id="pendingBtn"
                                        style="color:#2DB9F8;">Pending</button>
                                    <!-- <button type="button" class="btn btn-outline-success d-none" id="approvedBtn">Approved</button>
                                            <button type="button" class="btn btn-outline-danger d-none" id="rejectedBtn">Rejected</button> -->
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUpdated, watch } from 'vue';
import 'datatables.net'; // Import DataTables.js library
import 'datatables.net-bs4/css/dataTables.bootstrap4.css'; // Import DataTables.css
import $ from 'jquery';
import useLeaves from "@/composables/leaves";
const { leaves, getLeaves, deleteLeave } = useLeaves()
let dataTable = ref(null);
const myTable = ref(null);
const viewHistory = ref(true);
const isDataTableInitialized = ref(false)

onMounted(() => {
    loadDataTable();
})

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

        isDataTableInitialized.value = true;
    }
};
</script>

<style scoped>
@import '@/assets/css/ApprovalHistory.css';
</style>