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
            style="display: flex; justify-content: space-between;"><label>Search:<input type="search"
                    v-model="search_global" class="" placeholder="" aria-controls="EmpRolesTable"></label></div>
        <table id="EmpRolesTable" ref="myTable">
            <thead>
                <tr>

                    <th id="Name">Role Name</th>
                    <th id="EmpId">Permission</th>
                    <th id="Email">Action</th>

                </tr>
            </thead>
            <tbody>
                <tr v-for="role in roles?.data" :key="role.id">
                    <td>{{ role.name }}</td>
                    <td>{{ commaSeparated(role.permissions) }}</td>
                    <td>
                        <div class="d-flex" style="gap: 1rem;">
                            <router-link :to="{ name: 'admin.EmployeeRoleEdit', params: { id: role.id } }">
                                <i class="fa-solid fa-pencil fa-lg" style="color:green"></i>
                            </router-link>

                            <a href="#" @click.prevent="deleteRole(role.id)"><i class="fa-regular fa-trash-can fa-lg"
                                    style="color:red;line-height: 16px !important;"></i></a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script setup>
import { ref, onMounted, onUpdated, watchEffect, nextTick, reactive, computed, watch } from 'vue';
import useRoles from "../../../composables/roles";
const { roles, getRoles, deleteRole } = useRoles()
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
    getRoles();
});

onUpdated(() => {
    loadDataTable();
})

const loadDataTable = () => {
    const dataTableOptions = {
        pagingType: "full_numbers",
        bLengthChange: false,
        columnDefs: [
            { "className": "text-center", "targets": "_all" } // Center-align all columns
        ],
        order: [],
        processing: true,
    }
    if (!isDataTableInitialized.value) {
        dataTable = $(myTable.value).DataTable(dataTableOptions);
        console.log(dataTable)
        isDataTableInitialized.value = true;
    }
}

const commaSeparated = (jsonArray) => {
      // Use array map function to extract names
      const namesArray = jsonArray.map(obj => obj.name);
      // Join the names with comma
      return namesArray.join(', ');
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