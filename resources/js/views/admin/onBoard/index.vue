<template>
    <!-- -----nav-dashboard-table start----- -->


    <div id="dashboard-table" class="container-fluid">
        <div id="dashboard-table-info">
            <span>On-board</span>
            <span>Employees > On-board</span>
        </div>

        <div id="form-info" class="container">
            <form action="#" class="form">
                <div class=" d-flex flex-column">
                    <div class="Add-emp-div">Add Employee</div>
                    <div class="div-emp-rem"> Fill in the fields on each screen to create an employment record
                        for a new stater.</div>
                </div>
                <!-- Progress bar -->
                <div class="progressbar container">
                    <div class="progress" id="progress"></div>

                    <div class="progress-step progress-step-active" data-title="Personal Information"></div>
                    <div class="progress-step" data-title="Job Information"></div>
                    <div class="progress-step" data-title="Attendance & Leaves"></div>
                    <div class="progress-step" data-title="Tasks"></div>
                    <div class="progress-step" data-title="Done"></div>
                </div>

                <!-- Steps -->
                <div class="form-step form-step-active">
                    <div class="personal-infor">
                        <div class="row">
                            <div class="col input-group-fname">
                                <input placeholder="First Name" required="" type="text" name="text" autocomplete="off"
                                    class="input" id="fname-Value">
                                <label class="user-label">First Name</label>
                            </div>
                            <div class="col input-group-fname">
                                <input placeholder="Last Name" required="" type="text" name="text" autocomplete="off"
                                    class="input" id="lname-Value">
                                <label class="user-label">Last Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col input-group-fname">
                                <input placeholder="Email" required="" type="text" name="text" autocomplete="off"
                                    class="input" id="email-Value">
                                <label class="user-label">Email</label>
                            </div>
                            <div class="col input-group-fname">
                                <input placeholder="Mobile" required="" type="text" name="text" autocomplete="off"
                                    class="input" id="phone-Value">
                                <label class="user-label">Mobile</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col input-group-fname">
                                <select class="form-control input" id="gender" autocomplete="off"
                                    style="color: #7e7e7e;">
                                    <option value="" disabled selected>Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                                <label class="user-label">Gender</label>
                            </div>
                            <div class="col input-group-fname">
                                <input placeholder="Date" required="" type="text" name="text" autocomplete="off"
                                    class="input form-control" onfocus="(this.type='date')" onfocusin="showLabel()"
                                    id="dob-Value">
                                <label class="user-label ">Date of Birth</label>
                                <span class="dateIcon1 input-group-append">
                                    <span style=" position: relative; bottom: 31px; left: 300px;"><i
                                            class="fas fa-calendar-alt"></i></span>
                                </span>
                            </div>
                        </div>


                        <div class="p1">Adderss</div>



                        <div class="row d-flex">

                            <div class="col input-group-fname">
                                <input placeholder="Address Line 1" required="" type="text" name="text"
                                    autocomplete="off" class="input" id="address1-Value">
                                <label class="user-label">Address Line 1</label>
                            </div>
                            <div class="col input-group-fname">
                                <input placeholder="Address Line 2" required="" type="text" name="text"
                                    autocomplete="off" class="input" id="address2-Value">
                                <label class="user-label">Address Line 2</label>
                            </div>
                        </div>
                        <div class="row d-flex">

                            <div class="col input-group-fname">
                                <input placeholder="City/Town" required="" type="text" name="text" autocomplete="off"
                                    class="input" id="city-Value">
                                <label class="user-label">City/Town</label>
                            </div>
                            <div class="col input-group-fname">
                                <input placeholder="State" required="" type="text" name="text" autocomplete="off"
                                    class="input" id="state-Value">
                                <label class="user-label">State</label>
                            </div>
                        </div>
                        <div class="row d-flex">

                            <div class="col input-group-fname">
                                <input placeholder="Country" required="" type="text" name="text" autocomplete="off"
                                    class="input" id="country-Value">
                                <label class="user-label">Country</label>
                            </div>
                            <div class="col input-group-fname">
                                <input placeholder="Post Code" required="" type="text" name="text" autocomplete="off"
                                    class="input" id="post-Value">
                                <label class="user-label">Post Code</label>
                            </div>
                        </div>
                        <div class="p1">Uplode Image</div>

                        <input type="file" name="Uplode Photo" id="uplodePhoto" placeholder=" Darg and Drop">
                    </div>

                    <div class="btns-save-cancle">
                        <a id="myAnchor" href="#" class="btn btn-next btn-primary savenext">Save & Next</a>
                        <a id="myAnchor" href="dashboard.html" class="btn btn-outline-light cancle">Cancel</a>
                    </div>


                </div>

                <div class="form-step">
                    <div class="profile d-flex">
                        <div class="icon_wrap d-flex align-items-center" style="gap: .5rem;">
                            <img :src="apiPath + 'resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'" alt="profile_pic">
                            <span class="name">John Alex</span>
                        </div>
                    </div>

                    <div class="row d-flex">
                        <div class="col input-group-fname">
                            <select class="form-control input" id="Copyexistingdetails" autocomplete="off"
                                style="color: #7e7e7e;">
                                <option value="" disabled selected>Copy Existing details</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <label class="user-label">Copy Existing details</label>
                        </div>
                    </div>
                    <div class="row d-flex">
                        <div class="col input-group-fname">
                            <input placeholder="Employee ID" id="EmployeeID" required="" type="text" name="text"
                                autocomplete="off" class="input">
                            <label class="user-label">Employee ID</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col input-group-fname">
                            <input placeholder="Start Date" required="" type="text" name="text" autocomplete="off"
                                class="input form-control" onfocus="(this.type='date')" onfocusin="showLabel()">
                            <label class="user-label ">Start Date</label>
                            <span class="dateIcon1 input-group-append">
                                <span style=" position: relative; bottom: 31px; left: 300px;"><i
                                        class="fas fa-calendar-alt"></i></span>
                            </span>
                        </div>
                        <div class="col input-group-fname">
                            <input placeholder="Probation End Date" required="" type="text" name="text"
                                autocomplete="off" class="input form-control" onfocus="(this.type='date')"
                                onfocusin="showLabel()">
                            <label class="user-label ">Probation End Date</label>
                            <span class="dateIcon1 input-group-append">
                                <span style=" position: relative; bottom: 31px; left: 300px;"><i
                                        class="fas fa-calendar-alt"></i></span>
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col input-group-fname">
                            <select class="form-control input" id="gender" autocomplete="off" style="color: #7e7e7e;">
                                <option value="" disabled selected>Company</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <label class="user-label">Company</label>
                        </div>
                        <div class="col input-group-fname">
                            <select class="form-control input" id="gender" autocomplete="off" style="color: #7e7e7e;">
                                <option value="" disabled selected>Location</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <label class="user-label">Location</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col input-group-fname">
                            <select class="form-control input" id="gender" autocomplete="off" style="color: #7e7e7e;">
                                <option value="" disabled selected>Department</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <label class="user-label">Department</label>
                        </div>
                        <div class="col input-group-fname">
                            <select class="form-control input" id="gender" autocomplete="off" style="color: #7e7e7e;">
                                <option value="" disabled selected>Job Role</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <label class="user-label">Job Role</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col input-group-fname">
                            <select class="form-control input" id="gender" autocomplete="off" style="color: #7e7e7e;">
                                <option value="" disabled selected>Grade</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <label class="user-label">Grade</label>
                        </div>
                        <div class="col input-group-fname">
                            <select class="form-control input" id="gender" autocomplete="off" style="color: #7e7e7e;">
                                <option value="" disabled selected>Employment Type</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <label class="user-label">Employment Type</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col input-group-fname">
                            <input placeholder="Aadhar Number" required="" type="text" name="text" autocomplete="off"
                                class="input">
                            <label class="user-label">Aadhar Number</label>
                        </div>
                        <div class="col input-group-fname">
                            <input placeholder="PAN Number" required="" type="text" name="text" autocomplete="off"
                                class="input">
                            <label class="user-label">PAN Number</label>
                        </div>
                    </div>

                    <div class="btns-save-cancle">
                        <a id="myAnchor" href="#" class="btn btn-next btn-primary savenext">Save & Next</a>
                        <a id="myAnchor" href="dashboard.html" class="btn btn-outline-light cancle">Cancel</a>
                    </div>
                </div>



                <div class="form-step">
                    <div class="profile d-flex">
                        <div class="icon_wrap d-flex align-items-center" style="gap: .5rem;">
                            <img :src="apiPath + 'resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'" alt="profile_pic">
                            <span class="name">John Alex</span>
                        </div>
                    </div>

                    <div class="row d-flex">
                        <div class="col input-group-fname">
                            <select class="form-control input" id="HolidayYear" autocomplete="off"
                                style="color: #7e7e7e;">
                                <option value="" disabled selected>Holiday Year</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <label class="user-label">Holiday Year</label>
                        </div>
                    </div>
                    <div class="row d-flex">
                        <div class="col input-group-fname">
                            <select class="form-control input" id="WorkPattern" autocomplete="off"
                                style="color: #7e7e7e;">
                                <option value="" disabled selected>Work Pattern</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <label class="user-label">Work Pattern</label>
                        </div>
                    </div>
                    <div class="row d-flex">
                        <div class="col input-group-fname">
                            <input placeholder="Annual Earned Leave Entitlement" id="AnnualEarnedLeaveEntitlement"
                                required="" type="text" name="text" autocomplete="off" class="input">
                            <label class="user-label">Annual Earned Leave Entitlement</label>
                        </div>
                        <div class="container p2">If during probation no leaves are avaliable for employees,
                            then please set 0 as entitements below. You will able to set the entitlements later
                            on when marking the employee as confirmed</div>
                    </div>

                    <div class="row">
                        <div class="col input-group-fname">
                            <input placeholder="This Year" required="" type="text" name="text" autocomplete="off"
                                class="input">
                            <label class="user-label">This Year</label>
                        </div>
                        <div class="col input-group-fname">
                            <input placeholder="Next Year" required="" type="text" name="text" autocomplete="off"
                                class="input">
                            <label class="user-label">Next Year</label>
                        </div>
                    </div>
                    <div class="btns-save-cancle">
                        <a id="myAnchor" href="#" class="btn btn-next btn-primary savenext">Save & Next</a>
                        <a id="myAnchor" href="dashboard.html" class="btn btn-outline-light cancle">Cancel</a>
                    </div>
                </div>





                <div class="form-step">
                    <div class="profile1 d-flex">
                        <div class="icon_wrap d-flex align-items-center" style="gap: .5rem;">
                            <img :src="apiPath + 'resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'" alt="profile_pic">
                            <span class="name">John Alex</span>
                        </div>
                        <div class="d-flex">
                            <div class="showalltask-div">
                                <input type="checkbox" name="" id="">
                                <div class="p1">Show all tasks</div>
                            </div>

                        </div>
                    </div>

                    <div class="container p3">Basic information is completed and you are almost done. On this
                        screen you can update your task list for employee either by adding custom tasks or
                        selecting any visible task suggestions. </div>


                    <div class="container d-flex flex-column" style="gap: 1.1rem;">

                        <div class="row ">
                            <div class="col-sm-4">
                                <div class="card  card1">
                                    <div class="card-body">
                                        <div class="showalltask-card d-flex flex-column">
                                            <div class="d-flex" style="gap: .5rem;">
                                                <input type="checkbox" name="" id="">
                                                <div class="p4">Aadhar Card Number</div>
                                            </div>

                                            <a id="myAnchor" href="#" class="btn btn-primary removeTask">Remove Task</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card  card1">
                                    <div class="card-body">
                                        <div class="showalltask-card d-flex flex-column">
                                            <div class="d-flex" style="gap: .5rem;">
                                                <input type="checkbox" name="" id="">
                                                <div class="p4">Appointment letter</div>
                                            </div>
                                            <a id="myAnchor" href="#" class="btn btn-primary removeTask">Remove Task</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card  card1">
                                    <div class="card-body">
                                        <div class="showalltask-card d-flex flex-column">
                                            <div class="d-flex" style="gap: .5rem;">
                                                <input type="checkbox" name="" id="">
                                                <div class="p4">PF & ESIC information</div>
                                            </div>
                                            <a id="myAnchor" href="#" class="btn btn-primary removeTask">Remove Task</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-sm-4">
                                <div class="card  card1">
                                    <div class="card-body">
                                        <div class="showalltask-card d-flex flex-column">
                                            <div class="d-flex" style="gap: .5rem;">
                                                <input type="checkbox" name="" id="">
                                                <div class="p4">Confirmation letter</div>
                                            </div>

                                            <a id="myAnchor" href="#" class="btn btn-primary removeTask">Remove Task</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card  card2">
                                    <div class="card-body d-flex justify-content-center align-items-center">
                                        <div class="showalltask-card d-flex flex-column">
                                            <a id="myAnchor" href="#" class="btn btn-primary removeTask1">Add Task</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btns-save-cancle">
                        <a id="myAnchor" href="#" class="btn btn-next btn-primary savenext">Save & Next</a>
                        <a id="myAnchor" href="dashboard.html" class="btn btn-outline-light cancle">Cancel</a>
                    </div>
                </div>



                <div class="form-step">

                    <div class="container d-flex flex-column" style="gap: 2rem;">

                        <div class="d-flex justify-content-center align-items-center" style="gap: 1rem;">
                            <div class="done-task d-flex flex-column justify-content-center align-items-center"
                                style="gap: 1rem;">
                                <div class="d-flex align-items-center" style="gap: 1rem;"><i
                                        class="fa-solid fa-circle-check fa-xl" style="color: #1B8A5A;"></i>
                                    <div>Done! <span style="color: #2DB9F8;"> Austin Hodges</span> is successfully
                                        entered into the system.
                                    </div>
                                </div>
                                <div class="div-emp-rem"> What would you like to do next?</div>
                            </div>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center" style="gap: 2rem;">
                            <a id="myAnchor" href="dashboard.html" class="btn btn-primary removeTask">Finish and visit
                                employee's record</a>
                            <a id="myAnchor" href="../HTML/onBoard.html" class="btn btn-primary removeTask">Add another
                                employee</a>
                            <a id="myAnchor" href="../HTML/dashboard.html" class="btn btn-primary removeTask">Finish and
                                exit</a>
                        </div>

                    </div>


                </div>
            </form>

        </div>
    </div>
</template>

<script setup>

import { ref, onMounted } from 'vue';
import '@/assets/css/onBoard.css'

</script>