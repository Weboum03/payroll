<template>
    <div class="modal-mask" id="Compare">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="CompareLabel">Compare Employee Data</h5>
                        <button type="button" class="close" @click="closeModalCompare">
                            <span aria-hidden="true"><i class="fa-solid fa-circle-xmark fa-2xl"
                                    style="color: #2DB9F8;opacity: 1;"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                                <div class="container d-flex flex-column" id="Compare-Date-Format" style="gap: 1rem;">
                                    <div id="Compare-Date-Type" class="d-flex">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <input type="radio" name="CompareDateType" id="Financial-Year" value="FinancialYear"
                                                style="width: 25px;" @click="currentStep = 1" checked>
                                            <label for="Financial-Year" style="font-size: 16px;width:145px;margin-bottom: 0px;font-weight: 500; font-family: sans-serif;">By
                                                Financial
                                                Year</label>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <input type="radio" name="CompareDateType" id="ByYear" value="ByYear"
                                                style="width: 25px;" @click="currentStep = 2">
                                            <label for="ByYear" style="font-size: 16px;width: 145px;margin-bottom: 0px;font-weight: 500;font-family: sans-serif;">By Calender
                                                Year</label>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <input type="radio" name="CompareDateType" id="ByMonth" value="ByMonth"
                                                style="width: 25px;" @click="currentStep = 3">
                                            <label for="ByMonth" style="font-size: 16px;width: 145px;margin-bottom: 0px;font-weight: 500;font-family: sans-serif;">By
                                                Month</label>
                                        </div>
                                    </div>
                                    <div id="Compare-Data-Input">
                                        <template v-if="currentStep === 1">
                                        <div id="Compare-Data-FinanInput" class="d-flex flex-column "
                                            style="gap: 1rem;">

                                            <div class="row d-flex">
                                                <div class="col input-group-fname">
                                                    <select class="form-control input" id="FinancialYear1"
                                                        autocomplete="off" style="color: black;height: 50px;width:529px;"
                                                        required>
                                                        <option value="" disabled selected>Financial Year-1*</option>
                                                        <option v-for="year in financialYears" :value="year">{{year}}</option>
                                                    </select>
                                                    <label class="user-label">Financial Year-1*</label>
                                                </div>
                                            </div>


                                            <div class="row d-flex">
                                                <div class="col input-group-fname">
                                                    <select class="form-control input" id="FinancialYear2"
                                                        autocomplete="off" style="color: black;height: 50px;width:529px;"
                                                        required>
                                                        <option value="" disabled selected>Financial Year-2*</option>
                                                        <option v-for="year in financialYears" :value="year">{{year}}</option>
                                                    </select>
                                                    <label class="user-label">Financial Year-2*</label>
                                                </div>
                                            </div>


                                            <div class="row d-flex">
                                                <div class="col input-group-fname">
                                                    <select class="form-control input1" id="FinancialYear3"
                                                        autocomplete="off" style="color: black;height: 50px;width:529px;">
                                                        <option value="" disabled selected>Financial Year-3</option>
                                                        <option v-for="year in financialYears" :value="year">{{year}}</option>
                                                    </select>
                                                    <label class="user-label1">Financial Year-3</label>
                                                </div>
                                            </div>

                                            <div class="modal-footer" style="padding-top: 0px;">
                                                <button type="submit" @click="comparePage" id="Compare-Data-Financi-Year"
                                                    class="btn btn-primary"
                                                    style="background-color: #2DB9F8;border: none;width: 113px;height: 50px;font-size: 16px;font-weight: 500;font-family: poppins,sans-serif;">Compare</button>
                                            </div>

                                        </div>
                                        </template>
                                        <template v-if="currentStep === 2">
                                        <div id="Compare-Data-YearInput" class="d-flex flex-column " style="gap: 1rem;">
                                            <div class="row d-flex">
                                                <div class="col input-group-fname">
                                                    <select class="form-control input" id="Year1" autocomplete="off"
                                                        style="color: black;height: 50px;width:529px;" required>
                                                        <option value="" disabled selected>Select Year-1*</option>
                                                        <option v-for="year in calenderYears" :value="year">{{year}}</option>
                                                    </select>
                                                    <label class="user-label">Select Year-1*</label>
                                                </div>
                                            </div>


                                            <div class="row d-flex">
                                                <div class="col input-group-fname">
                                                    <select class="form-control input" id="Year2" autocomplete="off"
                                                        style="color: black;height: 50px;width:529px;" required>
                                                        <option value="" disabled selected>Select Year-2*</option>
                                                        <option v-for="year in calenderYears" :value="year">{{year}}</option>
                                                    </select>
                                                    <label class="user-label">Select Year-2*</label>
                                                </div>
                                            </div>


                                            <div class="row d-flex">
                                                <div class="col input-group-fname">
                                                    <select class="form-control input1" id="Year3" autocomplete="off"
                                                        style="color: black;height: 50px;width:529px;">
                                                        <option value="" disabled selected> Select Year-3</option>
                                                        <option v-for="year in calenderYears" :value="year">{{year}}</option>
                                                    </select>
                                                    <label class="user-label1">Select Year-3</label>
                                                </div>
                                            </div>

                                            <div class="modal-footer" style="padding-top: 0px;">
                                                <button type="submit" @click="comparePage" id="Compare-Data-Years" class="btn btn-primary"
                                                    style="background-color: #2DB9F8;border: none;width: 113px;height: 50px;font-size: 16px;font-weight: 500;font-family: poppins,sans-serif;">Compare</button>
                                            </div>
                                        </div>
                                        </template>
                                        <template v-if="currentStep === 3">
                                        <div id="Compare-Data-MonthInput" class="d-flex flex-column "
                                            style="gap: 1rem;">
                                            <div class="row d-flex">
                                                <div class="col input-group-fname">
                                                    <select class="form-control input3" id="Month1" autocomplete="off"
                                                        style="color: black;height: 50px;width: 240px;;" required>
                                                        <option value="" disabled selected>Select Month-1*</option>
                                                        <option v-for="month in months" :value="month">{{month}}</option>
                                                    </select>
                                                    <label class="user-label">Select Month-1*</label>
                                                </div>
                                                <div class="col input-group-fname">
                                                    <select class="form-control input3" id="Year1" autocomplete="off"
                                                        style="color: black;height: 50px;width: 240px;" required>
                                                        <option value="" disabled selected>Select Year-1*</option>
                                                        <option v-for="year in years" :value="year">{{year}}</option>
                                                    </select>
                                                    <label class="user-label">Select Year-1*</label>
                                                </div>
                                            </div>
                                            <div class="row d-flex">
                                                <div class="col input-group-fname">
                                                    <select class="form-control input3" id="Month2" autocomplete="off"
                                                        style="color: black;height: 50px;width: 240px;" required>
                                                        <option value="" disabled selected>Select Month-2*</option>
                                                        <option v-for="month in months" :value="month">{{month}}</option>
                                                    </select>
                                                    <label class="user-label">Select Month-2*</label>
                                                </div>
                                                <div class="col input-group-fname">
                                                    <select class="form-control input3" id="Year2" autocomplete="off"
                                                        style="color: black;height: 50px;width: 240px;" required>
                                                        <option value="" disabled selected>Select Year-2*</option>
                                                        <option v-for="year in years" :value="year">{{year}}</option>
                                                    </select>
                                                    <label class="user-label">Select Year-2*</label>
                                                </div>
                                            </div>
                                            <div class="row d-flex">
                                                <div class="col input-group-fname">
                                                    <select class="form-control input3" id="Month3" autocomplete="off"
                                                        style="color: black;height: 50px;width: 240px;" required>
                                                        <option value="" disabled selected>Select Month-3*</option>
                                                        <option v-for="month in months" :value="month">{{month}}</option>
                                                    </select>
                                                    <label class="user-label">Select Month-3*</label>
                                                </div>
                                                <div class="col input-group-fname">
                                                    <select class="form-control input3" id="Year3" autocomplete="off"
                                                        style="color: black;height: 50px;width: 240px;" required>
                                                        <option value="" disabled selected>Select Year-3*</option>
                                                        <option v-for="year in years" :value="year">{{year}}</option>
                                                    </select>
                                                    <label class="user-label">Select Year-3*</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="padding-top: 0px;">
                                                <button type="submit" @click="comparePage" id="Compare-Data-Months-Year"
                                                    class="btn btn-primary"
                                                    style="background-color: #2DB9F8;border: none;width: 113px;height: 50px;font-size: 16px;font-weight: 500;font-family: poppins,sans-serif;">Compare</button>
                                            </div>
                                        </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import { useRouter } from "vue-router";
const emit = defineEmits(['close']);
const router = useRouter();
const currentStep = ref(1);
const closeModalCompare = () => {
    emit('close');
}

const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
const years = [2024, 2023, 2022, 2021, 2020, 2019, 2018, 2017, 2016, 2015];
const financialYears = ['April, 2022 to March, 2023', 'April, 2023 to March, 2024', 'April, 2024 to March, 2025'];
const calenderYears = ['Jan, 2024 to Dec, 2025', 'Jan, 2024 to Dec, 2025', 'Jan, 2024 to Dec, 2025']

const comparePage = () => {
    router.push({name:'admin.FinancialYearCompareTable'})
}
</script>

<style scope>
@import '@/assets/css/Home.css';

</style>