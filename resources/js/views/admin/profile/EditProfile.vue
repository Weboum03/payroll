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
                    <div class="progress" :style="{ width: boxWidth + '%' }"></div>

                    <div class="progress-step progress-step-active" data-title="Personal Information"></div>
                    <div class="progress-step" :class="{ 'progress-step-active': currentStep >= 1 }"
                        data-title="Job Information"></div>
                    <div class="progress-step" :class="{ 'progress-step-active': currentStep >= 2 }"
                        data-title="Attendance & Leaves"></div>
                    <div class="progress-step" :class="{ 'progress-step-active': currentStep >= 3 }" data-title="Tasks">
                    </div>
                    <div class="progress-step" :class="{ 'progress-step-active': currentStep >= 4 }" data-title="Done">
                    </div>
                </div>

                <Form v-if="postData" @submit="nextStep" keep-values :validation-schema="currentSchema"
                    v-slot="{ errors, meta, isSubmitting }">


                    <template v-if="currentStep === 0">
                        <!-- Steps -->
                        <div class="form-step form-step-active">
                            <div class="personal-infor">
                                <div class="row">
                                    <div class="col input-group-fname">
                                        <Field type="text" name="first_name"
                                            :class="{ 'is-invalid': errors.first_name }" placeholder="First Name"
                                            class="input" v-model="userData.first_name" autocomplete="off" required />
                                        <label for="First Name" class="user-label">First Name</label>
                                        <ErrorMessage name="first_name" class="text-danger mt-1" />
                                    </div>
                                    <div class="col input-group-fname">
                                        <Field type="text" name="last_name" :class="{ 'is-invalid': errors.last_name }"
                                            placeholder="First Name" class="input" v-model="userData.last_name"
                                            autocomplete="off" required />
                                        <label for="Last Name" class="user-label">Last Name*</label>
                                        <ErrorMessage name="last_name" class="text-danger mt-1" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col input-group-fname">
                                        <Field type="text" name="email" class="input"
                                            :class="{ 'is-invalid': errors.email }" placeholder="Email"
                                            v-model="userData.email" autocomplete="off" required />
                                        <label for="Email" class="user-label">Email</label>
                                        <ErrorMessage name="email" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field type="text" name="secondary_email" v-model="userData.secondary_email"
                                            class="input" autocomplete="off"
                                            :class="{ 'is-invalid': errors.secondary_email }"
                                            placeholder="Secondary Email" required />
                                        <label for="Secondary Email" class="user-label">Secondary Email</label>
                                        <ErrorMessage name="secondary_email" class="text-danger mt-1" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col input-group-fname">
                                        <Field type="text" name="phone" class="input"
                                            :class="{ 'is-invalid': errors.phone }" v-model="userData.phone"
                                            autocomplete="off" placeholder="Mobile" required />
                                        <label for="Mobile" class="user-label">Mobile</label>
                                        <ErrorMessage name="phone" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field type="text" name="alternate_phone"
                                            :class="{ 'is-invalid': errors.alternate_phone }"
                                            v-model="userData.alternate_phone" class="input" autocomplete="off"
                                            placeholder="Alternate Mobile" required />
                                        <label for="Alternate Mobile" class="user-label">Alternate Mobile</label>
                                        <ErrorMessage name="alternate_phone" class="text-danger mt-1" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col input-group-fname">
                                        <Field name="gender" as="select" class="form-control input"
                                            :class="{ 'is-invalid': errors.gender }" v-model="userData.gender"
                                            autocomplete="off" style="color: #7e7e7e;" required>
                                            <option value="" disabled selected>Select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </Field>
                                        <label for="gender" class="user-label">Gender</label>
                                        <ErrorMessage name="gender" class="text-danger mt-1" />

                                    </div>
                                    <div class="col input-group-fname">
                                        <Field type="date" name="dob" class="input"
                                            v-model="userData.dob" autocomplete="off" placeholder="Date of Birth*"
                                            :class="{ 'is-invalid': errors.dob }" required />
                                        <label for="html" class="user-label ">Date of Birth</label>
                                        <ErrorMessage name="dob" class="text-danger mt-1" />
                                    </div>
                                </div>


                                <div class="p1  d-flex justify-content-start align-items-center" style="gap: 22rem;">
                                    <p>Local Address</p>
                                    <p class="d-flex justify-content-between align-items-center" style="gap: 8rem;">
                                        Permanent Address
                                        <span class="d-flex" style="gap: 6px;"> <Field name="as_local" v-model="sameAsLocal" :value="sameAsLocal" type="checkbox" />
                                            <label for="SameAsLocal">Same As Local {{ sameAsLocal }}</label></span>
                                    </p>
                                </div>



                                <div class="row d-flex">

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="address" class="input"
                                            v-model="userData.address" autocomplete="off" placeholder="Address Line 1*" required />
                                        <label for="Address" class="user-label">Address Line 1</label>
                                        <ErrorMessage name="address" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="p_address"
                                            v-model="userData.p_address" class="input" autocomplete="off" placeholder="Address Line 1*" required :disabled="sameAsLocal" />
                                        <label for="Address" class="user-label">Address Line 1</label>
                                        <ErrorMessage name="p_address" class="text-danger mt-1" />
                                    </div>


                                </div>

                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="address_1"
                                            v-model="userData.address_1" class="input" autocomplete="off" placeholder="Address Line 2*" required />
                                        <label for="Address" class="user-label">Address Line 2</label>
                                        <ErrorMessage name="address_1" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="p_address_1"
                                            v-model="userData.p_address_1" class="input" autocomplete="off" placeholder="Address Line 2*" required :disabled="sameAsLocal" />
                                        <label for="Address" class="user-label">Address Line 2</label>
                                        <ErrorMessage name="p_address_1" class="text-danger mt-1" />
                                    </div>
                                </div>



                                <div class="row d-flex">

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="city" class="input"
                                            v-model="userData.city" autocomplete="off" placeholder="City/Town*" required />
                                        <label for="City" class="user-label">City/Town*</label>
                                        <ErrorMessage name="city" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="p_city" class="input"
                                            v-model="userData.p_city" autocomplete="off" placeholder="City/Town*" required :disabled="sameAsLocal" />
                                        <label for="City" class="user-label">City/Town*</label>
                                        <ErrorMessage name="p_city" class="text-danger mt-1" />
                                    </div>

                                </div>

                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="country" class="input"
                                            v-model="userData.country" autocomplete="off" placeholder="Country*" required />
                                        <label for="Country" class="user-label">Country*</label>
                                        <ErrorMessage name="country" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="p_country"
                                            v-model="userData.p_country" class="input" autocomplete="off" placeholder="Country*" required :disabled="sameAsLocal" />
                                        <label for="Country" class="user-label">Country*</label>
                                        <ErrorMessage name="p_country" class="text-danger mt-1" />
                                    </div>
                                </div>

                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="state" class="input"
                                            v-model="userData.state" autocomplete="off" placeholder="State*" required />
                                        <label for="State" class="user-label">State*</label>
                                        <ErrorMessage name="state" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="p_state" class="input"
                                            v-model="userData.p_state" autocomplete="off" placeholder="State*" required :disabled="sameAsLocal" />
                                        <label for="State" class="user-label">State*</label>
                                        <ErrorMessage name="p_state" class="text-danger mt-1" />
                                    </div>

                                </div>

                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="number" name="postcode"
                                            v-model="userData.postcode" class="input" autocomplete="off" placeholder="Post Code*" required />
                                        <label for="Post Code" class="user-label">Post Code*</label>
                                        <ErrorMessage name="postcode" class="text-danger mt-1" />
                                    </div>
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="number" name="p_postcode"
                                            v-model="userData.p_postcode" class="input" autocomplete="off" placeholder="Post Code*" required :disabled="sameAsLocal" />
                                        <label for="Post Code" class="user-label">Post Code*</label>
                                        <ErrorMessage name="p_postcode" class="text-danger mt-1" />
                                    </div>
                                </div>

                                <div class="p1">Upload Image</div>

                                <input type="file" name="Uplode Photo" id="uplodePhoto" placeholder=" Darg and Drop">
                            </div>
                        </div>
                    </template>

                    <template v-if="currentStep === 1">
                        <div class="form-step form-step-active">
                            <div class="profile d-flex">
                                <div class="icon_wrap d-flex align-items-center" style="gap: .5rem;">
                                    <img :src="apiPath + '/resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'"
                                        alt="profile_pic">
                                    <span class="name">John Alex</span>
                                </div>
                            </div>

                            <div class="row d-flex">
                                <div class="col input-group-fname">
                                    <Field required name="user" as="select" v-model="userData.first_name"
                                        class="form-control input" autocomplete="off" :validateOnBlur="false"
                                        :validateOnChange="false" :validateOnInput="false" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Copy Existing details</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="details" class="user-label">Copy Existing details</label>
                                    <ErrorMessage name="user" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row d-flex">
                                <div class="col input-group-fname">
                                    <Field required type="text" name="employee_id" placeholder="Employee ID"
                                        v-model="userData.employee_id" :class="{ 'is-invalid': errors.employee_id }"
                                        class="input" autocomplete="off"  />
                                    <label for="Employee ID" class="user-label">Employee ID</label>
                                    <ErrorMessage name="employee_id" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required type="date" name="doj" placeholder="Date of Joining*"
                                        v-model="userData.doj" :class="{ 'is-invalid': errors.doj }" class="input"
                                        autocomplete="off" />
                                    <label for="Start Date" class="user-label ">Date of Joining*</label>
                                    <ErrorMessage name="doj" class="text-danger mt-1" />
                                </div>
                                <div class="col input-group-fname">
                                    <Field required type="date" name="prob_end_date" placeholder="Probation End Date*"
                                        v-model="userData.prob_end_date" :class="{ 'is-invalid': errors.prob_end_date }"
                                        class="input" autocomplete="off" />
                                    <label for="Probation End Date" class="user-label ">Probation End Date*</label>
                                    <ErrorMessage name="prob_end_date" class="text-danger mt-1" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required name="company" as="select" class="form-control input"
                                        autocomplete="off" v-model="userData.company" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Company*</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="Company" class="user-label">Company*</label>
                                    <ErrorMessage name="company" class="text-danger mt-1" />
                                </div>

                                <div class="col input-group-fname">
                                    <Field required name="location" as="select" class="form-control input"
                                        autocomplete="off" v-model="userData.location" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Location*</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="location" class="user-label">Location*</label>
                                    <ErrorMessage name="location" class="text-danger mt-1" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required name="qualification" as="select" class="form-control input"
                                        v-model="userData.qualification" autocomplete="off" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Qualification-Degree*</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="qualification" class="user-label">Qualification-Degree*</label>
                                    <ErrorMessage name="qualification" class="text-danger mt-1" />
                                </div>

                                <div class="col input-group-fname">
                                    <Field required name="experience" as="select" class="form-control input"
                                        autocomplete="off" v-model="userData.experience" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Work Experience*</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="experience" class="user-label">Work Experience*</label>
                                    <ErrorMessage name="experience" class="text-danger mt-1" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required name="immediate_manager" as="select" class="form-control input"
                                        v-model="userData.immediate_manager" autocomplete="off" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Immediate-Manager*</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="immediate_manager" class="user-label">Immediate-Manager*</label>
                                    <ErrorMessage name="immediate_manager" class="text-danger mt-1" />
                                </div>

                                <div class="col input-group-fname">
                                    <Field required type="date" name="immediate_manager_code"
                                        placeholder="Employee Code" v-model="userData.immediate_manager_code"
                                        :class="{ 'is-invalid': errors.immediate_manager_code }" class="input"
                                        autocomplete="off" />
                                    <label for="Probation End Date" class="user-label ">Employee Code</label>
                                    <ErrorMessage name="immediate_manager_code" class="text-danger mt-1" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required name="leave_approving_auth" as="select" class="form-control input"
                                        v-model="userData.leave_approving_auth" autocomplete="off"
                                        style="color: #7e7e7e;">
                                        <option value="" disabled selected>Leave Approving Authority*</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="leave_approving_auth" class="user-label">Leave Approving
                                        Authority*</label>
                                    <ErrorMessage name="leave_approving_auth" class="text-danger mt-1" />
                                </div>

                                <div class="col input-group-fname">
                                    <Field required type="date" name="leave_approving_code" placeholder="Employee Code"
                                        v-model="userData.leave_approving_code"
                                        :class="{ 'is-invalid': errors.leave_approving_code }" class="input"
                                        autocomplete="off" />
                                    <label for="Probation End Date" class="user-label ">Employee Code</label>
                                    <ErrorMessage name="leave_approving_code" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required name="department" as="select" class="form-control input"
                                        autocomplete="off" v-model="userData.department" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Department</option>
                                        <option value="">Department</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="Department" class="user-label">Department</label>
                                    <ErrorMessage name="department" class="text-danger mt-1" />
                                </div>
                                <div class="col input-group-fname">
                                    <Field required name="role_id" as="select" class="form-control input"
                                        autocomplete="off" v-model="userData.role_id" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Job Role</option>
                                        <option v-for="role in roles?.data" :key="role.id" :value="role.id">
                                            {{ role.name }}
                                        </option>
                                    </Field>
                                    <label for="html" class="user-label">Job Role</label>
                                    <ErrorMessage name="Job Role" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required name="grade" as="select" class="form-control input"
                                        autocomplete="off" v-model="userData.grade" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Grade*</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="Grade" class="user-label">Grade*</label>
                                    <ErrorMessage name="grade" class="text-danger mt-1" />
                                </div>
                                <div class="col input-group-fname">
                                    <Field required name="employment_type" as="select" class="form-control input"
                                        v-model="userData.employment_type" autocomplete="off" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Employment Type</option>
                                        <option value="A">Employment Type A</option>
                                        <option value="B">Employment Type B</option>
                                        <option value="C">Employment Type C</option>
                                    </Field>
                                    <label for="Employment Type" class="user-label">Employment Type</label>
                                    <ErrorMessage name="employment_type" class="text-danger mt-1" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required type="text" name="aadhar_number" placeholder="Aadhar Number*"
                                        v-model="userData.aadhar_number" :class="{ 'is-invalid': errors.aadhar_number }"
                                        class="input" autocomplete="off" />
                                    <label for="Aadhar Number" class="user-label">Aadhar Number*</label>
                                    <ErrorMessage name="aadhar_number" class="text-danger mt-1" />
                                </div>
                                <div class="col input-group-fname">
                                    <Field type="text" name="pan_number" placeholder="PAN Number*"
                                        v-model="userData.pan_number" :class="{ 'is-invalid': errors.pan_number }"
                                        class="input" autocomplete="off" required />
                                    <label for="PAN Number" class="user-label">PAN Number*</label>
                                    <ErrorMessage name="pan_number" class="text-danger mt-1" />
                                </div>
                            </div>
                        </div>
                    </template>


                    <template v-if="currentStep === 2">
                        <div class="form-step form-step-active">
                            <div class="profile d-flex">
                                <div class="icon_wrap d-flex align-items-center" style="gap: .5rem;">
                                    <img :src="apiPath + '/resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'"
                                        alt="profile_pic">
                                    <span class="name">John Alex</span>
                                </div>
                            </div>


                            <div class="row d-flex">

                                <div class="col input-group-fname">
                                    <Field required name="holiday_year" as="select" class="form-control input"
                                        autocomplete="off" v-model="userData.holiday_year" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Holiday Year*</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="Holiday Year" class="user-label">Holiday Year*</label>
                                    <ErrorMessage name="holiday_year" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row d-flex">

                                <div class="col input-group-fname">
                                    <Field required name="work_pattern" as="select" class="form-control input"
                                        autocomplete="off" v-model="userData.work_pattern" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Work Pattern*</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="Holiday Year" class="user-label">Work Pattern*</label>
                                    <ErrorMessage name="work_pattern" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row d-flex">
                                <div class="col input-group-fname">
                                    <Field required type="text" name="earning_leave_entitlement"
                                        v-model="userData.earning_leave_entitlement"
                                        placeholder="Annual Earned Leave Entitlement*"
                                        :class="{ 'is-invalid': errors.earning_leave_entitlement }" class="input"
                                        autocomplete="off" />
                                    <label for="PAN Number" class="user-label">Annual Earned Leave Entitlement*</label>
                                    <ErrorMessage name="earning_leave_entitlement" class="text-danger mt-1" />
                                </div>
                                <div class="container p2">If during probation no leaves are avaliable for employees,
                                    then please set 0 as entitements below. You will able to set the entitlements later
                                    on when marking the employee as confirmed</div>
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required type="text" name="this_year" placeholder="This Year*"
                                        v-model="userData.this_year" :class="{ 'is-invalid': errors.this_year }"
                                        class="input" autocomplete="off" />
                                    <label for="PAN Number" class="user-label">This Year*</label>
                                    <ErrorMessage name="this_year" class="text-danger mt-1" />
                                </div>

                                <div class="col input-group-fname">
                                    <Field required type="text" name="next_year" placeholder="Next Year*"
                                        v-model="userData.next_year" :class="{ 'is-invalid': errors.next_year }"
                                        class="input" autocomplete="off" />
                                    <label for="PAN Number" class="user-label">Next Year*</label>
                                    <ErrorMessage name="next_year" class="text-danger mt-1" />
                                </div>
                            </div>
                        </div>
                    </template>

                    <template v-if="currentStep === 3">
                        <div class="form-step form-step-active">
                            <div class="profile1 d-flex">
                                <div class="icon_wrap d-flex align-items-center" style="gap: .5rem;">
                                    <img :src="apiPath + '/resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'"
                                        alt="profile_pic">
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


                            <div class="container doc-container d-flex flex-column" style="gap: 1.1rem;">

                                <div class="row ">
                                    <div class="col-sm-4">
                                        <div class="card  card1">
                                            <div class="card-body">
                                                <div class="showalltask-card d-flex flex-column">
                                                    <div class="d-flex" style="gap: .5rem;">
                                                        <input type="checkbox" id="">
                                                        <div class="p4">Aadhar Card Number</div>
                                                    </div>

                                                    <button type="button" class="btn btn-primary updoc">Upload
                                                        Document</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="card  card1">
                                            <div class="card-body">
                                                <div class="showalltask-card d-flex flex-column">
                                                    <div class="d-flex" style="gap: .5rem;">
                                                        <input type="checkbox" id="">
                                                        <div class="p4">PAN Card</div>
                                                    </div>
                                                    <button type="button" class="btn btn-primary updoc">Upload Document</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="card  card1">
                                            <div class="card-body">
                                                <div class="showalltask-card d-flex flex-column">
                                                    <div class="d-flex" style="gap: .5rem;">
                                                        <input type="checkbox" id="">
                                                        <div class="p4">PF & ESIC information</div>
                                                    </div>

                                                    <div class="d-flex justify-content-center align-items-center"
                                                        style="gap: 24px;">
                                                        <button type="button" class="btn btn-primary updoc">Upload Document</button>
                                                        <div class="removeTask"><i
                                                                class="fa-solid fa-square-minus fa-lg "
                                                                style="color: #ffffff;"></i></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="card  card1">
                                            <div class="card-body">
                                                <div class="showalltask-card d-flex flex-column">
                                                    <div class="d-flex" style="gap: .5rem;">
                                                        <input type="checkbox" id="">
                                                        <div class="p4">Confirmation letter</div>
                                                    </div>

                                                    <div class="d-flex justify-content-center align-items-center"
                                                        style="gap: 24px;">
                                                        <button type="button" class="btn btn-primary updoc">Upload Document</button>
                                                        <div class="removeTask"><i
                                                                class="fa-solid fa-square-minus fa-lg "
                                                                style="color: #ffffff;"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="card  card1">
                                            <div class="card-body">
                                                <div class="showalltask-card d-flex flex-column">
                                                    <div class="d-flex" style="gap: .5rem;">
                                                        <input type="checkbox" id="">
                                                        <div class="p4">Education Document</div>
                                                    </div>

                                                    <div class="d-flex justify-content-center align-items-center"
                                                        style="gap: 24px;">
                                                        <button type="button" class="btn btn-primary updoc">Upload Document</button>
                                                        <div class="removeTask"><i
                                                                class="fa-solid fa-square-minus fa-lg "
                                                                style="color: #ffffff;"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="card  card1">
                                            <div class="card-body">
                                                <div class="showalltask-card d-flex flex-column">
                                                    <div class="d-flex" style="gap: .5rem;">
                                                        <input type="checkbox" id="">
                                                        <div class="p4">Experience Letter</div>
                                                    </div>

                                                    <div class="d-flex justify-content-center align-items-center"
                                                        style="gap: 24px;">
                                                        <button type="button" class="btn btn-primary updoc">Upload Document</button>
                                                        <div class="removeTask"><i
                                                                class="fa-solid fa-square-minus fa-lg "
                                                                style="color: #ffffff;"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="card  card2">
                                            <div class="card-body d-flex justify-content-center align-items-center">
                                                <div class="showalltask-card d-flex flex-column">
                                                    <button type="button" class="btn btn-primary updoc"
                                                        data-toggle="modal" data-target="#AddDocModal">Add
                                                        Document</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </template>

                    <template v-if="currentStep === 4">
                        <div class="form-step form-step-active">

                            <div class="container d-flex flex-column" style="gap: 2rem;">

                                <div class="d-flex justify-content-center align-items-center" style="gap: 1rem;">
                                    <div class="done-task d-flex flex-column justify-content-center align-items-center"
                                        style="gap: 8px;">
                                        <div class="d-flex align-items-center" style="gap:9px;"><i
                                                class="fa-solid fa-circle-check fa-xl" style="color: #1B8A5A;"></i>
                                            <div style="font-size: 13px;font-weight: 500">Done! <span
                                                    style="color: #2DB9F8;"> {{ userData.first_name }} {{ userData.last_name }}</span> is successfully
                                                entered into the system. </div>
                                        </div>
                                        <div style="font-size: 13px;font-weight: 500">Unique employee ID <span
                                                style="color: #2DB9F8;">{{ userData.employee_id }}</span> is generated.</div>
                                        <div class="div-emp-rem"> What would you like to do next?</div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column justify-content-center align-items-center"
                                    style="gap: 1rem;">
                                    <a href="/admin/dashboard" class="btn btn-primary btn1">Finish and visit employee's
                                        record</a>
                                    <a href="/admin/onBoard" class="btn btn-primary btn1 ">Add another
                                        employee</a>
                                    <a href="/admin/home" class="btn btn-primary btn1">Finish and exit</a>
                                </div>

                            </div>
                        </div>
                    </template>

                    <div v-if="currentStep < 4" class="btns-save-cancle">
                        <button type="submit" class="btn btn-next btn-primary savenext">Save & Next</button>
                        <button type="button" v-if="currentStep !== 0" @click="prevStep"
                            class="btn btn-next btn-primary savenext">Previous</button>
                        <a id="myAnchor" href="javascript:;" class="btn btn-outline-light cancle"
                            @click="cancel">Cancel</a>
                    </div>
                </Form>
            </form>

        </div>
    </div>
</template>


<script setup>
import * as yup from "yup";
import { Form, Field, ErrorMessage, useForm, useField } from 'vee-validate';
import { ref, reactive, onMounted, computed, inject, watch, onUpdated, watchEffect } from 'vue';
import useUsers from "@/composables/users";
import useRoles from "@/composables/roles";
const { updateUser, getUser, user: postData, validationErrors, isLoading } = useUsers();
const { roles, getRoles } = useRoles();
import { useRoute, useRouter } from "vue-router";
import { param } from "jquery";
const route = useRoute()
const router = useRouter();
const swal = inject('$swal')
const currentStep = ref(0);
const boxWidth = ref(0); // Initial width
const userData = ref({})
const sameAsLocal = ref(false);
const perAddress = ref({});
watch(sameAsLocal, (current, previous) => {
    if(sameAsLocal === true) {
        perAddress.value = userData.value;
    } else {
        perAddress.value = {};
    }
});

onMounted(async () => {
    getUser(route.params.id)
    getRoles()
});

watchEffect(() => {
    const user = postData.value;
    // sameAsLocal.value = user?.info?.as_local;
    if(user?.info?.as_local) {
        sameAsLocal.value = true;
    } else {
        sameAsLocal.value = true;
    }
    userData.value = {
        id: user?.id,
        first_name: user?.first_name,
        last_name: user?.last_name,
        email: user?.email,
        phone: user?.phone,
        gender: user?.info?.gender,
        dob: user?.info?.dob,
        secondary_email: user?.info?.secondary_email,
        alternate_phone: user?.info?.alternate_phone,
        address: user?.info?.address,
        address_1: user?.info?.address_1,
        city: user?.info?.city,
        state: user?.info?.state,
        country: user?.info?.country,
        postcode: user?.info?.postcode,
        as_local: user?.info?.as_local,
        p_address: user?.info?.address,
        p_address_1: user?.info?.address_1,
        p_city: user?.info?.city,
        p_state: user?.info?.state,
        p_country: user?.info?.country,
        p_postcode: user?.info?.postcode,
        employee_id: user?.employee_id,
        doj: user?.info?.doj,
        prob_end_date: user?.info?.prob_end_date,
        company: user?.info?.company,
        location: user?.info?.location,
        qualification: user?.info?.qualification,
        experience: user?.info?.experience,
        immediate_manager: user?.info?.immediate_manager,
        immediate_manager_code: user?.info?.immediate_manager_code,
        leave_approving_auth: user?.info?.leave_approving_auth,
        leave_approving_code: user?.info?.leave_approving_code,
        department: user?.info?.department,
        role_id: user?.role_id,
        grade: user?.info?.grade,
        employment_type: user?.info?.employment_type,
        aadhar_number: user?.info?.aadhar_number,
        pan_number: user?.info?.pan_number,
        holiday_year: user?.info?.holiday_year,
        work_pattern: user?.info?.work_pattern,
        earning_leave_entitlement: user?.info?.earning_leave_entitlement,
        this_year: user?.info?.this_year,
        next_year: user?.info?.next_year,
    };
})

const schemas = [
    yup.object({
        first_name: yup.string().required("Required!"),
        last_name: yup.string().required("Required!"),
        email: yup.string().required().email(),
        phone: yup.string().required("Required!"),
        gender: yup.string().required("Required!"),
        // dob: yup.string().required("Required!"),
        // address: yup.string().required("Required!"),
        // address_1: yup.string().required("Required!"),
        // city: yup.string().required("Required!"),
        // state: yup.string().required("Required!"),
        // country: yup.string().required("Required!"),
        // postcode: yup.string().required("Required!"),
    }),
    yup.object({
        employee_id: yup.string().required("Required!"),
        // doj: yup.string().required("Required!"),
        // prob_end_date: yup.string().required("Required!"),
        // aadhar_number: yup.string().required("Required!"),
        // pan_number: yup.string().required("Required!"),
    }),
    //   yup.object({
    //     address: yup.string().required(),
    //     postalCode: yup
    //       .string()
    //       .required()
    //       .matches(/^[0-9]+$/, 'Must be numeric'),
    //   }),
    //   yup.object({
    //     terms: yup.bool().required().equals([true]),
    //   }),
];

const currentSchema = computed(() => {
    return schemas[currentStep.value];
});

async function submitForm(user) {
    await updateUser(user);
}

async function nextStep(values, user) {
    if (currentStep.value === 3) {
        console.log(values);
        console.log('dahej', sameAsLocal.value)
        if(sameAsLocal.value === undefined) { userData.value.as_local = false; } 
        else { userData.value.as_local = true; }
        return submitForm(userData.value).then(response => { currentStep.value++; boxWidth.value = '72'; }).catch(error => { return });
    }
    currentStep.value++;
    boxWidth.value = currentStep.value == 1 ? '18' : currentStep.value == 2 ? '36' : currentStep.value == 3 ? '54' : currentStep.value == 4 ? '72' : '0';
}

function prevStep() {
    if (currentStep.value <= 0) {
        return;
    }
    currentStep.value--;
    boxWidth.value = currentStep.value == 1 ? '18' : currentStep.value == 2 ? '36' : currentStep.value == 3 ? '54' : currentStep.value == 4 ? '72' : '0';
}

function cancel() {
    router.push({ name: 'admin.EmpProfile', params: { id: route.params.id } })
}

</script>
<style scoped>
@import '@/assets/css/onboard.css';
</style>