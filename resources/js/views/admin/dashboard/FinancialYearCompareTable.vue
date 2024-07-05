<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table-info">
            <span>DASHBOARD</span>
            <span>Employee > Dashboard</span>
    </div>
    <div id="dashboard-table">
        <div class="d-flex justify-content-between" style="padding: 10px;background-color: #DAE1F3;">
            <div class="d-flex" style="gap: 2rem;">
                <router-link :to="{ name: 'admin.home' }" custom v-slot="{ navigate }">
                    <button @click="navigate" role="link"
                        style=" margin: 0px; padding: 0px; font-size: medium; color: black !important; border: none;background-color: transparent;">
                        <span><i class="fa-solid fa-arrow-right fa-flip-horizontal fa-sm"
                                style="color: #000000;"></i></span>
                        <span>Data comparision</span>
                    </button>
                </router-link>
            </div>
            <div><button type="button" @click="isModalCompare = true" id="Modify" data-toggle="modal" data-target="#Compare">Modify</button>
            </div>
        </div>

        <div style=" background-color: white; font-size: 9px; padding: 12px; color: #A8A8A8; font-weight: 500">
            Comparison data between <span v-for="item in compareData"> , {{ item.title }} </span></div>

        <div class="FinancialYearcompareTable" style="margin-top: -14px;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td scope="col"></td>
                        <td scope="col" v-for="item in compareData">{{ item.title }}</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">Employee Count</td>
                        <td v-for="item in compareData">{{ item.employee_count }}</td>
                    </tr>
                    <tr>
                        <td scope="row">New Starter</td>
                        <td v-for="item in compareData">{{ item.new_starter }}</td>
                    </tr>
                    <tr>
                        <td scope="row">Leaver</td>
                        <td v-for="item in compareData">{{ item.leaver }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Modal -->
    <!-- Modal compare-->
    <compareModel v-if="isModalCompare" @close="closeModal"></compareModel>
</template>

<script setup>
import { ref, onMounted, onUpdated, watch } from 'vue'
import compareModel from '@/views/admin/home/compareModel.vue'
import useDashboard from "@/composables/useDashboard"
const { getDashboardCompare, loading } = useDashboard()
import { useRouter, useRoute } from "vue-router";
const isModalCompare = ref(false);
const compareData = ref(null)
const route = useRoute();
const payload = ref(route.query)

onMounted(async () => {
    let response = await getDashboardCompare(route.query);
    compareData.value = response.data;
});

watch(payload, async () => {
    payload.value = route.query;
    let response = await getDashboardCompare(route.query);
    compareData.value = response.data;
})

const closeModal = async() => {
    isModalCompare.value = false
    payload.value = route.query;
    let response = await getDashboardCompare(route.query);
    compareData.value = response.data;
    location.reload()
}

// onUpdated(async () => {
//     let response = await getDashboardCompare(route.query);
//     compareData.value = response.data;
// });

</script>

<style scoped>
#FinancialYearcompareTable_filter {
            display: none;
        }

        .FinancialYearcompareTable {
            font-size: 11px;
            font-weight: 500;
        }

        .FinancialYearcompareTable tbody tr:nth-of-type(4) td:nth-of-type(2) {
            background-color: #2DB9F8;
            color: white;
        }

        .table-bordered th,
        .table-bordered td:nth-of-type(0) {
            background-color: #F8F8F8;
        }

        td,th{
    font-size: 13px;
    font-weight: 500;
    text-align: center !important;
}

.table-bordered td:first-child{
    text-align: start !important;
}


        .FinancialYearcompareTable {
            background-color: white;
            padding: 20px;
        }

        #Modify{
    font-weight: 500;
    border: none;
    background-color: #2DB9F8;
    color: white;
    border-radius: 4px;
    font-family: "Poppins", sans-serif;
    font-size: 19px;
    width: 154px;
    height: 50px;

}
#Compare .modal-content{
  width: 592px !important;
  height: 385px;
}

#Compare .modal-body {
    overflow: hidden !important;
    height: 273px;
}

#Compare .modal-footer {
    padding-top: 0px;
}

.modal-mask {
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, .2);
    border-radius: .3rem;
    outline: 0;
    width: 100% !important;
}
</style>