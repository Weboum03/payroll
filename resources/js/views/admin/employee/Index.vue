<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container">
        <div id="dashboard-table-info">
            <span>Employee Roles</span>
            <span>Employee Roles > Employee Roles</span>
        </div>

        <div id="datatable-Emp-info" class="container">
            <a href="/admin/EmployeeRoleAdd" class="add2">
                <i class="fa-solid fa-plus fa-xs" style="color: white;"></i>
            </a>
        </div>
        <div id="EmpRolesTable_filter" class="dataTables_filter .add2"
            style="display: flex; justify-content: space-between;"><label>Search:<input type="search" class=""
                    placeholder="" aria-controls="EmpRolesTable"></label></div>
        <table id="EmpRolesTable">
            <thead>
                <tr>

                    <th id="Name">Role Name</th>
                    <th id="EmpId">Permission</th>
                    <th id="Email">Action</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>CEO</td>
                    <td>All</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Team Leader</td>
                    <td>Approve leaves, View employee profile</td>
                    <td>
                        <div class="d-flex" style="gap: 1rem;">
                            <a href="/admin/EmployeeRoleEdit"><i class="fa-solid fa-pencil fa-lg"
                                    style="color:green"></i></a>
                            <i class="fa-regular fa-trash-can fa-lg"
                                style="color:red;line-height: 16px !important;"></i>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>HR</td>
                    <td>On-Board,De-Board,View employee profile,Update employee profile,Leave Approval,Generate Payroll
                    </td>
                    <td>
                        <div class="d-flex" style="gap: 1rem;">
                            <a href="EmployeeRoleEdit.html"><i class="fa-solid fa-pencil fa-lg"
                                    style="color:green;"></i></a>
                            <i class="fa-regular fa-trash-can fa-lg"
                                style="color:red;line-height: 16px !important;"></i>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>

    </div>
</template>

<style scoped>
@import '@/assets/css/EmployeeRole.css';
</style>