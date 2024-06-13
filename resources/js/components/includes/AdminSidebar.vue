<template>
    <!-- -----Main-sidebar------->
    <div id="main-sidebar">

        <div id="compy-Profile" class="d-flex flex-column">
            <div id="compy-info" class="d-flex flex-column">
                <div id="comp-name">
                    <img :src="apiPath + '/resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'"
                        id="admin-image" class="d-inline-block align-top" alt="">
                    <div class="admin-profile d-flex flex-column">
                        <p class="compname-name">Uaven Techno</p>
                        <p class="comp-name-no">RD84SF5352</p>
                    </div>
                </div>
                <div id="comp-date" class="d-flex">
                    <label id="Valid-up-to">Valid up to:</label>
                    <label id="Valid-up-to-date">12-May-2024</label>
                </div>
            </div>
            <div id="compy-Link"><a href="#">Renew Licence</a></div>

        </div>

        <!-- ------profile-------->
        <div id="profile">
            <nav class="navbar navbar-light ">
                <img v-if="user?.user_profile_picture" :src="user?.user_profile_picture" id="admin-image" class="d-inline-block align-top" />

                <img v-else id="admin-image" class="d-inline-block align-top"
                    :src="apiPath + '/resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'" />
                <div class="admin-profile d-flex flex-column">
                    <p class="admin-name">{{ user?.name }}</p>
                    <p class="admin-pro">Admin</p>
                </div>
            </nav>
        </div>
        <!-- ------data-------->

        <!-- ------employee Accordian-------->
        <div class="container accordion-menu" style=" gap: 1rem; display: flex; flex-direction: column ">
            <div id="accordion">
                <div class="card-header-emp" id="headingFour">
                    <h5 class="mb-0">
                        <router-link :to="{ name: 'admin.home' }" custom v-slot="{ navigate }">
                            <button class="btn btn-link " @click="navigate" role="link">
                                Dashboard
                            </button>
                        </router-link>
                    </h5>
                </div>
            </div>

            <div id="accordion">
                <div class="card-header-emp" id="headingOne">
                    <h5 class="mb-0">
                        <router-link :to="{ name: 'admin.dashboard' }" custom v-slot="{ navigate }">
                            <button class="btn btn-link " @click="navigate" role="link">
                                All Employees
                            </button>
                        </router-link>
                    </h5>
                </div>

                <!-- <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <ul>
                                <li>
                                    <router-link :to="{ name: 'admin.dashboard' }" exact-active-class="active">All Employees</router-link>
                                </li>
                                <li>
                                    <router-link :to="{ name: 'admin.onBoard' }" exact-active-class="active">On-board</router-link>
                                </li>
                            </ul>
                        </div>
                    </div> -->
            </div>

            <div id="accordion">
                <div class="card-header-leave" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link " @click="toggleLeavesRef()">
                            Leaves
                        </button>
                    </h5>
                </div>

                <div id="collapseTwo" class="collapse" :class="{ 'show': leaves }">
                    <div class="card-body">
                        <ul>
                            <li>
                                <router-link :to="{ name: 'admin.approvals' }"
                                    exact-active-class="active">Approvals</router-link>
                            </li>
                            <li>
                                <router-link v-if="can('View Leave History')" :to="{ name: 'admin.approvalHistory' }"
                                    exact-active-class="active">Approvals History</router-link>
                            </li>
                            <!-- <li>
                                <router-link :to="{ name: 'admin.leaveRequest' }" exact-active-class="active">Add
                                    New</router-link>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
            <div id="accordion">
                <div class="card-header-payroll" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link" @click="toggleRef()">
                            Payroll
                        </button>
                    </h5>
                </div>

                <div id="collapseThree" class="collapse" :class="{ 'show': payroll }" aria-labelledby="headingThree"
                    data-parent="#accordion">
                    <div class="card-body">
                        <ul>
                            <li>
                                <router-link :to="{ name: 'admin.payroll' }" exact-active-class="active">Payroll
                                    Data</router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div id="accordion">
                <div class="card-header-empRole" id="headingFive">
                    <h5 class="mb-0">
                        <router-link :to="{ name: 'admin.EmployeeRole' }" custom v-slot="{ navigate }">
                            <button class="btn btn-link " @click="navigate" role="link">
                                Employee Role
                            </button>
                        </router-link>
                    </h5>
                </div>
            </div>

        </div>




        <!-- ------main-sidebar-footer-------->
        <div id="main-sidebar-footer">


            <button class="logoutBtn" type="submit">

                <div class="sign"><svg viewBox="0 0 512 512">
                        <path
                            d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
                        </path>
                    </svg></div>

                <div class="text" @click="logout">Logout</div>
            </button>
        </div>



    </div>
</template>


<script setup>
import { ref, computed } from "vue";
import { useStore } from 'vuex';
import useAuth from "@/composables/auth";
import { useAbility } from '@casl/vue';
const { can } = useAbility()
const store = useStore();
const user = computed(() => store.state.auth.user)
const { processing, logout } = useAuth();

// const payroll = ref(false);
const leaves = ref(false);
const payroll = ref(false);


const toggleRef = () => { payroll.value = !payroll.value; };
const toggleLeavesRef = () => { leaves.value = !leaves.value; };

</script>


<style scoped></style>
