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

                <Form v-if="postData" @submit="nextStep" keep-values :validation-schema="currentSchema" @invalid-submit="onInvalidSubmit"
                    v-slot="{ errors, meta, isSubmitting }">


                    <template v-if="currentStep === 0">
                        <!-- Steps -->
                        <div class="form-step form-step-active">
                            <div class="personal-infor">
                                <div class="row">
                                    <div class="col input-group-fname">
                                        <Field type="text" name="first_name"
                                            :class="{ 'is-invalid': errors.first_name }" placeholder="First Name*"
                                            class="input" v-model="userData.first_name" autocomplete="off" required />
                                        <label for="First Name" class="user-label">First Name*</label>
                                        <ErrorMessage name="first_name" class="text-danger mt-1" />
                                    </div>
                                    <div class="col input-group-fname">
                                        <Field type="text" name="middle_name"
                                            :class="{ 'is-invalid': errors.middle_name }" placeholder="Middle Name"
                                            class="input" v-model="userData.middle_name" autocomplete="off" required />
                                        <label for="First Name" class="user-label">Middle Name</label>
                                        <ErrorMessage name="middle_name" class="text-danger mt-1" />
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col input-group-fname">
                                        <Field type="text" name="last_name" :class="{ 'is-invalid': errors.last_name }"
                                            placeholder="First Name*" class="input" v-model="userData.last_name"
                                            autocomplete="off" required />
                                        <label for="Last Name" class="user-label">Last Name*</label>
                                        <ErrorMessage name="last_name" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field type="email" name="email" class="input"
                                            :class="{ 'is-invalid': errors.email }" placeholder="Email*"
                                            v-model="userData.email" autocomplete="off" required />
                                        <label for="Email" class="user-label">Email*</label>
                                        <ErrorMessage name="email" class="text-danger mt-1" />
                                    </div>


                                </div>

                                <div class="row">

                                    <div class="col input-group-fname">
                                        <Field type="email" name="secondary_email" v-model="userData.secondary_email"
                                            class="input" autocomplete="off"
                                            :class="{ 'is-invalid': errors.secondary_email }"
                                            placeholder="Secondary Email" required />
                                        <label for="Secondary Email" class="user-label">Secondary Email</label>
                                        <ErrorMessage name="secondary_email" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field type="number" name="phone" class="input"
                                            :class="{ 'is-invalid': errors.phone }" v-model="userData.phone"
                                            autocomplete="off" placeholder="Mobile*" required />
                                        <label for="Mobile" class="user-label">Mobile*</label>
                                        <ErrorMessage name="phone" class="text-danger mt-1" />
                                    </div>


                                </div>
                                <div class="row">

                                    <div class="col input-group-fname">
                                        <Field type="number" name="alternate_phone"
                                            :class="{ 'is-invalid': errors.alternate_phone }"
                                            v-model="userData.alternate_phone" class="input" autocomplete="off"
                                            placeholder="Alternate Mobile" required />
                                        <label for="Alternate Mobile" class="user-label">Alternate Mobile</label>
                                        <ErrorMessage name="alternate_phone" class="text-danger mt-1" />
                                    </div>

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

                                </div>

                                <div class="row">
                                    <div class="col input-group-fname">
                                        <Field type="date" name="dob" class="input" v-model="userData.dob"
                                            autocomplete="off" placeholder="Date of Birth*"
                                            :class="{ 'is-invalid': errors.dob }" required />
                                        <label for="html" class="user-label ">Date of Birth*</label>
                                        <ErrorMessage name="dob" class="text-danger mt-1" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col p1">
                                        <p>Local Address</p>
                                    </div>

                                    <div class="col p1">
                                        <p class="d-flex justify-content-start align-items-center" style="gap: 8rem;">
                                        Permanent Address
                                        <span class="d-flex" style="gap: 6px;">
                                            <Field name="as_local" v-model="sameAsLocal" type="checkbox"
                                                :value="true" />
                                            <label for="SameAsLocal">Same As Local</label>
                                        </span>
                                    </p>
                                    </div>
                                </div>



                                <div class="row d-flex">

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="address" class="input"
                                            v-model="userData.address" autocomplete="off" placeholder="Address Line 1*"
                                            required />
                                        <label for="Address" class="user-label">Address Line 1*</label>
                                        <ErrorMessage name="address" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="p_address"
                                            v-model="perAddress.address" class="input" autocomplete="off"
                                            placeholder="Address Line 1*" required :disabled="sameAsLocal" />
                                        <label for="Address" class="user-label">Address Line 1*</label>
                                        <ErrorMessage name="p_address" class="text-danger mt-1" />
                                    </div>


                                </div>

                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="address_1"
                                            v-model="userData.address_1" class="input" autocomplete="off"
                                            placeholder="Address Line 2*" required />
                                        <label for="Address" class="user-label">Address Line 2*</label>
                                        <ErrorMessage name="address_1" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="p_address_1"
                                            v-model="perAddress.address_1" class="input" autocomplete="off"
                                            placeholder="Address Line 2*" required :disabled="sameAsLocal" />
                                        <label for="Address" class="user-label">Address Line 2*</label>
                                        <ErrorMessage name="p_address_1" class="text-danger mt-1" />
                                    </div>
                                </div>



                                <div class="row d-flex">

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="city" class="input"
                                            v-model="userData.city" autocomplete="off" placeholder="City/Town*"
                                            required />
                                        <label for="City" class="user-label">City/Town*</label>
                                        <ErrorMessage name="city" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="p_city" class="input"
                                            v-model="perAddress.city" autocomplete="off" placeholder="City/Town*"
                                            required :disabled="sameAsLocal" />
                                        <label for="City" class="user-label">City/Town*</label>
                                        <ErrorMessage name="p_city" class="text-danger mt-1" />
                                    </div>

                                </div>

                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <Field name="country" as="select" class="form-control input"
                                            :class="{ 'is-invalid': errors.country }" v-model="userData.country"
                                            autocomplete="off" style="color: #7e7e7e;" required>
                                            <option value="" disabled selected>Select</option>
                                            <option v-for="country in countries" :key="country.code" :value="country.code">{{ country.name }}</option>
                                        </Field>
                                        <label for="country" class="user-label">Country*</label>
                                        <ErrorMessage name="country" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field name="p_country" as="select" class="form-control input"
                                            :class="{ 'is-invalid': errors.country }" v-model="perAddress.country" :disabled="sameAsLocal"
                                            autocomplete="off" style="color: #7e7e7e;" required>
                                            <option value="" disabled selected>Select</option>
                                            <option v-for="country in countries" :key="country.code" :value="country.code">{{ country.name }}</option>
                                        </Field>
                                        <label for="country" class="user-label">Country*</label>
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
                                            v-model="perAddress.state" autocomplete="off" placeholder="State*" required
                                            :disabled="sameAsLocal" />
                                        <label for="State" class="user-label">State*</label>
                                        <ErrorMessage name="p_state" class="text-danger mt-1" />
                                    </div>

                                </div>

                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="number" name="postcode"
                                            v-model="userData.postcode" class="input" autocomplete="off"
                                            placeholder="Post Code*" required />
                                        <label for="Post Code" class="user-label">Post Code*</label>
                                        <ErrorMessage name="postcode" class="text-danger mt-1" />
                                    </div>
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="number" name="p_postcode"
                                            v-model="perAddress.postcode" class="input" autocomplete="off"
                                            placeholder="Post Code*" required :disabled="sameAsLocal" />
                                        <label for="Post Code" class="user-label">Post Code*</label>
                                        <ErrorMessage name="p_postcode" class="text-danger mt-1" />
                                    </div>
                                </div>

                                <div class="p1">Upload Image</div>

                                <input type="file" @change="uploadTempFile" name="Uplode Photo" id="uplodePhoto"
                                    placeholder=" Darg and Drop">
                                <div v-if="preview" class="preview">
                                    <img :src="preview" alt="Preview" v-if="isImage(preview)">
                                    <!-- <video :src="preview" controls v-if="isVideo(preview)"></video> -->
                                </div>
                            </div>
                        </div>
                    </template>

                    <template v-if="currentStep === 1">
                        <div class="form-step form-step-active">
                            <div class="profile d-flex">
                                <div class="icon_wrap d-flex align-items-center" style="gap: .5rem;">
                                    <img v-if="preview" :src="preview" alt="profile_pic">
                                    <img v-else
                                        :src="apiPath + '/resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'"
                                        alt="profile_pic">
                                    <span class="name">{{ userDetail.first_name }} {{ userDetail.last_name }}</span>
                                </div>
                            </div>

                            <div class="row d-flex">
                                <div class="col input-group-fname">
                                    <Field required name="user" as="select" v-model="userData.copy_from"
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
                                        class="input" autocomplete="off" />
                                    <label for="Employee ID" class="user-label">Employee ID</label>
                                    <ErrorMessage name="employee_id" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field type="date" name="doj" placeholder="Date of Joining" v-model="userData.doj"
                                        :class="{ 'is-invalid': errors.doj }" class="input" autocomplete="off" />
                                    <label for="Start Date" class="user-label ">Date of Joining*</label>
                                    <ErrorMessage name="doj" class="text-danger mt-1" />
                                </div>
                                <div class="col input-group-fname">
                                    <Field type="date" name="prob_end_date" placeholder="Probation End Date"
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
                                        <option value="" disabled selected>Company</option>
                                        <option value="ABC & Company Ltd.">ABC & Company Ltd.</option>
                                        <option value="Accenture Inc">Accenture Inc</option>
										<option value="North Corp Software">North Corp Software</option>
										<option value="Cyber Security Ltd">Cyber Security Ltd</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="Company" class="user-label">Company</label>
                                    <ErrorMessage name="company" class="text-danger mt-1" />
                                </div>

                                <div class="col input-group-fname">
                                    <Field required name="location" as="select" class="form-control input"
                                        autocomplete="off" v-model="userData.location" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Location</option>
                                        <option value="Guru Gram"> Guru Gram</option>
										<option value="Pune">Pune</option>
										<option value="Bangluru">Bangluru</option>
										<option value="California">California</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="location" class="user-label">Location</label>
                                    <ErrorMessage name="location" class="text-danger mt-1" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required name="qualification" as="select" class="form-control input"
                                        v-model="userData.qualification" autocomplete="off" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Qualification-Degree</option>
                                        <option value="Master Degree">Master Degree</option>
                                        <option value="B.Tech or BE">B.Tech or BE</option>
										<option value="Other Graduate">Other Graduate</option>
										<option value="Under Graduate">Under Graduate</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="qualification" class="user-label">Qualification-Degree</label>
                                    <ErrorMessage name="qualification" class="text-danger mt-1" />
                                </div>

                                <div class="col input-group-fname">
                                    <Field required name="experience" as="select" class="form-control input"
                                        autocomplete="off" v-model="userData.experience" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Work Experience</option>
                                        <option value="0 - 1 year"> 0 - 1 year</option>
										 <option value="1-3 years">1-3 years</option>
										 <option value="4-6 years"> 4-6 years</option>
										 <option value="7-9 years">7-9 years</option>
										 <option value="10-15 years">10-15 years </option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="experience" class="user-label">Work Experience</label>
                                    <ErrorMessage name="experience" class="text-danger mt-1" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required name="immediate_manager" as="select" class="form-control input"
                                        v-model="userData.immediate_manager" autocomplete="off" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Immediate-Manager</option>
                                        <option value="Hiring Manager">Hiring Manager</option>
										<option value="Team Lead">Team Lead</option>
                                        <option value="C.E.O">C.E.O</option>
                                        <option value="Assist Project Manager">Assist Project Manager</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="immediate_manager" class="user-label">Immediate-Manager</label>
                                    <ErrorMessage name="immediate_manager" class="text-danger mt-1" />
                                </div>

                                <div class="col input-group-fname">
                                    <Field type="text" name="immediate_manager_code" placeholder="Employee Code"
                                        v-model="userData.immediate_manager_code"
                                        :class="{ 'is-invalid': errors.immediate_manager_code }" class="input"
                                        autocomplete="off" />
                                    <label for="employee_code" class="user-label ">Employee Code</label>
                                    <ErrorMessage name="immediate_manager_code" class="text-danger mt-1" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required name="leave_approving_auth" as="select" class="form-control input"
                                        v-model="userData.leave_approving_auth" autocomplete="off"
                                        style="color: #7e7e7e;">
                                        <option value="" disabled selected>Leave Approving Authority</option>
                                        <option value="Project Manager">Project Manager</option>
                                        <option value="H. R. Manager">H. R. Manager</option>
										<option value="Director">Director</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="leave_approving_auth" class="user-label">Leave Approving
                                        Authority</label>
                                    <ErrorMessage name="leave_approving_auth" class="text-danger mt-1" />
                                </div>

                                <div class="col input-group-fname">
                                    <Field type="text" name="leave_approving_code" placeholder="Employee Code"
                                        v-model="userData.leave_approving_code"
                                        :class="{ 'is-invalid': errors.leave_approving_code }" class="input"
                                        autocomplete="off" />
                                    <label for="employee_code" class="user-label ">Employee Code</label>
                                    <ErrorMessage name="leave_approving_code" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required name="department" as="select" class="form-control input"
                                        autocomplete="off" v-model="userData.department" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Department</option>
                                        <option value="">Department</option>
                                        <option value="Software Development">Software Development</option>
                                        <option value="Quality Testing">Quality Testing</option>
										<option value="Designing">Designing</option>
										<option value="Management">Management</option>
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
                                    <ErrorMessage name="role_id" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required name="grade" as="select" class="form-control input"
                                        autocomplete="off" v-model="userData.grade" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Grade</option>
                                        <option value="Manager">Manager</option>
										<option value="Lead">Lead</option>
                                        <option value="Senior">Senior</option>
                                        <option value="Junior">Junior</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="Grade" class="user-label">Grade</label>
                                    <ErrorMessage name="grade" class="text-danger mt-1" />
                                </div>
                                <div class="col input-group-fname">
                                    <Field required name="employment_type" as="select" class="form-control input"
                                        v-model="userData.employment_type" autocomplete="off" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Employment Type</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Consultant">Contract</option>
                                        <option value="Trainee">Trainee</option>
										<option value="Apprenticeship">Apprenticeship</option>
										<option value="Casual">Casual</option>
										<option value="Temporary">Temporary </option>
                                    </Field>
                                    <label for="Employment Type" class="user-label">Employment Type</label>
                                    <ErrorMessage name="employment_type" class="text-danger mt-1" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required type="number" name="aadhar_number" placeholder="Aadhar Number"
                                        v-model="userData.aadhar_number" :class="{ 'is-invalid': errors.aadhar_number }"
                                        class="input" autocomplete="off" />
                                    <label for="Aadhar Number" class="user-label">Aadhar Number</label>
                                    <ErrorMessage name="aadhar_number" class="text-danger mt-1" />
                                </div>
                                <div class="col input-group-fname">
                                    <Field type="text" name="pan_number" placeholder="PAN Number"
                                        v-model="userData.pan_number" :class="{ 'is-invalid': errors.pan_number }"
                                        class="input" autocomplete="off" required />
                                    <label for="PAN Number" class="user-label">PAN Number</label>
                                    <ErrorMessage name="pan_number" class="text-danger mt-1" />
                                </div>
                            </div>
                        </div>
                    </template>


                    <template v-if="currentStep === 2">
                        <div class="form-step form-step-active">
                            <div class="profile d-flex">
                                <div class="icon_wrap d-flex align-items-center" style="gap: .5rem;">
                                    <img v-if="preview" :src="preview" alt="profile_pic">
                                    <img v-else
                                        :src="apiPath + '/resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'"
                                        alt="profile_pic">
                                    <span class="name">{{ userDetail.first_name }} {{ userDetail.last_name }}</span>
                                </div>
                            </div>


                            <div class="row d-flex">

                                <div class="col input-group-fname">
                                    <Field required name="holiday_year" as="select" class="form-control input"
                                        autocomplete="off" v-model="userData.holiday_year" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Holiday Year</option>
                                        <option value="Option1">2022 - 2023</option>
                                        <option value="Option2">2023 - 2024</option>
										 <option value="Option3">2024 - 2025</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="Holiday Year" class="user-label">Holiday Year</label>
                                    <ErrorMessage name="holiday_year" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row d-flex">

                                <div class="col input-group-fname">
                                    <Field required name="work_pattern" as="select" class="form-control input"
                                        autocomplete="off" v-model="userData.work_pattern" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Work Pattern</option>
                                        <option value="Full Time">Full Time</option>
										<option value="Part Time">Part Time</option>
                                        <option value="Remote">Remote</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="Holiday Year" class="user-label">Work Pattern</label>
                                    <ErrorMessage name="work_pattern" class="text-danger mt-1" />
                                </div>
                            </div>

                            <div class="row d-flex">
                                <div class="col input-group-fname">
                                    <Field required type="number" name="salary"
                                        v-model="userData.salary"
                                        placeholder="Salary"
                                        :class="{ 'is-invalid': errors.salary }" class="input"
                                        autocomplete="off" />
                                    <label for="PAN Number" class="user-label">Salary</label>
                                    <ErrorMessage name="salary" class="text-danger mt-1" />
                                </div>
                            </div>

                            <div class="row d-flex">
                                <div class="col input-group-fname">
                                    <Field required type="number" name="earning_leave_entitlement"
                                        v-model="userData.earning_leave_entitlement"
                                        placeholder="Annual Earned Leave Entitlement"
                                        :class="{ 'is-invalid': errors.earning_leave_entitlement }" class="input"
                                        autocomplete="off" />
                                    <label for="PAN Number" class="user-label">Annual Earned Leave Entitlement</label>
                                    <ErrorMessage name="earning_leave_entitlement" class="text-danger mt-1" />
                                </div>
                                <div class="container p2">If during probation no leaves are avaliable for employees,
                                    then please set 0 as entitements below. You will able to set the entitlements later
                                    on when marking the employee as confirmed</div>
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required type="number" name="this_year" placeholder="This Year"
                                        v-model="userData.this_year" :class="{ 'is-invalid': errors.this_year }"
                                        class="input" autocomplete="off" />
                                    <label for="PAN Number" class="user-label">This Year</label>
                                    <ErrorMessage name="this_year" class="text-danger mt-1" />
                                </div>

                                <div class="col input-group-fname">
                                    <Field required type="number" name="next_year" placeholder="Next Year"
                                        v-model="userData.next_year" :class="{ 'is-invalid': errors.next_year }"
                                        class="input" autocomplete="off" />
                                    <label for="PAN Number" class="user-label">Next Year</label>
                                    <ErrorMessage name="next_year" class="text-danger mt-1" />
                                </div>
                            </div>
                        </div>
                    </template>

                    <template v-if="currentStep === 3">
                        <div class="form-step form-step-active">
                            <div class="profile1 d-flex">
                                <div class="icon_wrap d-flex align-items-center" style="gap: .5rem;">
                                    <img v-if="preview" :src="preview" alt="profile_pic">
                                    <img v-else
                                        :src="apiPath + '/resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'"
                                        alt="profile_pic">
                                    <span class="name">{{ userDetail.first_name }} {{ userDetail.last_name }}</span>
                                </div>
                                <div class="d-flex">
                                    <div class="showalltask-div">
                                        <input type="checkbox" v-model="checkAll" name="" id="">
                                        <div class="p1">Show all tasks</div>
                                    </div>

                                </div>
                            </div>

                            <div class="container p3">Basic information is completed and you are almost done. On this
                                screen you can update your task list for employee either by adding custom tasks or
                                selecting any visible task suggestions. </div>


                            <div class="container doc-container d-flex flex-column" style="gap: 1.1rem;">

                                <div class="row ">
                                    <UploadDoc v-for="component in uploadComponent" :checked="checkAll"
                                        ref="childComponents" :is="component" :key="component.id"
                                        @delete-input="deleteInput(component.id)">
                                    </UploadDoc>
                                    <div class="col-sm-4">
                                        <div class="card  card2">
                                            <div class="card-body d-flex justify-content-center align-items-center">
                                                <div class="showalltask-card d-flex flex-column">
                                                    <button type="button" class="btn btn-primary updoc"
                                                        data-toggle="modal" data-target="#AddDocModal"
                                                        @click="openModal">Add
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
                                                    style="color: #2DB9F8;"> {{ userData.first_name }} {{
                                                        userData.last_name }}</span> is successfully
                                                updated into the system. </div>
                                        </div>
                                        <div style="font-size: 13px;font-weight: 500">Unique employee ID <span
                                                style="color: #2DB9F8;">{{ userData.employee_id }}</span> .
                                        </div>
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
                    <div v-if="currentStep < 4" class="form-step form-step-active">
                        <div class="btns-save-cancle">
                            <button type="submit" class="btn btn-next btn-primary savenext">Save & Next</button>
                            <button type="button" v-if="currentStep !== 0" @click="prevStep"
                                class="btn btn-next btn-primary savenext">Previous</button>
                            <a id="myAnchor" href="javascript:;" class="btn btn-outline-light cancle"
                                @click="cancel">Cancel</a>
                        </div>
                    </div>
                    <template>
                        <div v-if="valErrors = errors"></div>
                    </template>
                </Form>
            </form>

        </div>
    </div>

    <div v-if="isModalOpened" class="modal-mask" id="AddDocModal" tabindex="-1" aria-labelledby="AddDocModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddDocModalLabel">Add Document</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" @click="closeModal">
                        <span aria-hidden="true"><i class="fa-solid fa-circle-xmark fa-2xl"
                                style="color: #2DB9F8"></i></span>
                    </button>
                </div>
                <Form @submit="submitDocForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col input-group-fname">
                                <Field placeholder="Document name*" required type="text" name="docName"
                                    autocomplete="off" class="input" id="Doc-name" style="width: 310px;" />
                                <label class="user-label">Document name*</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn  btn-primary save">Save</button>
                        <a href="javascript:;" class="btn btn-outline-light cancle" @click="closeModal">Cancel</a>
                    </div>
                </Form>

            </div>
        </div>
    </div>
</template>


<script setup>
import * as yup from "yup";
import { Form, Field, ErrorMessage, useForm, useField } from 'vee-validate';
import { ref, reactive, onMounted, computed, inject, watch, onUpdated, watchEffect } from 'vue';
import useUsers from "@/composables/users";
import useRoles from "@/composables/roles";
import UploadDoc from "@/components/UploadDoc.vue";
import { countries } from "@/constants/countries";
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
const userDetail = ref({});
const sameAsLocal = ref(false);
const perAddress = ref({});
const oldPerAddress = ref({});
const preview = ref();
const checkAll = ref();
const childComponents = ref([]);
const valErrors = ref({});


watch(sameAsLocal, (current, previous) => {
    if (sameAsLocal.value === true) {
        perAddress.value = userData.value;
    } else {
        perAddress.value = oldPerAddress.value;
    }
});

watch(checkAll, (current, previous) => {
    childComponents.value.forEach((childRef) => {
        if (childRef) {
            childRef.childMethod(current);
        }
    });
});

function capitalize(s)
{
    return s[0].toUpperCase() + s.slice(1);
}

function onInvalidSubmit({ values, errors, results }) {
    let current = valErrors.value;
    if (Object.keys(current).length > 0) {
        swal({
            icon: "error",
            title: capitalize(Object.values(current)[0]),
        });
    }
}
const getUploadDocData = () => {
    let files = [];
    childComponents.value.forEach((childRef) => {
        if (childRef && Object.keys(childRef.fileData).length > 0) {
            files.push(childRef.fileData);
        }
    });
    return files;
}

const getOldUploadDocData = () => {
    let files = [];
    childComponents.value.forEach((childRef) => {
        if (childRef) {
            files.push({id: childRef.id, check: childRef.checked});
        }
    });
    return files;
}


onMounted(async () => {
    getUser(route.params.id)
    getRoles()

});

const uploadComponent = ref([])
watchEffect(() => {
    const user = postData.value;
    // sameAsLocal.value = user?.info?.as_local;
    if (user?.info?.as_local) {
        sameAsLocal.value = user?.info?.as_local;
    } else {
        sameAsLocal.value = false;
    }



    preview.value = user?.user_profile_picture;
    checkAll.value = user?.info?.check_all;
    userData.value = {
        id: user?.id,
        first_name: user?.first_name,
        middle_name: user?.middle_name,
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
        p_address: user?.info?.p_address,
        p_address_1: user?.info?.p_address_1,
        p_city: user?.info?.p_city,
        p_state: user?.info?.p_state,
        p_country: user?.info?.p_country,
        p_postcode: user?.info?.p_postcode,
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
        salary: user?.info?.salary,
        this_year: user?.info?.this_year,
        next_year: user?.info?.next_year,
        check_all: user?.info?.check_all,
        attachments: []
    };

    oldPerAddress.value = {
        address: userData.value?.p_address,
        address_1: userData.value?.p_address_1,
        city: userData.value?.p_city,
        state: userData.value?.p_state,
        country: userData.value?.p_country,
        postcode: userData.value?.p_postcode,
    }

    perAddress.value = {
        address: userData.value?.p_address,
        address_1: userData.value?.p_address_1,
        city: userData.value?.p_city,
        state: userData.value?.p_state,
        country: userData.value?.p_country,
        postcode: userData.value?.p_postcode,
    }
    // console.log('oldData2', userData.value)

    let files = user?.files;
    if(files) {
        for (var key in files) {
            console.log(files[key]);
            let element = files[key];
            if(element.custom_properties.collection_name != 'user_profile_picture') {
                uploadComponent.value.push({
                    id: key,
                    title: element.custom_properties.title,
                    type: element.custom_properties.collection_name,
                    check:element.custom_properties.check,
                    uploaded : true,
                    edit: true
                });
            }
        }
    }
    
})

// const uploadComponent = ref([
//     {
//         id: Math.random().toString(36).substring(7),
//         title: 'Aadhar Card Number',
//         type: 'aadhar_proof',
//         edit: false
//     },
//     {
//         id: Math.random().toString(36).substring(7),
//         title: 'PAN Card',
//         type: 'pan_proof',
//         edit: false
//     },
//     {
//         id: Math.random().toString(36).substring(7),
//         title: 'PF & ESIC information',
//         type: 'pf_info',
//         edit: true
//     },
//     {
//         id: Math.random().toString(36).substring(7),
//         title: 'Confirmation letter',
//         type: 'confirmation_letter',
//         edit: true
//     },
//     {
//         id: Math.random().toString(36).substring(7),
//         title: 'Education Document',
//         type: 'education_doc',
//         edit: true
//     },
//     {
//         id: Math.random().toString(36).substring(7),
//         title: 'Experience Letter',
//         type: 'experience_letter',
//         edit: true
//     }
// ]);

const deleteFiles = ref([])
const deleteInput = (id) => {
    uploadComponent.value.splice(uploadComponent.value.findIndex(component => component.id === id), 1);
    deleteFiles.value.push(id)
}

const schemas = [
    yup.object({
        first_name: yup.string().required('First name is required').min(3, 'Name must be at least 3 characters').max(30, 'Name must be at max 30 characters'),
        middle_name: yup.string().nullable().max(30, 'Name must be at max 30 characters'),
        last_name: yup.string().required('Last name is required').min(3, 'Name must be at least 3 characters').max(30, 'Name must be at max 30 characters'),
        email: yup.string().required('Email is required').matches(/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i, 'Invalid email format'),
        secondary_email: yup.string().email('Invalid Email').nullable(),
        phone: yup.string().required('Phone is required').min(10).max(10),
        alternate_phone: yup.string().nullable().test('length', 'The field must be exactly 10 characters long or null', 
            value => value === null || value === '' || value.length === 10),
            gender: yup.string().required('Gender is required'),
        dob: yup.string().required('Date of Birth is required'),
        address: yup.string().required('Address is required'),
        address_1: yup.string().required('Address 2 is required'),
        city: yup.string().required('City is required'),
        state: yup.string().required('State is required'),
        country: yup.string().required('Country is required'),
        postcode: yup.string().required('Postcode is required').test('length', 'Invalid postcode', 
                value => value === null || value === '' || value.length === 6),

        p_address: yup.string().required('Permanent address is required'),
        p_address_1: yup.string().required('Permanent address 2 is required'),
        p_city: yup.string().required('Permanent city is required'),
        p_state: yup.string().required('Permanent state is required'),
        p_country: yup.string().required('Permanent country is required'),
        p_postcode: yup.string().required('Permanent postcode is required').test('length', 'Invalid postcode', 
                value => value === null || value === '' || value.length === 6),
        }),
    yup.object({
        employee_id: yup.string().required("Required!"),
        role_id: yup.string().required("Required!"),
        doj: yup.string().required("Required!"),
        // prob_end_date: yup.string().required("Required!"),
        prob_end_date: yup.date().required('End date is required')
        .test('is-greater', 'Probation date must be greater than date of joining', function(value) {
        const { doj } = this.parent;
        const date = new Date(value);
        // Get year, month, and day part from the date
        var year = date.toLocaleString("default", { year: "numeric" });
        var month = date.toLocaleString("default", { month: "2-digit" });
        var day = date.toLocaleString("default", { day: "2-digit" });
        var formattedDate = year + "-" + month + "-" + day;
        return !doj || !value || formattedDate > doj;
        }),
        // aadhar_number: yup.string().required("Required!"),
        // pan_number: yup.string().required("Required!"),
        aadhar_number: yup.string().nullable().test('length', 'Invalid Aadhar number',
            value => value === null || value === '' || value.length === 12),
        // pan_number: yup.string().nullable().test('length', 'Invalid PAN number',
        //     value => value === null || value === '' || value.length === 10),

        pan_number: yup.string().nullable()
        .test('is-greater', 'Invalid PAN card number', function(value) {
            const panCardPattern = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
            if (value != null && value != '' && !panCardPattern.test(value)) {
                return false;
            }
            return true;
        }),

        
    }),
      yup.object({
        earning_leave_entitlement: yup
          .string()
          .matches(/^[0-9]+$/, 'Must be numeric'),
        this_year: yup.string().nullable().matches(/^[0-9]+$/, 'Must be numeric')
        .test('is-greater', 'This year value must be less than sum of Annual Earned Leave Entitlement and Next year value', function(value) {
        const { earning_leave_entitlement, next_year } = this.parent;
        if(Number(value) > earning_leave_entitlement) { return false; }
        return !Number(earning_leave_entitlement) || !value || Number(value) + Number(next_year) <= Number(earning_leave_entitlement);
        }),
        next_year: yup.string().nullable().matches(/^[0-9]+$/, 'Must be numeric')
        .test('is-greater', 'Next year value must be less than Annual Earned Leave Entitlement', function(value) {
        const { earning_leave_entitlement } = this.parent;
        return !Number(earning_leave_entitlement) || !value || Number(value) <= Number(earning_leave_entitlement);
        }),
      }),
    //   yup.object({
    //     terms: yup.bool().required().equals([true]),
    //   }),
];


const previewFile = (event) => {
    this.file = event.target.files[0];
    this.preview = URL.createObjectURL(this.file);
}
const isImage = (file) => {
    return file;
}
// const isVideo = (file) => {
//     return file && file.type.startsWith('data:video');
// }

const uploadTempFile = async (event) => {
    const file = event.target.files[0];
    if (file.size > 1024 * 1024 * 10) {
        swal({
            icon: "error",
            title: "File too big! Maximum file size is 10MB.",
        });
        return;
    }
    if (!['image/png', 'image/jpeg', 'image/jpg'].includes(file.type)) {
        file.value = null;
        swal({
            icon: "error",
            title: "Invalid file type",
        });
        return;
    }
    const formData = new FormData();
    formData.append('image', file);
    try {
        const response = await axios.post('/api/tempfile', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });

        const tempPath = response.data.temporary_path;
        userDetail.value.user_profile_picture = tempPath;
        userData.value.user_profile_picture = tempPath;
        preview.value = URL.createObjectURL(file);
        alert('File uploaded temporarily');
    } catch (error) {
        console.error(error);
        alert('Failed to upload file');
    }
}


const currentSchema = computed(() => {
    return schemas[currentStep.value];
});

async function submitForm(user) {
    await updateUser(user);
}

async function nextStep(values, errors) {
    if (currentStep.value === 3) {
        userDetail.value = values;
        userData.value.as_local = sameAsLocal.value;
        userData.value.docs = getOldUploadDocData();;
        Object.assign(userData.value, {
            p_address: perAddress.value?.address,
            p_address_1: perAddress.value?.address_1,
            p_city: perAddress.value?.city,
            p_state: perAddress.value?.state,
            p_country: perAddress.value?.country,
            p_postcode: perAddress.value?.postcode,
            check_all: checkAll.value
        });
        userData.value.attachments = getUploadDocData();
        userData.value.delete_files = deleteFiles.value;
        return submitForm(userData.value).then(response => { currentStep.value++; boxWidth.value = '72'; }).catch(error => { return });
    }
    userDetail.value = values;
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


const isModalOpened = ref(false);
const openModal = () => {
    isModalOpened.value = true;
};
const closeModal = () => {
    isModalOpened.value = false;
};

const submitDocForm = (values) => {
    uploadComponent.value.push({
        id: Math.random().toString(36).substring(7),
        title: values.docName,
        type: values.docName.split(' ').join('_').toLowerCase(),
        edit: true
    });
    closeModal();
};
</script>
<style>
@import '@/assets/css/onboard.css';
</style>

<style>
.preview img,
.preview video {
    max-width: 300px;
    max-height: 300px;
    margin-top: 10px;
}

.modal-mask {
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, .2);
    border-radius: .3rem;
    outline: 0;
    width: 100% !important;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type=number] {
    -moz-appearance: textfield;
}
</style>