<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table-info">
        <span>Discard Payroll</span>
            <span>Payroll > Discard Payroll</span>
    </div>
    <div id="dashboard-table">
        <div id="EmpTable_wrapper" class="dataTables_wrapper no-footer">
            <div id="leavesEmpTable_filter" class="dataTables_filter"
                style="display: flex; justify-content: space-between;"><label>Search:<input type="search" class=""
                        v-model="searchQuery" @input="filterRows" placeholder="" aria-controls="leavesEmpTable">
                </label>
            </div>
            <DataTable :key="tableKey" v-if="logs?.data" :headers="tableHeaders" :rows="logs" @filter="filterData"
                ref="table" @rowclick="selectUser">
                <template v-slot:cell-name="{ row }">
                    <img alt="dp" v-if="row.user?.user_profile_picture" :src="row.user?.user_profile_picture"
                        width="20px" height="20px" style="border-radius: 50%;">
                    {{ row.user.name }}
                </template>
            </DataTable>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import DataTable from '@/components/DataTable.vue';
import useBatch from "@/composables/useBatch";
const { items: batches, item: batch, fetchOne: getBatch, getBatchLogs, loading, success } = useBatch()
import { useAbility } from '@casl/vue';
const { can } = useAbility()
const table = ref(null)
const pagelength = ref(10);
const searchQuery = ref("");
const tableKey = ref(0);
const selectedUser = ref({})
const isModalOpened = ref(false)
const isBulkOpened = ref(false)
const isActive = ref(false)
const tableHeaders = ref([])
const logs = ref({})

const filterData = async(filterValues) => {
    logs.value = await getBatchLogs(filterValues)
}

const filterRows = () => {
    table.value.filterData.filter.push({
        key: "search",
        value: searchQuery.value.toLowerCase(),
    })
    table.value.filterPayload();
};

const showHistory = (value) => {
    isActive.value = value;
}
onMounted( async () => {
    tableHeaders.value = [
        { key: 'name', label: 'Employee' },
        { key: 'type', label: 'Leave Type' },
        { key: 'from', label: 'From', sorting: true },
        { key: 'to', label: 'To', sorting: true },
        { key: 'duration', label: 'No of Days' },
        { key: 'status', label: 'Status', sorting: true },
    ];
    tableHeaders.value.push({ key: 'action', label: 'Action' });
    
    logs.value = await getBatchLogs();
    console.log('logs', logs)
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

.bulkAction,
.allActivity,
.empWise {
    height: 40px;
    width: 210px;
    font-size: 16px;
    font-weight: 500;
    font-family: Poppins, sans-serif;
    padding-left: 8px;
    border: none;
    border-radius: 8px;
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
    width: 100%;
}

.dt-search {
    display: none;
}
</style>