<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table-info">
            <span>Leaves</span>
            <span>Employee > Leaves</span>
        </div>
    <div id="dashboard-table">
        

        <div id="datatable-Emp-info">


        </div>
        <div id="EmpTable_wrapper" class="dataTables_wrapper no-footer">
        <div id="leavesEmpTable_filter" class="dataTables_filter"
            style="display: flex; justify-content: space-between;"><label>Search:<input type="search" class=""
                    v-model="searchQuery" @input="filterRows" placeholder=""
                    aria-controls="leavesEmpTable"></label><select id="dropdown1" class="bulkAction" v-model="filterStatus">
                <option value="" disabled>Select Status</option>
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
            </select>
            <select id="dropdown2" class="allActivity" v-model="pagelength">
                <option value="10">10 Activity</option>
                <option value="25">25 Activity</option>
                <option value="50">50 Activity</option>
            </select>
            <select id="dropdown1" class="empWise" v-model="filterUser">
                <option disabled value="">Employee wise</option>
                <option v-for="user in users?.data" :key="user.id" :value="user.id">{{ user.name }}</option>
            </select>
            <button type="button" @click="refreshData" class="btn refresh"><i
                    class="fa-solid fa-rotate-right fa-flip-horizontal fa-sm" style="color: #ffffff;"
                    aria-hidden="true"></i></button>
        </div>
        <DataTable :key="tableKey" v-if="leaves?.data" :headers="tableHeaders" :rows="leaves" @filter="filterData"
            @rowclick="selectUser" ref="table">
            <template v-slot:cell-name="{ row }">
                <img alt="dp" v-if="row.user?.user_profile_picture" :src="row.user?.user_profile_picture" width="20px"
                    height="20px" style="border-radius: 50%;">
                {{ row.user.name }}
            </template>
            <template v-slot:cell-type="{ row }">
                {{ row.type.type }}
            </template>
            <template v-slot:cell-duration="{ row }">
                {{ row.duration }} Days
            </template>

            <template v-slot:cell-status="{ row }">
                <button type="button" class="btn"
                    :class="{ 'btn-outline-primary': row.status == 'Pending', 'btn-outline-danger': row.status == 'Rejected', 'btn-outline-success': row.status == 'Approved' }"
                    id="pendingBtn">{{ row.status }}</button>
            </template>



            <template v-slot:cell-action="{ row }">
                <i class="fa-solid fa-ellipsis-vertical fa-sm" style="color: #000000;"></i>
            </template>
        </DataTable>
    </div>
    </div>

    <user-detail v-if="isModalOpened" :user="selectedUser" @close="closeModal" @showHistory="showHistory"></user-detail>

    <singleHistory v-if="isActive" :user="selectedUser" @showHistory="showHistory"></singleHistory>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import DataTable from '@/components/DataTable.vue';
import useLeaves from "@/composables/leaves";
import useUsers from "@/composables/users";
import singleHistory from './singleHistory.vue';
import UserDetail from './UserDetail.vue'
const { users, getUsers } = useUsers()
const { leaves, getLeaves, isLoading } = useLeaves()
import { useAbility } from '@casl/vue';
const { can } = useAbility()
const table = ref(null)
const pagelength = ref(10);
const searchQuery = ref("");
const tableKey = ref(0);
const selectedUser = ref({})
const isModalOpened = ref(false)
const isActive = ref(false)
const tableHeaders = ref([])

const filterData = (filterValues) => {
    getLeaves(filterValues)
}

const filterRows = () => {
    table.value.filterData.filter.push({
        key: "search",
        value: searchQuery.value.toLowerCase(),
    })
    table.value.filterPayload();
};
function refreshData() {
    tableKey.value++;
    getLeaves();
    filterUser.value = '';
    filterStatus.value = '';
    searchQuery.value = '';
    pagelength.value = 10;
}

const showHistory = (value) => {
    isActive.value = value;
}
onMounted(() => {
    tableHeaders.value = [
        { key: 'name', label: 'Employee' },
        { key: 'type', label: 'Leave Type', sorting: true },
        { key: 'from', label: 'From', sorting: true },
        { key: 'to', label: 'To', sorting: true },
        { key: 'duration', label: 'No of Days', sorting: true },
        { key: 'status', label: 'Status', sorting: true },
    ];

    //if (can('Leave Approval')) {
        tableHeaders.value.push({ key: 'action', label: 'Action' });
    //}
    getLeaves();
    getUsers();
});

const selectUser = (user) => {
    if (can('Leave Approval')) {
        selectedUser.value = user;
        isModalOpened.value = true;
    }
};

const openModalHistory = () => {
    viewHistory.value = true;
};

const openModal = () => {
    isModalOpened.value = true;
};
const closeModal = () => {
    isModalOpened.value = false;
};

const filterUser = ref('');
watch(filterUser, (current, previous) => {
    table.value.filterData.filter.push({
        key: "user_id",
        value: current,
    })
    table.value.filterPayload();
});

const filterStatus = ref('');
watch(filterStatus, (current, previous) => {
    table.value.filterData.filter.push({
        key: "status",
        value: current,
    })
    table.value.filterPayload();
});

watch(pagelength, (current, previous) => {
    table.value.pageLength = current;
    table.value.page = 1;
    table.value.filterPayload();
});

watch(tableHeaders, (current, previous) => {
    tableKey.value++;
});
</script>

<style>
@import '@/assets/css/Approvals.css';
@import '@/assets/css/onBoard.css';
@import 'datatables.net-dt';

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

.bulkAction, .allActivity, .empWise {
    height: 40px;
    width: 210px;
    font-size: 16px;
    font-weight: 500;
    font-family: Poppins, sans-serif;
    padding-left: 8px;
    border: none;
    border-radius: 8px;
}

#leavesEmpTable_filter {
    margin-bottom: -15px;
}

.modal-mask {
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, .2);
    border-radius: .3rem;
    outline: 0;
    width: 100% !important;
}

.dt-search {
    display: none;
}
</style>