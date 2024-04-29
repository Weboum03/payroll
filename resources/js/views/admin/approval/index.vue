<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container-fluid">
        <div id="dashboard-table-info">
            <span>Leaves</span>
            <span>Employee > Leaves</span>
        </div>

        <div id="datatable-Emp-info" class="container">


        </div>

        <table id="leavesEmpTable">
            <thead>
                <tr>

                    <th id="Name">Employee</th>
                    <th id="EmpId">Leave Type</th>
                    <th id="Email">From</th>
                    <th id="Mob">To</th>
                    <th id="Role">No of Days</th>
                    <th id="Role">Status</th>
                    <th id="Role">Action</th>

                </tr>
            </thead>
            <tbody>
                <tr data-toggle="modal" data-target="#leaveModal">
                    <td><img :src="apiPath + 'resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'" width="20px"
                            height="20px" style="border-radius: 50%;">
                        Devansh</td>
                    <td>Medical Leave</td>
                    <td>Feb 20,2024</td>
                    <td>Feb 20,2024</td>
                    <td>2 Days</td>
                    <td>
                        <button type="button" class="btn btn-outline-primary " id="pendingBtn">Pending</button>
                        <!-- <button type="button" class="btn btn-outline-success d-none" id="approvedBtn">Approved</button>
                            <button type="button" class="btn btn-outline-danger d-none" id="rejectedBtn">Rejected</button> -->
                    </td>

                    <td><i class="fa-solid fa-ellipsis-vertical fa-sm" style="color: #000000;"></i></td>

                </tr>


            </tbody>
        </table>


        <div class="modal fade" id="leaveModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="leaveModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content" style="height: 500px;">
                    <div class="modal-header">
                        <div id="Leave-approve-profile">
                            <nav class="navbar navbar-light ">
                                <img :src="apiPath + 'resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'" id="admin-image"
                                    class="d-inline-block align-top" alt="">
                                <div class="admin-Leave-approve-profile d-flex flex-column">
                                    <p class="admin-Leave-approve-name">Devansh</p>
                                    <p class="admin-Leave-approve-role">Supervisor</p>
                                </div>
                            </nav>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="leavedetails-popupModal">
                            <div class="form-row">
                                <div class="col d-flex flex-column">
                                    <label for="Leavename" class="Leave-Type">Leave type</label>
                                    <span id="Leavename" class="leave-type">Medical Leave</span>
                                </div>
                                <div class="col d-flex flex-column">
                                    <label for="LeaveAppliedon" class="Leave-Appliedon">Applied on</label>
                                    <span id="LeaveAppliedon" class="leave-appliedon">Feb 19,2024</span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col d-flex flex-column">
                                    <label for="LeaveFrom" class="Leave-From">From</label>
                                    <span id="LeaveFrom" class="leave-from">Feb 20,2024</span>
                                </div>
                                <div class="col d-flex flex-column">
                                    <label for="Leave-To" class="Leave-To">To</label>
                                    <span id="Leave-To" class="leave-to">Feb 22,2024</span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col d-flex flex-column">
                                    <label for="Leave-Days" class="Leave-Days">Leave Days</label>
                                    <span id="Leave Days" class="leave-days">2 Days</span>
                                </div>
                                <div class="col d-flex flex-column">
                                    <label for="Leave-Balance" class="Leave-Balance">Leave Balance</label>
                                    <span id="Leave-Balance" class="leave-balance">5</span>
                                </div>
                            </div>

                            <button type="button" id="View-employee-leave-history" data-toggle="modal"
                                data-target="#modalLeave-list">
                                View employee leave history
                            </button>

                            <div class="row">
                                <div class="col input-group-leaveStatus">
                                    <select class="form-control input" id="Leave-Status" autocomplete="off">
                                        <!-- <option value="" selected disabled>Leave Status</option> -->
                                        <option value="Pending">Pending</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                    </select>
                                    <label class="user-leaveStatus">Leave Status</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col input-group-remarks">
                                    <input placeholder="Remarks" required="" type="text" name="text" autocomplete="off"
                                        class="input">
                                    <label class="user-remarks">Remarks</label>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="save">Save</button>
                    </div>
                </div>
            </div>
        </div>




        <!-- Modal -->
        <div class="modal fade" id="modalLeave-list" data-backdrop="false" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content" style=" width: 870px; height: 500px ">
                    <div class="modal-header" style="align-items: center; gap: 3rem;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style=" margin: 0px; padding: 0px; font-size: medium; color: black !important">
                            <span><i class="fa-solid fa-arrow-right fa-flip-horizontal fa-sm"
                                    style="color: #000000;"></i></span>
                            <span style="cursor: pointer;">Back</span>
                        </button>
                        <div class="data-leave-modal">
                            <select id="dropdown1" class="data-leave-modal"
                                style="height: 30.83px;width: 260px;font-size: 13px;font-weight: 500;font-family: sans-serif;padding-left: 9px;border-radius: 5px;">
                                <option value="Last 3 Months">Last 3 Months</option>
                                <option value="value2">Option 2</option>
                            </select>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table id="dataleave-table-modal">
                            <thead>
                                <tr>
                                    <th id="EmpId">Leave Type</th>
                                    <th id="Email">From</th>
                                    <th id="Mob">To</th>
                                    <th id="Days">Days/Hours</th>
                                    <th id="AppliedOn">Applied On</th>
                                    <th id="Status">Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr data-toggle="modal" data-target="#leaveModal">
                                    <td>Medical Leave</td>
                                    <td>Feb 20,2024</td>
                                    <td>Feb 22,2024</td>
                                    <td>2 Days</td>
                                    <td>Feb 19, 2024</td>
                                    <td>
                                        <button type="text" class="btn" id="pendingBtn"
                                            style="color:#2DB9F8;">Pending</button>
                                        <!-- <button type="button" class="btn btn-outline-success d-none" id="approvedBtn">Approved</button>
                                            <button type="button" class="btn btn-outline-danger d-none" id="rejectedBtn">Rejected</button> -->
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script setup>

import { ref, onMounted } from 'vue';
import '@/assets/css/Approvals.css'


onMounted(() => {
    const script = document.createElement('script');
    script.src = '../../resources/js/Approvals.js';
    document.head.appendChild(script);
});

</script>