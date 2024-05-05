<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container-fluid">
        <div id="dashboard-table-info">
            <span>Payroll</span>
            <span>Payroll > Payroll Data</span>
        </div>

        <div id="Financial-year-dropdown">
            <span>Financial Year</span>
            <span id="finYearDropdown"></span>
        </div>

        <nav aria-label="Page navigation example" class="d-flex flex-column"
            style="background-color: white; gap: 1rem;">
            <ul class="pagination" id="pagination">
                <li class="page-item ">
                    <a class="page-link page-item-prev" href="#" aria-label="Previous">
                        <span aria-hidden="true"><i class="fa-solid fa-angle-left fa-2xl"
                                style="color: #000000;"></i></span>
                    </a>
                </li>
                <div class="months-years"></div>
                <li class="page-item">
                    <a class="page-link page-item-next" href="#" aria-label="Next">
                        <span aria-hidden="true"><i class="fa-solid fa-angle-left fa-flip-horizontal fa-2xl"
                                style="color: #000000;"></i></span>
                    </a>
                </li>
            </ul>
            <div class="d-flex" style="gap: 15rem;">
                <div
                    style="font-size: 10px; margin-left: 10px; color: #4D4D4D; font-weight: 600; font-family: sans-serif;background-color: white;">
                    March 2024 payroll from 1st March 2024 to 31st march 2024</div>
                <a href="#"
                    style="font-size: 10px; margin-left: 10px; color:#2DB9F8; font-weight: 600; font-family: sans-serif;text-decoration: none;">Check
                    for deduction u/s 80JJAA for Hiring New Employee</a>

            </div>
        </nav>


        <div class="d-flex flex-column align-items-center; " style="background-color: white;gap: 1rem;">


            <div class="graph chartjs-div-payrolldata d-flex" style="gap: 175px;">
                <div class="payrolldata-graph d-flex flex-column">
                    <div class="programming-stats4">
                        <div class="payrollData-container">
                            <canvas class="payrolldata-chart"></canvas>
                        </div>

                        <div class="details">
                            <ul></ul>
                        </div>
                    </div>
                </div>


                <div class="FinencialTable">
                    <table class="table table-bordered" style="margin-top: 14px;">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">February 2024</th>
                                <th scope="col">March 2024</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Employee Count</th>
                                <td>251</td>
                                <td>253</td>
                            </tr>
                            <tr>
                                <th scope="row">New Starter</th>
                                <td>3</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <th scope="row">Leaver</th>
                                <td>1</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <th scope="row">On Notice Period</th>
                                <td>0</td>
                                <td>3</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="PayrollBatch-btn" class="d-flex justify-content-center align-items-center" style="gap: 1rem;">
                <button type="button" class="btn btn-primary PayrollBatchbtn" @click="openModal">Create Payroll
                    Batch</button>
                <button type="button" class="btn btn-secondary PayrollDocbtn" data-toggle="modal"
                    data-target="#PayrollBatch-modal" disabled>Download Documents</button>
            </div>

            <div style="font-size: 14px;padding: 12px;font-weight: 500;">Payroll Batch</div>

            <table id="Payroll-Batch-table">
                <thead>
                    <tr>

                        <th id="Sr-No">Sr No.</th>
                        <th id="Batch-Name">Batch Name</th>
                        <th id="Emp-Count">Employee Count</th>
                        <th id="Creat-On">Created On</th>
                        <th id="Status">Status</th>
                        <th id="Gross-Wages">Gross Wages</th>
                        <th id="Detuc">Deduction</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>No Data Yet</td>
                    </tr>


                </tbody>
            </table>
        </div>
    </div>
    <ModalComponent :isOpen="isModalOpened" @modal-close="closeModal" @submit="submitHandler" name="first-modal">
        <template #header>
            <h5 class="modal-title" id="staticBackdropLabel">Create New Payroll Batch</h5>
            <button type="button" class="close" @click="closeModal">
                <span aria-hidden="true" style="margin-bottom: 5px;">&times;</span>
            </button>
        </template>
        <template #content>
            <div class="modal-body d-flex justify-content-center align-items-center Year-Payrool-Batch-modalLAbInp ">
                <label for="Year-Payrool-Batch">March2024</label>
                <Input type="text" id="Year-Payrool-Batch" placeholder="Batch Name*"></Input>
            </div>
        </template>
        <template #footer>
            <button class="btn btn-next btn-primary save">Save</button>
            <a href="javascript:;" class="btn btn-outline-light cancle" @click="closeModal">Cancel</a>
        </template>
    </ModalComponent>

</template>

<script setup>

import { ref, onMounted } from 'vue';
import '@/assets/css/Payroll.css'
import '@/assets/css/onBoard.css'
import ModalComponent from '../../../components/ModalComponent.vue';

const isModalOpened = ref(false);

const openModal = () => {
    isModalOpened.value = true;
};
const closeModal = () => {
    isModalOpened.value = false;
};

const submitHandler = () => {
    //here you do whatever
}

onMounted(() => {
    const script = document.createElement('script');
    script.src = '../../resources/js/Payroll.js';
    document.head.appendChild(script);
});

</script>