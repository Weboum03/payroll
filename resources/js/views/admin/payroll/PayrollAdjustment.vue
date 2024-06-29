<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table-info">
            <span>Payroll</span>
            <span>Payroll > Payroll adjustment</span>
    </div>

    <div id="dashboard-table">
        <div class="d-flex flex-column" style="gap: 2rem; background-color: white;padding: 20px;">
            <div class="header">{{ batch?.data?.name }} - Make a new payroll adjustment</div>
            <div class="section d-flex flex-column" style="gap: 1rem;">
                <div class="updateMode d-flex justify-content-start align-items-baseline" style="gap: 1rem;flex-wrap: wrap;">
                    <span>1</span>

                    <div class="row d-flex flex-column align-items-start justify-content-center">
                        <div class="col input-group-fname">
                            <select class="form-control input" v-model="mode" id="UpdateMode" required autocomplete="off"
                                style="color: #131313;">
                                <option value="" selected>Update Mode*</option>
                                <option value="salary">Update Salary</option>
                                <option value="overtime">Overtime hours</option>
                                <option value="bonus">Bonus Adjustment</option>
                                <option value="commission">Commission Adjustment</option>
                                <option value="deduction">Deduction Adjustment</option>
                                <option value="reimbursement">Reimbursement Adjustment</option>
                                <option value="salary">Salary Correction</option>
                                <option value="leave_bal">Leave Balance Adjustment</option>
                                <option value="salary">Shift Differential Adjustment</option>
                                <option value="salary">Retroactive Pay Adjustment</option>
                            </select>
                            <label class="user-label">Update Mode*</label>
                        </div>
                        <p
                            style="margin-left: 18px;margin-bottom: 0px;font-size: 12px;color: #212121;font-weight: 500;opacity: 50%;">
                            Praesent sit amet metus nec quam molestie</p>
                    </div>

                </div>
                <div class="dwnldFile  d-flex justify-content-start align-items-baseline" style="gap: 1rem;">
                    <span>2</span>
                    <div id="dwnldFile" class="d-flex align-items-center justify-content-start"
                        style="gap: 1rem;font-size: 16px;font-weight: 500;font-family:  sans-serif;">Download file
                        pre-field with employee data to make adjustment
                        <i class="fa-solid fa-download fa-sm" @click="downloadFileBatch"
                            style="background-color: #2DB9F8;width: 44px;height: 40px;border-radius: 6px;text-align: center;align-items: center;justify-content: center;display: flex;color: white;"></i>
                    </div>

                </div>
                <div class="upldExcelfile d-flex justify-content-start align-items-baseline" style="gap: 1rem;">
                    <span>3</span>
                    <span>Upload Excel file*</span>
                    <div class="input-group is-invalid">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"  @change="handleFileSelect" id="validatedInputGroupCustomFile" required>
                            <label class="custom-file-label" for="validatedInputGroupCustomFile">{{ fileText }}</label>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center" style="gap: 1.4rem;margin-left: -280px;">

                        <button @click="uploadFile" :disabled="!selectedFile" role="link" type="button" class="btn vldExcel ">{{ text }}</button>

                    <router-link :to="{ name: 'admin.PayrollBatchList', params: {id: route.params.id}}" custom v-slot="{ navigate }">
                        <button @click="navigate" type="button" class="btn btn-cancle cancle">Cancel</button>
                    </router-link>
                    
                </div>
            </div>

            <DataTable v-if="batches?.data" :headers="tableHeaders" :rows="batches" @filter="filterData" ref="table">
                <template v-slot:cell-company="{ row }">
                    {{ row.info?.company }}
                </template>
                <template v-slot:cell-location="{ row }">
                    {{ row.info?.location }}
                </template>
                <template v-slot:cell-salary="{ row }">
                    {{ row.pivot?.salary }}
                </template>
                <template v-slot:cell-deduction="{ row }">
                    {{ row.pivot?.deduction }}
                </template>
                <template v-slot:cell-overtime="{ row }">
                    {{ row.pivot?.overtime }}
                </template>
                <template v-slot:cell-bonus="{ row }">
                    {{ row.pivot?.bonus }}
                </template>
                <template v-slot:cell-commission="{ row }">
                    {{ row.pivot?.commission }}
                </template>
                <template v-slot:cell-reimbursement="{ row }">
                    {{ row.pivot?.reimbursement }}
                </template>
                <template v-slot:cell-leave_bal="{ row }">
                    {{ row.pivot?.leave_bal }}
                </template>
                <template v-slot:cell-action="{ row }">
                    <i @click.prevent="deleteUser(row.id)" class="fa-regular fa-trash-can fa-lg" style="color: #f02828;"
                        aria-hidden="true"></i>
                </template>
            </DataTable>
        </div>
    </div>
</template>


<script setup>
import { ref, onMounted, onUpdated, watchEffect, nextTick, reactive, computed, watch, inject } from 'vue';
import DataTable from '@/components/DataTable.vue';
import useBatch from "@/composables/useBatch";
import { useRouter, useRoute } from "vue-router";
import 'datatables.net'; // Import DataTables.js library
import 'datatables.net-bs4/css/dataTables.bootstrap4.css'; // Import DataTables.css
import $ from 'jquery';
const { items: batches, item: batch, fetchOne: getBatch, exportBatch,importBatch, getBatchUsers, loading: isLoading, success } = useBatch();
const router = useRouter();
const route = useRoute();
const text = ref('Validate Excel')
const swal = inject('$swal')
const mode = ref('')
const fileText = ref('Select File...')

const filterData = (filterValues) => {
    getBatchUsers(route.params.id, filterValues)
}

onMounted(() => {
    getBatchUsers(route.params.id)
    getBatch(route.params.id)
});

watch(mode, (current, previous) => {
    getBatchUsers(route.params.id, {mode:current})
    tableHeaders.splice(tableHeaders.findIndex(component => component.key === current), 1);
    tableHeaders.push({key:current, label: capitalize(current.split('_').join(' '))})
    // tableHeaders = tableHeaders.
})

function capitalize(s)
{
    return s[0].toUpperCase() + s.slice(1);
}

const downloadFileBatch = async () => {
    let response = await exportBatch(route.params.id, {mode:mode.value});
    downloadFile(response)
}

const downloadFile = async (response) => {
    const url = response.data;
    const link = document.createElement('a');
    link.href = url;
    let fileName = 'downloaded_file.xlsx';
    link.setAttribute('download', fileName);
    document.body.appendChild(link);
    link.click();
    swal({
        icon: "success",
        title: "Export successfully",
    });
}

const selectedFile = ref(null)

const handleFileSelect = (event) => {
      const file = event.target.files[0];
      if (file) {
        fileText.value = file.name
        selectedFile.value = file;
      }
}

const uploadFile = async (event) => {
    text.value = 'Processing';
    await setTimeout(async () => {
        if (!selectedFile.value) {
            alert("Please select a file first!");
            return;
        }
        let response = await importBatch(route.params.id, {attachment : selectedFile.value,mode:mode.value});
        text.value = 'Validate Excel';
        if(success.value) { router.push({name: 'admin.PayrollBatchProcess', params: {id: route.params.id}}) }
    }, 1000);
}

const tableHeaders = [
    { key: 'id', label: 'Sr No.', sorting: true },
    { key: 'employee_id', label: 'EMP ID', sorting: true },
    { key: 'first_name', label: 'First Name', sorting: true },
    { key: 'last_name', label: 'Last Name', sorting: true },
    { key: 'company', label: 'Company' },
    { key: 'location', label: 'Location' },
    { key: 'salary', label: 'Salary' }
];

</script>

<style scoped>
@import 'datatables.net-dt';
@import '@/assets/css/PayrollAdjustment.css';

.dt-search {
    display: none;
}
#PayrollbatchList-Table_filter {
    margin-bottom: -15px;
}
</style>