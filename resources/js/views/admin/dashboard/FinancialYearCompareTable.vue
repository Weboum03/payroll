<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container">
        <div id="dashboard-table-info">
            <span>DASHBOARD</span>
            <span>Employee > Dashboard</span>
        </div>

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
            <div><button type="button" id="Modify" data-toggle="modal" data-target="#Compare">Modify</button>
            </div>
        </div>

        <div style=" background-color: white; font-size: 9px; padding: 12px; color: #A8A8A8; font-weight: 500">
            Comparison data between financial yaer April-2022 to March-2023,April-2023 to March-2024 and
            April-2024 to March-2025</div>

        <div class="FinancialYearcompareTable" style="margin-top: -14px;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td scope="col"></td>
                        <td scope="col">April 2022 to March-2023</td>
                        <td scope="col">April 2023 to March-2024</td>
                        <td scope="col">April 2024 to March-2025</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">Employee Count</td>
                        <td>4652</td>
                        <td>4732</td>
                        <td>5406</td>
                    </tr>
                    <tr>
                        <td scope="row">New Starter</td>
                        <td>652</td>
                        <td>586</td>
                        <td>354</td>
                    </tr>
                    <tr>
                        <td scope="row">Leaver</td>
                        <td>573</td>
                        <td>324</td>
                        <td>335</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="Compare" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="CompareLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CompareLabel">Compare Employee Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-circle-xmark fa-lg"
                                style="color: #2DB9F8;opacity: 1;"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container d-flex flex-column" id="Compare-Date-Format" style="gap: 1rem;height: 253px;">
                        <div id="Compare-Date-Type" class="d-flex">
                            <div class="d-flex justify-content-center align-items-center">
                                <input type="radio" name="CompareDateType" id="Financial-Year" value="FinancialYear"
                                    style="width: 25px;" onclick="radioshow(event)" checked>
                                <label for="Financial-Year" style="font-size: 13px;width: 115px;margin-bottom: 0px;">By
                                    Financial
                                    Year</label>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <input type="radio" name="CompareDateType" id="ByYear" value="ByYear"
                                    style="width: 25px;" onclick="radioshow(event)">
                                <label for="ByYear" style="font-size: 13px;width: 115px;margin-bottom: 0px;">By Calender
                                    Year</label>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <input type="radio" name="CompareDateType" id="ByMonth" value="ByMonth"
                                    style="width: 25px;" onclick="radioshow(event)">
                                <label for="ByMonth" style="font-size: 13px;width: 115px;margin-bottom: 0px;">By
                                    Month</label>
                            </div>
                        </div>
                        <div id="Compare-Data-Input">
                            <div id="Compare-Data-FinanInput" class="d-flex flex-column " style="gap: 1rem;">

                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <select class="form-control input" id="FinancialYear1" autocomplete="off"
                                            style="color: black; height: 40px;" required="">
                                            <option value="" disabled selected>Financial Year-1*</option>
                                            <option value="Option1">Option1</option>
                                            <option value="Option2">Option2</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <label class="user-label">Financial Year-1*</label>
                                    </div>
                                </div>


                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <select class="form-control input" id="FinancialYear2" autocomplete="off"
                                            style="color: black; height: 40px;" required="">
                                            <option value="" disabled selected>Financial Year-2*</option>
                                            <option value="Option1">Option1</option>
                                            <option value="Option2">Option2</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <label class="user-label">Financial Year-2*</label>
                                    </div>
                                </div>


                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <select class="form-control input1" id="FinancialYear3" autocomplete="off"
                                            style="color: black; height: 40px;">
                                            <option value="" disabled selected>Financial Year-3</option>
                                            <option value="Option1">Option1</option>
                                            <option value="Option2">Option2</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <label class="user-label1">Financial Year-3</label>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" id="Compare-Data-Financi-Year" class="btn btn-primary"
                                        style="background-color: #2DB9F8;border: none;">Compare</button>
                                </div>

                            </div>
                            <div id="Compare-Data-YearInput" class="d-flex flex-column " style="gap: 1rem;">
                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <select class="form-control input" id="Year1" autocomplete="off"
                                            style="color: black; height: 40px;" required="">
                                            <option value="" disabled selected>Select Year-1*</option>
                                            <option value="Option1">Option1</option>
                                            <option value="Option2">Option2</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <label class="user-label">Select Year-1*</label>
                                    </div>
                                </div>


                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <select class="form-control input" id="Year2" autocomplete="off"
                                            style="color: black; height: 40px;" required="">
                                            <option value="" disabled selected>Select Year-2*</option>
                                            <option value="Option1">Option1</option>
                                            <option value="Option2">Option2</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <label class="user-label">Select Year-2*</label>
                                    </div>
                                </div>


                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <select class="form-control input1" id="Year3" autocomplete="off"
                                            style="color: black; height: 40px;">
                                            <option value="" disabled selected> Select Year-3</option>
                                            <option value="Option1">Option1</option>
                                            <option value="Option2">Option2</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <label class="user-label1">Select Year-3</label>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" id="Compare-Data-Years" class="btn btn-primary"
                                        style="background-color: #2DB9F8;border: none;">Compare</button>
                                </div>
                            </div>



                            <div id="Compare-Data-MonthInput" class="d-flex flex-column" style="gap: 1rem;">
                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <select class="form-control input3" id="Month1" autocomplete="off"
                                            style="color: black; height: 40px;" required="">
                                            <option value="" disabled selected>Select Month-1*</option>
                                            <option value="Option1">Option1</option>
                                            <option value="Option2">Option2</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <label class="user-label">Select Month-1*</label>
                                    </div>
                                    <div class="col input-group-fname">
                                        <select class="form-control input3" id="Year1" autocomplete="off"
                                            style="color: black; height: 40px;" required="">
                                            <option value="" disabled selected>Select Year-1*</option>
                                            <option value="Option1">Option1</option>
                                            <option value="Option2">Option2</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <label class="user-label">Select Year-1*</label>
                                    </div>
                                </div>
                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <select class="form-control input3" id="Month2" autocomplete="off"
                                            style="color: black; height: 40px;" required="">
                                            <option value="" disabled selected>Select Month-2*</option>
                                            <option value="Option1">Option1</option>
                                            <option value="Option2">Option2</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <label class="user-label">Select Month-2*</label>
                                    </div>
                                    <div class="col input-group-fname">
                                        <select class="form-control input3" id="Year2" autocomplete="off"
                                            style="color: black; height: 40px;" required="">
                                            <option value="" disabled selected>Select Year-2*</option>
                                            <option value="Option1">Option1</option>
                                            <option value="Option2">Option2</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <label class="user-label">Select Year-2*</label>
                                    </div>
                                </div>
                                <div class="row d-flex">
                                    <div class="col input-group-fname">
                                        <select class="form-control input3" id="Month3" autocomplete="off"
                                            style="color: black; height: 40px;" required="">
                                            <option value="" disabled selected>Select Month-3*</option>
                                            <option value="Option1">Option1</option>
                                            <option value="Option2">Option2</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <label class="user-label">Select Month-3*</label>
                                    </div>
                                    <div class="col input-group-fname">
                                        <select class="form-control input3" id="Year3" autocomplete="off"
                                            style="color: black; height: 40px;" required="">
                                            <option value="" disabled selected>Select Year-3*</option>
                                            <option value="Option1">Option1</option>
                                            <option value="Option2">Option2</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <label class="user-label">Select Year-3*</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="Compare-Data-Months-Year" class="btn btn-primary"
                                        style="background-color: #2DB9F8;border: none;">Compare</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

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

.FinancialYearcompareTable {
    background-color: white;
    padding: 20px;
}

#Modify {
    border: none;
    background-color: #2DB9F8;
    color: white;
    border-radius: 4px;
    padding: 9px;
    font-size: 12px;
    width: 65px;
    height: 35px;

}

#Compare .modal-body {
    overflow: hidden !important;
    height: 273px;
}

#Compare .modal-footer {
    padding-top: 0px;
}
</style>