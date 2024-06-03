<template>
    <div id="dashboard-table" class="container-fluid">
        <div id="dashboard-table-info">
            <span>On-board</span>
            <span>Employees > On-board</span>
        </div>

        <div id="form-info" class="container">
            <form class="form">
                <div class=" d-flex flex-column">
                    <div class="Add-emp-div">Add Employee</div>
                    <div class="div-emp-rem"> Fill in the fields on each screen to create an employment record
                        for a new stater.</div>
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

                <Form @submit="nextStep" keep-values :validation-schema="currentSchema" :initial-values="formValues"
                    v-slot="{ handleSubmit, values, errors }">

                    <template v-if="currentStep === 0">
                        <!-- Steps -->
                        <div class="form-step form-step-active">
                            <div class="personal-infor">
                                <div class="row">
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" :value="values.first_name"
                                            placeholder="First Name*" name="first_name" :valid="false" class="input"
                                            autocomplete="off" required />
                                        <label for="First Name" class="user-label">First Name*</label>
                                        <ErrorMessage name="first_name" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" :value="values.middle_name"
                                            placeholder="Middle Name" name="middle_name" :valid="false" class="input"
                                            autocomplete="off" required />
                                        <label for="Middle Name" class="user-label">Middle Name</label>
                                        <ErrorMessage name="middle_name" class="text-danger mt-1" />
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="last_name"
                                            class="input" autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.last_name }" placeholder="Last Name*"
                                                type="text" autocomplete="off" class="input" required>
                                        </Field>
                                        <label for="Last Name" class="user-label">Last Name*</label>
                                        <ErrorMessage name="last_name" class="text-danger mt-1" />
                                    </div>
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="email" name="email" class="input"
                                            autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.email }" placeholder="Email*"
                                                type="email" autocomplete="off" class="input" required>
                                        </Field>
                                        <label for="Email" class="user-label">Email*</label>
                                        <ErrorMessage name="email" class="text-danger mt-1" />
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="email" name="secondary_email"
                                            class="input" autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.secondary_email }"
                                                placeholder="Secondary Email" type="email" autocomplete="off"
                                                class="input" required>
                                        </Field>
                                        <label for="Secondary Email" class="user-label">Secondary Email</label>
                                        <ErrorMessage name="secondary_email" class="text-danger mt-1" />
                                    </div>
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="phone" class="input"
                                            autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.phone }" placeholder="Mobile*"
                                                type="number" autocomplete="off" class="input" required>
                                        </Field>
                                        <label for="Mobile" class="user-label">Mobile*</label>
                                        <ErrorMessage name="phone" class="text-danger mt-1" />
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="alternate_phone"
                                            class="input" autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.alternate_phone }"
                                                placeholder="Alternate Mobile" type="number" autocomplete="off"
                                                class="input" required>
                                        </Field>
                                        <label for="Alternate Mobile" class="user-label">Alternate Mobile</label>
                                        <ErrorMessage name="alternate_phone" class="text-danger mt-1" />
                                    </div>
                                    <div class="col input-group-fname">
                                        <Field required name="gender" as="select" class="form-control input"
                                            autocomplete="off" style="color: #7e7e7e;">
                                            <option value="" disabled selected>Gender</option>
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
                                        <Field v-slot="{ field, handleChange }" name="password" class="input">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.password }" placeholder="Password*"
                                                type="password" autocomplete="new-password" class="input" required>
                                        </Field>
                                        <label for="html" class="user-label ">Password</label>
                                        <ErrorMessage name="password" class="text-danger mt-1" />
                                    </div>
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" name="dob" class="input"
                                            autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.dob }" onfocus="(this.type='date')"
                                                placeholder="Date of Birth*" type="text" autocomplete="off"
                                                class="input" required>
                                        </Field>
                                        <label for="html" class="user-label ">Date of Birth*</label>
                                        <ErrorMessage name="dob" class="text-danger mt-1" />
                                    </div>
                                </div>

                                <div class="p1  d-flex justify-content-start align-items-center" style="gap: 22rem;">
                                    <p>Local Address</p>
                                    <p class="d-flex justify-content-between align-items-center" style="gap: 8rem;">
                                        Permanent Address
                                        <span class="d-flex" style="gap: 6px;">
                                            <Field name="as_local" v-model="sameAsLocal" type="checkbox"
                                                :value="true" />
                                            <label for="SameAsLocal">Same As Local</label>
                                        </span>
                                    </p>
                                </div>



                                <div class="row d-flex">

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="address" class="input"
                                            v-model="localAddress.address" autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.address }" placeholder="Address Line 1*"
                                                type="text" autocomplete="off" class="input" required>
                                        </Field>
                                        <label for="Address" class="user-label">Address Line 1*</label>
                                        <ErrorMessage name="address" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="p_address"
                                            v-model="perAddress.address" class="input" autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.p_address }" placeholder="Address Line 1*"
                                                type="text" autocomplete="off" class="input" required
                                                :disabled="sameAsLocal">
                                        </Field>
                                        <label for="Address" class="user-label">Address Line 1*</label>
                                        <ErrorMessage name="p_address" class="text-danger mt-1" />
                                    </div>


                                </div>

                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="address_1"
                                            v-model="localAddress.address_1" class="input" autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.address_1 }" placeholder="Address Line 2*"
                                                type="text" autocomplete="off" class="input" required>
                                        </Field>
                                        <label for="Address" class="user-label">Address Line 2*</label>
                                        <ErrorMessage name="address_1" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="p_address_1"
                                            v-model="perAddress.address_1" class="input" autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.p_address_1 }"
                                                placeholder="Address Line 2*" type="text" autocomplete="off"
                                                class="input" required :disabled="sameAsLocal">
                                        </Field>
                                        <label for="Address" class="user-label">Address Line 2*</label>
                                        <ErrorMessage name="p_address_1" class="text-danger mt-1" />
                                    </div>
                                </div>



                                <div class="row d-flex">

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="city" class="input"
                                            v-model="localAddress.city" autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.city }" placeholder="City/Town*"
                                                type="text" autocomplete="off" class="input" required>
                                        </Field>
                                        <label for="City" class="user-label">City/Town*</label>
                                        <ErrorMessage name="city" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="p_city" class="input"
                                            v-model="perAddress.city" autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.p_city }" placeholder="City/Town*"
                                                type="text" autocomplete="off" class="input" required
                                                :disabled="sameAsLocal">
                                        </Field>
                                        <label for="City" class="user-label">City/Town*</label>
                                        <ErrorMessage name="p_city" class="text-danger mt-1" />
                                    </div>

                                </div>

                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="country" class="input"
                                            v-model="localAddress.country" autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.country }" placeholder="Country*"
                                                type="text" autocomplete="off" class="input" required>
                                        </Field>

                                        <label for="Country" class="user-label">Country*</label>
                                        <ErrorMessage name="country" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="p_country"
                                            v-model="perAddress.country" class="input" autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.p_country }" placeholder="Country*"
                                                type="text" autocomplete="off" class="input" required
                                                :disabled="sameAsLocal">
                                        </Field>

                                        <label for="Country" class="user-label">Country*</label>
                                        <ErrorMessage name="p_country" class="text-danger mt-1" />
                                    </div>
                                </div>

                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="state" class="input"
                                            v-model="localAddress.state" autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.state }" placeholder="State*" type="text"
                                                autocomplete="off" class="input" required>
                                        </Field>
                                        <label for="State" class="user-label">State*</label>
                                        <ErrorMessage name="state" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="p_state" class="input"
                                            v-model="perAddress.state" autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.p_state }" placeholder="State*"
                                                type="text" autocomplete="off" class="input" required
                                                :disabled="sameAsLocal">
                                        </Field>
                                        <label for="State" class="user-label">State*</label>
                                        <ErrorMessage name="p_state" class="text-danger mt-1" />
                                    </div>

                                </div>

                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="number" name="postcode"
                                            v-model="localAddress.postcode" class="input" autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.postcode }" placeholder="Post Code*"
                                                type="number" autocomplete="off" class="input" required>
                                        </Field>
                                        <label for="Post Code" class="user-label">Post Code*</label>
                                        <ErrorMessage name="postcode" class="text-danger mt-1" />
                                    </div>
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="number" name="p_postcode"
                                            v-model="perAddress.postcode" class="input" autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.p_postcode }" placeholder="Post Code*"
                                                type="number" autocomplete="off" class="input" required
                                                :disabled="sameAsLocal">
                                        </Field>
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
                                    <Field required name="user" as="select" class="form-control input"
                                        autocomplete="off" :validateOnBlur="false" :validateOnChange="false"
                                        :validateOnInput="false" style="color: #7e7e7e;">
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
                                    <Field required type="text" name="employee_id" placeholder="Employee ID*" :value="employeeId"
                                        :class="{ 'is-invalid': errors.employee_id }" class="input"
                                        autocomplete="off" />
                                    <label for="Employee ID" class="user-label">Employee ID*</label>
                                    <ErrorMessage name="employee_id" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required type="text" onfocus="(this.type='date')" name="doj"
                                        placeholder="Date of Joining*" :class="{ 'is-invalid': errors.doj }"
                                        class="input" autocomplete="off" />
                                    <label for="Start Date" class="user-label ">Date of Joining*</label>
                                    <ErrorMessage name="doj" class="text-danger mt-1" />
                                </div>
                                <div class="col input-group-fname">
                                    <Field required type="text" onfocus="(this.type='date')" name="prob_end_date"
                                        placeholder="Probation End Date*" :class="{ 'is-invalid': errors.prob_end_date }"
                                        class="input" autocomplete="off" />
                                    <label for="Probation End Date" class="user-label ">Probation End Date*</label>
                                    <ErrorMessage name="prob_end_date" class="text-danger mt-1" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required name="company" as="select" class="form-control input"
                                        autocomplete="off" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Company</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="Company" class="user-label">Company</label>
                                    <ErrorMessage name="company" class="text-danger mt-1" />
                                </div>

                                <div class="col input-group-fname">
                                    <Field required name="location" as="select" class="form-control input"
                                        autocomplete="off" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Location</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="location" class="user-label">Location</label>
                                    <ErrorMessage name="location" class="text-danger mt-1" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required name="qualification" as="select" class="form-control input"
                                        autocomplete="off" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Qualification-Degree</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="qualification" class="user-label">Qualification-Degree</label>
                                    <ErrorMessage name="qualification" class="text-danger mt-1" />
                                </div>

                                <div class="col input-group-fname">
                                    <Field required name="experience" as="select" class="form-control input"
                                        autocomplete="off" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Work Experience</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="experience" class="user-label">Work Experience</label>
                                    <ErrorMessage name="experience" class="text-danger mt-1" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required name="immediate_manager" as="select" class="form-control input"
                                        autocomplete="off" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Immediate-Manager</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="immediate_manager" class="user-label">Immediate-Manager</label>
                                    <ErrorMessage name="immediate_manager" class="text-danger mt-1" />
                                </div>

                                <div class="col input-group-fname">
                                    <Field required type="text" onfocus="(this.type='date')"
                                        name="immediate_manager_code" placeholder="Employee Code"
                                        :class="{ 'is-invalid': errors.immediate_manager_code }" class="input"
                                        autocomplete="off" />
                                    <label for="Probation End Date" class="user-label ">Employee Code</label>
                                    <ErrorMessage name="immediate_manager_code" class="text-danger mt-1" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required name="leave_approving_auth" as="select" class="form-control input"
                                        autocomplete="off" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Leave Approving Authority</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="leave_approving_auth" class="user-label">Leave Approving
                                        Authority</label>
                                    <ErrorMessage name="leave_approving_auth" class="text-danger mt-1" />
                                </div>

                                <div class="col input-group-fname">
                                    <Field required type="text" onfocus="(this.type='date')" name="leave_approving_code"
                                        placeholder="Employee Code"
                                        :class="{ 'is-invalid': errors.leave_approving_code }" class="input"
                                        autocomplete="off" />
                                    <label for="Probation End Date" class="user-label ">Employee Code</label>
                                    <ErrorMessage name="leave_approving_code" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required name="department" as="select" class="form-control input"
                                        autocomplete="off" style="color: #7e7e7e;">
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
                                        autocomplete="off" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Job Role*</option>
                                        <option v-for="role in roles?.data" :key="role.id" :value="role.id">
                                            {{ role.name }}
                                        </option>
                                    </Field>
                                    <label for="html" class="user-label">Job Role*</label>
                                    <ErrorMessage name="role_id" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field required name="grade" as="select" class="form-control input"
                                        autocomplete="off" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Grade</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="Grade" class="user-label">Grade</label>
                                    <ErrorMessage name="grade" class="text-danger mt-1" />
                                </div>
                                <div class="col input-group-fname">
                                    <Field required name="employment_type" as="select" class="form-control input"
                                        autocomplete="off" style="color: #7e7e7e;">
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
                                    <Field required type="number" name="aadhar_number" placeholder="Aadhar Number"
                                        :class="{ 'is-invalid': errors.aadhar_number }" class="input"
                                        autocomplete="off" />
                                    <label for="Aadhar Number" class="user-label">Aadhar Number</label>
                                    <ErrorMessage name="aadhar_number" class="text-danger mt-1" />
                                </div>
                                <div class="col input-group-fname">
                                    <Field type="text" name="pan_number" placeholder="PAN Number"
                                        :class="{ 'is-invalid': errors.pan_number }" class="input" autocomplete="off" />
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
                                        autocomplete="off" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Holiday Year</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="Holiday Year" class="user-label">Holiday Year</label>
                                    <ErrorMessage name="holiday_year" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row d-flex">

                                <div class="col input-group-fname">
                                    <Field required name="work_pattern" as="select" class="form-control input"
                                        autocomplete="off" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Work Pattern</option>
                                        <option value="Option1">Option1</option>
                                        <option value="Option2">Option2</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label for="Holiday Year" class="user-label">Work Pattern</label>
                                    <ErrorMessage name="work_pattern" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row d-flex">
                                <div class="col input-group-fname">
                                    <Field required type="text" name="earning_leave_entitlement"
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
                                    <Field required type="text" name="this_year" placeholder="This Year"
                                        :class="{ 'is-invalid': errors.this_year }" class="input" autocomplete="off" />
                                    <label for="PAN Number" class="user-label">This Year</label>
                                    <ErrorMessage name="this_year" class="text-danger mt-1" />
                                </div>

                                <div class="col input-group-fname">
                                    <Field required type="text" name="next_year" placeholder="Next Year"
                                        :class="{ 'is-invalid': errors.next_year }" class="input" autocomplete="off" />
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
                                    <UploadDoc v-for="component in uploadComponent" :is="component" :key="component.id"
                                        @delete-input="deleteInput(component.id)" @update-ref="updateDocRefValue">
                                    </UploadDoc>
                                    <!-- <div class="col-sm-4">
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
                                                        <div class="p4">PF & ESIC information</div>
                                                    </div>

                                                    <div class="d-flex justify-content-center align-items-center"
                                                        style="gap: 24px;">
                                                        <button type="button" class="btn btn-primary updoc">Upload
                                                            Document</button>
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
                                                        <button type="button" class="btn btn-primary updoc">Upload
                                                            Document</button>
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
                                                        <button type="button" class="btn btn-primary updoc">Upload
                                                            Document</button>
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
                                                        <button type="button" class="btn btn-primary updoc">Upload
                                                            Document</button>
                                                        <div class="removeTask"><i
                                                                class="fa-solid fa-square-minus fa-lg "
                                                                style="color: #ffffff;"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="col-sm-4">
                                        <div class="card  card2">
                                            <div class="card-body d-flex justify-content-center align-items-center">
                                                <div class="showalltask-card d-flex flex-column">
                                                    <button type="button" class="btn btn-primary updoc"
                                                        data-toggle="modal" data-target="#AddDocModal"
                                                        @click="addComponent">Add
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
                                                    style="color: #2DB9F8;"> {{ userDetail.first_name }} {{
                                                        userDetail.last_name }}</span> is successfully
                                                entered into the system. </div>
                                        </div>
                                        <div style="font-size: 13px;font-weight: 500">Unique employee ID <span
                                                style="color: #2DB9F8;">{{ userDetail.employee_id }}</span> is
                                            generated.</div>
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
                            <a id="myAnchor" class="btn btn-outline-light cancle"
                                @click="cancel">Cancel</a>
                        </div>
                    </div>

                </Form>
            </form>
        </div>

    </div>
</template>


<script setup>



</script>

<script setup>
import { onMounted, watch } from "vue";
import {useRouter} from 'vue-router'
import { Form, Field, ErrorMessage, useForm } from 'vee-validate';
import * as yup from 'yup';
import useRoles from "@/composables/roles";
import { ref, reactive, computed, inject } from 'vue';
import useUsers from "@/composables/users";
const router = useRouter()
const { user, storeUser, validationErrors, validationMessage, isLoading } = useUsers();
const { roles, getRoles } = useRoles();
const swal = inject('$swal')
const currentStep = ref(0);
const boxWidth = ref(0); // Initial width
const sameAsLocal = ref(false);
const localAddress = ref({});
const perAddress = ref({});
const userDetail = ref({});
const preview = ref();

watch(sameAsLocal, (current, previous) => {
    if(sameAsLocal.value === true) {
        perAddress.value = localAddress.value;
    } else {
        perAddress.value = {};
    }
});

// Each step should have its own validation schema
const schemas = [
  yup.object({
    first_name: yup.string().required("Required!").min(3, 'Name must be at least 3 characters').max(30, 'Name must be at max 30 characters'),
    middle_name: yup.string().nullable().max(30, 'Name must be at max 30 characters'),
    last_name: yup.string().required("Required!").min(3, 'Name must be at least 3 characters').max(30, 'Name must be at max 30 characters'),
    email: yup.string().required().matches(/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i, 'Invalid email format'),
    secondary_email: yup.string().email('Invalid Email').nullable(),
    phone: yup.string().required("Required!").min(10).max(10),
    alternate_phone: yup.string().nullable().test('length', 'The field must be exactly 10 characters long or null', 
          value => value === null || value === '' || value.length === 10),
    gender: yup.string().required("Required!"),
    password: yup.string().required("Required!"),
    dob: yup.string().required("Required!"),
    address: yup.string().required("Required!"),
    address_1: yup.string().required("Required!"),
    city: yup.string().required("Required!"),
    state: yup.string().required("Required!"),
    country: yup.string().required("Required!"),
    postcode: yup.string().required("Required!").test('length', 'Invalid postcode', 
            value => value === null || value === '' || value.length === 6),

    p_address: yup.string().required("Required!"),
    p_address_1: yup.string().required("Required!"),
    p_city: yup.string().required("Required!"),
    p_state: yup.string().required("Required!"),
    p_country: yup.string().required("Required!"),
    p_postcode: yup.string().required("Required!").test('length', 'Invalid postcode', 
            value => value === null || value === '' || value.length === 6),
  }),
  yup.object({
    employee_id: yup.string().required("Required!"),
    role_id: yup.string().required("Required!"),
    doj: yup.string().required("Required!"),
    prob_end_date: yup.string().required("Required!"),
    // aadhar_number: yup.string().required("Required!"),
    // pan_number: yup.string().required("Required!"),
    aadhar_number: yup.string().nullable().test('length', 'Invalid Aadhar number', 
          value => value === null || value === '' || value.length === 12),
    pan_number: yup.string().nullable().test('length', 'Invalid PAN number', 
          value => value === null || value === '' || value.length === 10),
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

onMounted(() => {
    getRoles()
})

// Initial values
const formValues = {
    first_name: '',
    middle_name: '',
    last_name: '',
    email: '',
    secondary_email: '',
    phone: '',
    alternate_phone: '',
    gender: '',
    dob: '',
    address: '',
    p_address: '',
    address_1: '',
    p_address_1: '',
    city: '',
    p_city: '',
    country: '',
    p_country: '',
    state: '',
    p_state: '',
    postcode: '',
    p_postcode: '',
    user: '',
    employee_id: Math.floor(Math.random() * 10000000),
    doj: '',
    prob_end_date: '',
    company: '',
    location: '',
    qualification: '',
    experience: '',
    immediate_manager: '',
    immediate_manager_code: '',
    leave_approving_auth: '',
    leave_approving_code: '',
    department: '',
    role_id: '',
    grade: '',
    employment_type: '',
    aadhar_number: '',
    pan_number: '',
    holiday_year: '',
    work_pattern: '',
    earning_leave_entitlement: '',
    this_year: '',
    next_year: ''
};

const isImage = (file) => {
    return file;
}
// const isVideo = (file) => {
//     return file && file.type.startsWith('data:video');
// }
const profilePic = ref();
const filesToUpload = ref({});
const uploadTempFile = async (event) => {
    const file = event.target.files[0];
    if (file.size > 1024 * 1024 * 10) {
            swal({
                icon: "error",
                title: "File too big! Maximum file size is 10MB.",
            });
            return;
        }
        if(!['image/png','image/jpeg','image/jpg'].includes(file.type)){
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
        // filesToUpload.value.push(tempPath);
        filesToUpload.value.user_profile_picture = tempPath;
        userDetail.value.user_profile_picture = tempPath;
        console.log(filesToUpload.value);
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
    await storeUser(user);
}

async function nextStep(values, user) {
  if (currentStep.value === 3) {
    userDetail.value = values;
    // values.user_profile_picture = profilePic.value;
    Object.assign(values, filesToUpload.value);
    return submitForm(values).then(response => { currentStep.value++; boxWidth.value = '72'; } ).catch(error => { return });
  }
  userDetail.value = values;
  console.log('vipan', userDetail);
  currentStep.value++;
  boxWidth.value = currentStep.value == 1 ? '18' : currentStep.value == 2 ? '36' : currentStep.value == 3 ? '54' : currentStep.value == 4 ? '72' : '0';
}

function cancel() {
    router.push({ name: 'admin.dashboard' })
}
function prevStep() {
  if (currentStep.value <= 0) {
    return;
  }
  currentStep.value--;
  boxWidth.value = currentStep.value == 1 ? '18' : currentStep.value == 2 ? '36' : currentStep.value == 3 ? '54' : currentStep.value == 4 ? '72' : '0';
}

import UploadDoc from "../../../components/UploadDoc.vue";



const updateDocRefValue = (newValue) => {
    filesToUpload.value[newValue.name] = newValue.path;
    console.log('Rahul',newValue);
    console.log(filesToUpload.value);
}
const uploadComponent = ref([
    {
        id : Math.random().toString(36).substring(7),
        title:'Aadhar Card Number',
        type:'aadhar_proof',
        edit:false
    },
    {
        id : Math.random().toString(36).substring(7),
        title:'PAN Card',
        type:'pan_proof',
        edit:false
    },
    {
        id : Math.random().toString(36).substring(7),
        title:'PF & ESIC information',
        type:'doc',
        edit:true
    },
    {
        id : Math.random().toString(36).substring(7),
        title:'Confirmation letter',
        type:'doc',
        edit:true
    },
    {
        id : Math.random().toString(36).substring(7),
        title:'Education Document',
        type:'doc',
        edit:true
    },
    {
        id : Math.random().toString(36).substring(7),
        title:'Experience Letter',
        type:'doc',
        edit:true
    }
]);

const addComponent = () => {
      uploadComponent.value.push({
        id: Math.random().toString(36).substring(7),
        title: "Document",
        edit:true
      });
    }

const deleteInput = (id) => {
    uploadComponent.value.splice(uploadComponent.value.findIndex(component => component.id === id), 1);
};
</script>

<style>
@import '@/assets/css/onBoard.css';
</style>

<style>
.preview img,
.preview video {
    max-width: 300px;
    max-height: 300px;
    margin-top: 10px;
}
</style>