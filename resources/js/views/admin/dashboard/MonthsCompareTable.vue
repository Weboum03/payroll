<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container">
        <div id="dashboard-table-info">
            <span>DASHBOARD</span>
            <span>Employee > Dashboard</span>
        </div>

        <div class="d-flex justify-content-between" style="padding: 10px;background-color: #DAE1F3;">
            <div class="d-flex" style="gap: 2rem;">
                <button type="button" class="close1" data-dismiss="modal" aria-label="Close"
                    style=" margin: 0px; padding: 0px; font-size: medium; color: black !important; border: none;background-color: transparent;">
                    <span><i class="fa-solid fa-arrow-right fa-flip-horizontal fa-sm"
                            style="color: #000000;"></i></span>
                    <span>Data comparision</span>
                </button>

            </div>
            <div><button type="button" id="Modify" data-toggle="modal" data-target="#Compare">Modify</button></div>
        </div>

        <div style=" background-color: white; font-size: 9px; padding: 12px; color: #A8A8A8; font-weight: 500">
            Comparison data between financial yaer April-2022 to March-2023,April-2023 to March-2024 and April-2024 to
            March-2025</div>

        <div class="FinancialYearcompareTable" style="margin-top: -14px;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td scope="col"></td>
                        <td scope="col">March-2022</td>
                        <td scope="col">March-2023</td>
                        <td scope="col">March-2024</td>
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
</style>