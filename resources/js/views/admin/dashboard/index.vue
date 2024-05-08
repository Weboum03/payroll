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
        <table ref="myTable" class="display" style="width:100%"></table>


        <!-- <table id="EmpTable">
            <thead>
                <tr>

                    <th id="Name">Name</th>
                    <th id="EmpId">Employee ID</th>
                    <th id="Email">Email</th>
                    <th id="Mob">Mobile</th>
                    <th id="Role">Role</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="post in users.data" :key="post.id">
                    <td>{{ post.first_name }}</td>
                    <td>{{ post.employee_id }}</td>
                    <td>{{ post.email }}</td>
                    <td>{{ post.phone }}</td>
                    <td>{{ post.role }}</td>
                </tr>
            </tbody>
        </table> -->

    </div>
</template>

<script setup>

import { ref, onMounted, watch } from 'vue';

import useUsers from "../../../composables/users";
import { useAbility } from '@casl/vue'
import store from '../../../store';

const search_id = ref('')
const search_title = ref('')
const search_global = ref('')
const orderColumn = ref('created_at')
const orderDirection = ref('desc')
const { users, getUsers, deleteUser } = useUsers()
const { can } = useAbility()

let table;
let baseURL = import.meta.env.VITE_AXIOS_BASE_URL;
if (baseURL) { baseURL = baseURL + '/api/' }
else { baseURL = '/api/' }

import $ from 'jquery';
import 'datatables.net';
import 'datatables.net-bs4/css/dataTables.bootstrap4.css'; // Use the appropriate CSS file for your project

const myTable = ref(null);

onMounted(() => {
    table = datatable()
    const script = document.createElement('script');
    script.src = '../../resources/js/dashboard.js';
    document.head.appendChild(script);
});



watch(search_global, (current, previous) => {
    if (search_global.value.length >= 3 || search_global.value.length == 0) {
        table.search(search_global.value).draw();
    }
})
const user = store.state.auth.user;

// watch(search_global, _.debounce((current, previous) => {
//     getUsers(
//         1,
//         search_id.value,
//         search_title.value,
//         current
//     )
// }, 200))

// Add click event handler for clickable-name spans
$(document).on('click', '.fa-trash', function(e) {
    var userId = $(this).attr('data-id');
    deleteUser(userId)
    table.row($(this).closest('tr')).remove().draw();
});


function datatable() {
    const dataTableOptions = {
        processing: true,
        serverSide: true,
        ajax: {
            "url": baseURL + "admin/users",
            "type": "GET",
            "datatype": "json",
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + user.access_token);
            }
        },
        // data: users.value.data,
        columns: [
            {
                title: 'Name', render: function (data, type, row) {
                    // Concatenate first_name and last_name
                    return row.first_name + ' ' + row.last_name;
                },
                data: 'first_name' // We set data to null to prevent DataTables from trying to use data property
            },
            { title: 'Employee ID', data: 'employee_id' },
            { title: 'Email', data: 'email' },
            { title: 'Mobile', data: 'phone' },
            { title: 'Role', data: 'role_id' },
            {
                title: 'Action', render: function (data, type, row) {
                    // Concatenate first_name and last_name
                    return '<i class="fa-solid fa-pen-to-square"></i> &nbsp <i class="fa-solid fa-trash" data-id= '+ row.id +'></i>';
                },
                data: null // We set data to null to prevent DataTables from trying to use data property
            },

            // Define your columns here
        ],
        language: {
            paginate: {
                next: '&#8594;', // Custom next symbol
                previous: '&#8592'
            }
        },
        search: {
            return: true
        },
        "searching": true,
        // "bPaginate": true,
        // "sPaginationType": "full_numbers",
        "bLengthChange": false,
        "columnDefs": [
            { "targets": 0, "orderable": true },
            { "targets": 1, "orderable": true },
            { "targets": 2, "orderable": true },
            { "targets": 3, "orderable": true },
            { "targets": 4, "orderable": true },

        ],
        "pagingType": "simple_numbers",
        // "bFilter": true,
        // "bInfo": false,
        // "draw":2,
        // "recordsFiltered":10,
        // "bAutoWidth": false,
        // "searching": false,
        // "scrollX": true,
        // "recordsTotal":100
    };

    return $(myTable.value).DataTable(dataTableOptions);
}
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