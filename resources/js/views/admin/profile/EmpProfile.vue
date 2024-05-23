<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-Profile" class="container  d-flex flex-column">

        <div id="dashboard-table-info">
            <span class="d-flex justify-content-center align-items-center" style="gap: 9px;"><i
                    class="fa-solid fa-arrow-left fa-xs back-icon" style="color: #000000;"></i>Profile</span>
            <span>Employee > Profile</span>
        </div>

        <div id="EmpProfile-details" class="d-flex container" style="gap: 1rem;">

            <div id="Emp-details" class="d-flex flex-column justify-content-center align-items-center"
                style="gap: 1rem;height: 500px;">

                <img v-if="user?.user_profile_picture" class="emp-img" :src="user?.user_profile_picture" />

                <img v-else class="emp-img"
                    :src="apiPath + '/resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'" />

                <div class="name-role d-flex flex-column justify-content-center align-items-center"
                    style="font-family: monospace;">
                    <div>{{ user?.first_name }}</div>
                    <div style="font-size: 13px;color: #A8A8A8;font-weight: 500;">{{ user?.role?.name }}</div>
                </div>

                <div class="email-phone d-flex flex-column justify-content-center align-items-center"
                    style="gap: .2rem;">
                    <div class="Phone d-flex justify-content-center align-items-center" style="gap: .5rem;">
                        <div class="Phone-icon"><i class="fa-solid fa-phone fa-sm" style="color: #2DB9F8;"></i>
                        </div>
                        <div style=" font-size: 12px; font-weight: 600;">{{ user?.phone }}</div>
                    </div>

                    <div class="Email d-flex justify-content-center align-items-center" style="gap: .5rem;">
                        <div class="Phone-icon"><i class="fa-solid fa-envelope fa-sm" style="color: #2DB9F8;"></i></div>
                        <div style=" font-size: 11px; font-weight: 600;" id="email-Value">{{ user?.email }}
                        </div>
                    </div>

                </div>


                <router-link :to="{ name: 'admin.EditProfile', params: { id: user?.id } }" custom v-slot="{ navigate }">
                    <button @click="navigate" role="link" type="button" id="editButton" class="btn">Edit
                        Profile</button>
                </router-link>

                <router-link :to="{ name: 'admin.planner' }" custom v-slot="{ navigate }">
                    <button @click="navigate" role="link" type="button" id="plannerButton" class="btn">Planner</button>
                </router-link>

                <router-link :to="{ name: 'admin.deBoard', params: { id: user?.id } }" custom v-slot="{ navigate }">
                    <button @click="navigate" role="link" type="button" id="de-boardButton"
                        class="btn btn-danger">De-Board</button>
                </router-link>
            </div>


            <div id="Personal-Job-info" class="container d-flex flex-column justify-content-center align-items-center"
                style="padding: 0px;gap: 1rem;">

                <div id="Emp-Leaves-absences" class="container d-flex justify-content-space-between align-items-center"
                    style="gap: 1rem;padding: 0px;">
                    <div id="lengthOfEmp" class="d-flex flex-column justify-content-center align-items-center">
                        <p>Length Of Employment</p>
                        <p>10 Months</p>
                        <p>15 Days</p>
                    </div>
                    <div id="Absences" class="d-flex flex-column justify-content-flex-start align-items-center">
                        <p>Absences</p>
                        <p>2 Days</p>
                    </div>
                    <div id="Remaining-Leaves" class="d-flex flex-column justify-content-flex-start align-items-center">
                        <p>Remaining Leaves</p>
                        <p>6.5 Days</p>
                    </div>
                </div>

                <div class="container  d-flex flex-column justify-content-center"
                    style="padding: 0px;background: white;border-radius:10px;margin-bottom: 12px;">
                    <div
                        style="padding: 14px;background-color: #F8F8F8;color: #2DB9F8;font-weight: 500;font-size: 13px;border-top-left-radius: 10px;border-top-right-radius: 10px;">
                        Personal Information</div>
                    <div class="form-row d-flex justify-content-around" style="padding:10px;">
                        <div class="col-md-3 mb-3 d-flex flex-column" style="gap: .2rem;">
                            <div id="Name">Full Name</div>
                            <div id="name-Value" class="Name-value">{{ user?.first_name }} {{ user?.last_name }}</div>
                        </div>
                        <div class="col-md-3 mb-3 d-flex flex-column" style="gap: .2rem;">
                            <div id="Gender">Gender</div>
                            <div id="gender-Value" class="Gender-value ">{{ capitalize(user?.info?.gender) }}</div>
                        </div>
                        <div class="col-md-3 mb-3 d-flex flex-column" style="gap: .2rem;">
                            <div id="DOB">Date of Birth</div>
                            <div id="dob-Value" class="DOB-value">{{ user?.info?.dob ?
                                moment(user?.info?.dob).format('MMMM D, YYYY') :
                                '---' }}</div>
                        </div>
                    </div>
                    <div class="form-row d-flex justify-content-around" style="margin-left: 30px;">
                        <div class="col-md-6 mb-3">
                            <div id="Email">Email</div>
                            <div id="email-Value" class="Email-value">{{ user?.email }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div id="Mobile">Mobile</div>
                            <div id="mobile-Value" class="Mobile-value">{{ user?.phone }}</div>
                        </div>
                    </div>

                    <div class="form-row d-flex justify-content-around" style="margin-left: 30px;">
                        <div class="col-md-12 mb-3">
                            <div id="Address">Address</div>
                            <div id="Address-value" class="address-Value">{{ user?.info?.address }}</div>
                        </div>
                    </div>


                    <div
                        style="padding: 14px;background-color: #F8F8F8;color: #2DB9F8;font-weight: 500;font-size: 13px;">
                        Job Information</div>


                    <div class="form-row d-flex justify-content-around" style="padding:10px;">
                        <div class="col-md-3 mb-3 d-flex flex-column" style="gap: .2rem;">
                            <div id="EmpID">Employee ID</div>
                            <div id="empid-Value" class="EmpID-value">{{ user?.employee_id }}</div>
                        </div>
                        <div class="col-md-3 mb-3 d-flex flex-column" style="gap: .2rem;">
                            <div id="SD">Start Date</div>
                            <div id="sd-Value" class="SD-value ">{{ user?.info?.doj ?
                                moment(user?.info?.doj).format('MMMM D, YYYY') :
                                '---' }}
                            </div>
                        </div>
                        <div class="col-md-3 mb-3 d-flex flex-column" style="gap: .2rem;">
                            <div id="ProbationDay">Probation End Date</div>
                            <div id="probationday-Value" class="ProbationDay-value"> {{ user?.info?.prob_end_date ?
                                moment(user?.info?.prob_end_date).format('MMMM D, YYYY') :
                                '---' }}</div>
                        </div>
                    </div>
                    <div class="form-row d-flex justify-content-around" style="margin-left: 30px;">
                        <div class="col-md-6 mb-3">
                            <div id="Company">Company</div>
                            <div id="company-Value" class="Company-value">{{ user?.info?.company }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div id="Location">Location</div>
                            <div id="loctaion-Value" class="Location-value">{{ user?.info?.location }}</div>
                        </div>
                    </div>
                    <div class="form-row d-flex justify-content-around" style="margin-left: 30px;">
                        <div class="col-md-6 mb-3">
                            <div id="Aadhar">Aadhar Number</div>
                            <div id="aadher-Value" class="Aadhar-value">{{ user?.info?.aadhar_number ?
                                user.info.aadhar_number :
                                '---'
                                }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div id="PAN">PAN Number</div>
                            <div id="pan-Value" class="PAN-value">{{ user?.info?.pan_number ? user.info.pan_number :
                                '---' }}</div>
                        </div>
                    </div>

                    <div
                        style="padding: 14px;background-color: #F8F8F8;color: #2DB9F8;font-weight: 500;font-size: 13px;">
                        Document</div>

                    <div class="form-row d-flex justify-content-around"
                        style="margin-left: 17px;padding: 13px;padding-bottom: 0px;">
                        <div class="col-md-6 mb-3">
                            <div id="Aadhar">Aadhar Number</div>
                            <div id="aadher-Value" class="Aadhar-value">{{ user?.info?.aadhar_number ?
                                user.info.aadhar_number :
                                '---'
                                }}</div>
                        </div>
                        <div class="col-md-6 mb-3 d-flex justify-content-center align-items-center" style="gap: 3px;">
                            <!-- <button id="Aadhar-view" :target="_blank" :href="url">View</button> -->
                            <a v-if="user?.aadhar_proof" id="Aadhar-view" target="_blank" :href="user?.aadhar_proof">View</a>
                            <div id="Aadhar-download-icon"><i class="fa-sharp fa-solid fa-file-export fa-sm"
                                    style="color: #2DB9F8;"></i></div>
                        </div>
                    </div>
                    <div class="form-row d-flex justify-content-around"
                        style="margin-left: 17px;padding: 13px;padding-top: 0px;">
                        <div class="col-md-6 mb-3">
                            <div id="PAN">PAN Number</div>
                            <div id="pan-Value" class="PAN-value">{{ user?.info?.pan_number ? user.info.pan_number :
                                '---' }}</div>
                        </div>
                        <div class="col-md-6 mb-3 d-flex justify-content-center align-items-center" style="gap: 3px;">
                            <!-- <button id="Pan-view">View</button> -->
                            <a v-if="user?.pan_proof" id="Aadhar-view" target="_blank" :href="user?.pan_proof">View</a>
                            <div id="Pan-download-icon"><i class="fa-sharp fa-solid fa-file-export fa-sm"
                                    style="color: #2DB9F8;"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUpdated, reactive, watchEffect } from "vue";
import useUsers from "@/composables/users";
import moment from 'moment';
import { useForm, useField, defineRule } from "vee-validate";
import apiClient from "../../../composables/api-client";
import { useRoute } from "vue-router";
import { param } from "jquery";
const route = useRoute()
const user = ref({
    'first_name': '',
    'email': ''
})
const { updateUser, getUser, user: postData, validationErrors, isLoading } = useUsers();

// const user = reactive({
//         name,
//         email,
//         password,
//         role_id,
//     })

onMounted(() => {
    console.log('onMounted')
    getUser(route.params.id)
    console.log(postData.value)

    apiClient.get('/admin/users/' + route.params.id)
        .then(response => {
            user.value = response.data.data;
        })

});

function capitalize(value) {
    if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
}
onUpdated(() => {
    console.log('onUpdated')
    getUser(route.params.id)
});

watchEffect(() => {
    console.log('watchEffect')
    // user.id = postData.value.id
    // user.name = postData.value.name
    // user.email = postData.value.email
    // user.role_id = postData.value.role_id
});

</script>

<style scoped>
@import '@/assets/css/EmpProfile.css';
</style>
