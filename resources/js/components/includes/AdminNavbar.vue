<template>
    <!-- -----nav-dashboard start----- -->
    <div id="nav-dashboard">
                <nav class="navbar navbar-dark bg-primary nav-icon d-flex justify-content-between">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon"></span>
                    </button>


                    <div class="notification">
                        <div class="navbar_right">
                            <div class="notifi">
                                <div class="icon_wrap"><span><i class="fa-regular fa-bell fa-xs"
                                            style="color: rgba(255, 255, 255)"></i></span></div>

                                <div class="notification_dd">
                                    <ul class="notification_ul">
                                        <li class="starbucks success">

                                            <div class="notify_data">
                                                <div class="title">
                                                    Lorem, ipsum dolor.
                                                </div>
                                                <div class="sub_title">
                                                    Lorem ipsum dolor sit amet consectetur.
                                                </div>
                                            </div>
                                            <div class="notify_status">
                                                <p>Success</p>
                                            </div>
                                        </li>
                                        <li class="baskin_robbins failed">

                                            <div class="notify_data">
                                                <div class="title">
                                                    Lorem, ipsum dolor.
                                                </div>
                                                <div class="sub_title">
                                                    Lorem ipsum dolor sit amet consectetur.
                                                </div>
                                            </div>
                                            <div class="notify_status">
                                                <p>Failed</p>
                                            </div>
                                        </li>
                                        <li class="mcd success">

                                            <div class="notify_data">
                                                <div class="title">
                                                    Lorem, ipsum dolor.
                                                </div>
                                                <div class="sub_title">
                                                    Lorem ipsum dolor sit amet consectetur.
                                                </div>
                                            </div>
                                            <div class="notify_status">
                                                <p>Success</p>
                                            </div>
                                        </li>
                                        <li class="pizzahut failed">

                                            <div class="notify_data">
                                                <div class="title">
                                                    Lorem, ipsum dolor.
                                                </div>
                                                <div class="sub_title">
                                                    Lorem ipsum dolor sit amet consectetur.
                                                </div>
                                            </div>
                                            <div class="notify_status">
                                                <p>Failed</p>
                                            </div>
                                        </li>
                                        <li class="kfc success">

                                            <div class="notify_data">
                                                <div class="title">
                                                    Lorem, ipsum dolor.
                                                </div>
                                                <div class="sub_title">
                                                    Lorem ipsum dolor sit amet consectetur.
                                                </div>
                                            </div>
                                            <div class="notify_status">
                                                <p>Success</p>
                                            </div>
                                        </li>
                                        <li class="show_all">
                                            <p class="link">Show All Activities</p>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <div class="profile">
                                <div class="icon_wrap">
                                    <img :src="apiPath + '/resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'"
                                        alt="profile_pic">
                                    <span class="name">{{ user?.name }}</span>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="popup">
                        <div class="shadow"></div>
                        <div class="inner_popup">
                            <div class="notification_dd">
                                <ul class="notification_ul">
                                    <li class="title">
                                        <p>All Notifications</p>
                                        <p class="close"><i class="fas fa-times" aria-hidden="true"></i></p>
                                    </li>
                                    <li class="starbucks success">

                                        <div class="notify_data">
                                            <div class="title">
                                                Lorem, ipsum dolor.
                                            </div>
                                            <div class="sub_title">
                                                Lorem ipsum dolor sit amet consectetur.
                                            </div>
                                        </div>
                                        <div class="notify_status">
                                            <p>Success</p>
                                        </div>
                                    </li>
                                    <li class="baskin_robbins failed">

                                        <div class="notify_data">
                                            <div class="title">
                                                Lorem, ipsum dolor.
                                            </div>
                                            <div class="sub_title">
                                                Lorem ipsum dolor sit amet consectetur.
                                            </div>
                                        </div>
                                        <div class="notify_status">
                                            <p>Failed</p>
                                        </div>
                                    </li>
                                    <li class="mcd success">

                                        <div class="notify_data">
                                            <div class="title">
                                                Lorem, ipsum dolor.
                                            </div>
                                            <div class="sub_title">
                                                Lorem ipsum dolor sit amet consectetur.
                                            </div>
                                        </div>
                                        <div class="notify_status">
                                            <p>Success</p>
                                        </div>
                                    </li>
                                    <li class="baskin_robbins failed">

                                        <div class="notify_data">
                                            <div class="title">
                                                Lorem, ipsum dolor.
                                            </div>
                                            <div class="sub_title">
                                                Lorem ipsum dolor sit amet consectetur.
                                            </div>
                                        </div>
                                        <div class="notify_status">
                                            <p>Failed</p>
                                        </div>
                                    </li>
                                    <li class="pizzahut failed">

                                        <div class="notify_data">
                                            <div class="title">
                                                Lorem, ipsum dolor.
                                            </div>
                                            <div class="sub_title">
                                                Lorem ipsum dolor sit amet consectetur.
                                            </div>
                                        </div>
                                        <div class="notify_status">
                                            <p>Failed</p>
                                        </div>
                                    </li>
                                    <li class="kfc success">
                                        <div class="notify_data">
                                            <div class="title">
                                                Lorem, ipsum dolor.
                                            </div>
                                            <div class="sub_title">
                                                Lorem ipsum dolor sit amet consectetur.
                                            </div>
                                        </div>
                                        <div class="notify_status">
                                            <p>Success</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
</template>

<script setup>
import {computed} from "vue";
import { useStore } from 'vuex';
import useAuth from "@/composables/auth";
import LocaleSwitcher from "../../components/LocaleSwitcher.vue";

    const store = useStore();
    const user = computed(() => store.state.auth.user)
    const {processing, logout} = useAuth();
</script>

<style scoped>

</style>
