<template>
    <!-- -----nav-dashboard-table start----- -->


    <div id="dashboard-table" class="container-fluid">
        <div id="dashboard-table-info">
            <span>De-board</span>
            <span>Employees > De-board</span>
        </div>

        <div id="form-info" class="container" style="margin-bottom: 2rem;">
            <form action="#" class="form">
                <div class=" d-flex flex-column">
                    <div class="Add-emp-div">De-board Employee</div>
                    <div class="div-emp-rem">Follow these steps to update the system when an employee leaves (or is
                        preparing to leave) employment with the company. </div>
                </div>
                <!-- Progress bar -->
                <div class="progressbar container">
                    <div class="progress" id="progress"></div>

                    <div class="progress-step progress-step-active" data-title="Personal Details"></div>
                    <div class="progress-step" data-title="Employment"></div>
                    <div class="progress-step" data-title="Entitlement"></div>
                    <div class="progress-step" data-title="Tasks"></div>
                    <div class="progress-step" data-title="Complete"></div>
                </div>

                <!-- Steps -->
                <div class="form-step form-step-active">
                    <div class="personal-infor">

                        <div class="row">
                            <div class="col input-group-fname">
                                <select class="form-control input" id="reasonForLeaving" autocomplete="off"
                                    style="color: #7e7e7e;height: 38px;">
                                    <option value="" disabled selected>Reason for leaving</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                                <label class="user-label">Reason for leaving</label>
                            </div>

                            <div class="col input-group-fname">
                                <select class="form-control input" id="noticePeriod" autocomplete="off"
                                    style="color: #7e7e7e;height: 38px;">
                                    <option value="" disabled selected>Notice Period</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                                <label class="user-label">Notice Period</label>
                            </div>
                        </div>
                        <div class="row d-flex">
                            <div class="col input-group-fname">
                                <!-- <textarea name="" id="" cols="30" rows="10"></textarea> -->
                                <textarea placeholder="Additional Comments" required="" type="text" name="text"
                                    autocomplete="off" class="input" id="additionalComment"></textarea>
                                <label class="user-label">Additional Comments</label>
                            </div>
                        </div>
                        <div class="row justify-content-start align-items-start">
                            <div class="col input-group-fname">
                                <input placeholder="Start Date" required="" type="text" name="text" autocomplete="off"
                                    class="input form-control" id="startDate" onfocus="(this.type='date')">
                                <label class="user-label ">Start Date</label>
                                <span class="dateIcon" class="input-group-append">
                                    <span style=" position: relative; bottom: 31px; left: 300px;"><i
                                            class="fas fa-calendar-alt"></i></span>
                                </span>
                            </div>

                            <div class="col input-group-fname">
                                <label class="custom-checkbox d-flex justify-content-center align-items-center"
                                    style="gap: .5rem;">
                                    <span class="checkmark"></span>
                                    <input name="dummy" type="checkbox"> Make a Leaver Immediately?
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col input-group-fname ">
                                <input placeholder="Final Employment Date" required="" type="text" name="text"
                                    autocomplete="off" class="input form-control" id="finalEmploymentDate"
                                    onfocus="(this.type='date')">
                                <label class="user-label ">Final Employment Date</label>
                                <span class="dateIcon1" class="input-group-append">
                                    <span style=" position: relative; bottom: 31px; left: 300px;"><i
                                            class="fas fa-calendar-alt"></i></span>
                                </span>
                            </div>
                            <div class="col input-group-fname">
                                <input placeholder="Final Working Date" required="" type="text" name="text"
                                    autocomplete="off" class="input form-control" id="finalWorkingDate"
                                    onfocus="(this.type='date')">
                                <label class="user-label ">Final Working Date</label>
                                <span class="dateIcon2" class="input-group-append">
                                    <span style=" position: relative; bottom: 31px; left: 300px;"><i
                                            class="fas fa-calendar-alt"></i></span>
                                </span>
                            </div>
                        </div>
                        <div class="btns-save-cancle" style="margin-top: -9px;">
                            <a id="myAnchor" href="#" class="btn btn-next btn-primary savenext">Save & Next</a>
                            <a id="myAnchor" href="EmpProfile.html" class="btn btn-outline-light cancle">Cancel</a>
                        </div>
                    </div>
                </div>

                <div class="form-step" style="padding: 20px; gap: 1.5rem;">
                    <div class="profile d-flex">
                        <div class="icon_wrap d-flex align-items-center" style="gap: .5rem;">
                            <img :src="apiPath + 'resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'" alt="profile_pic">
                            <span class="name">John Alex</span>
                        </div>
                    </div>

                    <div class="row d-flex">
                        <div class="col input-group-fname">
                            <select class="form-control input" id="reAssignReports" autocomplete="off"
                                style="color: #7e7e7e;">
                                <option value="" disabled selected>Re-Assign Direct Reports to</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <label class="user-label">Re-Assign Direct Reports to</label>
                        </div>
                    </div>
                    <div class="row d-flex">
                        <div class="col input-group-fname">
                            <!-- <textarea name="" id="" cols="30" rows="10"></textarea> -->
                            <textarea placeholder="Supporting Comments" required="" type="text" name="text"
                                autocomplete="off" class="input" id="supportingComments"></textarea>
                            <label class="user-label">Supporting Comments</label>
                        </div>
                    </div>


                    <div style=" font-size: x-small; font-weight: 500;">Re-employable</div>
                    <div class="d-flex align-items-center" style="gap: 1rem;margin-top: -15px;">
                        <div class="d-flex" style="gap: .5rem;">
                            <input type="radio" name="Yes" id="radioYes" style="width: 13px;">
                            <label for="radioYes"
                                style="font-size: 14px;font-weight: 500;margin-top: 3px;margin-bottom: 0px;">Yes</label>
                        </div>
                        <div class="d-flex" style="gap: .5rem;">
                            <input type="radio" name="No" id="radioYes" style="width: 13px;">
                            <label for="radioYes"
                                style="font-size: 14px;font-weight: 500;margin-top: 1px;margin-bottom: 0px;">No</label>
                        </div>
                    </div>

                    <div class="btns-save-cancle">
                        <a id="myAnchor" href="#" class="btn btn-next btn-primary savenext">Save & Next</a>
                        <a id="myAnchor" href="EmpProfile.html" class="btn btn-outline-light cancle">Cancel</a>
                    </div>
                </div>



                <div class="form-step" style="gap: 2rem;padding: 15px;">
                    <div class="profile d-flex">
                        <div class="icon_wrap d-flex align-items-center" style="gap: .5rem;">
                            <img :src="apiPath + 'resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'" alt="profile_pic">
                            <span class="name">John Alex</span>
                        </div>
                    </div>
                    <div class="row d-flex">
                        <div class="col input-group-fname">
                            <input placeholder="Remaining Earned Leaves This Year" id="remainingLeaves" required=""
                                type="text" name="text" autocomplete="off" class="input">
                            <label class="user-label">Remaining Earned Leaves This Year</label>
                        </div>
                    </div>
                    <div class="row d-flex">
                        <div class="col input-group-fname">
                            <input placeholder="Remaining Earned Leaves (Pro-Rata based on leaving date)"
                                id="proRataLeavingDate" required="" type="text" name="text" autocomplete="off"
                                class="input">
                            <label class="user-label">Remaining Earned Leaves (Pro-Rata based on leaving date)</label>
                        </div>
                    </div>
                    <div class="btns-save-cancle">
                        <a id="myAnchor" href="#" class="btn btn-next btn-primary savenext">Save & Next</a>
                        <a id="myAnchor" href="EmpProfile.html" class="btn btn-outline-light cancle">Cancel</a>
                    </div>
                </div>





                <div class="form-step" style="gap: 2rem;">
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

                    <div class="container p3">Basic information is completed, and you are almost done. Below are
                        suggestion you may with to your task list. Simply select the tasks you'd like to add, or create
                        your own. </div>


                    <div class="container d-flex flex-column" style="gap: 1.1rem;">

                        <div class="row ">
                            <div class="col-sm-4">
                                <div class="card  card1">
                                    <div class="card-body">
                                        <div class="showalltask-card d-flex flex-column">
                                            <div class="d-flex" style="gap: .5rem;">
                                                <input type="checkbox" name="" id="">
                                                <div class="p4">Equipment</div>
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
                                                <div class="p4">Exit Interview</div>
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
                                                <div class="p4">Internal Update</div>
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
                                                <div class="p4">Relieving letter</div>
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
                    <div class="btns-save-cancle" style="margin-left: 16px;">
                        <a id="myAnchor" href="#" class="btn btn-next btn-primary savenext">Save & Next</a>
                        <a id="myAnchor" href="EmpProfile.html" class="btn btn-outline-light cancle">Cancel</a>
                    </div>
                </div>



                <div class="form-step">

                    <div class="container d-flex flex-column" style="gap: 2rem;">

                        <div class="d-flex justify-content-center align-items-center" style="gap: 1rem;">
                            <div class="done-task d-flex flex-column justify-content-center align-items-center"
                                style="gap: 1rem;">
                                <div class="d-flex align-items-center" style="gap: 1rem;"><i
                                        class="fa-solid fa-circle-check fa-xl" style="color: #1B8A5A;"></i>
                                    <div style="font-size: 14px;font-weight: 600;">Done! <span
                                            style="color: #2DB9F8;font-weight: bold;font-size: 13px;"> Austin
                                            Hodges</span> is successfully entered into the system.
                                    </div>
                                </div>
                                <div class="div-emp-rem"> What would you like to do next?</div>
                            </div>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center" style="gap: 1rem;">
                            <a id="myAnchor" href="#" class="btn btn-primary removeTask">Finish and visit employee's
                                record</a>
                            <a id="myAnchor" href="/admin/onBoard" class="btn btn-primary removeTask">Add another
                                employee</a>
                            <a id="myAnchor" href="/admin/dashboard" class="btn btn-primary removeTask">Finish and
                                exit</a>
                        </div>

                    </div>


                </div>
            </form>

        </div>
    </div>
</template>