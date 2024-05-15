<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container">
        <div id="dashboard-table-info">
            <span>Payroll</span>
            <span>Payroll > Payroll batch</span>
        </div>


        <div class="container d-flex flex-column justify-content-center"
            style="background-color: white;padding: 10px; gap: 1rem;">

            <div class="d-flex justify-content-between align-items-center">
                <div class="Payroll-header">
                    <p>Payroll Batch-March2024_Lipsum</p>
                    <p>Select Employees to add to the batch</p>
                </div>
                <button type="button" id="testRslt" data-toggle="modal" data-target="#testRslt1">Test
                    Rule</button>
            </div>

            <div style="font-size: 10px;color: red;font-weight: 500;">Note: Only those employees who are not
                already added to another batch and meet the below criteria will be added </div>

            <div class="container payForm d-flex flex-column" style="gap: 1rem;">
                <div class="row d-flex">
                    <div class="col input-group-fname">
                        <select class="form-control input" id="Companies" autocomplete="off" style="color: #7e7e7e;">
                            <option value="" selected>All</option>
                            <option value="Option1">Option1</option>
                            <option value="Option2">Option2</option>
                            <option value="other">Other</option>
                        </select>
                        <label class="user-label">Companies</label>
                    </div>
                </div>

                <div class="row d-flex">
                    <div class="col input-group-fname">
                        <select class="form-control input" id="Location" autocomplete="off" style="color: #7e7e7e;">
                            <option value="" selected>All</option>
                            <option value="Option1">Option1</option>
                            <option value="Option2">Option2</option>
                            <option value="other">Other</option>
                        </select>
                        <label class="user-label">Location</label>
                    </div>
                </div>

                <div class="row d-flex">
                    <div class="col input-group-fname">
                        <select class="form-control input" id="Department" autocomplete="off" style="color: #7e7e7e;">
                            <option value="" selected>All</option>
                            <option value="Option1">Option1</option>
                            <option value="Option2">Option2</option>
                            <option value="other">Other</option>
                        </select>
                        <label class="user-label">Department</label>
                    </div>
                </div>
                <div class="row d-flex">
                    <div class="col input-group-fname">
                        <select class="form-control input" id="Job-Role" autocomplete="off" style="color: #7e7e7e;">
                            <option value="" selected>All</option>
                            <option value="Option1">Option1</option>
                            <option value="Option2">Option2</option>
                            <option value="other">Other</option>
                        </select>
                        <label class="user-label">Job Role</label>
                    </div>
                </div>
                <div class="row d-flex">
                    <div class="col input-group-fname">
                        <select class="form-control input" id="Grader" autocomplete="off" style="color: #7e7e7e;">
                            <option value="" selected>All</option>
                            <option value="Option1">Option1</option>
                            <option value="Option2">Option2</option>
                            <option value="other">Other</option>
                        </select>
                        <label class="user-label">Grader</label>
                    </div>
                </div>
                <div class="row d-flex">
                    <div class="col input-group-fname">
                        <select class="form-control input" id="Emp-type" autocomplete="off" style="color: #7e7e7e;">
                            <option value="" selected>All</option>
                            <option value="Option1">Option1</option>
                            <option value="Option2">Option2</option>
                            <option value="other">Other</option>
                        </select>
                        <label class="user-label">Employment Type</label>
                    </div>
                </div>
                <div class="row d-flex">
                    <div class="col input-group-fname">
                        <select class="form-control input" id="Specific-Emp" autocomplete="off" style="color: #7e7e7e;">
                            <option value="" selected>Select</option>
                            <option value="Option1">Option1</option>
                            <option value="Option2">Option2</option>
                            <option value="other">Other</option>
                        </select>
                        <label class="user-label">Specific Employee(s)</label>
                    </div>
                </div>
                <div class="row d-flex">
                    <div class="col input-group-fname">
                        <select class="form-control input" id="Exclude-Emp" autocomplete="off" style="color: #7e7e7e;">
                            <option value="" selected>Select</option>
                            <option value="Option1">Option1</option>
                            <option value="Option2">Option2</option>
                            <option value="other">Other</option>
                        </select>
                        <label class="user-label">Exclude Employee(s)</label>
                    </div>
                </div>

                <div class="btns-save-cancle">
                    <router-link :to="{ name: 'admin.PayrollBatchList' }" custom v-slot="{ navigate }">
                        <button @click="navigate" role="link" class="btn btn-next btn-primary save savePayBatchForm">Save</button>
                    </router-link>
                    <a href="/admin/payroll" class="btn btn-outline-light cancle">Cancel</a>
                </div>

            </div>
        </div>




    </div>





    <!-- Modal Notice period list2 -->
    <div class="modal fade" id="testRslt1" data-backdrop="false" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style=" width: 800px !important; scrollbar-width: none; ">
                <div class="modal-header" style="align-items: center; gap: 3rem;">
                    <button type="button" class="close1" data-dismiss="modal" aria-label="Close"
                        style=" margin: 0px; padding: 0px; font-size: medium; color: black !important">
                        <span><i class="fa-solid fa-arrow-right fa-flip-horizontal fa-sm"
                                style="color: #000000;"></i></span>
                        <span style="cursor: pointer;">Back</span>
                    </button>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-circle-xmark fa-lg"
                                style="color: #2DB9F8;opacity: 1;"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="testRslt-table">
                        <thead>
                            <tr>
                                <th id="EmpId">Employee ID</th>
                                <th id="EmpName">Employee Name</th>
                                <th id="DoResg">Company</th>
                                <th id="Loc">Location</th>
                                <th id="Dept">Department</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>DFH51324</td>
                                <td>Austin Hodges</td>
                                <td>Lorem, ipsum dolor.</td>
                                <td>Kingmouth,Louisiana</td>
                                <td>Superisor</td>
                            </tr>
                            <tr>
                                <td>SDG54635</td>
                                <td>Randy Johnson</td>
                                <td>Sanford-Leannon</td>
                                <td>UK</td>
                                <td>Manager</td>
                            </tr>
                            <tr>
                                <td>YTJ62463</td>
                                <td>MAtthew Luckett</td>
                                <td>LLC</td>
                                <td>Cananda</td>
                                <td>SR.Developer</td>
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="savePayBatchForm1" tabindex="-1" aria-labelledby="savePayBatchFormLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-circle-xmark fa-2xl"
                                style="color: #2DB9F8;opacity: 1;"></i></span>
                    </button>
                </div>
                <div class="container modal-body d-flex flex-column">
                    <div>Added employee to batch</div>
                    <div>258 Employees were added to the payroll batch successfully.</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary ok">OK</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
@import '@/assets/css/PayrollBatchform.css';

.save {
    display: inline-block;
    padding: 0.375rem 0.75rem;
}
</style>