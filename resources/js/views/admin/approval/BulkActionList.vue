<template>

    <!-- Modal -->
    <div class="modal-mask" id="modalLeave-list" data-backdrop="false" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style=" width: 870px; height: 500px " ref="target">
                <div class="modal-header" style="align-items: center; gap: 3rem;">
                    <h5 class="modal-title" id="bulkActionLabel">Bulk Select Action</h5>
                    <button @click="hideHistory" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-circle-xmark fa-xl"
                                style="color: #2DB9F8;opacity:1; margin-top: 19px;" aria-hidden="true"></i></span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="divAction">
                        <select name="status"  v-model="filterStatus" id="dropdownAction" @change="changeStatus">
                            <option value="">--Select Option--</option>
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                        <div class="divDataselctAction">
                            <DataTable :key="tableKey" v-if="leaves?.data" :headers="tableHeaders" :rows="leaves"
                                id="DataselctAction-modal" class="display" @filter="filterData" ref="table">
                                <template v-slot:cell-name="{ row }">
                                    <img alt="dp" v-if="row.user?.user_profile_picture"
                                        :src="row.user?.user_profile_picture" width="20px" height="20px"
                                        style="border-radius: 50%;">
                                    {{ row.user.name }}
                                </template>
                                <template v-slot:cell-type="{ row }">
                                    {{ row.type.type }}
                                </template>
                                <template v-slot:cell-checkbox="{ row }">
                                    <input type="checkbox" v-model="statusValue" :checked="statusValue.includes(row.id) || checkAll" name="ids" :value="row.id">
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
                                    <i class="fa-solid fa-ellipsis-vertical fa-sm" @click="selectUser(row)"
                                        style="color: #000000;"></i>
                                </template>
                            </DataTable>
                        </div>
                        <div class="d-flex justify-content-start flex-column">
                            <label for="">Comment</label>
                            <textarea name="comment" v-model="comment" id="" required></textarea>
                        </div>
                    </div>


                </div>
                <div class="modal-footer justify-content-start" style="gap: 1rem;">
                    <button v-if="buttonStatus.pending" @click="updateStatus('Pending')" type="button" class="btn btn-primary pendingBtn">Pending</button>
                    <button v-if="buttonStatus.approved" @click="updateStatus('Approved')" type="button" class="btn btn-success approveBtn" style="">Approved</button>
                    <button v-if="buttonStatus.rejected" @click="updateStatus('Rejected')" type="button" class="btn btn-danger rejectBtn" style="">Rejected</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, defineProps, onUpdated, watch } from 'vue';
import 'datatables.net'; // Import DataTables.js library
import DataTable from '@/components/DataTable.vue';
import 'datatables.net-bs4/css/dataTables.bootstrap4.css'; // Import DataTables.css
import $ from 'jquery';
import { onClickOutside } from '@vueuse/core'
import useLeaves from "@/composables/leaves";
const { leaves, getLeaves,bulkUpdateLeave, getLeaveByUser, deleteLeave } = useLeaves()
const emit = defineEmits(['showHistory']);
let dataTable = ref(null);
const viewHistory = ref(true);
const table = ref(null)
const isDataTableInitialized = ref(false)
const tableHeaders = ref([])
const filterStatus = ref('')
const statusValue = ref([])
const comment = ref('')
const checkAll = ref(false)
const buttonStatus = ref({
    pending : false,
    approved:false,
    rejected:false
})
const tableKey = ref(0)
const props = defineProps({
    user: Object,
    active: Boolean
});

watch(leaves, (current, previous) => {
    if(checkAll.value) {
        let result = leaves.value?.data.map(a => a.id);
        statusValue.value = statusValue.value.concat(result)
    }

    if(Object.keys(leaves.value?.data).length == 0) {
        buttonStatus.value = {
            pending : false,
            approved:false,
            rejected:false
        }
    }
});

watch(filterStatus, (current, previous) => {
    table.value.filterData.filter.push({
        key: "status",
        value: current,
    })
    table.value.filterPayload();
});

const updateStatus = (status) => {
    return bulkUpdateLeave({ids:statusValue.value, status:status, reason : comment.value, filter_status: filterStatus.value, check_all : checkAll.value }).then( (response) => {
        emit('close');
    });
}

const filterData = (filterValues) => {
    getLeaves(filterValues)
}

const changeStatus = () => {
    if(filterStatus.value == 'Pending') {
        buttonStatus.value = {
            pending:false,
            approved:true,
            rejected:true,
        }
    }
    if(filterStatus.value == 'Approved') {
        buttonStatus.value = {
            pending:true,
            approved:false,
            rejected:true,
        }
    }
    if(filterStatus.value == 'Rejected') {
        buttonStatus.value = {
            pending:false,
            approved:false,
            rejected:false,
        }
    }

}

$(document).on('click','#selectAll', function(event) {
    if ($(this).is(':checked')) {
        checkAll.value = true
        
        console.log('Checkbox is now checked!');
    } else {
        checkAll.value = false
        console.log('Checkbox is now unchecked!');
    }
});

// $('#myCheckbox').click(function() {
//     if ($(this).is(':checked')) {
//       console.log('Checkbox is now checked!');
//     } else {
//       console.log('Checkbox is now unchecked!');
//     }
//   });

onMounted(() => {
    getLeaves()
    tableHeaders.value = [
        { key: 'checkbox', label: `<input type="checkbox" v-model="statusValue" id="selectAll" name="ids" :value="row.id" id="select-all">` },
        { key: 'name', label: 'Employee' },
        { key: 'type', label: 'Leave Type', sorting: true },
        { key: 'from', label: 'From', sorting: true },
        { key: 'to', label: 'To', sorting: true },
        { key: 'duration', label: 'No of Days', sorting: true },
        { key: 'status', label: 'Status', sorting: true },
    ];
})

const hideHistory = () => {
    emit('close', false);
}

const target = ref(null)
onClickOutside(target, () => { emit('close'); });
</script>

<style scoped>
@import 'datatables.net-dt';
@import '@/assets/css/Approvals.css';

.dt-search {
    display: none;
}
</style>
