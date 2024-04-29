<template>
           <!-- Page Header Start-->
           <div class="page-main-header">
            <div class="main-header-right row">
                <div class="main-header-left d-lg-none w-auto">
                    <div class="logo-wrapper">
                        <a href="index.html">
                        <img src="https://plus.unsplash.com/premium_photo-1676637000058-96549206fe71?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                        </a>
                    </div>
                </div>
                <div class="mobile-sidebar w-auto">
                    <div class="media-body text-end switch-sm">
                        <label class="switch"><a href="javascript:void(0)"><i id="sidebar-toggle"
                                    data-feather="align-left"></i></a></label>
                    </div>
                </div>
               
            </div>
        </div>
        <!-- Page Header Ends -->
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
