<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container">
        <div id="dashboard-table-info">
            <span>Employee Roles</span>
            <span>Employee Roles > Employee Roles</span>
        </div>

        <div id="datatable-Emp-info" class="container">
            <a href="/admin/EmployeeRoleAdd" class="add2">
                <i class="fa-solid fa-plus fa-xs" style="color: white;"></i>
            </a>
        </div>
        <div id="EmpRolesTable_filter" class="dataTables_filter .add2"
            style="display: flex; justify-content: space-between;"><label>Search:<input type="search" v-model="search_global" class=""
                    placeholder="" aria-controls="EmpRolesTable"></label></div>
        <table id="EmpRolesTable" ref="myTable">
            <thead>
                <tr>

                    <th id="Name">Role Name</th>
                    <th id="EmpId">Permission</th>
                    <th id="Email">Action</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>CEO</td>
                    <td>All</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Team Leader</td>
                    <td>Approve leaves, View employee profile</td>
                    <td>
                        <div class="d-flex" style="gap: 1rem;">
                            <a href="/admin/EmployeeRoleEdit"><i class="fa-solid fa-pencil fa-lg"
                                    style="color:green"></i></a>
                            <i class="fa-regular fa-trash-can fa-lg"
                                style="color:red;line-height: 16px !important;"></i>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>HR</td>
                    <td>On-Board,De-Board,View employee profile,Update employee profile,Leave Approval,Generate Payroll
                    </td>
                    <td>
                        <div class="d-flex" style="gap: 1rem;">
                            <a href="EmployeeRoleEdit.html"><i class="fa-solid fa-pencil fa-lg"
                                    style="color:green;"></i></a>
                            <i class="fa-regular fa-trash-can fa-lg"
                                style="color:red;line-height: 16px !important;"></i>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>

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
@import '@/assets/css/EmployeeRole.css';
</style>

<style>
@import 'datatables.net-dt';

.dt-search {
    display: none;
}
</style>