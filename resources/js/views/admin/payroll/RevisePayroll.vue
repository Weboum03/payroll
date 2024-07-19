<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table-info">
        <span>View Logs</span>
        <span>Payroll > Logs</span>
    </div>
    <div id="dashboard-table" class="container-fluid">
        <div class="header d-flex flex-column">

            <div class="d-flex justify-content-start align-items-center" style="background-color: white;gap: 33%;height: 85px;">
                <router-link :to="{ name: 'admin.PayrolldownloadProcess', params:{id: route.params.id} }" custom v-slot="{ navigate }">
                    <button @click="navigate" role="link" type="button" class="close1 " data-dismiss="modal"
                        aria-label="Close"
                        style="   margin: 0px;padding-left: 10px !important;font-size:20px;color: black !important;width: 135px;">
                        <span><i class="fa-solid fa-arrow-right fa-flip-horizontal fa-sm"
                                style="color: #000000;"></i></span>
                        <span style="cursor: pointer;">Back to list</span>
                    </button>
                </router-link>
                <h5>{{ batch?.data?.name }}</h5>
            </div>

            <div id="PayrollbatchList-Table_wrapper" class="dataTables_wrapper no-footer">
            <div id="PayrollbatchList-Table_filter" class="dataTables_filter"
                style="display: flex; justify-content: space-between;"><label>Search:<input type="search" class=""
                        v-model="searchQuery" @input="filterRows" placeholder="" aria-controls="PayrollbatchList-Table"></label>

            </div>
            <DataTable v-if="logs?.data" :headers="tableHeaders" :rows="logs" @filter="filterData" ref="table">
                <template v-slot:cell-sn="{ row }">
                    {{ row.id }}
                </template>
                <template v-slot:cell-overtime="{ row }">
                    {{ row.pivot?.overtime }}
                </template>
                <template v-slot:cell-doj="{ row }">
                    {{ row.info?.doj }}
                </template>
                <template v-slot:cell-role="{ row }">
                    {{ row.role?.name }}
                </template>
                <template v-slot:cell-action="{ row }">
                    <i @click.prevent="deleteUser(row.id)" class="fa-regular fa-trash-can fa-lg" style="color: #f02828;"
                        aria-hidden="true"></i>
                </template>
            </DataTable>
        </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import DataTable from '@/components/DataTable.vue';
import useBatch from "@/composables/useBatch";
import { useRouter, useRoute } from "vue-router";
const { items: batches, item: batch, fetchOne: getBatch, getBatchLogsByType, loading, success } = useBatch()
import { useAbility } from '@casl/vue';
const route = useRoute()
const router = useRouter();
const table = ref(null)
const pagelength = ref(10);
const searchQuery = ref("");
const tableKey = ref(0);
const isActive = ref(false)
const tableHeaders = ref([])
const logs = ref({})

const filterData = async(filterValues) => {
    logs.value = await getBatchLogsByType(route.params.id, 'revise', filterValues)
}

const filterRows = () => {
    table.value.filterData.filter.push({
        key: "search",
        value: searchQuery.value.toLowerCase(),
    })
    table.value.filterPayload();
};
onMounted( async () => {
    tableHeaders.value = [
        { key: 'log_name', label: 'Log' },
        { key: 'description', label: 'Description' },
    ];
    getBatch(route.params.id)
    logs.value = await getBatchLogsByType(route.params.id, 'revise');
    console.log('logs', logs)
});

const filterUser = ref('');
watch(filterUser, (current, previous) => {
    table.value.filterData.filter.push({
        key: "user_id",
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

<style scoped>
@import '@/assets/css/PayrollBatchList.css';
</style>