<template>
    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>Users</h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item">
                                <a href="index.html">
                                    <i data-feather="home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">User</li>
                            <li class="breadcrumb-item active">User List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
        
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <vue-good-table
      :columns="columns"
      :rows="users" ref="users"/>

                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
</template>


<style setup>
@import 'bootstrap';
@import 'datatables.net-bs5';
@import 'bootstrap/dist/css/bootstrap.min.css';
/* @import 'datatables.net-dt'; */
/* @import 'datatables.net-select-dt'; */
</style>
<script setup>
import {ref, toRef , onMounted, watch} from "vue";
import useUsers from "../../../composables/users";
import {useAbility} from '@casl/vue'
import $ from 'jquery';
// import DataTable from 'datatables.net-vue3'
import DataTablesLib from 'datatables.net';
// import DataTablesLib from 'datatables.net-bs5';
import "datatables.net-bs5";
import "datatables.net-responsive-bs5";
import 'datatables.net';
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';
import VueGoodTablePlugin from 'vue-good-table';
// import the styles
import 'vue-good-table/dist/vue-good-table.css'
const {users, getUsers, deleteUser} = useUsers()
const {can} = useAbility()

let rows = ref([])
onMounted(() => {
    getUsers()
    //DataTable.use(DataTablesLib);
    //$('#demo').dataTable()
    const unwrapped = users.getBoundingClientRect();;
    rows.value = users;
    console.log('Rahul', unwrapped);
});

watch(users, ()=>{
  console.log('vipan',users.value.data);
})
let columns = [
        {
          label: 'ID',
          field: 'id',
        },
        {
          label: 'Name',
          field: 'name',
        },
        
        {
          label: 'Email',
          field: 'email',
        },
        {
          label: 'Created On',
          field: 'created_at',
          type: 'date',
          dateInputFormat: 'yyyy-MM-dd',
          dateOutputFormat: 'MMM do yy',
        },
      ];

      

</script>

<style scoped>
/* Custom DataTables styling */
.dataTables_wrapper {
  padding: 20px;
}

.dataTables_filter input[type="search"] {
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 5px;
}

.dataTables_paginate .paginate_button {
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 5px 10px;
  margin: 0 5px;
}
</style>