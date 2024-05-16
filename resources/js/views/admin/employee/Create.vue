<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container">
        <div id="dashboard-table-info">
            <span>Employee Roles</span>
            <span>Employee Roles > Employee Roles</span>
        </div>

        <div class="container header d-flex flex-column" style="gap: 1.5rem;">
            <div class="sec d-flex flex-column">
                <p>Create Employee Roles</p>
                <p>Create employee role and it's permissions to access portal features.</p>
            </div>

            <div class="container d-flex flex-column" style="gap: 2rem;">
                <form @submit.prevent="submitForm">
                <div class="row">
                    <div class="col input-group-fname">
                        <input placeholder="Role Name*" v-model="role.name" type="text" value="" autocomplete="off" class="input"
                            id="RoleName-Value" required>
                        <label class="user-label">Role Name*</label>
                        <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.name">
                                    {{ message }}
                                </div>
                        </div>
                    </div>
                </div>

                <div class="outter-div d-flex flex-column" style="gap: 1.5rem;">
                    <div class="inner-div d-flex flex-column" style="gap: 5px;">
                        <h6>Employee Management</h6>
                        <div class="d-flex" style="gap: 2rem;">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="user-create" v-model="permissions" id="OnBoard">
                                <label class="custom-control-label" for="OnBoard">On-Board</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="user-delete" v-model="permissions" id="DeBoard">
                                <label class="custom-control-label" for="DeBoard">De-Board</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="user-edit" v-model="permissions" id="Upprofile">
                                <label class="custom-control-label" for="Upprofile">Update Profile</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="user-view" v-model="permissions" id="viewProf">
                                <label class="custom-control-label" for="viewProf">View Profile</label>
                            </div>

                        </div>
                    </div>


                    <div class="inner-div d-flex flex-column" style="gap: 5px;">
                        <h6>Leave Management</h6>
                        <div class="d-flex" style="gap: 2rem;">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="leave-edit" v-model="permissions" id="leaveApp">
                                <label class="custom-control-label" for="leaveApp">Leave Approval</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="leave-list" v-model="permissions" id="viewleavHis">
                                <label class="custom-control-label" for="viewleavHis">View Leave History</label>
                            </div>
                        </div>
                    </div>

                    <div class="inner-div d-flex flex-column" style="gap: 5px;">
                        <h6>Payroll</h6>
                        <div class="d-flex" style="gap: 2rem;">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="payroll-create" v-model="permissions" id="GenPay">
                                <label class="custom-control-label" for="GenPay">Generate Payroll</label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="btns-Update-cancle">
                    <button type="submit" :disabled="isLoading" class="btn btn-primary savenext">Save</button>
                    <a href="/admin/EmployeeRole" class="btn btn-outline-light cancle">Cancel</a>
                </div>
                </form>
            </div>


        </div>


    </div>
</template>


<script setup>
import { ref, onMounted, reactive } from "vue";
import useRoles from "@/composables/roles";
import * as yup from 'yup';
import { useForm, useField, defineRule } from "vee-validate";

// Define a validation schema
const schema =
    yup.object({
        name: yup.string().required("Required!"),
    });
// Create a form context with the validation schema
const { validate, errors } = useForm({ validationSchema: schema });
// Define actual fields for validation
const { value: name } = useField('name', null, { initialValue: '' });

const { storeRole, validationErrors, isLoading } = useRoles();

let permissions = ref([]);
const role = reactive({
    name,
    permissions
})
function submitForm() {
    validate().then(form => { if (form.valid) storeRole(role) })
}
</script>

<style scoped>
@import '@/assets/css/EmployeeRoleEdit.css';
</style>