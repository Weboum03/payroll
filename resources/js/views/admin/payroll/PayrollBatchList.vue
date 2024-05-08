<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container">
        <div id="dashboard-table-info">
            <span>Payroll</span>
            <span>Patroll > Payroll batch</span>
        </div>
        <div class="container header d-flex flex-column">
            <div class="d-flex justify-content-start align-items-center" style="background-color: white; gap: 12rem;">
                <router-link :to="{ name: 'admin.home' }" custom v-slot="{ navigate }">
                    <button @click="navigate" role="link"
                        style=" margin: 0px; padding: 0px; font-size: medium; color: black !important">
                        <span><i class="fa-solid fa-arrow-right fa-flip-horizontal fa-sm"
                                style="color: #000000;"></i></span>
                        <span style="cursor: pointer;">Back to list</span>
                    </button>
                </router-link>
                <h5>March2024_Lipsum</h5>
            </div>

            <table id="PayrollbatchList-Table">
                <thead>
                    <tr>
                        <th> Delete</th>
                        <th> Sr.No.</th>
                        <th> EMP ID</th>
                        <th> Name</th>
                        <th> Designation</th>
                        <th> PF</th>
                        <th> ESIC</th>
                        <th>DOJ</th>
                        <th>Last Day</th>
                        <th> Payment Frequency</th>
                        <th> Over Time</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="Delete"><i class="fa-regular fa-trash-can fa-lg" style="color: #f02828;"></i></td>
                        <td id="srNo">1</td>
                        <td id="EmpId">7608951</td>
                        <td id="Emp-name">Austin Hodges</td>
                        <td id="Desig">Supervisor</td>
                        <td id="pf">Yes</td>
                        <td id="esic">Yes</td>
                        <td id="doj">Jul 21,2015</td>
                        <td id="Lday">-</td>
                        <td id="payFre"> Monthly</td>
                        <td id="OT">0</td>
                    </tr>
                    <tr>
                        <td class="Delete"><i class="fa-regular fa-trash-can fa-lg" style="color: #f02828;"></i></td>
                        <td id="srNo">2</td>
                        <td id="EmpId">9331728</td>
                        <td id="Emp-name">Ben Hunter</td>
                        <td id="Desig">Supervisor</td>
                        <td id="pf">Yes</td>
                        <td id="esic">Yes</td>
                        <td id="doj">Mar 10,2016</td>
                        <td id="Lday">-</td>
                        <td id="payFre"> Monthly</td>
                        <td id="OT">2hr</td>
                    </tr>
                    <tr>
                        <td class="Delete"><i class="fa-regular fa-trash-can fa-lg" style="color: #f02828;"></i></td>
                        <td id="srNo">3</td>
                        <td id="EmpId">7437663</td>
                        <td id="Emp-name">Chloe Edum</td>
                        <td id="Desig">Supervisor</td>
                        <td id="pf">Yes</td>
                        <td id="esic">Yes</td>
                        <td id="doj">Apr 24,2017</td>
                        <td id="Lday">-</td>
                        <td id="payFre"> Monthly</td>
                        <td id="OT">0</td>
                    </tr>
                    <tr>
                        <td class="Delete"><i class="fa-regular fa-trash-can fa-lg" style="color: #f02828;"></i></td>
                        <td id="srNo">4</td>
                        <td id="EmpId">7758597</td>
                        <td id="Emp-name">Irene Skinner</td>
                        <td id="Desig">Supervisor</td>
                        <td id="pf">Yes</td>
                        <td id="esic">Yes</td>
                        <td id="doj">Sep 2,2019</td>
                        <td id="Lday">-</td>
                        <td id="payFre"> Monthly</td>
                        <td id="OT">0</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped>
@import '@/assets/css/PayrollBatchList.css';
</style>