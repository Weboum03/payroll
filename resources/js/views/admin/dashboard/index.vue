<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container-fluid">
        <div id="dashboard-table-info">
            <span>DASHBOARD</span>
            <span>Employee > Dashboard</span>
        </div>

        <div id="datatable-Emp-info" class="container">


            <button type="button" class="add">
                <i class="fa-solid fa-plus fa-sm" style="color: white;"></i>
                </button>
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
                <tr>
                    <td><img :src="apiPath + 'resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'" width="20px"
                            height="20px" style="border-radius: 50%;">
                        Devansh</td>
                    <td>13452</td>
                    <td>devansh@gmail.com</td>
                    <td>75628852</td>
                    <td>developer</td>
                </tr>


            </tbody>
        </table>

    </div>
</template>

<script setup>

import { ref, onMounted } from 'vue';
import '@/assets/css/dashboard.css'


onMounted(() => {
    const script = document.createElement('script');
    script.src = '../../resources/js/dashboard.js';
    document.head.appendChild(script);
});

</script>