<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container">
        <div id="dashboard-table-info">
            <span>Payroll</span>
            <span>Patroll > Payroll batch</span>
        </div>


        <div class="container header d-flex flex-column">

            <div class="d-flex justify-content-start align-items-center" style="background-color: white; gap: 12rem;">

                <router-link :to="{ name: 'admin.payroll' }" custom v-slot="{ navigate }">
                        <button @click="navigate" role="link" type="button" class="close1 " data-dismiss="modal" aria-label="Close"
                    style=" margin: 0px; padding: 0px; font-size: medium; color: black !important">
                    <span><i class="fa-solid fa-arrow-right fa-flip-horizontal fa-sm"
                            style="color: #000000;"></i></span>
                    <span style="cursor: pointer;">Back to list</span>
                </button>
                    </router-link>


                
                <h5>March2024_Lipsum</h5>
            </div>

            <div id="PayrollbatchList-Table_filter" class="dataTables_filter" style="display: flex; justify-content: space-between;"><label>Search:<input type="search" class="" placeholder="" aria-controls="PayrollbatchList-Table"></label><div class="container1" style="display: flex; gap: 1rem;"><button id="button4" data-toggle="modal" data-target="#ProcessModal" class="Process" style="">Process</button><button id="button5" class="Download" style="">Download</button><button type="buttonDelt" class="btn delete" style=" background-color: red;"><i class="fa-regular fa-trash-can fa-sm" style="color: white;" aria-hidden="true"></i></button></div></div>

            
            <table id="PayrollbatchList-Table" ref="myTable">
                <thead>
                    <tr>
                        <th> Delete</th>
                        <th> Sr.No.</th>
                        <th> EMP ID</th>
                        <th> Name</th>
                        <th> Designation</th>
                        <th> PF</th>
                        <th> ESIC</th>
                        <th>DOJ</th>
                        <th>Last Day</th>
                        <th> Payment Frequency</th>
                        <th> Over Time</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="Delete"><i class="fa-regular fa-trash-can fa-lg" style="color: #f02828;"></i></td>
                        <td id="srNo">1</td>
                        <td id="EmpId">7608951</td>
                        <td id="Emp-name">Austin Hodges</td>
                        <td id="Desig">Supervisor</td>
                        <td id="pf">Yes</td>
                        <td id="esic">Yes</td>
                        <td id="doj">Jul 21,2015</td>
                        <td id="Lday">-</td>
                        <td id="payFre"> Monthly</td>
                        <td id="OT">0</td>
                    </tr>
                    <tr>
                        <td class="Delete"><i class="fa-regular fa-trash-can fa-lg" style="color: #f02828;"></i></td>
                        <td id="srNo">2</td>
                        <td id="EmpId">9331728</td>
                        <td id="Emp-name">Ben Hunter</td>
                        <td id="Desig">Supervisor</td>
                        <td id="pf">Yes</td>
                        <td id="esic">Yes</td>
                        <td id="doj">Mar 10,2016</td>
                        <td id="Lday">-</td>
                        <td id="payFre"> Monthly</td>
                        <td id="OT">2hr</td>
                    </tr>
                    <tr>
                        <td class="Delete"><i class="fa-regular fa-trash-can fa-lg" style="color: #f02828;"></i></td>
                        <td id="srNo">3</td>
                        <td id="EmpId">7437663</td>
                        <td id="Emp-name">Chloe Edum</td>
                        <td id="Desig">Supervisor</td>
                        <td id="pf">Yes</td>
                        <td id="esic">Yes</td>
                        <td id="doj">Apr 24,2017</td>
                        <td id="Lday">-</td>
                        <td id="payFre"> Monthly</td>
                        <td id="OT">0</td>
                    </tr>
                    <tr>
                        <td class="Delete"><i class="fa-regular fa-trash-can fa-lg" style="color: #f02828;"></i></td>
                        <td id="srNo">4</td>
                        <td id="EmpId">7758597</td>
                        <td id="Emp-name">Irene Skinner</td>
                        <td id="Desig">Supervisor</td>
                        <td id="pf">Yes</td>
                        <td id="esic">Yes</td>
                        <td id="doj">Sep 2,2019</td>
                        <td id="Lday">-</td>
                        <td id="payFre"> Monthly</td>
                        <td id="OT">0</td>
                    </tr>

                </tbody>


            </table>

        </div>



    </div>
</template>

<script setup>
import { ref, onMounted, onUpdated, watchEffect, nextTick, reactive, computed, watch } from 'vue';
import useUsers from "../../../composables/users";
const { users, getUsers, deleteUser } = useUsers()
import { useRouter } from "vue-router";
import 'datatables.net'; // Import DataTables.js library
import 'datatables.net-bs4/css/dataTables.bootstrap4.css'; // Import DataTables.css
import $ from 'jquery';

const router = useRouter();
const myTable = ref(null);
const search_global = ref('');
let dataTable = ref(null);
const isDataTableInitialized = ref(false)


onMounted(() => {
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
@import '@/assets/css/PayrollBatchList.css';

.Process,
.Download {
    height: 36.83px;
    width: 120px;
    font-size: 12px;
    font-weight: 500;
    font-family: sans-serif;
    padding-left: 9px;
    border: none;
    border-radius: 5px;
    background-color: #03A9F3;
    color: white;
}
</style>

<style>
@import 'datatables.net-dt';

.dt-search {
    display: none;
}

#PayrollbatchList-Table_filter {
    margin-bottom: -15px;
}

.Addemployee,
.Adjustments,
.SavePre {
    height: 36.83px;
    width: 120px;
    font-size: 12px;
    font-weight: 500;
    font-family: sans-serif;
    padding-left: 9px;
    border: none;
    border-radius: 5px;
    background-color: #03A9F3;
    color: white;
}
</style>