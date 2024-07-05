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
                        <input type="radio" value="finencial" v-model="plannerType" id="Financial-Year"
                            style="width: 20px;">
                        <label for="Financial-Year"
                            style="font-size: 16px;font-weight: 500;margin-top: -1px;margin-bottom: 0px;line-height: 24px;font-family: Poppins, sans-serif;">By
                            finencial year</label>
                    </div>
                    <div class="d-flex" style="gap:10px">
                        <input type="radio" value="calendar" v-model="plannerType" id="ByYear" style="width: 20px;">
                        <label for="ByYear"
                            style="font-size: 16px;font-weight: 500;margin-top: -1px;margin-bottom: 0px;line-height: 24px;font-family: Poppins, sans-serif;">By
                            Calender
                            Year</label>
                    </div>
                    <div class="d-flex" style="gap:10px">
                        <input type="radio" value="month" v-model="plannerType" id="ByMonth" style="width: 20px;">
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
                            <Doughnut :key="tableKey" id="counter" :data="attendancechartData" :options="options" width="125"
                                height="125"
                                style="display: block; box-sizing: border-box; height: 100px; width: 100px;" />
                        </div>

                        <div class="details">
                            <ul>
                                <li style="display: flex;">
                                    <div
                                        style="display: flex; width: 21px; background-color: rgb(45, 185, 248); height: 21px; border-radius: 28%;">
                                    </div>
                                    <div>{{ attendanceValue.absent }} days absence</div>
                                </li>
                                <li style="display: flex;">
                                    <div
                                        style="display: flex; width: 21px; background-color: rgb(218, 225, 243); height: 21px; border-radius: 28%;">
                                    </div>
                                    <div>{{ attendanceValue.present }} working days</div>
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
                            <Doughnut :key="tableKey" id="counter" :data="earnedchartData" :options="options2" width="125" height="125"
                                style="display: block; box-sizing: border-box; height: 100px; width: 100px;" />
                        </div>

                        <div class="details1">
                            <ul>
                                <li style="display: flex;">
                                    <div
                                        style="display: flex; width: 21px; background-color: rgb(45, 185, 248); height: 21px; border-radius: 28%;">
                                    </div>
                                    <div>{{ attendanceValue.leave_taken }} days taken</div>
                                </li>
                                <li style="display: flex;">
                                    <div
                                        style="display: flex; width: 21px; background-color: rgb(218, 225, 243); height: 21px; border-radius: 28%;">
                                    </div>
                                    <div>{{ attendanceValue.leave_remaining }} remaining</div>
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
            June,2024 to July,2024 </div>

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

    {{ attendancechartData.labels }}
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import $, { param } from 'jquery';
import { Doughnut } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { useRoute } from "vue-router";
import useAttendance from "@/composables/useAttendance";
const { getUserAttendanceCount, loading: isLoading, success } = useAttendance();
const startDate = ref('')
const endDate = ref('')
const attendanceData = ref({})
const route = useRoute()
const plannerType = ref()
const tableKey = ref(0)
const attendanceValue = ref({
    present : 0,
    absent : 0,
    leave_taken: 0,
    leave_remaining: 0
})

ChartJS.register(ArcElement, Tooltip, Legend)

watch(plannerType, (current, previous) => {
    if(current == 'calendar') {
        // Get the current year
        const currentYear = new Date().getFullYear();

        // Create a date object for January 1st of the current year
        const firstDate = new Date(currentYear, 0, 1);

        // Create a date object for December 31st of the current year
        const lastDate = new Date(currentYear, 11, 31);

        startDate.value = formatDate(firstDate);
        endDate.value = formatDate(lastDate);
        updateChart();
    } 
    else if(current == 'finencial') {
        getFinencialYear();
        updateChart();
    }
    else {
        const today = new Date();

        // Get the current year and month
        const currentYear = today.getFullYear();
        const currentMonth = today.getMonth();

        // Create a date object for the first day of the current month
        let firstDateOfMonth = new Date(currentYear, currentMonth, 1);

        // Create a date object for the last day of the current month
        let lastDateOfMonth = new Date(currentYear, currentMonth + 1, 0);

        // Format the first and last dates of the current month
        startDate.value = formatDate(firstDateOfMonth);
        endDate.value = formatDate(lastDateOfMonth);
        updateChart();
    }
})

function getFinencialYear() {
    // Get the current date
    const today = new Date();
    const currentYear = today.getFullYear();
    const currentMonth = today.getMonth();

    // Determine the financial year
    let financialStartYear;
    let financialEndYear;

    if (currentMonth >= 3) { // April (3) to December (11) months
    financialStartYear = currentYear;
    financialEndYear = currentYear + 1;
    } else { // January (0) to March (2) months
    financialStartYear = currentYear - 1;
    financialEndYear = currentYear;
    }

    // Create date objects for the financial year's start and end
    const financialStartDate = new Date(financialStartYear, 3, 1); // April 1st
    const financialEndDate = new Date(financialEndYear, 2, 31); // March 31st

    startDate.value = formatDate(financialStartDate);
    endDate.value = formatDate(financialEndDate);
}
// Function to format a Date object into YY-MM-DD format
function formatDate(date) {
  const year = String(date.getFullYear());
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const day = String(date.getDate()).padStart(2, '0');
  return `${year}-${month}-${day}`;
}

const updateAttendanceChartData = () => {

    var present = attendanceData.value.data.present_count;
    var absent = attendanceData.value.data.absent_count;
    var leaveTaken = attendanceData.value.data.leave_taken;
    var leaveRemaining = attendanceData.value.data.leave_remaining;

    attendancechartData.value.labels = [absent + " days absence", present + " working days"]
    attendancechartData.value.datasets[0].data = [absent, present]

    earnedchartData.value.labels = [leaveTaken + " days taken", leaveRemaining + " remaining"]
    earnedchartData.value.datasets[0].data = [leaveTaken, leaveRemaining]
    attendanceValue.value = {
        present : present,
        absent : absent,
        leave_remaining : leaveRemaining,
        leave_taken : leaveTaken,
    }
    tableKey.value++;
}

const filterRows = async () => {
    attendanceData.value = await getUserAttendanceCount(route.params.id, {start: startDate.value, end: endDate.value})
    updateAttendanceChartData();
};

const attendancechartData = ref({
    labels: ["5 days absence", "800 working days"],
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

const earnedchartData = ref({
    labels: ["10 days taken", "6 remaining"],
    datasets: [
        {
            backgroundColor: ['#0492F5', '#DAE1F3'],
            data: [70, 10],
            cutout: '70%',
        }
    ],
})

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

const updateChart = async () => {
    attendanceData.value = await getUserAttendanceCount(route.params.id, {start: startDate.value, end: endDate.value})
    updateAttendanceChartData();
}

onMounted( async () => {
    plannerType.value = 'month';
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