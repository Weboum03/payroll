<template>
    <!-- -----nav-dashboard-table start----- -->

    <div id="dashboard-table-info">
        <span>All Employees</span>
        <span>Employees &gt; All Employees</span>
    </div>

    <div id="dashboard-table">
        <div id="EmpTable_wrapper" class="dataTables_wrapper no-footer">
            <div id="EmpTable_filter" class="dataTables_filter .add"
                style="display: flex; justify-content: space-between;">
                <label>Search:<input type="search" class="" v-model="searchQuery" @input="filterRows" placeholder=""
                        aria-controls="EmpTable"></label>

                <div class="ImpoExpBtns">

                    <router-link v-if="can('On-Board')" :to="{ name: 'admin.onBoard' }">
                        <button id="button3" class="add"
                            style="height: 50px;width: 154px;font-size: 16px;font-weight: 500;font-family: sans-serif;border: none;border-radius: 5px;text-align: start;display: flex;justify-content: space-evenly;align-items: center;">Add
                            on Board <div id="datatable-Emp-info"><span type="button" class="add1"> <i
                                        class="fa-solid fa-plus fa-xs" style="color: white;" aria-hidden="true"></i>
                                </span>
                            </div></button></router-link>

                    <router-link :to="{ name: 'admin.ExportData' }">
                        <a id="Export" href="javascript:;">
                            <button class="Export">
                                Export
                                <div id="datatable-Emp-info">
                                    <span type="button" class="Export1">
                                        <i class="fa-solid fa-arrow-up-from-bracket fa-flip-vertical fa-xs"
                                            style="color: white;" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </button>
                        </a>
                    </router-link>

                    <router-link :to="{ name: 'admin.ImportData' }">
                        <a id="Export" href="javascript:;">
                            <button class="Export">
                                Import
                                <div id="datatable-Emp-info">
                                    <span type="button" class="Export1">
                                        <i class="fa-solid fa-arrow-up-from-bracket fa-xs" style="color: white;"
                                            aria-hidden="true"></i>
                                    </span>
                                </div>
                            </button>
                        </a>
                    </router-link>
                    <router-link :to="{ name: 'admin.unverified' }">
                        <a id="Export" href="javascript:;">
                            <button class="Export">
                                Unverified
                            </button>
                        </a>
                    </router-link>
                    <div>
                    </div>
                </div>
            </div>

            <DataTable v-if="users?.data" :headers="tableHeaders" :rows="users" @filter="filterData" @rowclick="navigateToDetailPage" ref="table">
                <template v-slot:cell-role="{ row }">
                    {{ row.role?.name }}
                </template>
            </DataTable>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUpdated, watchEffect, nextTick, reactive, computed, watch } from 'vue';
import useUsers from "@/composables/users";
import { useAbility } from '@casl/vue';
import DataTable from '@/components/DataTable.vue';
const { users, getUsersPaginate, deleteUser } = useUsers()
import { useRouter } from "vue-router";
import debounce from 'lodash.debounce'

const searchQuery = ref("");
const table = ref(null)
const { can } = useAbility()
const router = useRouter();

onMounted(async () => {
    getUsersPaginate();
});

const filterData = (filterValues) => {
    getUsersPaginate(filterValues)
}

const filterRows = debounce(() => {
    table.value.currentPage = 1;
    table.value.filterData.filter.push({
        key: "search",
        value: searchQuery.value.toLowerCase(),
    })
    table.value.filterPayload();
}, 500)

const tableHeaders = [
    { key: 'name', label: 'Name', sorting: true },
    { key: 'employee_id', label: 'Employee ID', sorting: true },
    { key: 'email', label: 'Email', sorting: true },
    { key: 'phone', label: 'Phone', sorting: true },
    { key: 'role', label: 'Designation' },
];

const navigateToDetailPage = (item) => {
    if (can('View Profile')) {
        router.push({ name: 'admin.EmpProfile', params: { id: item.id } });
    }
};

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

.dt-empty {
    text-align: center !important;
}

.dt-search {
    display: none;
}
</style>