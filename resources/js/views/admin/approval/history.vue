<template>
<!-- -----nav-dashboard-table start----- -->
<div id="dashboard-table" class="container">
                <div id="dashboard-table-info">
                    <span>Approval history</span>
                    <span>Leaves > Approval History</span>
                </div>

                <div id="datatable-Emp-info" class="container">


                    <button type="button" class="add">
                        <i class="fa-solid fa-plus fa-sm" style="color: white;"></i></button>
                </div>
                <div id="Approvedleave-historyTable_filter" class="dataTables_filter"><label>Search:<input type="search" v-model="search_global" class="" placeholder="" aria-controls="Approvedleave-historyTable"></label><select id="dropdown1" class="lastActivities" style="height: 30.83px;  width: 225px;  font-size: 13px;  font-weight: bold;  font-family: sans-serif;  padding-left: 13px;  border: none; border-radius: 5px; float: left;"><option value="BulkAction">10 Last activities</option><option value="value2">Option 2</option></select></div>
                <table id="Approvedleave-historyTable" ref="myTable" style="width: 100%;">
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
                        <tr>
                            <td>25/02/2024
                                10:51 pm
                            </td>
                            <td>John Doe</td>
                            <td>26/02/2024</td>
                            <td>Austin Hodges</td>
                            <td>Nulla Varlus,sapien</td>
                            <td>Morbi sit amet nulla..</td>
                            <td> <button type="button" class="btn" id="ApprovedBtn" style="color: green; font-size: 14px;">Approved</button></td>
                            <td><i class="fa-solid fa-ellipsis-vertical fa-sm" style="color: #000000;"></i></td>
                        </tr>
                        <tr>
                            <td>24/02/2024
                                09:51 pm
                            </td>
                            <td>Brandon Poole</td>
                            <td>24/02/2024</td>
                            <td>Benjamin Hunter</td>
                            <td>Nulla Varlus,sapien</td>
                            <td>Morbi sit amet nulla..</td>
                            <td> <button type="button" class="btn" id="ApprovedBtn" style="color: rgb(254, 39, 39); font-size: 14px;">Rejected</button></td>
                            <td><i class="fa-solid fa-ellipsis-vertical fa-sm" style="color: #000000;"></i></td>
                        </tr>
                        <tr>
                            <td>23/02/2024
                                07:51 pm
                            </td>
                            <td>John Waston</td>
                            <td>26/02/2024</td>
                            <td>Chole Skinner</td>
                            <td>Nulla Varlus,sapien</td>
                            <td>Morbi sit amet nulla..</td>
                            <td> <button type="button" class="btn" id="PendingBtn" style="color: rgb(33, 214, 255); font-size: 14px;">Pending</button></td>
                            <td><i class="fa-solid fa-ellipsis-vertical fa-sm" style="color: #000000;"></i></td>
                        </tr>
                      
                       
                        <!-- <tr>
                            <td>harsh</td>
                            <td>13452</td>
                            <td>harsh@gmail.com</td>
                            <td>75628852</td>
                            <td>developer</td>
                        </tr> -->

                    </tbody>
                </table>

            </div>
</template>

<script setup>
import { ref, onMounted, onUpdated, watch } from 'vue';
import '@/assets/css/Approvals.css'
import 'datatables.net'; // Import DataTables.js library
import 'datatables.net-bs4/css/dataTables.bootstrap4.css'; // Import DataTables.css
import $ from 'jquery';
let dataTable = ref(null);
const myTable = ref(null);
const isDataTableInitialized = ref(false)
const search_global = ref('');



onMounted(() => {
    // Create a script element
    const script = document.createElement('script');
    script.src = '../../resources/js/ApporvalHistory.js';

    // Append the script element to the document's head
    document.head.appendChild(script);
    loadDataTable();
});

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