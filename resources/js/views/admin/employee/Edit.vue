<template>

    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container">
        <div id="dashboard-table-info">
            <span>Employee Roles</span>
            <span>Employee Roles > Employee Roles</span>
        </div>

        <div class="container header d-flex flex-column" style="gap: 1.5rem;">
            <div class="sec d-flex flex-column">
                <p>Update Employee Roles</p>
                <p>Update employee role and it's permissions to access portal features.</p>
            </div>

            <div class="container d-flex flex-column" style="gap: 2rem;">

                <div class="row">
                    <div class="col input-group-fname">
                        <input placeholder="Role Name*" type="text" value="Team Leader" autocomplete="off" class="input"
                            id="RoleName-Value" required>
                        <label class="user-label">Role Name*</label>
                    </div>
                </div>

                <div class="outter-div d-flex flex-column" style="gap: 1.5rem;">
                    <div class="inner-div d-flex flex-column" style="gap: 5px;">
                        <h6>Employee Management</h6>
                        <div class="d-flex" style="gap: 2rem;">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="OnBoard">
                                <label class="custom-control-label" for="OnBoard">On-Board</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="DeBoard">
                                <label class="custom-control-label" for="DeBoard">De-Board</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="Upprofile">
                                <label class="custom-control-label" for="Upprofile">Update Profile</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="viewProf" checked>
                                <label class="custom-control-label" for="viewProf">View Profile</label>
                            </div>

                        </div>
                    </div>


                    <div class="inner-div d-flex flex-column" style="gap: 5px;">
                        <h6>Leave Management</h6>
                        <div class="d-flex" style="gap: 2rem;">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="leaveApp" checked>
                                <label class="custom-control-label" for="leaveApp">Leave Approval</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="viewleavHis" checked>
                                <label class="custom-control-label" for="viewleavHis">View Leave History</label>
                            </div>
                        </div>
                    </div>

                    <div class="inner-div d-flex flex-column" style="gap: 5px;">
                        <h6>Payroll</h6>
                        <div class="d-flex" style="gap: 2rem;">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="GenPay">
                                <label class="custom-control-label" for="GenPay">Generate Payroll</label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="btns-Update-cancle">
                    <a href="EmployeeRole.html" class="btn btn-primary savenext">Update</a>
                    <a href="EmployeeRole.html" class="btn btn-outline-light cancle">Cancle</a>
                </div>

            </div>


        </div>


    </div>
</template>

<style scoped>
@import '@/assets/css/EmployeeRoleEdit.css';
</style>