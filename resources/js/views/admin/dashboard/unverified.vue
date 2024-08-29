<template>
    <!-- -----nav-dashboard-table start----- -->

    <div id="dashboard-table-info">
        <span>Unverified Employees</span>
        <span>Employees &gt; Unverified Employees</span>
    </div>

    <div id="dashboard-table">
        <div id="EmpTable_wrapper" class="dataTables_wrapper no-footer">
            <div id="EmpTable_filter" class="dataTables_filter .add"
                style="display: flex; justify-content: space-between;">
                <label>Search:<input type="search" class="" v-model="searchQuery" @input="filterRows" placeholder=""
                        aria-controls="EmpTable"></label>
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
import { ref, onMounted } from 'vue';
import useUsers from "@/composables/users";
import { useAbility } from '@casl/vue';
import DataTable from '@/components/DataTable.vue';
const { users, getUserUnverified, deleteUser } = useUsers()
import { useRouter } from "vue-router";
import debounce from 'lodash.debounce'

const searchQuery = ref("");
const table = ref(null)
const { can } = useAbility()
const router = useRouter();

onMounted(async () => {
    getUserUnverified();
});

const filterData = (filterValues) => {
    getUserUnverified(filterValues)
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