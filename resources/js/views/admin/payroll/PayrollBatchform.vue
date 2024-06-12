<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container">
        <div id="dashboard-table-info">
            <span>Payroll</span>
            <span>Payroll > Payroll batch</span>
        </div>

        <div class="container d-flex flex-column justify-content-center"
            style="background-color: white;padding: 10px; gap: 1rem;">
            <div class="d-flex justify-content-between align-items-center">
                <div class="Payroll-header">
                    <p>Payroll Batch-March2024_Lipsum</p>
                    <p>Select Employees to add to the batch</p>
                </div>
                <button type="button" id="testRslt" data-toggle="modal" data-target="#testRslt1">Test
                    Rule</button>
            </div>

            <div style="font-size: 10px;color: red;font-weight: 500;">Note: Only those employees who are not
                already added to another batch and meet the below criteria will be added </div>
            <Form @submit="submitForm">
            <div class="container payForm d-flex flex-column" style="gap: 1rem;">
                <div class="row d-flex">
                    <div class="col input-group-fname">
                        <Field as="select" class="form-control input" v-model="filterVlaues.company" id="Companies" name="company" autocomplete="off" style="color: #7e7e7e;">
                            <option value="" selected>All</option>
                            <option value="ABC & Company Ltd.">ABC & Company Ltd.</option>
                            <option value="Accenture Inc">Accenture Inc</option>
                            <option value="North Corp Software">North Corp Software</option>
                            <option value="Cyber Security Ltd">Cyber Security Ltd</option>
                            <option value="other">Other</option>
                        </Field>
                        <label class="user-label">Companies</label>
                    </div>
                </div>

                <div class="row d-flex">
                    <div class="col input-group-fname">
                        <Field as="select" class="form-control input" v-model="filterVlaues.location" id="Location" name="location" autocomplete="off" style="color: #7e7e7e;">
                            <option value="" selected>All</option>
                            <option value="Guru Gram"> Guru Gram</option>
                            <option value="Pune">Pune</option>
                            <option value="Bangluru">Bangluru</option>
                            <option value="California">California</option>
                        </Field>
                        <label class="user-label">Location</label>
                    </div>
                </div>

                <div class="row d-flex">
                    <div class="col input-group-fname">
                        <Field as="select" class="form-control input" v-model="filterVlaues.department" id="Department" name="department" autocomplete="off" style="color: #7e7e7e;">
                            <option value="" selected>All</option>
                            <option value="Software Development">Software Development</option>
                            <option value="Quality Testing">Quality Testing</option>
                            <option value="Designing">Designing</option>
                            <option value="Management">Management</option>
                            <option value="other">Other</option>
                        </Field>
                        <label class="user-label">Department</label>
                    </div>
                </div>
                <div class="row d-flex">
                    <div class="col input-group-fname">
                        <Field as="select" class="form-control input" v-model="filterVlaues.job_role" id="Job-Role" name="role" autocomplete="off" style="color: #7e7e7e;">
                            <option value="" selected>All</option>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </Field>
                        <label class="user-label">Job Role</label>
                    </div>
                </div>
                <div class="row d-flex">
                    <div class="col input-group-fname">
                        <Field as="select" class="form-control input" v-model="filterVlaues.gender" id="Grader" name="gender" autocomplete="off" style="color: #7e7e7e;">
                            <option value="" selected>All</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </Field>
                        <label class="user-label">Gender</label>
                    </div>
                </div>
                <div class="row d-flex">
                    <div class="col input-group-fname">
                        <Field as="select" class="form-control input" v-model="filterVlaues.employment_type" id="Emp-type" name="employment_type" autocomplete="off" style="color: #7e7e7e;">
                            <option value="" selected>All</option>
                            <option value="Regular">Regular</option>
                            <option value="Consultant">Contract</option>
                            <option value="Trainee">Trainee</option>
                            <option value="Apprenticeship">Apprenticeship</option>
                            <option value="Casual">Casual</option>
                            <option value="Temporary">Temporary </option>
                        </Field>
                        <label class="user-label">Employment Type</label>
                    </div>
                </div>
                <div class="row d-flex">
                    <div class="col input-group-fname">
                        <Field as="select" class="form-control input" id="Specific-Emp" name="selected_user" autocomplete="off" style="color: #7e7e7e;">
                            <option value="" :selected="!users?.data">Select</option>
                            <option v-for="user in users?.data" :key="user.id" :value="user.id">{{ user.name }}</option>
                        </Field>
                        <label class="user-label">Specific Employee(s)</label>
                    </div>
                </div>
                <div class="row d-flex">
                    <div class="col input-group-fname">
                        <Field as="select" class="form-control input" id="Exclude-Emp" name="excluded_user" autocomplete="off" style="color: #7e7e7e;">
                            <option value="" selected>Select</option>
                            <option v-for="user in users?.data" :key="user.id" :value="user.id">{{ user.name }}</option>
                        </Field>
                        <label class="user-label">Exclude Employee(s)</label>
                    </div>
                </div>

                <div class="btns-save-cancle">
                    <button type="submit" role="link" class="btn btn-next btn-primary save savePayBatchForm">Save</button>
                    <router-link :to="{ name: 'admin.PayrollBatchList', params: { id: route.params.id } }" custom v-slot="{ navigate }">
                        <a @click="navigate" href="javascipt:;" class="btn btn-outline-light cancle">Cancel</a>
                    </router-link>
                    
                </div>
            </div>
            </Form>
        </div>
    </div>

    <!-- Modal Notice period list2 -->
    <div class="modal fade" id="testRslt1" data-backdrop="false" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style=" width: 800px !important; scrollbar-width: none; ">
                <div class="modal-header" style="align-items: center; gap: 3rem;">
                    <button type="button" class="close1" data-dismiss="modal" aria-label="Close"
                        style=" margin: 0px; padding: 0px; font-size: medium; color: black !important">
                        <span><i class="fa-solid fa-arrow-right fa-flip-horizontal fa-sm"
                                style="color: #000000;"></i></span>
                        <span style="cursor: pointer;">Back</span>
                    </button>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-circle-xmark fa-lg"
                                style="color: #2DB9F8;opacity: 1;"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="testRslt-table">
                        <thead>
                            <tr>
                                <th id="EmpId">Employee ID</th>
                                <th id="EmpName">Employee Name</th>
                                <th id="DoResg">Company</th>
                                <th id="Loc">Location</th>
                                <th id="Dept">Department</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>DFH51324</td>
                                <td>Austin Hodges</td>
                                <td>Lorem, ipsum dolor.</td>
                                <td>Kingmouth,Louisiana</td>
                                <td>Superisor</td>
                            </tr>
                            <tr>
                                <td>SDG54635</td>
                                <td>Randy Johnson</td>
                                <td>Sanford-Leannon</td>
                                <td>UK</td>
                                <td>Manager</td>
                            </tr>
                            <tr>
                                <td>YTJ62463</td>
                                <td>MAtthew Luckett</td>
                                <td>LLC</td>
                                <td>Cananda</td>
                                <td>SR.Developer</td>
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="savePayBatchForm1" tabindex="-1" aria-labelledby="savePayBatchFormLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-circle-xmark fa-2xl"
                                style="color: #2DB9F8;opacity: 1;"></i></span>
                    </button>
                </div>
                <div class="container modal-body d-flex flex-column">
                    <div>Added employee to batch</div>
                    <div>258 Employees were added to the payroll batch successfully.</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary ok">OK</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useRouter,useRoute } from "vue-router";
import { Form, Field, ErrorMessage } from "vee-validate";
import useUsers from "@/composables/users";
import useBatch from "@/composables/useBatch";
import { onMounted, reactive, watch } from "vue";
const { users, getUsers, is } = useUsers()
const { addEmployee, loading, success } = useBatch()
const route = useRoute()
const router = useRouter();
const filteredValue = reactive([]);
const filterVlaues = reactive({
    company:'',
    location:'',
    department:'',
    job_role:'',
    gender:'',
    employment_type:'',
    filtered_users:[]
});

watch(filterVlaues, async (current, previous) => {
    await getUsers(filterVlaues)
    // console.log(filterVlaues.filtered_users)
    // filterVlaues.filtered_users = users.value.data.map(e => e.id)
    filteredValue.value = users.value.data.map(e => e.id)
});



onMounted(() => {
    getUsers(filterVlaues)
})



const submitForm = async (values) => {
    console.log('rahul', values);
    await addEmployee(route.params.id, values);
};
</script>

<style scoped>
@import '@/assets/css/PayrollBatchform.css';

.save {
    display: inline-block;
    padding: 0.375rem 0.75rem;
}
</style>