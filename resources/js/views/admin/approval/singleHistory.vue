<template>

    <!-- Modal -->
    <div class="modal-mask" id="modalLeave-list" data-backdrop="false" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style=" width: 870px; height: 500px ">
                <div class="modal-header" style="align-items: center; gap: 3rem;">
                    <button @click="hideHistory" type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style=" margin: 0px; padding: 0px; font-size: medium; color: black !important">
                        <span><i class="fa-solid fa-arrow-right fa-flip-horizontal fa-sm"
                                style="color: #000000;"></i></span>
                        <span style="cursor: pointer;">Back</span>
                    </button>
                    <div class="data-leave-modal">
                        <select id="dropdown1" class="data-leave-modal"
                            style="height: 30.83px;width: 260px;font-size: 13px;font-weight: 500;font-family: sans-serif;padding-left: 9px;border-radius: 5px;">
                            <option value="Last 3 Months">Last 3 Months</option>
                            <option value="value2">Option 2</option>
                        </select>
                    </div>
                    <button type="button" @click="hideHistory" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="dataleave-table-modal" ref="myTable">
                        <thead>
                            <tr>
                                <th id="EmpId">Leave Type</th>
                                <th id="Email">From</th>
                                <th id="Mob">To</th>
                                <th id="Days">Days/Hours</th>
                                <th id="AppliedOn">Applied On</th>
                                <th id="Status">Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="leave in leaves?.data" :key="leave.id">
                                <td>{{ leave.type.type }}</td>
                                <td>{{ leave.from }}</td>
                                <td>{{ leave.to }}</td>
                                <td>{{ leave.duration }} Days</td>
                                <td>{{ leave.created_at }}</td>
                                <td>
                                    <button type="text" class="btn" id="pendingBtn" :style="{
                                        color: getStatusColor(leave.status),
                                    }">{{ leave.status }}</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, defineProps, onUpdated, watch } from 'vue';
import 'datatables.net'; // Import DataTables.js library
import 'datatables.net-bs4/css/dataTables.bootstrap4.css'; // Import DataTables.css
import $ from 'jquery';
import useLeaves from "@/composables/leaves";
const { leaves, getLeaves,getLeaveByUser, deleteLeave } = useLeaves()
const emit = defineEmits(['showHistory']);
let dataTable = ref(null);
const myTable = ref(null);
const viewHistory = ref(true);
const isDataTableInitialized = ref(false)

const props = defineProps({
    user: Object,
    active: Boolean
});

onMounted(() => {
    getLeaveByUser(props.user.user_id)
})

onUpdated(() => {
    loadDataTable()
}) 
const hideHistory = () => {
    emit('showHistory', false);
}

const getStatusColor = (status) => {
    if (status == 'Pending') { return 'blue'; }
    if (status == 'Rejected') { return 'red'; }
    return 'green';
}

const loadDataTable = () => {
    const dataTableOptions = {
        "pagingType": "full_numbers",
        "bLengthChange": false,
        "columnDefs": [
            { "className": "text-center", "targets": "_all" } // Center-align all columns
        ],
        processing: true,
    }
    if (!isDataTableInitialized.value) {
        dataTable = $(myTable.value).DataTable(dataTableOptions);

        isDataTableInitialized.value = true;
    }
};
</script>

<style>
@import 'datatables.net-dt';

.dataTables_filter {
    margin-bottom: -15px;
}

.dt-search {
    display: none;
}
</style>
