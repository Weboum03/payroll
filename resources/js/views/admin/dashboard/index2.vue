<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container-fluid">
        <div id="dashboard-table-info">
            <span>DASHBOARD</span>
            <span>Employee > Dashboard</span>
        </div>
        <div id="EmpTable_filter">
            <div class="dataTables_filter .add" style="display: flex; justify-content: space-between;">
                <label>Search:<input type="search" v-model="search_global" class="" placeholder=""
                        aria-controls="EmpTable"></label>

                <router-link :to="{ name: 'admin.onBoard' }"><button id="button3" class="add"><i
                            class="fa-solid fa-plus fa-xs" style="color: white;"></i></button></router-link>
            </div>
        </div>
        <table class="display" ref="myTable">
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
                    <td>{{ user.first_name }}</td>
                    <td>{{ user.employee_id }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.phone }}</td>
                    <td>{{ user.role_id }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { ref, onMounted, onUpdated, reactive, computed, watch } from 'vue';
import useUsers from "../../../composables/users";
const { users, getUsers, deleteUser } = useUsers()
import { useRouter } from "vue-router";
import 'datatables.net'; // Import DataTables.js library
import 'datatables.net-bs4/css/dataTables.bootstrap4.css'; // Import DataTables.css
import $ from 'jquery';

const router = useRouter();
const myTable = ref(null);

let dataTable = ref(null);
// let table = ref(null)

onMounted(() => {
    getUsers();
});

onUpdated(() => {
    // text content should be the same as current `count.value`
    const dataTableOptions = {
        "pagingType": "simple_numbers",
        "bLengthChange": false,
        // processing: true,
    }
    dataTable = $(myTable.value).DataTable(dataTableOptions);
})

const navigateToDetailPage = (itemId) => {
    router.push({ name: 'admin.EmpProfile' });
};

</script>

<style>
@import '@/assets/css/onBoard.css';
@import 'datatables.net-dt';

table.dataTable thead th,
table.dataTable thead td,
table.dataTable tfoot th,
table.dataTable tfoot td {
    text-align: left;
}

table.dataTable tbody tr td {
    text-align: left;
}

.dt-search {
    display: none;
}
</style>