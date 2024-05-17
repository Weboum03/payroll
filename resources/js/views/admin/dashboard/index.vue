<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container">
        <div id="dashboard-table-info">
            <span>DASHBOARD</span>
            <span>Employee > Dashboard</span>
        </div>
       
        <div id="EmpTable_filter" class="dataTables_filter .add" style="display: flex; justify-content: space-between;">
                <label>Search:<input type="search" v-model="search_global" class="" placeholder=""
                        aria-controls="EmpTable"></label>

                <router-link :to="{ name: 'admin.onBoard' }"><button id="button3" class="add"><i
                            class="fa-solid fa-plus fa-xs" style="color: white;"></i></button></router-link>
        </div>
        <table class="table text-center" ref="myTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Employee ID</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users?.data" :key="user.id" @click="navigateToDetailPage(user.id)">
                    <td><img alt="dp" :src="apiPath + '/resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'" width="20px" height="20px" style="border-radius: 50%;"> {{ user.first_name }}</td>
                    <td>{{ user.employee_id }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.phone }}</td>
                    <td>{{ user.role?.name }}</td>
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
// let table = ref(null)

onMounted(() => {
    getUsers();
});

onUpdated(() => {
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
const navigateToDetailPage = (itemId) => {
    router.push({ name: 'admin.EmpProfile', params: { id: itemId } });
};

watch(search_global, (current, previous) => {
    dataTable.search(search_global.value).draw();
});

</script>

<style scoped>
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


.dt-search {
    display: none;
}
</style>