<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container">
        <div id="dashboard-table-info">
            <span>Employee Roles</span>
            <span>Employee Roles > Employee Roles</span>
        </div>

        <div class="container header d-flex flex-column" style="gap: 1.5rem;">
            <div class="sec d-flex flex-column">
                <p>Update Employee Roles</p>
                <p>Update employee role and it's permissions to access portal features.</p>
            </div>
            <form @submit.prevent="submitForm">
                <div class="container d-flex flex-column" style="gap: 2rem;">

                    <div class="row">
                        <div class="col input-group-fname">
                            <input placeholder="Role Name*" v-model="role.name" type="text" autocomplete="off"
                                class="input" id="RoleName-Value" required>
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
                            <h6>Employee Management</h6>
                            <div class="d-flex" style="gap: 2rem;">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="user-create"
                                        v-model="role.permissions" id="OnBoard">
                                    <label class="custom-control-label" for="OnBoard">On-Board</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="user-delete"
                                        v-model="role.permissions" id="DeBoard">
                                    <label class="custom-control-label" for="DeBoard">De-Board</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="user-edit"
                                        v-model="role.permissions" id="Upprofile">
                                    <label class="custom-control-label" for="Upprofile">Update Profile</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="user-view"
                                        v-model="role.permissions" id="viewProf">
                                    <label class="custom-control-label" for="viewProf">View Profile</label>
                                </div>
                            </div>
                        </div>


                        <div class="inner-div d-flex flex-column" style="gap: 5px;">
                            <h6>Leave Management</h6>
                            <div class="d-flex" style="gap: 2rem;">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="leave-edit"
                                        v-model="role.permissions" id="leaveApp">
                                    <label class="custom-control-label" for="leaveApp">Leave Approval</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="leave-list"
                                        v-model="role.permissions" id="viewleavHis">
                                    <label class="custom-control-label" for="viewleavHis">View Leave History</label>
                                </div>
                            </div>
                        </div>

                        <div class="inner-div d-flex flex-column" style="gap: 5px;">
                            <h6>Payroll</h6>
                            <div class="d-flex" style="gap: 2rem;">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="payroll-create"
                                        v-model="role.permissions" id="GenPay">
                                    <label class="custom-control-label" for="GenPay">Generate Payroll</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="btns-Update-cancle">
                        <button type="submit" :disabled="isLoading" class="btn btn-primary savenext">Update</button>
                        <a href="/admin/EmployeeRole" class="btn btn-outline-light cancle">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, reactive, watchEffect, inject } from "vue";
import useRoles from "@/composables/roles";
import { useForm, useField, ErrorMessage } from "vee-validate";
import { useRoute } from "vue-router";
import * as yup from 'yup';
const swal = inject("$swal");
const route = useRoute()
const { role: postData, getRole, updateRole, validationErrors, storeRole, isLoading } = useRoles();
import useAuth from "../../../composables/auth";
const { getUser } = useAuth() 

// Define a validation schema
const schema =
    yup.object({
        name: yup.string().required("Please enter the required field").matches(/^[aA-zZ\s]+$/, "Only alphabets are allowed for this field "),
    });

// Create a form context with the validation schema
const { validate, errors } = useForm({ validationSchema: schema });
const { value: name } = useField('name', null, { initialValue: '' });

const role = reactive({
    name
})

onMounted(() => {
    getRole(route.params.id)
})

const checkedValues = (jsonArray) => {
    if (Object.keys(jsonArray).length === 0) return []
    const namesArray = jsonArray.map(obj => obj.slug);
    return namesArray;
}

watchEffect(() => {
    role.id = postData.value.id
    role.name = postData.value.name
    role.permissions = checkedValues(postData.value.permissions)
});

const submitForm = () => {
    if(Object.keys(role.permissions).length === 0) {
        swal({
            icon: 'error',
            title: 'Please select atleast one permission'
        });
    } else {
        validate().then(form => { if (form.valid) updateRole(role) })
        getUser()
    }
    
};

</script>

<style scoped>
@import '@/assets/css/EmployeeRoleEdit.css';
</style>