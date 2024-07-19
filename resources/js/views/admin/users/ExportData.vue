<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table-info">
                <span>Export Data</span>
                <span>More > Export Data</span>
            </div>
            <div id="dashboard-table">
                <Form @submit="submitForm" :validation-schema="schema" v-slot="{ validate, errors, handleSubmit }">
                <div id="ExportData" class="d-flex flex-column" style="padding: 20px 25px; gap: 1rem;">
                    <div class="section d-flex flex-column justify-content-between align-items" style="gap: 1rem;">
                       <div class="d-flex back-main" style="gap: 5px">
                            <div class="back-div">
                               <router-link :to="{ name: 'admin.dashboard' }">
                               <span><i class="fa-solid fa-arrow-right fa-flip-horizontal fa-sm"
                                style="color: #000000;"></i></span>
                                <span style="cursor: pointer; padding-left:5px;" >Back</span>  
                                </router-link>
                            </div>
                            <div class="back-div-content" style="padding-left:40px;">
                            <p>Export data from database</p>
                            <p>Select file format and fields which want to export</p>
                            </div>
                        </div>
                        <div>
                            <div class="col input-group-fname">
                                <Field required name="file_type" as="select" class="form-control input" autocomplete="off"
                                style="color: #7e7e7e;">
                                    <option value="" disabled selected>To</option>
                                    <option value="XLSX">XLSX File</option>
                                </Field>
                                <label class="user-label">File Type*</label>
                            </div>
                        </div>
                    </div>
                    <div class="inner-div d-flex flex-column" style="gap: 5px; flex-wrap: wrap;">
                        <h6>Employee Management</h6>
                        <div class="d-flex row-cols-5" style="gap:1rem;">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" v-model="checkValue" value="first_name" class="custom-control-input" id="FirstName">
                                <label class="custom-control-label" for="FirstName">First Name</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" v-model="checkValue" value="last_name" class="custom-control-input" id="LastName">
                                <label class="custom-control-label" for="LastName">Last Name</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" v-model="checkValue" value="email" class="custom-control-input" id="Email">
                                <label class="custom-control-label" for="Email">Email</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" v-model="checkValue" value="secondary_email" class="custom-control-input" id="SecondaryEmail">
                                <label class="custom-control-label" for="SecondaryEmail">Secondary Email</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" v-model="checkValue" value="phone" class="custom-control-input" id="Mobile">
                                <label class="custom-control-label" for="Mobile">Mobile</label>
                            </div>
                        </div>
                            <div class="d-flex row-cols-5" style="gap:1rem;">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" v-model="checkValue" class="custom-control-input" value="alternate_mobile" id="AlternateMobile">
                                <label class="custom-control-label" for="AlternateMobile">Alternate Mobile</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" v-model="checkValue" class="custom-control-input" value="gender" id="Gender">
                                <label class="custom-control-label" for="Gender">Gender</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" v-model="checkValue" class="custom-control-input" value="dob" id="DOB">
                                <label class="custom-control-label" for="DOB">Date of Birth</label>
                            </div>

                        </div>
                    </div>
                    <div>
                        <button type="submit" class="ExpSeleData">Export Selected Data</button>
                    </div>
                </div>
            </Form>
            </div>
</template>


<script setup>
import { Form, Field, ErrorMessage } from "vee-validate";
import { inject, ref } from "vue";
import useUsers from "@/composables/users";
import { useRoute, useRouter } from "vue-router";
const { exportCustomUser, isLoading, success } = useUsers();
const swal = inject('$swal')
const checkValue = ref([])
const route = useRoute()
const router = useRouter()

const submitForm = async (values, action) => {
    let response = await exportCustomUser({params: checkValue.value});

    downloadFile(response)
}

const downloadFile = async (response) => {
    const url = response.data;
    const link = document.createElement('a');
    link.href = url;
    let fileName = 'users_file.xlsx';
    link.setAttribute('download', fileName);
    document.body.appendChild(link);
    link.click();
    swal({
        icon: "success",
        title: "Export successfully",
    });

    router.push({name:'admin.dashboard'})
}

</script>
<style scoped>
@import '@/assets/css/ExportData.css';
</style>