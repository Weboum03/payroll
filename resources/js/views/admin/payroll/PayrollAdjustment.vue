<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container">
        <div id="dashboard-table-info">
            <span>Payroll</span>
            <span>Payroll > Payroll adjustment</span>
        </div>

        <div class="container d-flex flex-column" style="gap: 2rem; background-color: white;padding: 20px;">
            <div class="header">{{ batch?.data?.name }} - Make a new payroll adjustment</div>
            <div class="section d-flex flex-column" style="gap: 1rem;">
                <div class="updateMode d-flex justify-content-start align-items-baseline" style="gap: 1rem;">
                    <span>1</span>

                    <div class="row d-flex flex-column align-items-start justify-content-center">
                        <div class="col input-group-fname">
                            <select class="form-control input" id="UpdateMode" required autocomplete="off"
                                style="color: #131313;">
                                <option value="" selected>Update Mode*</option>
                                <option value="Option1">Option1</option>
                                <option value="Option2">Option2</option>
                                <option value="other">Other</option>
                            </select>
                            <label class="user-label">Update Mode*</label>
                        </div>
                        <p
                            style="margin-left: 18px;margin-bottom: 0px;font-size: 10px;color: #A8A8A8;font-weight: 500;">
                            Praesent sit amet metus nec quam molestie</p>
                    </div>

                </div>
                <div class="dwnldFile  d-flex justify-content-start align-items-baseline" style="gap: 1rem;">
                    <span>2</span>
                    <div id="dwnldFile" class="d-flex align-items-center justify-content-start"
                        style="gap: 1rem;font-size: 14px;font-weight: 700;font-family:  sans-serif;">Download file
                        pre-field with employee data to make adjustment
                        <i class="fa-solid fa-download fa-sm"
                            style="background-color: #2DB9F8;width: 36px;height: 33px;border-radius: 6px;text-align: center;align-items: center;justify-content: center;display: flex;color: white;"></i>
                    </div>

                </div>
                <div class="upldExcelfile d-flex justify-content-start align-items-baseline" style="gap: 1rem;">
                    <span>3</span>
                    <span>Upload Excel file*</span>
                    <div class="input-group is-invalid">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="validatedInputGroupCustomFile" required>
                            <label class="custom-file-label" for="validatedInputGroupCustomFile">Select File...</label>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center" style="gap: 1.4rem;margin-left: -280px;">

                    <router-link :to="{ name: 'admin.PayrollBatchProcess' }" custom v-slot="{ navigate }">
                        <button @click="navigate" role="link" type="button" class="btn vldExcel ">Validate Excel</button>
                    </router-link>

                    
                    <button type="button" class="btn btn-cancle cancle">Cancle</button>
                </div>
            </div>

            <DataTable v-if="batches?.data" :headers="tableHeaders" :rows="batches" @filter="filterData" ref="table">
                <template v-slot:cell-company="{ row }">
                    {{ row.info?.company }}
                </template>
                <template v-slot:cell-location="{ row }">
                    {{ row.info?.location }}
                </template>
                <template v-slot:cell-overtime="{ row }">
                    0
                </template>
                <template v-slot:cell-action="{ row }">
                    <i @click.prevent="deleteUser(row.id)" class="fa-regular fa-trash-can fa-lg" style="color: #f02828;"
                        aria-hidden="true"></i>
                </template>
            </DataTable>

            <!-- <table id="PayrollAdjustment-Table" ref="myTable">
                <thead>
                    <tr>
                        <th> Sr.No.</th>
                        <th>EMP Id</th>
                        <th> First Name</th>
                        <th>Last Name</th>
                        <th>Company</th>
                        <th>Location</th>
                        <th>Over Time</th>
                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <td id="SrNo">1</td>
                        <td id="EmpId">1016636</td>
                        <td id="FName">David</td>
                        <td id="LName">Ince</td>
                        <td id="Company">Aenean quis placerat</td>
                        <td id="Location">west Eleaser, Arkansas</td>
                        <td id="OTime">0</td>
                    </tr>
                    <tr>
                        <td id="SrNo">2</td>
                        <td id="EmpId">1035103</td>
                        <td id="FName">Boris</td>
                        <td id="LName">Gibson</td>
                        <td id="Company">Crash in justo</td>
                        <td id="Location">Emmieburgh, Ohio</td>
                        <td id="OTime">0</td>
                    </tr>
                    <tr>
                        <td id="SrNo">3</td>
                        <td id="EmpId">1092073</td>
                        <td id="FName">Tracey</td>
                        <td id="LName">Hughes</td>
                        <td id="Company">Donec pellentesque</td>
                        <td id="Location">Randallview, Nebraska</td>
                        <td id="OTime">2,651.20</td>
                    </tr>
                    <tr>
                        <td id="SrNo">4</td>
                        <td id="EmpId">1113615</td>
                        <td id="FName">Jennifer</td>
                        <td id="LName">Grant</td>
                        <td id="Company">Aliquam sadales</td>
                        <td id="Location">East Treva, Kentucky</td>
                        <td id="OTime">0</td>
                    </tr>
                    <tr>
                        <td id="SrNo">5</td>
                        <td id="EmpId">1204429</td>
                        <td id="FName">Peter</td>
                        <td id="LName">Nolan</td>
                        <td id="Company">Vitae neque vel</td>
                        <td id="Location">rauside, South Dakota</td>
                        <td id="OTime">8,456.12</td>
                    </tr>
                    <tr>
                        <td id="SrNo">6</td>
                        <td id="EmpId">1273333</td>
                        <td id="FName">William</td>
                        <td id="LName">Coleman</td>
                        <td id="Company">Proin at nisl et</td>
                        <td id="Location">Port Annette, New Hampshire</td>
                        <td id="OTime">0</td>
                    </tr>
                    <tr>
                        <td id="SrNo">7</td>
                        <td id="EmpId">1432342</td>
                        <td id="FName">Michael</td>
                        <td id="LName">Spinger</td>
                        <td id="Company">Vivamus ut dolor</td>
                        <td id="Location">Pollyview, Wisconsin</td>
                        <td id="OTime">0</td>
                    </tr>
                    <tr>
                        <td id="SrNo">8</td>
                        <td id="EmpId">1501418</td>
                        <td id="FName">Boris</td>
                        <td id="LName">Murray</td>
                        <td id="Company">Aenean quis nisi</td>
                        <td id="Location">Riceberg, New York </td>
                        <td id="OTime">0</td>
                    </tr>
                </tbody>
            </table> -->
        </div>
    </div>
</template>


<script setup>
import { ref, onMounted, onUpdated, watchEffect, nextTick, reactive, computed, watch } from 'vue';
import DataTable from '@/components/DataTable.vue';
import useBatch from "@/composables/useBatch";
import { useRouter, useRoute } from "vue-router";
import 'datatables.net'; // Import DataTables.js library
import 'datatables.net-bs4/css/dataTables.bootstrap4.css'; // Import DataTables.css
import $ from 'jquery';

const { items: batches, item: batch, fetchOne: getBatch, processBatch, getBatchUsers, create: storeBatch, deleteBatchUser, loading: isLoading, success } = useBatch();
const router = useRouter();
const route = useRoute();
const myTable = ref(null);
const search_global = ref('');
let dataTable = ref(null);
const isDataTableInitialized = ref(false)

onMounted(() => {
    loadDataTable();
    getBatchUsers(route.params.id)
    getBatch(route.params.id)
});

const tableHeaders = [
    { key: 'id', label: 'Sr No.', sorting: true },
    { key: 'employee_id', label: 'EMP ID', sorting: true },
    { key: 'first_name', label: 'First Name', sorting: true },
    { key: 'last_name', label: 'Last Name', sorting: true },
    { key: 'company', label: 'Company' },
    { key: 'location', label: 'Location' },
    { key: 'overtime', label: 'Over Time', sorting: true }
];

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
@import '@/assets/css/PayrollAdjustment.css';

</style>

<style>
@import 'datatables.net-dt';

.dt-search {
    display: none;
}
#PayrollbatchList-Table_filter {
    margin-bottom: -15px;
}
</style>