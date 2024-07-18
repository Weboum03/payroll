<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table-info">
        <span>Payroll</span>
        <span>Payroll > Payroll batch</span>
    </div>
    <div id="dashboard-table">


        <div class="header d-flex flex-column" style="background-color: white; gap: 1rem;">

            <div class="back-button-div   d-flex" style="gap:22rem;">

                <router-link :to="{ name: 'admin.payroll' }" custom v-slot="{ navigate }">
                    <button @click="navigate" type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="margin: 0px;padding: 0px;font-size: 20px;font-weight: 500;color: black !important">
                        <span><i class="fa-solid fa-arrow-right fa-flip-horizontal fa-sm" style="color: #000000;"
                                aria-hidden="true"></i></span>
                        <span style="cursor: pointer;">Back</span>
                    </button>
                </router-link>


                <p style=" font-size: 20px;font-weight: 500;font-family:Poppins, sans-serif ">{{ batch?.data?.name }}
                </p>
            </div>

            <div class="details">
                <span class="data1">
                    <span class="GrossWages">Gross Wages</span>
                    <span class="GrossValue"> {{ batch?.data?.wages || '0.00' }}</span>
                </span>
                <span class="data2">
                    <span class="Deduction">Deduction</span>
                    <span class="DeductionValue"> {{ batch?.data?.deduction || '0.00' }}</span>
                </span>
                <span class="data3">
                    <span class="NetWages">Net Wages</span>
                    <span class="NetValue"> {{ batch?.data?.payout || '0.00' }}</span>
                </span>
                <span class="data4">
                    <span class="LeaveEncashment">Leave Encashment</span>
                    <span class="LeaveValue"> {{ batch?.data?.Leave_encashment || '0.00' }}</span>
                </span>
                <span class="data5">
                    <span class="Gratuity">Gratuity</span>
                    <span class="GratuityValue"> {{ batch?.data?.gratuity || '0.00' }}</span>
                </span>
                <span class="data6">
                    <span class="TotalPay">Total Pay</span>
                    <span class="TotalValue"> {{ batch?.data?.payout || '0.00' }}</span>
                </span>
            </div>


            <div class="buttons-div d-flex" style="gap: 1rem;">
                <router-link :to="{ name: 'admin.viewLog' }" custom v-slot="{ navigate }">
                    <button @click="navigate" class="btn btn-primary" type="button" id="viewlog">View Log</button>
                </router-link>
                
                <router-link :to="{ name: 'admin.RevisePayroll' }" custom v-slot="{ navigate }">
                    <button @click="navigate" class="btn btn-primary" type="button" id="revisepay">Revise payroll</button>
                </router-link>

                <router-link :to="{ name: 'admin.ReleaseSalarySlip' }" custom v-slot="{ navigate }">
                    <button @click="navigate" class="btn btn-primary" type="button" id="relSalSlip">Release Salary Slip</button>
                </router-link>

                <router-link :to="{ name: 'admin.DiscardPayroll' }" custom v-slot="{ navigate }">
                    <button @click="navigate" class="btn btn-primary" type="button" id="DiscardPay">Discard payroll</button>
                </router-link>
            </div>

            <table id="Doc-Download">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Document Format</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>Salary Register</td>
                        <td>
                            <select name="" id="DocumentFormat">
                                <option disabled value="">Select file type</option>
                                <option selected value="pdf">Pdf</option>
                            </select>
                        </td>
                        <td>
                            <button @click="downloadFile('https://payroll.wtpl.net/api/admin/batches/64/donwload_doc/SalaryFormat')" class="btn btn-primary d-flex justify-content-center align-items-center"
                                type="button" id="SRDownload">Download
                                <i class="fa fa-download" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>Attendance Register</td>
                        <td>
                            <select name="" id="DocumentFormat">
                                <option disabled value="">Select file type</option>
                                <option selected value="pdf">Pdf</option>
                            </select>
                        </td>
                        <td>
                            <button @click="downloadFile('https://payroll.wtpl.net/api/admin/batches/64/donwload_doc/AttendaceFormat')" class="btn btn-primary d-flex justify-content-center align-items-center"
                                type="button" id="ARDownload">Download
                                <i class="fa fa-download" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>Bank Salary Transfer Letter</td>
                        <td>
                            <select name="" id="DocumentFormat">
                                <option disabled value="">Select file type</option>
                                <option selected value="pdf">Pdf</option>
                            </select>
                        </td>
                        <td>
                            <button @click="downloadFile('https://payroll.wtpl.net/api/admin/batches/64/donwload_doc/SalaryTransferLetter')" class="btn btn-primary d-flex justify-content-center align-items-center"
                                type="button" id="BLDownload">Download
                                <i class="fa fa-download" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>Covering Letter for Bank</td>
                        <td>
                            <select name="" id="DocumentFormat">
                                <option  disabled value="">Select file type</option>
                                <option selected value="pdf">Pdf</option>
                            </select>
                        </td>
                        <td>
                            <button @click="downloadFile('https://payroll.wtpl.net/api/admin/batches/64/donwload_doc/SalaryFormat')" class="btn btn-primary d-flex justify-content-center align-items-center"
                                type="button" id="SRDownload">Download
                                <i class="fa fa-download" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>Salary Slip</td>
                        <td>
                            <select name="" id="DocumentFormat">
                                <option selected disabled value="">Select file type</option>
                                <option value="pdf">Pdf</option>
                            </select>
                        </td>
                        <td>
                            <button @click="downloadFile('https://payroll.wtpl.net/api/admin/batches/64/donwload_doc/SalaryFormat')" class="btn btn-primary d-flex justify-content-center align-items-center"
                                type="button" id="SRDownload">Download
                                <i class="fa fa-download" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>

        </div>



    </div>

</template>

<script setup>
import { ref, onMounted, onUpdated, watchEffect, nextTick, reactive, computed, watch, inject } from 'vue';
import useBatch from "@/composables/useBatch";
import { useRouter, useRoute } from "vue-router";
const router = useRouter();
const route = useRoute();
const swal = inject("$swal");

const { items: batches, item: batch, fetchOne: getBatch, downloadDocument, processBatch, remove, getBatchUsers, deleteBatchUser, success } = useBatch();

onMounted(() => {
    getBatch(route.params.id)
});

const downloadFileBatch = async (url) => {
    let response = await downloadDocument(route.params.id, 'SalaryTransferLetter');
    downloadFile(url)
}

const downloadFile = async (response) => {
    const url = response;
    const link = document.createElement('a');
    link.href = url;
    let fileName = 'downloaded_file.pdf';
    link.setAttribute('download', fileName);
    document.body.appendChild(link);
    link.click();
    swal({
        icon: "success",
        title: "Download successfully",
    });
}

</script>

<style scoped>
@import '@/assets/css/PayrolldownloadProcess.css';
</style>