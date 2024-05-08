<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container">
                <div id="dashboard-table-info">
                    <span>Planner</span>
                    <span>Employee > Profile > Planner</span>
                </div>

                <div class="container d-flex flex-column" style="background-color: white; padding: 20px; gap: 1rem;">
                    <div id="empPlanner d-flex">
                        <div class="div-empPlanner d-flex flex-column">
                            <div style="font-size: larger; font-weight: 600; font-family: monospace;">Employee Planner
                            </div>
                            <div style="font-size: x-small; font-weight: 500;color:#A8A8A8;">Vivamus eu ligula in libero
                                sagittis luctus nec vel neque. Sed at ultrices est aliquam vitae pretium tortor.</div>
                        </div>
                        <div class="back-icon"><i class="fa-solid fa-arrow-left fa-sm" style="color: #000000;"></i>
                        </div>
                    </div>

                    <div class="d-flex flex-column" style="gap: 1.5rem;">
                        <div style="font-size: x-small;font-weight: 500;margin-left: 1px;">Re-employable</div>
                        <div class="d-flex align-items-center" style="gap: 1rem;margin-top: -15px;">
                            <div class="d-flex" style="gap: .5rem;">
                                <input type="radio" name="" id="Financial-Year" value="Financial-Year" style="width: 13px;">
                                <label for="Financial-Year"
                                    style="font-size: 12px;font-weight: 500;margin-top: -1px;margin-bottom: 0px;">By
                                    finencial year</label>
                            </div>
                            <div class="d-flex" style="gap: .5rem;">
                                <input type="radio" name="" value="FinancialYear" id="ByYear" style="width: 13px;">
                                <label for="ByYear"
                                    style="font-size: 12px;font-weight: 500;margin-top: -1px;margin-bottom: 0px;">By Calender
                                 Year</label>
                            </div>
                            <div class="d-flex" style="gap: .5rem;">
                                <input type="radio" name="" id="ByMonth" value="ByMonth" style="width: 13px;">
                                <label for="ByMonth"
                                    style="font-size: 12px;font-weight: 500;margin-top: -1px;margin-bottom: 0px;">By
                                    Month</label>
                            </div>
                        </div>
                    </div>


                    <div class="row" style="width: 500px ;">
                        <div class="col input-group-fname">
                            <input placeholder="from" required="" type="text" name="text" autocomplete="off"
                                class="input form-control" onfocus="(this.type='date')" onfocusin="showLabel()"
                                style="width:200px;">
                            <label class="user-label ">From</label>
                        </div>
                        <div class="col input-group-fname">
                            <input placeholder="To" required="" type="text" name="text" autocomplete="off"
                                class="input form-control" onfocus="(this.type='date')" onfocusin="showLabel()"
                                style="width: 200px;">
                            <label class="user-label ">To</label>
                        </div>
                    </div>

                    <div class="graph d-flex">
                        <div class="attandance-graph d-flex flex-column">
                            <h6 class="chart-heading d-flex justify-content-center">Attendance</h6>
                            <div class="programming-stats">
                                <div class="attendance-container">
                                    <canvas class="attendance-chart"></canvas>
                                </div>

                                <div class="details">
                                    <ul></ul>
                                </div>
                            </div>
                        </div>

                        <div class="line"></div>

                        <div class="earned-graph d-flex flex-column">
                            <h6 class="chart-heading d-flex justify-content-center">Attendance</h6>
                            <div class="programming-stats1">
                                <div class="earned-container">
                                    <canvas class="earned-chart"></canvas>
                                </div>

                                <div class="details1">
                                    <ul></ul>
                                </div>
                            </div>
                        </div>

                        <div class="line"></div>

                        <div class="absentheat-graph d-flex flex-column">
                            <div class="chart-heading d-flex justify-content-center">Absent hear map</div>
                            <div class="programming-stats3">

                                <div class="form-row weekdays-container">
                                    <div class="col-md-3 ">
                                        <div class="mon" style=" background-color: orange; width: 42px; height: 29px; text-align: center; border-radius: 7px; color: white; font-weight: 100; font-family: system-ui;padding: 3px;font-size: smaller; ">MON</div> 
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="tue" style=" background-color: green; width: 42px; height: 29px; text-align: center; border-radius: 7px; color: white; font-weight: 100; font-family: system-ui;padding: 3px;font-size: smaller; ">TUE</div> 
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="wed" style=" background-color: green; width: 42px; height: 29px; text-align: center; border-radius: 7px; color: white; font-weight: 100; font-family: system-ui;padding: 3px;font-size: smaller; ">WED</div> 
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="thu" style=" background-color: green; width: 42px; height: 29px; text-align: center; border-radius: 7px; color: white; font-weight: 100; font-family: system-ui;padding: 3px;font-size: smaller; ">THU</div> 
                                    </div>
                                  </div>
                                <div class="form-row weekdays-container">
                                    <div class="col-md-3 ">
                                        <div class="fri" style=" background-color: green; width: 42px; height: 29px; text-align: center; border-radius: 7px; color: white; font-weight: 100; font-family: system-ui;padding: 3px;font-size: smaller; ">FRI</div> 
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="sat" style=" background-color: green; width: 42px; height: 29px; text-align: center; border-radius: 7px; color: white; font-weight: 100; font-family: system-ui;padding: 3px;font-size: smaller; ">SAT</div> 
                                    </div>
                                    <div class="col-md-3 ">
                                     <div class="sun" style=" background-color: green; width: 42px; height: 29px; text-align: center; border-radius: 7px; color: white; font-weight: 100; font-family: system-ui;padding: 3px;font-size: smaller; ">Sun</div> 
                                    </div>
                                  </div>

                            </div>
                        </div>

                    </div>

                </div>


                <div class="input-valuses" style=" padding: 17px; font-size: 15px; font-family: system-ui; font-weight: 500; background-color: #DAE1F3 ">January,2024 to March,2024 </div>

                <div class="accordion" id="input-valuses-accord">
                    <div class="card leaveTable-card">
                        <div class="card-header" id="input-valuses-accordOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#input-valuses-accord-collapseOne" aria-expanded="false" aria-controls="input-valuses-accord-collapseOne">
                                    February
                                </button>
                            </h2>
                        </div>
                
                        <div id="input-valuses-accord-collapseOne" class="collapse" aria-labelledby="input-valuses-accordOne" data-parent="#input-valuses-accord">
                            <div class="card-body leaveTable-cardbody">
                                <div id="hp"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card leaveTable-card">
                        <div class="card-header" id="input-valuses-accordTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#input-valuses-accord-collapseTwo" aria-expanded="false" aria-controls="input-valuses-accord-collapseTwo">
                                   March
                                </button>
                            </h2>
                        </div>
                        <div id="input-valuses-accord-collapseTwo" class="collapse" aria-labelledby="input-valuses-accordTwo" data-parent="#input-valuses-accord">
                            <div class="card-body leaveTable-cardbody">
                                <div id="ap"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card leaveTable-card">
                        <div class="card-header" id="input-valuses-accordThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#input-valuses-accord-collapseThree" aria-expanded="false" aria-controls="input-valuses-accord-collapseThree">
                                  April
                                </button>
                            </h2>
                        </div>
                        <div id="input-valuses-accord-collapseThree" class="collapse" aria-labelledby="input-valuses-accordThree" data-parent="#input-valuses-accord">
                            <div class="card-body leaveTable-cardbody">
                                <div id="dp"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
onMounted(() => {
    const script = document.createElement('script');
    script.src = '../../resources/js/planner.js';
    document.head.appendChild(script);
});
</script>

<style scoped>
@import '@/assets/css/planner.css';

</style>