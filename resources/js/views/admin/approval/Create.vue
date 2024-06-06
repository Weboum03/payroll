<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container">
        <div id="dashboard-table-info">
            <span>Leave Request</span>
            <span>Create New Request</span>
        </div>

        <div class="container header d-flex flex-column" style="gap: 1.5rem;">
            <div class="sec d-flex flex-column">
                <p>Create Leave Request</p>
                <p>Create Leave Request.</p>
            </div>
            <Form @submit="submitForm" :validation-schema="schema" v-slot="{ validate, errors }">
                <div class="container d-flex flex-column" style="gap: 2rem;">

                    <div class="row">
                        <div class="col input-group-fname">
                            <Field required name="leave_type_id" as="select" class="form-control input" autocomplete="off"
                                style="color: #7e7e7e;">
                                <option value="" disabled selected>Leave Type</option>
                                <option value="1">Earned Leave</option>
                            </Field>
                            <label for="leave_type_id" class="user-label">Leave Type</label>
                            <ErrorMessage name="leave_type_id" class="text-danger mt-1" />

                        </div>
                    </div>

                    <div class="row">
                        <div class="col input-group-fname">
                            <Field required name="from_type" as="select" class="form-control input" autocomplete="off"
                                style="color: #7e7e7e;">
                                <option value="" disabled selected>From</option>
                                <option value="Full Day">Full Day</option>
                                <option value="Half Day">Half Day</option>
                            </Field>
                            <label for="from_type" class="user-label">From</label>
                            <ErrorMessage name="from_type" class="text-danger mt-1" />

                        </div>

                    </div>
                    <div class="row">
                        <div class="col input-group-fname">
                            <Field type="text" name="from" class="input" onfocus="(this.type='date')"
                                autocomplete="off" placeholder="From Date*"
                                :class="{ 'is-invalid': errors.from }" />
                            <label for="html" class="user-label ">From Date*</label>
                            <ErrorMessage name="from" class="text-danger mt-1" />

                        </div>
                    </div>

                    <div class="row">
                        <div class="col input-group-fname">
                            <Field required name="to_type" as="select" class="form-control input" autocomplete="off"
                                style="color: #7e7e7e;">
                                <option value="" disabled selected>To</option>
                                <option value="Full Day">Full Day</option>
                                <option value="Half Day">Half Day</option>
                            </Field>
                            <label for="to_type" class="user-label">To</label>
                            <ErrorMessage name="to_type" class="text-danger mt-1" />

                        </div>
                    </div>

                    <div class="row">
                        <div class="col input-group-fname">
                            <Field type="text" name="to" class="input" onfocus="(this.type='date')"
                                autocomplete="off" placeholder="To Date*"
                                :class="{ 'is-invalid': errors.to }" />
                            <label for="html" class="user-label ">To Date*</label>
                            <ErrorMessage name="to" class="text-danger mt-1" />

                        </div>
                    </div>

                    <div class="row d-flex">

                        <div class="col input-group-fname">
                            <Field type="text" as="textarea" name="reason" :class="{ 'is-invalid': errors.reason }"
                                placeholder="Reason" class="input1" id="additionalComment"
                                autocomplete="off" />
                            <label for="reason" class="user-label">Reason</label>
                            <ErrorMessage name="reason" class="text-danger mt-1" />
                        </div>
                    </div>

                    <div class="btns-Update-cancle">
                        <button type="submit" :disabled="isLoading"  @click="validate" class="btn btn-primary savenext">Save</button>
                        <router-link :to="{name: 'admin.home'}" class="btn btn-outline-light cancle">Cancel</router-link>
                    </div>

                </div>

            </Form>
        </div>


    </div>
</template>


<script setup>
import { inject } from "vue";
import useLeaves from "@/composables/leaves";
import * as yup from 'yup';
import { Form, Field, ErrorMessage } from "vee-validate";
const swal = inject("$swal");

// Define a validation schema
const schema =
    yup.object({
        leave_type_id: yup.string().required("Please enter the required field"),
        from_type: yup.string().required("Please enter the required field"),
        from: yup.string().required("Please enter the required field"),
        to_type: yup.string().required("Please enter the required field"),
        to: yup.string().required("Please enter the required field"),
        reason: yup.string().required("Please enter the required field")
    });

const { storeLeave, validationErrors, isLoading } = useLeaves();

function submitForm(values, action) {
    return storeLeave(values).then( (response) => {
        action.resetForm();
    });
}
</script>

<style scoped>
@import '@/assets/css/EmployeeRoleEdit.css';

.input-group-fname>.input1 {
    width: 780px !important;
    height: 110px;
    width: 332px;
    border: solid 1px #9e9e9e;
    padding: 8px !important;
    border-radius: 11px;
    background-color: white !important;
    font-size: .95rem;
    color: #000000;
    transition: border 150ms cubic-bezier(0.4, 0, 0.2, 1);
}
</style>