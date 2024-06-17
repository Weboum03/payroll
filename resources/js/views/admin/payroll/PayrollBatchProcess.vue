<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container-fluid">
        <div id="dashboard-table-info">
            <span>Payroll</span>
            <span>Patroll > Payroll batch</span>
        </div>


        <div class="container-fluid header d-flex flex-column">

            <div class="d-flex justify-content-start align-items-center" style="background-color: white; gap: 12rem;">

                <router-link :to="{ name: 'admin.home' }" custom v-slot="{ navigate }">
                    <button @click="navigate" role="link" type="button" class="close1 " data-dismiss="modal"
                        aria-label="Close"
                        style=" margin: 0px; padding: 0px; font-size: medium; color: black !important">
                        <span><i class="fa-solid fa-arrow-right fa-flip-horizontal fa-sm"
                                style="color: #000000;"></i></span>
                        <span style="cursor: pointer;">Back to list</span>
                    </button>
                </router-link>



                <h5>{{ batch?.data?.name }}</h5>
            </div>

            <div id="PayrollbatchList-Table_filter" class="dataTables_filter"
                style="display: flex; justify-content: space-between;">
                <label>Search:<input type="search" class=""
                        placeholder="" aria-controls="PayrollbatchList-Table">
                </label>
                <div class="container1" style="display: flex; gap: 1rem;">
                    <button id="button4" @click="processData" data-toggle="modal"
                        data-target="#ProcessModal" class="Process" style="">Process</button><button id="button5"
                        class="Download" style="">Download</button>
                    <button type="buttonDelt" class="btn delete"
                        style=" background-color: red;"><i class="fa-regular fa-trash-can fa-sm" style="color: white;"
                            aria-hidden="true"></i>
                    </button>
                </div>
            </div>


            <DataTable v-if="batches?.data" :headers="tableHeaders" :rows="batches" @filter="filterData" ref="table">
                <template v-slot:cell-sn="{ row }">
                    {{ row.id }}
                </template>
                <template v-slot:cell-wages="{ row }">
                    0
                </template>
                <template v-slot:cell-doj="{ row }">
                    {{ row.info?.doj }}
                </template>
                <template v-slot:cell-role="{ row }">
                    {{ row.role?.name }}
                </template>
                <template v-slot:cell-action="{ row }">
                    <i @click.prevent="deleteUser(row.id)" class="fa-regular fa-trash-can fa-lg" style="color: #f02828;"
                        aria-hidden="true"></i>
                </template>
            </DataTable>

        </div>



    </div>
</template>

<script setup>
import { ref, onMounted, inject } from 'vue';
import DataTable from '@/components/DataTable.vue';
import useBatch from "@/composables/useBatch";
const { items: batches, item: batch, fetchOne: getBatch, processBatch, getBatchUsers, deleteBatchUser, success } = useBatch();
import { useRouter, useRoute } from "vue-router";
import 'datatables.net'; // Import DataTables.js library
import 'datatables.net-bs4/css/dataTables.bootstrap4.css'; // Import DataTables.css
import $ from 'jquery';
const route = useRoute()
const router = useRouter();
const swal = inject("$swal")
const myTable = ref(null);
const search_global = ref('');
let dataTable = ref(null);
const isDataTableInitialized = ref(false)


onMounted(() => {
    getBatchUsers(route.params.id)
    getBatch(route.params.id)
});

const processData = async () => {
    await processBatch(route.params.id)
    if (success) {
        swal({
            icon: 'success',
            title: 'Processed successfully'
        });
        router.push({name: 'admin.payroll'})
    }
}

const tableHeaders = [
    { key: 'action', label: 'Delete' },
    { key: 'sn', label: 'Sr No.' },
    { key: 'employee_id', label: 'EMP ID', sorting: true },
    { key: 'name', label: 'Name', sorting: true },
    { key: 'role', label: 'Designation', sorting: true },
    { key: 'status', label: 'PF', sorting: true },
    { key: 'wages', label: 'ESIC', sorting: true },
    { key: 'doj', label: 'DOJ', sorting: true },
    { key: 'payout', label: 'Last Day', sorting: true },
    { key: 'salary_slip', label: 'Payment Frequency', sorting: true },
    { key: 'download', label: 'Over Time' },
];
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