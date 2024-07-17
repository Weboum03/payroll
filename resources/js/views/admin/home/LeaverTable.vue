<template>
    <div class="modal-mask" id="noticPrd-Table-list2">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content" style=" width: 1030px !important; height: auto ">
                        
                        <div class="modal-body">
                            <div id="noticeperiod-table1_wrapper" class="dataTables_wrapper no-footer">
                                <div id="noticeperiod-table1_filter" class="dataTables_filter"><label>Search:<input
                                            type="search" v-model="searchQuery" @input="filterRows" class="" placeholder=""
                                            aria-controls="noticeperiod-table1"></label>
                                            <button type="button" class="close1" @click="closeModal"
                                        data-dismiss="modal" aria-label="Close"
                                        style="margin: 0px; padding: 0px; font-size: medium; color: black !important"><span><i
                                                class="fa-solid fa-arrow-right fa-flip-horizontal fa-sm"
                                                style="color: #000000;" aria-hidden="true"></i></span>
                                                <span
                                            style="cursor: pointer;">Back</span></button>
                                            
                                            <button type="button" class="close" @click="closeModal"
                                        data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i
                                                class="fa-solid fa-circle-xmark fa-2xl" style="color: #2DB9F8;"
                                                aria-hidden="true"></i>
                                            </span>
                                        </button>
                                    </div>
    
                                <DataTable v-if="users?.data" :headers="tableHeaders" :rows="users" @filter="filterData"
                                    ref="table">
                                    <template v-slot:cell-blank="{ row }">
                                        --
                                    </template>
                                    <template v-slot:cell-start_date="{ row }">
                                        {{ row.deboard?.start_date }}
                                    </template>
                                    <template v-slot:cell-created_at="{ row }">
                                        {{ moment(row.deboard?.created_at).format('YYYY-MM-DD') }}
                                    </template>
                                    <template v-slot:cell-final_employment_date="{ row }">
                                        {{ row.deboard?.final_employment_date }}
                                    </template>
                                    <template v-slot:cell-final_working_date="{ row }">
                                        {{ row.deboard?.final_working_date }}
                                    </template>
                                    <template v-slot:cell-duration="{ row }">
                                        {{ row.deboard?.duration }} Days
                                    </template>
                                    <template v-slot:cell-leave_bal="{ row }">
                                        {{ row.pivot?.leave_bal }}
                                    </template>
                                    <template v-slot:cell-action="{ row }">
                                        <i @click.prevent="deleteUser(row.id)" class="fa-regular fa-trash-can fa-lg"
                                            style="color: #f02828;" aria-hidden="true"></i>
                                    </template>
                                </DataTable>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </template>
    
    <script setup>
    import { ref, onMounted, defineProps, onUpdated, watch } from 'vue';
    import DataTable from '@/components/DataTable.vue';
    import moment from 'moment';
    import 'datatables.net'; // Import DataTables.js library
    import 'datatables.net-bs4/css/dataTables.bootstrap4.css'; // Import DataTables.css
    import $ from 'jquery';
    import {useAbility} from '@casl/vue';
    import useDashboard from "@/composables/useDashboard";
    const { getDashboardDetails, getDashboardUsers, loading } = useDashboard();
    

    const props = defineProps({
        data: Object,
    });

    const emit = defineEmits(['close']);
    const closeModal = () => {
        emit('close');
    }
    let dataTable = ref(null);
    const table = ref(null)
    const searchQuery = ref("");
    const myTable = ref(null);
    const isDataTableInitialized = ref(false)
    const search_global = ref('')
    const users = ref([])

    const filterData = async (filterValues) => {
        Object.assign(filterValues, props.data)
        users.value = await getDashboardUsers(filterValues);
    }
    
    onMounted( async () => {
        users.value = await getDashboardUsers(props.data);
    });
    
    const filterRows = () => {
        table.value.filterData.filter.push({
            key: "search",
            value: searchQuery.value.toLowerCase(),
        })
        table.value.filterPayload();
    };
    
    const tableHeaders = [
        { key: 'employee_id', label: 'Employee ID', sorting: true },
        { key: 'name', label: 'Employee Name', sorting: true },
        { key: 'created_at', label: 'Date of Resignation' },
        { key: 'start_date', label: 'Last Notice Period Date as per master' },
        { key: 'final_employment_date', label: 'Notice Period Date Selected by Employee' },
        { key: 'final_working_date', label: 'Notice Period Date Approved Department Head' },
        { key: 'duration', label: 'Short Notice Pay in Days' },
    ];

    
    watch(search_global, (current, previous) => {
        dataTable.search(search_global.value).draw();
    });
    
    </script>
    
    <style scoped>
    @import '@/assets/css/Home.css';
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

    #noticeperiod-table1_filter {
    float: left;
    background-color: #DAE1F3;
    width: 100%;
    padding: 18px 21px;
    display: flex;
    justify-content: start;
    flex-direction: row-reverse;
    align-items: baseline;
    gap: 3rem;
}
    </style>