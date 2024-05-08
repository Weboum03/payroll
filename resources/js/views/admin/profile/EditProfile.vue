<template>
    <div id="dashboard-table" class="container">
                <div id="dashboard-table-info">
                    <span>Update</span>
                    <span>Employees > Profile > Update</span>
                </div>

                <div id="form-info" class="container">
                    <form action="#" class="form">
                        <div class="d-flex" style="gap: 1rem;">
                            <!-- <button type="button" class="close1 btn-prev" data-dismiss="modal" aria-label="Close"
                            style=" margin: 0px; padding: 0px; font-size: medium; color: black !important">
                            <span><i class="fa-solid fa-arrow-right fa-flip-horizontal fa-sm"
                                    style="color: #000000;"></i></span>
                        </button> -->
                            <div class=" d-flex flex-column">
                                <div class="Add-emp-div">Update Employee</div>
                                <div class="div-emp-rem"> Fill in the fields on each screen to create an employment record
                                    for a new stater.</div>
                            </div>
                        </div>
                        
                        <!-- Progress bar -->
                        <div class="progressbar container">
                            <div class="progress" id="progress"></div>

                            <div class="progress-step progress-step-active" data-title="Personal Information"></div>
                            <div class="progress-step" data-title="Job Information"></div>
                            <div class="progress-step" data-title="Attendance & Leaves"></div>
                            <div class="progress-step" data-title="Documents"></div>
                            <div class="progress-step" data-title="Done!"></div>
                        </div>

                        <!-- Steps -->
                        <div class="form-step form-step-active">
                            <div class="personal-infor">
                                <div class="row">
                                    <div class="col input-group-fname">
                                        <input placeholder="First Name*" type="text" value=""  autocomplete="off" class="input" id="fname-Value" required>
                                        <label class="user-label" >First Name*</label>
                                    </div>
                                    <div class="col input-group-fname">
                                        <input placeholder="Last Name*" required type="text" value=""  autocomplete="off" class="input" id="lname-Value">
                                        <label class="user-label">Last Name*</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col input-group-fname">
                                        <input placeholder="Email*" required type="email" value=""  autocomplete="off" class="input" id="email-Value">
                                        <label class="user-label">Email*</label>
                                    </div>
                                    <div class="col input-group-fname">
                                        <input placeholder="Secondary Email" type="email"  autocomplete="off" class="input1" id="email-Value">
                                        <label class="user-label1">Secondary Email</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col input-group-fname">
                                        <input placeholder="Mobile*" required type="tel" value=""  autocomplete="off" class="input" id="phone-Value">
                                        <label class="user-label">Mobile*</label>
                                    </div>
                                    <div class="col input-group-fname">
                                        <input placeholder="Alternate Mobile" type="tel"  autocomplete="off" class="input1" id="phone-Value">
                                        <label class="user-label1">Alternate Mobile</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col input-group-fname">
                                        <select class="form-control input" id="gender" autocomplete="off" style="color: #7e7e7e;" required>
                                            <option value="" >Gender*</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <label class="user-label">Gender*</label>
                                    </div>
                                    <div class="col input-group-fname">
                                        <input placeholder="Date of Birth*" type="text" value=""  autocomplete="off" class="input form-control" onfocus="(this.type='date')" onfocusin="showLabel()" id="dob-Value" required>
                                        <label class="user-label ">Date of Birth*</label>
                                            <span  class="dateIcon1" style=" position: relative; bottom: 31px; left: 300px;"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <!-- <div class="col input-group-fname">
                                        <input placeholder="Date of Birth*" type="date" autocomplete="off" class="input form-control" id="dob-Value" required>
                                        <label class="user-label ">Date of Birth*</label>
                                    </div> -->
                                </div>


                                <div class="p1  d-flex justify-content-between align-items-center">
                                    <p>Local Address</p>
                                    <p class="d-flex justify-content-between align-items-center" style="gap: 8rem;">Permanent Address
                                        <span class="d-flex" style="gap: 6px;"> <input type="checkbox" name="SameAsLocal" id="SameAsLocal">
                                            <label for="SameAsLocal">Same As Local</label></span>
                                   
                                    </p>
                                </div>



                                <div class="row d-flex">

                                    <div class="col input-group-fname">
                                        <input placeholder="Address Line 1*" required type="text" value=""  autocomplete="off" class="input" id="Laddress1-Value">
                                        <label class="user-label">Address Line 1*</label>
                                    </div>
                                    <div class="col input-group-fname">
                                        <input placeholder="Address Line 1*" required type="text"  autocomplete="off" class="input" id="Paddress1-Value">
                                        <label class="user-label">Address Line 1*</label>
                                    </div>
                                </div>

                                <div class="row d-flex">

                                    <div class="col input-group-fname">
                                        <input placeholder="Address Line 2"  type="text" value=""  autocomplete="off" class="input1" id="Laddress2-Value">
                                        <label class="user-label1">Address Line 2</label>
                                    </div>
                                    <div class="col input-group-fname">
                                        <input placeholder="Address Line 2" type="text"  autocomplete="off" class="input1" id="Paddress2-Value">
                                        <label class="user-label1">Address Line 2</label>
                                    </div>
                                </div>

                                <div class="row d-flex">

                                    <div class="col input-group-fname">
                                        <input placeholder="City/Town*" required type="text" value=""  autocomplete="off" class="input" id="Lcity-Value">
                                        <label class="user-label">City/Town*</label>
                                    </div>
                                    <div class="col input-group-fname">
                                        <input placeholder="City/Town*" required type="text" value=""  autocomplete="off" class="input" id="Pcity-Value">
                                        <label class="user-label">City/Town*</label>
                                    </div>
                                </div>

                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <input placeholder="Country*" required type="text" value=""  autocomplete="off" class="input" id="Lcountry-Value">
                                        <label class="user-label">Country*</label>
                                    </div>
                                    <div class="col input-group-fname">
                                        <input placeholder="Country*" required type="text" value=""  autocomplete="off" class="input" id="Pcountry-Value">
                                        <label class="user-label">Country*</label>
                                    </div>
                                  
                                </div>

                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <input placeholder="State*" required type="text" value=""  autocomplete="off" class="input" id="Lstate-Value">
                                        <label class="user-label">State*</label>
                                    </div>
                                    <div class="col input-group-fname">
                                        <input placeholder="State*" required type="text" value=""  autocomplete="off" class="input" id="Pstate-Value">
                                        <label class="user-label">State*</label>
                                    </div>
                                </div>
                              
                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <input placeholder="Post Code*" required type="number" value="" autocomplete="off" class="input" id="Lpost-Value">
                                        <label class="user-label">Post Code*</label>
                                    </div>
                                    <div class="col input-group-fname">
                                        <input placeholder="Post Code*" required type="number" value="" autocomplete="off" class="input" id="Ppost-Value">
                                        <label class="user-label">Post Code*</label>
                                    </div>
                                </div>
                                
                                <div class="p1">Uplode Image</div>

                                <input type="file" name="Uplode Photo" id="uplodePhoto" placeholder=" Darg and Drop">
                            </div>

                            <div class="btns-save-cancle">
                                <button class="btn btn-next btn-primary savenext">Save & Next</button>
                                <a href="../HTML/EmpProfile.html" class="btn btn-outline-light cancle">Cancel</a>
                            </div>


                        </div>

                        <div class="form-step">
                            <div class="profile d-flex">
                                <div class="icon_wrap d-flex align-items-center" style="gap: .5rem;">
                                    <img :src="apiPath + '/resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'"
                                        alt="profile_pic">
                                    <span class="name">John Alex</span>
                                </div>
                            </div>

                            <div class="row d-flex">
                                <div class="col input-group-fname">
                                    <select class="form-control input1" id="Copyexistingdetails" autocomplete="off" style="color: #7e7e7e;">
                                        <option value="">Copy Existing details</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <label class="user-label1">Copy Existing details</label>
                                </div>
                            </div>
                            <div class="row d-flex">
                                <div class="col input-group-fname">
                                    <input placeholder="Employee ID" id="EmployeeID" value="8456132" required type="number"  autocomplete="off" class="input">
                                    <label class="user-label">Employee ID</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col input-group-fname">
                                    <input placeholder="Start Date*" required type="text" value=""  autocomplete="off" class="input form-control" onfocus="(this.type='date')" onfocusin="showLabel()" id="strdate">
                                    <label class="user-label ">Date of Joining*</label>
                                   
                                        <span class="dateIcon1" style=" position: relative; bottom: 31px; left: 300px;"><i class="fas fa-calendar-alt"></i></span>
                            
                                </div>
                                <div class="col input-group-fname">
                                    <input placeholder="Probation End Date*" required type="text" value=""  autocomplete="off" class="input form-control" onfocus="(this.type='date')" onfocusin="showLabel()" id="prodate">
                                    <label class="user-label">Probation End Date*</label>
                                    <span class="dateIcon1" style="position: relative; bottom: 31px; left: 300px;"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <select class="form-control input" id="Company" autocomplete="off" style="color: #7e7e7e;" required>
                                        <option value="">Company*</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <label class="user-label">Company*</label>
                                </div>
                                <div class="col input-group-fname">
                                    <select class="form-control input1"  id="Location" autocomplete="off" style="color: #7e7e7e;">
                                        <option value="">Location</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <label class="user-label1">Location</label>
                                </div>
                            </div>

                            <div class="row d-flex">
                                <div class="col input-group-fname">
                                    <select class="form-control input" id="Qualification-Degree" autocomplete="off"
                                        style="color: #7e7e7e;" required>
                                        <option value="" >Qualification-Degree*</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <label class="user-label">Qualification-Degree*</label>
                                </div>
                                <div class="col input-group-fname">
                                    <select class="form-control input" id="WorkExp" autocomplete="off"
                                        style="color: #7e7e7e;" required>
                                        <option value="" >Work Experience*</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <label class="user-label">Work Experience*</label>
                                </div>
                            </div>
                            <div class="row d-flex">
                                <div class="col input-group-fname">
                                    <select class="form-control input" id="Immediate-Manager" autocomplete="off"
                                        style="color: #7e7e7e;" required>
                                        <option value="">Immediate-Manager*</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <label class="user-label">Immediate-Manager*</label>
                                </div>
                                <div class="col input-group-fname">
                                    <select class="form-control input" id="LeaveAppAutho" autocomplete="off"
                                        style="color: #7e7e7e;" required>
                                        <option value="">Leave Approving Authority*</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <label class="user-label">Leave Approving Authority*</label>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col input-group-fname">
                                    <select class="form-control input1" id="Department" autocomplete="off" style="color: #7e7e7e;">
                                        <option value="" >Department</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <label class="user-label1">Department</label>
                                </div>
                                <div class="col input-group-fname">
                                    <select class="form-control input1" id="Job-role" autocomplete="off" style="color: #7e7e7e;">
                                        <option value="">Job Role</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <label class="user-label1">Job Role</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col input-group-fname">
                                    <select class="form-control input" id="Grade" required autocomplete="off" style="color: #7e7e7e;">
                                        <option value="">Grade*</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <label class="user-label">Grade*</label>
                                </div>
                                <div class="col input-group-fname">
                                    <select class="form-control input1" id="Emp-Type" autocomplete="off"
                                        style="color: #7e7e7e;">
                                        <option value="">Employment Type</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <label class="user-label1">Employment Type</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <input placeholder="Aadhar Number*" required type="number"  autocomplete="off" class="input" id="Aadhar-Num">
                                    <label class="user-label">Aadhar Number*</label>
                                </div>
                                <div class="col input-group-fname">
                                    <input placeholder="PAN Number*" required type="text"  autocomplete="off" class="input" id="Pan-num">
                                    <label class="user-label">PAN Number*</label>
                                </div>
                            </div>

                            <div class="btns-save-cancle">
                                <button type="button" class="btn btn-next btn-primary savenext">Save & Next</button>
                                <button type="button" class="btn btn-outline-light btn-prev cancle">Back</button>
                            </div>
                        </div>



                        <div class="form-step">
                            <div class="profile d-flex">
                                <div class="icon_wrap d-flex align-items-center" style="gap: .5rem;">
                                    <img :src="apiPath + '/resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'"
                                        alt="profile_pic">
                                    <span class="name">John Alex</span>
                                </div>
                            </div>

                            <div class="row d-flex">
                                <div class="col input-group-fname">
                                    <select class="form-control input" id="HolidayYear" autocomplete="off"
                                        style="color: #7e7e7e;" required>
                                        <option value="" disabled selected>Holiday Year*</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <label class="user-label">Holiday Year*</label>
                                </div>
                            </div>
                            <div class="row d-flex">
                                <div class="col input-group-fname">
                                    <select class="form-control input" id="WorkPattern" autocomplete="off"
                                        style="color: #7e7e7e;" required>
                                        <option value="" disabled selected>Work Pattern*</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <label class="user-label">Work Pattern*</label>
                                </div>
                            </div>
                            <div class="row d-flex">
                                <div class="col input-group-fname">
                                    <input placeholder="Annual Earned Leave Entitlement*"
                                        id="AnnualEarnedLeaveEntitlement" required type="text" 
                                        autocomplete="off" class="input">
                                    <label class="user-label">Annual Earned Leave Entitlement*</label>
                                </div>
                                <div class="container p2">If during probation no leaves are avaliable for employees,
                                    then please set 0 as entitements below. You will able to set the entitlements later
                                    on when marking the employee as confirmed</div>
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <input placeholder="This Year*" required type="text" 
                                        autocomplete="off" class="input">
                                    <label class="user-label">This Year*</label>
                                </div>
                                <div class="col input-group-fname">
                                    <input placeholder="Next Year*" required type="text" 
                                        autocomplete="off" class="input">
                                    <label class="user-label">Next Year*</label>
                                </div>
                            </div>
                            <div class="btns-save-cancle">
                                <button type="button" class="btn btn-next btn-primary savenext">Save & Next</button>
                                <button type="button" class="btn btn-outline-light btn-prev cancle">Back</button>
                            </div>
                        </div>





                        <div class="form-step">
                            <div class="profile1 d-flex">
                                <div class="icon_wrap d-flex align-items-center" style="gap: .5rem;">
                                    <img :src="apiPath + '/resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'"
                                        alt="profile_pic">
                                    <span class="name">John Alex</span>
                                </div>
                                <div class="d-flex">
                                    <div class="showalltask-div">
                                        <input type="checkbox"  id="">
                                        <div class="p1">Show all tasks</div>
                                    </div>

                                </div>
                            </div>

                            <div class="container p3">Basic information is completed and you are almost done. On this
                                screen you can update your task list for employee either by adding custom tasks or
                                selecting any visible task suggestions. </div>


                            <div class="container doc-container d-flex flex-column" style="gap: 1.1rem;">

                                <div class="row ">
                                    <div class="col-sm-4" >
                                        <div class="card  card1">
                                            <div class="card-body">
                                                <div class="showalltask-card d-flex flex-column">
                                                    <div class="d-flex" style="gap: .5rem;">
                                                        <input type="checkbox"  id="">
                                                        <div class="p4">Aadhar Card Number</div>
                                                    </div>

                                                    <button href="#" class="btn btn-primary updoc">Upload Document</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="card  card1">
                                            <div class="card-body">
                                                <div class="showalltask-card d-flex flex-column">
                                                    <div class="d-flex" style="gap: .5rem;">
                                                        <input type="checkbox"  id="">
                                                        <div class="p4">PAN Card</div>
                                                    </div>
                                                    <button class="btn btn-primary updoc">Upload Document</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="card  card1">
                                            <div class="card-body">
                                                <div class="showalltask-card d-flex flex-column">
                                                    <div class="d-flex" style="gap: .5rem;">
                                                        <input type="checkbox"  id="">
                                                        <div class="p4">PF & ESIC information</div>
                                                    </div>

                                                    <div class="d-flex justify-content-center align-items-center" style="gap: 24px;">
                                                        <button  class="btn btn-primary updoc">Upload Document</button>
                                                        <div class="removeTask"><i class="fa-solid fa-square-minus fa-lg " style="color: #ffffff;"></i></div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4" >
                                        <div class="card  card1">
                                            <div class="card-body">
                                                <div class="showalltask-card d-flex flex-column">
                                                    <div class="d-flex" style="gap: .5rem;">
                                                        <input type="checkbox"  id="">
                                                        <div class="p4">Confirmation letter</div>
                                                    </div>

                                                    <div class="d-flex justify-content-center align-items-center"  style="gap: 24px;">
                                                        <button  class="btn btn-primary updoc">Upload Document</button>
                                                        <div class="removeTask"><i class="fa-solid fa-square-minus fa-lg " style="color: #ffffff;"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4" >
                                        <div class="card  card1">
                                            <div class="card-body">
                                                <div class="showalltask-card d-flex flex-column">
                                                    <div class="d-flex" style="gap: .5rem;">
                                                        <input type="checkbox"  id="">
                                                        <div class="p4">Education Document</div>
                                                    </div>

                                                    <div class="d-flex justify-content-center align-items-center"  style="gap: 24px;">
                                                        <button  class="btn btn-primary updoc">Upload Document</button>
                                                        <div class="removeTask"><i class="fa-solid fa-square-minus fa-lg " style="color: #ffffff;"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4" >
                                        <div class="card  card1">
                                            <div class="card-body">
                                                <div class="showalltask-card d-flex flex-column">
                                                    <div class="d-flex" style="gap: .5rem;">
                                                        <input type="checkbox"  id="">
                                                        <div class="p4">Experience Letter</div>
                                                    </div>

                                                    <div class="d-flex justify-content-center align-items-center"  style="gap: 24px;">
                                                        <button  class="btn btn-primary updoc">Upload Document</button>
                                                        <div class="removeTask"><i class="fa-solid fa-square-minus fa-lg " style="color: #ffffff;"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="card  card2">
                                            <div class="card-body d-flex justify-content-center align-items-center">
                                                <div class="showalltask-card d-flex flex-column">
                                                    <button type="button" class="btn btn-primary updoc" data-toggle="modal" data-target="#AddDocModal">Add Document</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="btns-save-cancle">
                                <button type="button" class="btn btn-next btn-primary savenext">Save & Next</button>
                                <button type="button" class="btn btn-outline-light btn-prev cancle">Back</button>
                            </div>
                        </div>



                        <div class="form-step">

                            <div class="container d-flex flex-column" style="gap: 2rem;">

                                <div class="d-flex justify-content-center align-items-center" style="gap: 1rem;">
                                    <div class="done-task d-flex flex-column justify-content-center align-items-center" style="gap: 8px;">
                                        <div class="d-flex align-items-center" style="gap:9px;"><i class="fa-solid fa-circle-check fa-xl" style="color: #1B8A5A;"></i>
                                            <div style="font-size: 13px;font-weight: 500">Done! <span style="color: #2DB9F8;"> Austin Hodges</span> is successfully entered into the system. </div>
                                        </div>
                                        <!-- <div style="font-size: 13px;font-weight: 500">Unique employee ID <span style="color: #2DB9F8;">8456135</span> is generated.</div> -->
                                    <div class="div-emp-rem"> What would you like to do next?</div>
                                </div>
                                </div>
                                <div class="d-flex flex-column justify-content-center align-items-center" style="gap: 1rem;">
                                    <a  href="../HTML/dashboard.html" class="btn btn-primary btn1">Finish and visit employee's record</a>
                                    <a  href="../HTML/EmpProfile.html" class="btn btn-primary btn1 ">Finish and visit employee's profile</a>
                                    <!-- <a  href="../HTML/dashboard.html" class="btn btn-primary btn1">Finish and exit</a> -->
                                </div>

                            </div>


                        </div>
                    </form>

                </div>
            </div>
</template>

<style scoped>
@import '@/assets/css/onboard.css';

</style>