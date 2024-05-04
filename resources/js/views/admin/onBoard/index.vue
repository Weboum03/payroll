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
                    <div class="progress" id="progress"></div>

                    <div class="progress-step progress-step-active" data-title="Personal Information"></div>
                    <div class="progress-step" data-title="Job Information"></div>
                    <div class="progress-step" data-title="Attendance & Leaves"></div>
                    <div class="progress-step" data-title="Tasks"></div>
                    <div class="progress-step" data-title="Done"></div>
                </div>

                <Form @submit="nextStep" keep-values :validation-schema="currentSchema"
                    v-slot="{ handleSubmit, values, errors }">

                    <template v-if="currentStep === 0">
                        <!-- Steps -->
                        <div class="form-step form-step-active">
                            <div class="personal-infor">
                                <div class="row">
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="first_name"
                                            class="input" autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.first_name }" placeholder="First Name*"
                                                type="text" autocomplete="off" class="input" required>
                                        </Field>
                                        <label class="user-label">First Name*</label>
                                        <ErrorMessage name="first_name" class="text-danger mt-1" />
                                    </div>
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="last_name"
                                            class="input" autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.last_name }" placeholder="Last Name*"
                                                type="text" autocomplete="off" class="input" required>
                                        </Field>
                                        <label class="user-label">First Name*</label>
                                        <ErrorMessage name="last_name" class="text-danger mt-1" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="email" class="input"
                                            autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.email }" placeholder="Email" type="text"
                                                autocomplete="off" class="input" required>
                                        </Field>
                                        <label class="user-label">Email</label>
                                        <ErrorMessage name="email" class="text-danger mt-1" />
                                    </div>
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="phone" class="input"
                                            autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.phone }" placeholder="Phone" type="text"
                                                autocomplete="off" class="input" required>
                                        </Field>
                                        <label class="user-label">Mobile</label>
                                        <ErrorMessage name="phone" class="text-danger mt-1" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col input-group-fname">
                                        <Field name="gender" as="select" class="form-control input" autocomplete="off"
                                            style="color: #7e7e7e;">
                                            <option value="" disabled selected>Select</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </Field>
                                        <label class="user-label">Gender</label>
                                        <ErrorMessage name="gender" class="text-danger mt-1" />
                                    </div>
                                    <div class="col input-group-fname">

                                        <Field v-slot="{ field, handleChange }" type="date" name="dob" class="input"
                                            autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.dob }" onfocus="(this.type='date')"
                                                id="dob-Value" placeholder="Date of Birth*" type="text"
                                                autocomplete="off" class="input" required>
                                        </Field>
                                        <label class="user-label ">Date of Birth</label>
                                        <ErrorMessage name="dob" class="text-danger mt-1" />
                                        <span class="dateIcon1 input-group-append">
                                            <span style=" position: relative; bottom: 31px; left: 300px;"><i
                                                    class="fas fa-calendar-alt"></i></span>
                                        </span>
                                    </div>
                                </div>


                                <div class="p1">Adderss</div>



                                <div class="row d-flex">

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="address" class="input"
                                            autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.address }" placeholder="address"
                                                type="text" autocomplete="off" class="input" required>
                                        </Field>
                                        <label class="user-label">Address Line 1</label>
                                        <ErrorMessage name="address" class="text-danger mt-1" />
                                    </div>
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="address_1"
                                            class="input" autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.address_1 }" placeholder="address 1"
                                                type="text" autocomplete="off" class="input" required>
                                        </Field>
                                        <label class="user-label">Address Line 2</label>
                                        <ErrorMessage name="address_1" class="text-danger mt-1" />
                                    </div>
                                </div>
                                <div class="row d-flex">

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="city" class="input"
                                            autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.city }" placeholder="city" type="text"
                                                autocomplete="off" class="input" required>
                                        </Field>
                                        <label class="user-label">City/Town</label>
                                        <ErrorMessage name="city" class="text-danger mt-1" />
                                    </div>
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="state" class="input"
                                            autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.state }" placeholder="state" type="text"
                                                autocomplete="off" class="input" required>
                                        </Field>
                                        <label class="user-label">State</label>
                                        <ErrorMessage name="state" class="text-danger mt-1" />
                                    </div>
                                </div>
                                <div class="row d-flex">

                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="country" class="input"
                                            autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.country }" placeholder="country"
                                                type="text" autocomplete="off" class="input" required>
                                        </Field>

                                        <label class="user-label">Country</label>
                                        <ErrorMessage name="country" class="text-danger mt-1" />
                                    </div>
                                    <div class="col input-group-fname">
                                        <Field v-slot="{ field, handleChange }" type="text" name="postcode"
                                            class="input" autocomplete="off">
                                            <input @change="handleChange" :value="field.value"
                                                :class="{ 'is-invalid': errors.postcode }" placeholder="postcode"
                                                type="text" autocomplete="off" class="input" required>
                                        </Field>
                                        <label class="user-label">Post Code</label>
                                        <ErrorMessage name="postcode" class="text-danger mt-1" />
                                    </div>
                                </div>
                                <div class="p1">Uplode Image</div>

                                <input type="file" name="Uplode Photo" id="uplodePhoto" placeholder=" Darg and Drop">
                            </div>
                        </div>
                    </template>


                    <template v-if="currentStep === 1">
                        <div class="form-step form-step-active">
                            <div class="profile d-flex">
                                <div class="icon_wrap d-flex align-items-center" style="gap: .5rem;">
                                    <img :src="apiPath + 'resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'"
                                        alt="profile_pic">
                                    <span class="name">John Alex</span>
                                </div>
                            </div>

                            <div class="row d-flex">
                                <div class="col input-group-fname">
                                    <Field name="user" as="select" class="form-control input" autocomplete="off"
                                        style="color: #7e7e7e;">
                                        <option value="" disabled selected>Copy Existing details</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </Field>
                                    <label class="user-label">Copy Existing details</label>
                                    <ErrorMessage name="user" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row d-flex">
                                <div class="col input-group-fname">
                                    <Field type="text" name="employee_id" placeholder="Employee ID"
                                        :class="{ 'is-invalid': errors.employee_id }" class="input"
                                        autocomplete="off" />
                                    <label class="user-label">Employee ID</label>
                                    <ErrorMessage name="employee_id" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field type="text" name="start_date" placeholder="start date"
                                        :class="{ 'is-invalid': errors.start_date }" class="input" autocomplete="off" />
                                    <label class="user-label ">Start Date</label>
                                    <span class="dateIcon1 input-group-append">
                                        <span style=" position: relative; bottom: 31px; left: 300px;"><i
                                                class="fas fa-calendar-alt"></i></span>
                                    </span>
                                    <ErrorMessage name="start_date" class="text-danger mt-1" />
                                </div>
                                <div class="col input-group-fname">
                                    <Field type="text" name="prob_end_date" placeholder="Probation End Date"
                                        :class="{ 'is-invalid': errors.prob_end_date }" class="input"
                                        autocomplete="off" />
                                    <label class="user-label ">Probation End Date</label>
                                    <ErrorMessage name="prob_end_date" class="text-danger mt-1" />
                                    <span class="dateIcon1 input-group-append">
                                        <span style=" position: relative; bottom: 31px; left: 300px;"><i
                                                class="fas fa-calendar-alt"></i></span>
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field name="company" as="select" class="form-control input" autocomplete="off"
                                        style="color: #7e7e7e;">
                                        <option value="" disabled selected>Copy Existing details</option>
                                        <option value="company 1">Company 1</option>
                                        <option value="company 2">Company 2</option>
                                        <option value="company 3">Company 3</option>
                                    </Field>
                                    <label class="user-label">Company</label>
                                    <ErrorMessage name="prob_end_date" class="text-danger mt-1" />
                                </div>
                                <div class="col input-group-fname">
                                    <Field name="location" as="select" class="form-control input" autocomplete="off"
                                        style="color: #7e7e7e;">
                                        <option value="" disabled selected>Location</option>
                                        <option value="location 1">Location 1</option>
                                        <option value="location 2">Location 2</option>
                                        <option value="location 3">Location 3</option>
                                    </Field>
                                    <label class="user-label">Location</label>
                                    <ErrorMessage name="location" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field name="department" as="select" class="form-control input" autocomplete="off"
                                        style="color: #7e7e7e;">
                                        <option value="" disabled selected>Location</option>
                                        <option value="Department 1">Department 1</option>
                                        <option value="Department 2">Department 2</option>
                                        <option value="Department 3">Department 3</option>
                                    </Field>
                                    <label class="user-label">Department</label>
                                    <ErrorMessage name="department" class="text-danger mt-1" />
                                </div>
                                <div class="col input-group-fname">
                                    <Field name="job_role" as="select" class="form-control input" autocomplete="off"
                                        style="color: #7e7e7e;">
                                        <option value="" disabled selected>Select</option>
                                        <option value="HR">HR</option>
                                        <option value="Developer">Developer</option>
                                        <option value="Tester">Tester</option>
                                    </Field>
                                    <label class="user-label">Job Role</label>
                                    <ErrorMessage name="job_role" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field name="grade" as="select" class="form-control input" autocomplete="off"
                                        style="color: #7e7e7e;">
                                        <option value="" disabled selected>Select</option>
                                        <option value="A">Grade A</option>
                                        <option value="B">Grade B</option>
                                        <option value="C">Grade C</option>
                                    </Field>
                                    <label class="user-label">Grade</label>
                                    <ErrorMessage name="grade" class="text-danger mt-1" />
                                </div>
                                <div class="col input-group-fname">
                                    <Field name="employment_type" as="select" class="form-control input"
                                        autocomplete="off" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Select</option>
                                        <option value="A">Employment Type A</option>
                                        <option value="B">Employment Type B</option>
                                        <option value="C">Employment Type C</option>
                                    </Field>
                                    <label class="user-label">Employment Type</label>
                                    <ErrorMessage name="employment_type" class="text-danger mt-1" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <Field type="text" name="aadhar_number" placeholder="Aadhar number"
                                        :class="{ 'is-invalid': errors.aadhar_number }" class="input"
                                        autocomplete="off" />
                                    <label class="user-label">Aadhar Number</label>
                                    <ErrorMessage name="aadhar_number" class="text-danger mt-1" />
                                </div>
                                <div class="col input-group-fname">
                                    <Field type="text" name="pan_number" placeholder="Pan Number"
                                        :class="{ 'is-invalid': errors.pan_number }" class="input" autocomplete="off" />
                                    <label class="user-label">PAN Number</label>
                                    <ErrorMessage name="pan_number" class="text-danger mt-1" />
                                </div>
                            </div>
                        </div>
                    </template>


                    <template v-if="currentStep === 2">
                        <div class="form-step form-step-active">
                            <div class="profile d-flex">
                                <div class="icon_wrap d-flex align-items-center" style="gap: .5rem;">
                                    <img :src="apiPath + 'resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'"
                                        alt="profile_pic">
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
                                    <input placeholder="Annual Earned Leave Entitlement"
                                        id="AnnualEarnedLeaveEntitlement" required="" type="text" name="text"
                                        autocomplete="off" class="input">
                                    <label class="user-label">Annual Earned Leave Entitlement</label>
                                </div>
                                <div class="container p2">If during probation no leaves are avaliable for employees,
                                    then please set 0 as entitements below. You will able to set the entitlements later
                                    on when marking the employee as confirmed</div>
                            </div>

                            <div class="row">
                                <div class="col input-group-fname">
                                    <input placeholder="This Year" required="" type="text" name="text"
                                        autocomplete="off" class="input">
                                    <label class="user-label">This Year</label>
                                </div>
                                <div class="col input-group-fname">
                                    <input placeholder="Next Year" required="" type="text" name="text"
                                        autocomplete="off" class="input">
                                    <label class="user-label">Next Year</label>
                                </div>
                            </div>
                        </div>
                    </template>

                    <template v-if="currentStep === 3">
                        <div class="form-step form-step-active">
                            <div class="profile1 d-flex">
                                <div class="icon_wrap d-flex align-items-center" style="gap: .5rem;">
                                    <img :src="apiPath + 'resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'"
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

                                                    <a id="myAnchor" href="#" class="btn btn-primary removeTask">Remove
                                                        Task</a>
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
                                                    <a id="myAnchor" href="#" class="btn btn-primary removeTask">Remove
                                                        Task</a>
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
                                                    <a id="myAnchor" href="#" class="btn btn-primary removeTask">Remove
                                                        Task</a>
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

                                                    <a id="myAnchor" href="#" class="btn btn-primary removeTask">Remove
                                                        Task</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="card  card2">
                                            <div class="card-body d-flex justify-content-center align-items-center">
                                                <div class="showalltask-card d-flex flex-column">
                                                    <a id="myAnchor" href="#" class="btn btn-primary removeTask1">Add
                                                        Task</a>
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
                                        style="gap: 1rem;">
                                        <div class="d-flex align-items-center" style="gap: 1rem;"><i
                                                class="fa-solid fa-circle-check fa-xl" style="color: #1B8A5A;"></i>
                                            <div>Done! <span style="color: #2DB9F8;"> Austin Hodges</span> is
                                                successfully
                                                entered into the system.
                                            </div>
                                        </div>
                                        <div class="div-emp-rem"> What would you like to do next?</div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column justify-content-center align-items-center"
                                    style="gap: 2rem;">
                                    <a id="myAnchor" href="/admin.dashboard" class="btn btn-primary removeTask">Finish and
                                        visit
                                        employee's record</a>
                                    <a id="myAnchor" href="/admin/onBoard.html" class="btn btn-primary removeTask">Add
                                        another
                                        employee</a>
                                    <a id="myAnchor" href="/admin/dashboard"
                                        class="btn btn-primary removeTask">Finish and
                                        exit</a>
                                </div>

                            </div>


                        </div>
                    </template>
                    <!-- <template v-if="currentStep === 0">
                    <label for="name">Name</label>
                    <Field name="name" id="name" />
                    <ErrorMessage name="name" />

                    <label for="email">Email</label>
                    <Field name="email" id="email" type="email" />
                    <ErrorMessage name="email" />
                </template>

                <template v-if="currentStep === 1">
                    <label for="password">Password</label>
                    <Field name="password" type="password" id="password" />
                    <ErrorMessage name="password" />

                    <label for="confirmation">Confirm Password</label>
                    <Field name="confirmPassword" type="password" id="confirmation" />
                    <ErrorMessage name="confirmPassword" />
                </template>

                <template v-if="currentStep === 2">
                    <label for="address">Address</label>
                    <Field as="textarea" name="address" id="address" />
                    <ErrorMessage name="address" />

                    <label for="postalCode">Postal Code</label>
                    <Field name="postalCode" id="postalCode" />
                    <ErrorMessage name="postalCode" />
                </template>

                <template v-if="currentStep === 3">
                    <label for="terms">Agree to terms and conditions</label>
                    <Field name="terms" type="checkbox" id="terms" :value="true" />
                    <ErrorMessage name="terms" />
                </template>

                <button v-if="currentStep !== 0" type="button" @click="prevStep">
                    Previous
                </button>

                <button v-if="currentStep !== 3" type="submit">Next</button>

                <button v-if="currentStep === 3" type="submit">Finish</button>

                <pre>{{ values }}</pre> -->


                    <div class="btns-save-cancle">
                        <button type="submit" class="btn btn-next btn-primary savenext">Save & Next</button>
                        <button type="button" v-if="currentStep !== 0" @click="prevStep"
                            class="btn btn-next btn-primary savenext">Previous</button>
                        <a id="myAnchor" href="dashboard.html" class="btn btn-outline-light cancle">Cancel</a>
                    </div>
                </Form>
            </form>
        </div>

    </div>
</template>


<script setup>



</script>

<script setup>

import '@/assets/css/onBoard.css'
// import { ref, onMounted } from 'vue';
import { Form, Field, ErrorMessage, useForm } from 'vee-validate';
import * as yup from 'yup';
import { ref, reactive, computed } from 'vue';
import useUsers from "@/composables/users";

const { storeUser, validationErrors, isLoading } = useUsers();

const currentStep = ref(0);

// Each step should have its own validation schema
const schemas = [
  yup.object({
    first_name: yup.string().required("Required!"),
    last_name: yup.string().required("Required!"),
    email: yup.string().required().email(),
    phone: yup.string().required("Required!"),
    gender: yup.string().required("Required!"),
    dob: yup.string().required("Required!"),
    address: yup.string().required("Required!"),
    address_1: yup.string().required("Required!"),
    city: yup.string().required("Required!"),
    state: yup.string().required("Required!"),
    country: yup.string().required("Required!"),
    postcode: yup.string().required("Required!"),
  }),
  yup.object({
    employee_id: yup.string().required("Required!"),
    start_date: yup.string().required("Required!"),
    prob_end_date: yup.string().required("Required!"),
    aadhar_number: yup.string().required("Required!"),
    pan_number: yup.string().required("Required!"),
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

function submitForm(user) {
    storeUser(user)
}

function nextStep(values) {
  if (currentStep.value === 4) {
    submitForm(values);
    return;
  }

  currentStep.value++;
}

function prevStep() {
  if (currentStep.value <= 0) {
    return;
  }

  currentStep.value--;
}
</script>