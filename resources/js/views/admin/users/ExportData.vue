<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table-info">
                <span>Export Data</span>
                <span>More > Export Data</span>
            </div>
            <div id="dashboard-table">

                <div id="ExportData" class="d-flex flex-column" style="padding: 20px 25px; gap: 1rem;">
                    <div class="section d-flex flex-column justify-content-between align-items" style="gap: 1rem;">
                        <div class="d-flex flex-column" style="gap: 5px">
                            <p>Export data from database</p>
                            <p>Select file format and fields which want to export</p>
                        </div>
                        <div>
                            <div class="col input-group-fname">
                                <select class="form-control input" id="SelectColmn" required autocomplete="off"
                                    style="color: #7e7e7e;">
                                    <option value="" selected disabled>File Type*</option>
                                    <option value="Option1">Option1</option>
                                    <option value="Option2">Option2</option>
                                    <option value="other">Other</option>
                                </select>
                                <label class="user-label">File Type*</label>
                            </div>
                        </div>
                    </div>
                    <div class="inner-div d-flex flex-column" style="gap: 5px; flex-wrap: wrap;">
                        <h6>Employee Management</h6>
                        <div class="d-flex row-cols-5" style="gap:1rem;">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="FirstName">
                                <label class="custom-control-label" for="FirstName">First Name</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="LastName">
                                <label class="custom-control-label" for="LastName">Last Name</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="Email">
                                <label class="custom-control-label" for="Email">Email</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="SecondaryEmail">
                                <label class="custom-control-label" for="SecondaryEmail">Secondary Email</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="Mobile">
                                <label class="custom-control-label" for="Mobile">Mobile</label>
                            </div>
                        </div>
                            <div class="d-flex row-cols-5" style="gap:1rem;">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="AlternateMobile">
                                <label class="custom-control-label" for="AlternateMobile">Alternate Mobile</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="Gender">
                                <label class="custom-control-label" for="Gender">Gender</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="DOB">
                                <label class="custom-control-label" for="DOB">Date of Birth</label>
                            </div>

                        </div>
                    </div>
                    <div>
                        <a href="dashboard.html"><button type="button" class="ExpSeleData">Export Selected Data</button></a>
                    </div>
                </div>

            </div>
</template>

<style>
@import '@/assets/css/ExportData.css';
</style>