<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table-info">
        <span>Payroll</span>
        <span>Payroll > Payroll batch</span>
    </div>
    <div id="dashboard-table">


        <div class="header d-flex flex-column" style="background-color: white; gap: 1rem;">

            <div class="back-button-div   d-flex" style="gap:22rem;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="margin: 0px;padding: 0px;font-size: 20px;font-weight: 500;color: black !important">
                    <span><i class="fa-solid fa-arrow-right fa-flip-horizontal fa-sm" style="color: #000000;"
                            aria-hidden="true"></i></span>
                    <span style="cursor: pointer;">Back</span>
                </button>
                <p style=" font-size: 20px;font-weight: 500;font-family:Poppins, sans-serif ">{{ batch?.data?.name }}</p>
            </div>

            <div class="details">
                <span class="data1">
                    <span class="GrossWages">Gross Wages</span>
                    <span class="GrossValue"> 5,42,152.45</span>
                </span>
                <span class="data2">
                    <span class="Deduction">Deduction</span>
                    <span class="DeductionValue"> 1,84,651.20</span>
                </span>
                <span class="data3">
                    <span class="NetWages">Net Wages</span>
                    <span class="NetValue"> 7,26,767.65</span>
                </span>
                <span class="data4">
                    <span class="LeaveEncashment">Leave Encashment</span>
                    <span class="LeaveValue"> 24,546.51</span>
                </span>
                <span class="data5">
                    <span class="Gratuity">Gratuity</span>
                    <span class="GratuityValue"> 51,320.00</span>
                </span>
                <span class="data6">
                    <span class="TotalPay">Total Pay</span>
                    <span class="TotalValue"> 8,02,634.16</span>
                </span>
            </div>


            <div class="buttons-div d-flex" style="gap: 1rem;">
                <button class="btn btn-primary" type="button" id="viewlog">View Log</button>
                <button class="btn btn-primary" type="button" id="revisepay">Revise payroll</button>
                <button class="btn btn-primary" type="button" id="relSalSlip">Release Salary Slip</button>
                <button class="btn btn-primary" type="button" id="DiscardPay">Discard payroll</button>
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
                                <option value="">Select file type</option>
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-primary d-flex justify-content-center align-items-center"
                                type="button" id="SRDownload">Download
                                <i class="fa fa-download" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>Attendance Register</td>
                        <td>
                            <select name="" id="DocumentFormat">
                                <option value="">Select file type</option>
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-primary d-flex justify-content-center align-items-center"
                                type="button" id="ARDownload">Download
                                <i class="fa fa-download" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>Bank Salary Transfer Letter</td>
                        <td>
                            <select name="" id="DocumentFormat">
                                <option value="">Select file type</option>
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-primary d-flex justify-content-center align-items-center"
                                type="button" id="BLDownload">Download
                                <i class="fa fa-download" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>Covering Letter for Bank</td>
                        <td>
                            <select name="" id="DocumentFormat">
                                <option value="">Select file type</option>
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-primary d-flex justify-content-center align-items-center"
                                type="button" id="CBDownload">Download
                                <i class="fa fa-download" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>Salary Slip</td>
                        <td>
                            <select name="" id="DocumentFormat">
                                <option value="">Select file type</option>
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-primary d-flex justify-content-center align-items-center"
                                type="button" id="SSDownload">Download
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
const { item: batch, fetchOne: getBatch } = useBatch();
const route = useRoute();

onMounted(() => {
    getBatch(route.params.id)
});
</script>

<style scoped>
@import '@/assets/css/PayrolldownloadProcess.css';

</style>