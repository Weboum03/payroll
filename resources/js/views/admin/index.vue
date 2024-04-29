<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container-fluid">
                <div id="dashboard-table-info">
                    <span>Dashboard</span>
                    <span>Dashboard</span>
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


                <div class="d-flex flex-column align-items-center; "
                    style="background-color: white;gap: 1rem; height: 275px;">


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
                    <div id="PayrollBatch-btn" class="d-flex justify-content-center align-items-center">
                        <button type="button" class="btn btn-primary PayrollBatchbtn" data-toggle="modal"
                            data-target="#PayrollBatch-modal">Create Payroll Batch</button>
                    </div>

                </div>



                <!-- Modal -->
                <div class="modal fade" id="PayrollBatch-modal" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Create New Payroll Batch</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" style="margin-bottom: 5px;">&times;</span>
                                </button>
                            </div>
                            <div
                                class="modal-body d-flex justify-content-center align-items-center Year-Payrool-Batch-modalLAbInp ">
                                <label for="Year-Payrool-Batch">March2024</label>
                                <Input type="text" id="Year-Payrool-Batch" placeholder="Batch Name*"></Input>
                            </div>
                            <div class="modal-footer">
                                <a id="myAnchor" href="#" class="btn btn-next btn-primary save">Save</a>
                                <a id="myAnchor" href="Home.html" class="btn btn-outline-light cancle">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- -----nav-dashboard-table end----- -->
</template>

<!-- <script setup>
</script> -->

<script setup>
import 'feather-icons'
import { ref, onMounted } from 'vue';
import '@/assets/css/Home.css'


const user = ref({
    total: 0,
    active: 0,
    inactive: 0
});
const getDashboardData = async () => {
    axios.get('/api/admin/dashboard')
        .then(response => {
            user.value = response.data.data;
        });
};

onMounted(() => {
    const script = document.createElement('script');
    script.src = '../../resources/js/Home.js';
    document.head.appendChild(script);
    getDashboardData()
});
</script>
