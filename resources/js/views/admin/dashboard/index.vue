<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container-fluid">
                <div id="dashboard-table-info">
                    <span>DASHBOARD</span>
                    <span>Employee > Dashboard</span>
                </div>

                <div id="datatable-Emp-info" class="container">


                    <span type="button" class="add1">
                        <i class="fa-solid fa-plus fa-xs" style="color: white;"></i>
                    
                    </span>
                </div>

                <table id="EmpTable">
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
                </table>

            </div>
</template>

<script setup>

import { ref, onMounted, watch } from 'vue';
import '@/assets/css/dashboard.css'
import useUsers from "../../../composables/users";
import {useAbility} from '@casl/vue'


const search_id = ref('')
const search_title = ref('')
const search_global = ref('')
const orderColumn = ref('created_at')
const orderDirection = ref('desc')
const {users, getUsers, deleteUser} = useUsers()
const {can} = useAbility()

onMounted(() => {
    getUsers()
    const script = document.createElement('script');
    script.src = '../../resources/js/dashboard.js';
    document.head.appendChild(script);
});

const updateOrdering = (column) => {
    orderColumn.value = column;
    orderDirection.value = (orderDirection.value === 'asc') ? 'desc' : 'asc';
    getUsers(
        1,
        search_id.value,
        search_title.value,
        search_global.value,
        orderColumn.value,
        orderDirection.value
    );
}
watch(search_id, (current, previous) => {
    getUsers(
        1,
        current,
        search_title.value,
        search_global.value
    )
})
watch(search_title, (current, previous) => {
    getUsers(
        1,
        search_id.value,
        current,
        search_global.value
    )
})
// watch(search_global, _.debounce((current, previous) => {
//     getUsers(
//         1,
//         search_id.value,
//         search_title.value,
//         current
//     )
// }, 200))

</script>