<template>
    <!-- -----nav-dashboard-table start----- -->

    <div id="dashboard-table-info" class="container">
        <span>Planner</span>
        <span>Employee > Profile > Planner</span>
    </div>
    <div id="dashboard-table" class="container">

        <div class=" d-flex flex-column" style="background-color: white; padding: 20px; gap: 1rem;">
            <div id="empPlanner" class=" d-flex">
                <RouterLink :to="{ name: 'admin.EmpProfile', params: { id: route.params.id } }" custom v-slot="{ navigate }">
                    <div @click="navigate" class="back-icon">
                        <i class="fa-solid fa-arrow-left fa-sm" style="color: #000000;"></i>
                    </div>
                </RouterLink>
                <div class="div-empPlanner d-flex flex-column">
                    <div style="font-size: 17px;font-weight: 500;line-height: 25.5px;font-family: Poppins, sans-serif;">
                        Employee Planner
                    </div>
                    <div
                        style="font-size: 13px;font-weight: 500;color: #212121;line-height: 19.5px;opacity: 50%;font-family: Poppins, sans-serif;">
                        Vivamus eu ligula in libero
                        sagittis luctus nec vel neque. Sed at ultrices est aliquam vitae pretium tortor.</div>
                </div>

            </div>

            <div class="d-flex flex-column" style="gap: 1.5rem;padding: 0px 13px;">
                <div
                    style="font-size: 12px;font-weight: 500;font-family: Poppins, sans-serif;line-height: 18px;width: 65px;">
                    View Data</div>
                <div class="d-flex align-items-center" style="gap: 2rem;margin-top: -15px;flex-wrap: wrap;">
                    <div class="d-flex" style="gap:10px">
                        <input type="radio" name="viewdata" id="Financial-Year" value="Financial-Year"
                            style="width: 20px;">
                        <label for="Financial-Year"
                            style="font-size: 16px;font-weight: 500;margin-top: -1px;margin-bottom: 0px;line-height: 24px;font-family: Poppins, sans-serif;">By
                            finencial year</label>
                    </div>
                    <div class="d-flex" style="gap:10px">
                        <input type="radio" name="viewdata" value="FinancialYear" id="ByYear" style="width: 20px;">
                        <label for="ByYear"
                            style="font-size: 16px;font-weight: 500;margin-top: -1px;margin-bottom: 0px;line-height: 24px;font-family: Poppins, sans-serif;">By
                            Calender
                            Year</label>
                    </div>
                    <div class="d-flex" style="gap:10px">
                        <input type="radio" checked name="viewdata" id="ByMonth" value="ByMonth" style="width: 20px;">
                        <label for="ByMonth"
                            style="font-size: 16px;font-weight: 500;margin-top: -1px;margin-bottom: 0px;line-height: 24px;font-family: Poppins, sans-serif;">By
                            Month</label>
                    </div>
                </div>
            </div>


            <div class="row row-cols-6" style=" padding: 0px 13px;align-items: center;">
                <div class="col input-group-fname">
                    <input v-model="startDate" @change="filterRows" placeholder="from" required="" type="text" name="text" autocomplete="off"
                        class="input form-control" onfocus="(this.type='date')"
                        style="width: 251px;height: 45px;">
                    <label class="user-label ">From</label>
                </div>
                <span
                    style="text-align: center;padding-left: 115px;padding-bottom: 4px;font-size: 16px;font-weight: 500;line-height: 24px;">to</span>
                <div class="col input-group-fname">
                    <input v-model="endDate" @change="filterRows" placeholder="To" required="" type="text" name="text" autocomplete="off"
                        class="input form-control" onfocus="(this.type='date')"
                        style="width: 251px;height: 45px;">
                    <label class="user-label ">To</label>
                </div>
            </div>

            <div class="graph d-flex">
                <div class="attandance-graph d-flex flex-column">
                    <h6 class="chart-heading d-flex justify-content-start">Attendance</h6>
                    <div class="programming-stats">
                        <div class="attendance-container">
                            <Doughnut id="counter" :data="attendancechartData" :options="options" width="125"
                                height="125"
                                style="display: block; box-sizing: border-box; height: 100px; width: 100px;" />
                        </div>

                        <div class="details">
                            <ul>
                                <li style="display: flex;">
                                    <div
                                        style="display: flex; width: 21px; background-color: rgb(45, 185, 248); height: 21px; border-radius: 28%;">
                                    </div>
                                    <div>{{ attendanceValue.present }} days absence</div>
                                </li>
                                <li style="display: flex;">
                                    <div
                                        style="display: flex; width: 21px; background-color: rgb(218, 225, 243); height: 21px; border-radius: 28%;">
                                    </div>
                                    <div>{{ attendanceValue.absent }} working days</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="line"></div>

                <div class="earned-graph d-flex flex-column">
                    <h6 class="chart-heading d-flex justify-content-start">Earned Leaves (Days)</h6>
                    <div class="programming-stats1">
                        <div class="earned-container">
                            <Doughnut id="counter" :data="earnedchartData" :options="options2" width="125" height="125"
                                style="display: block; box-sizing: border-box; height: 100px; width: 100px;" />
                        </div>

                        <div class="details1">
                            <ul>
                                <li style="display: flex;">
                                    <div
                                        style="display: flex; width: 21px; background-color: rgb(45, 185, 248); height: 21px; border-radius: 28%;">
                                    </div>
                                    <div>10 days taken</div>
                                </li>
                                <li style="display: flex;">
                                    <div
                                        style="display: flex; width: 21px; background-color: rgb(218, 225, 243); height: 21px; border-radius: 28%;">
                                    </div>
                                    <div>6 remaining</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="line"></div>

                <div class="absentheat-graph d-flex flex-column">
                    <div class="chart-heading d-flex justify-content-start">Absent hear map</div>
                    <div class="programming-stats3">

                        <div class="form-row weekdays-container">
                            <div class="col-md-3 ">
                                <div class="mon" style="background-color: #f68838;">MON</div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="tue" style="background-color: #1b8a5a;">TUE</div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="wed" style="background-color: #1b8a5a;">WED</div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="thu" style="background-color: #1b8a5a;">THU</div>
                            </div>
                        </div>
                        <div class="form-row weekdays-container">
                            <div class="col-md-3 ">
                                <div class="fri" style="background-color: #1b8a5a;">FRI</div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="sat" style="background-color: #1b8a5a;">SAT</div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="sun" style="background-color: #1b8a5a;">Sun</div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>


        <div class="input-valuses"
            style="padding: 29px;font-size: 18px;font-family: system-ui;font-weight: 500;background-color: #DAE1F3 ">
            January,2024 to March,2024 </div>

        <div class="accordion" id="input-valuses-accord">
            <div class="card leaveTable-card">
                <div class="card-header" id="input-valuses-accordOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#input-valuses-accord-collapseOne" aria-expanded="false"
                            aria-controls="input-valuses-accord-collapseOne">
                            February
                        </button>
                    </h2>
                </div>

                <div id="input-valuses-accord-collapseOne" class="collapse" aria-labelledby="input-valuses-accordOne"
                    data-parent="#input-valuses-accord">
                    <div class="card-body leaveTable-cardbody">
                        <div id="hp"></div>
                    </div>
                </div>
            </div>
            <div class="card leaveTable-card">
                <div class="card-header" id="input-valuses-accordTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#input-valuses-accord-collapseTwo" aria-expanded="false"
                            aria-controls="input-valuses-accord-collapseTwo">
                            March
                        </button>
                    </h2>
                </div>
                <div id="input-valuses-accord-collapseTwo" class="collapse" aria-labelledby="input-valuses-accordTwo"
                    data-parent="#input-valuses-accord">
                    <div class="card-body leaveTable-cardbody">
                        <div id="ap"></div>
                    </div>
                </div>
            </div>
            <div class="card leaveTable-card">
                <div class="card-header" id="input-valuses-accordThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#input-valuses-accord-collapseThree" aria-expanded="false"
                            aria-controls="input-valuses-accord-collapseThree">
                            April
                        </button>
                    </h2>
                </div>
                <div id="input-valuses-accord-collapseThree" class="collapse"
                    aria-labelledby="input-valuses-accordThree" data-parent="#input-valuses-accord">
                    <div class="card-body leaveTable-cardbody">
                        <div id="dp"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ attendancechartData }}
</template>

<script setup>
import { ref, onMounted } from 'vue';
import $, { param } from 'jquery';
import { Doughnut } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { useRoute } from "vue-router";
import useAttendance from "@/composables/useAttendance";
const { getUserAttendanceCount, loading: isLoading, success } = useAttendance();
const startDate = ref('2024-06-01')
const endDate = ref('2024-06-31')
const attendanceData = ref({})
const route = useRoute()
const attendanceValue = ref({
    present : 0,
    absent : 0
})

ChartJS.register(ArcElement, Tooltip, Legend)

const filterRows = async () => {
    attendanceData.value = await getUserAttendanceCount(route.params.id, {start: startDate.value, end: endDate.value})
    attendancechartData.value.datasets[0].data = [attendanceData.value.data.present_count, attendanceData.value.data.absent_count]
    attendanceValue.value = {
        present : attendanceData.value.data.present_count,
        absent : attendanceData.value.data.absent_count
    }
};

const attendancechartData = ref({
    labels: ["5 days absence", "900 working days"],
    datasets: [
        {
            backgroundColor: ['#0492F5', '#DAE1F3'],
            data: [10, 70],
            cutout: '70%',
        }
    ],
})

const counter1 = {
    id: "counter",
    beforeDraw(chart, args, options) {
        const { ctx, chartArea: { top, right, bottom, left, width, height } } = chart;
        ctx.save()
        const yCenter = (height / 2) + top + 6;
        ctx.font = '15px monospace'
        ctx.fillStyle = 'black'
        ctx.fillText('70%', '40', yCenter)
    }
}

const earnedchartData = {
    labels: ["10 days taken", "6 remaining"],
    datasets: [
        {
            backgroundColor: ['#0492F5', '#DAE1F3'],
            data: [70, 10],
            cutout: '70%',
        }
    ],
}

const options = {
    borderRadius: 2,
    hoverBorderWidth: 0,
    responsive: true,
    maintainAspectRatio: false,
    rotation: 0,
    plugins: {
        legend: {
            display: false,
        },
        tooltip: {
            callbacks: {
                label: function (context) {
                    return context.label; // Display only the label, without associated data
                },
            },
        },
    },
}

const options2 = {
    borderRadius: 2,
    hoverBorderWidth: 0,
    responsive: true,
    maintainAspectRatio: false,
    rotation: 0,
    plugins: {
        legend: {
            display: false,
        },
        tooltip: {
            callbacks: {
                label: function (context) {
                    return context.label; // Display only the label, without associated data
                },
            },
        },
    },
}

onMounted( async () => {
    attendanceData.value = await getUserAttendanceCount(route.params.id, {start: startDate.value, end: endDate.value})
    attendancechartData.value.datasets[0].data = [attendanceData.value.data.present_count, attendanceData.value.data.absent_count]
    attendancechartData.value.labels = ['Rahul', 'Vipan']
    attendanceValue.value = {
        present : attendanceData.value.data.present_count,
        absent : attendanceData.value.data.absent_count
    }
});

</script>

<style scoped>
@import '@/assets/css/planner.css';
@import '@/assets/css/onBoard.css';

.form-row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -5px;
    margin-left: -5px;
}
</style>