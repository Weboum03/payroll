<template>
    <!-- footer start-->
<footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 footer-copyright text-start">
                            <p class="mb-0">Copyright 2022 © Tether All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- footer end-->
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
