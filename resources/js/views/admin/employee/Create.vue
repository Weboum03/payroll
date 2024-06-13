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
            <form @submit.prevent="submitForm">
                <div class="container d-flex flex-column" style="gap: 2rem;">

                    <div class="row">
                        <div class="col input-group-fname">
                            <input placeholder="Role Name*" v-model="role.name" name="name" type="text" value=""
                                autocomplete="off" class="input" id="RoleName-Value" required>
                            <label class="user-label">Role Name*</label>
                            <ErrorMessage name="name" class="text-danger mt-1" />
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.name">
                                    {{ message }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="outter-div d-flex flex-column" style="gap: 1.5rem;">
                        <div class="inner-div d-flex flex-column" style="gap: 5px;">
                            <ErrorMessage name="permissions" class="text-danger mt-1" />
                            <h6>Employee Management</h6>
                            <div class="d-flex" style="gap: 2rem;">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="user-create"
                                        v-model="permissions" id="OnBoard">
                                    <label class="custom-control-label" for="OnBoard">On-Board</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="user-delete"
                                        v-model="permissions" id="DeBoard">
                                    <label class="custom-control-label" for="DeBoard">De-Board</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="user-edit"
                                        v-model="permissions" id="Upprofile">
                                    <label class="custom-control-label" for="Upprofile">Update Profile</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="user-view"
                                        v-model="permissions" id="viewProf">
                                    <label class="custom-control-label" for="viewProf">View Profile</label>
                                </div>

                            </div>
                        </div>


                        <div class="inner-div d-flex flex-column" style="gap: 5px;">
                            <h6>Leave Management</h6>
                            <div class="d-flex" style="gap: 2rem;">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="leave-edit"
                                        v-model="permissions" id="leaveApp">
                                    <label class="custom-control-label" for="leaveApp">Leave Approval</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="leave-list"
                                        v-model="permissions" id="viewleavHis">
                                    <label class="custom-control-label" for="viewleavHis">View Leave History</label>
                                </div>
                            </div>
                        </div>

                        <div class="inner-div d-flex flex-column" style="gap: 5px;">
                            <h6>Payroll</h6>
                            <div class="d-flex" style="gap: 2rem;">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="payroll-create"
                                        v-model="permissions" id="GenPay">
                                    <label class="custom-control-label" for="GenPay">Generate Payroll</label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="btns-Update-cancle">
                        <button type="submit" :disabled="isLoading" class="btn btn-primary savenext">Add Role</button>
                        <router-link :to="{ name: 'admin.EmployeeRole' }" class="btn btn-outline-light cancle">
                            Cancel
                        </router-link>
                    </div>

                </div>

            </form>
        </div>


    </div>
</template>


<script setup>
import { ref, reactive, inject } from "vue";
import useRole from "@/composables/useRole";
import * as yup from 'yup';
import { useRouter } from 'vue-router'
import { useForm, useField, ErrorMessage } from "vee-validate";
const swal = inject("$swal");
const router = useRouter()

// Define a validation schema
const schema =
    yup.object({
        name: yup.string().required("Please enter the required field").matches(/^[aA-zZ\s]+$/, "Only alphabets are allowed for this field "),
    });
// Create a form context with the validation schema
const { validate, errors } = useForm({ validationSchema: schema });
// Define actual fields for validation
const { value: name } = useField('name', null, { initialValue: '' });

const { create: storeRole, validationErrors, loading: isLoading, error, success } = useRole();

let permissions = ref([]);
const role = reactive({
    name,
    permissions
})
async function submitForm() {
    if (Object.keys(permissions.value).length === 0) {
        swal({
            icon: 'error',
            title: 'Please select atleast one permission'
        });
    } else {
        validate().then(async form => {
            if (form.valid) {
                await storeRole(role)
                if (success.value) { router.push({ name: 'admin.EmployeeRole' }) }
            }
        })
    }
}
</script>

<style scoped>
@import '@/assets/css/EmployeeRoleEdit.css';
</style>