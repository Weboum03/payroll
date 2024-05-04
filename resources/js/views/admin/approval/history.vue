<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table" class="container-fluid">
        <div id="dashboard-table-info">
            <span>Approval history</span>
            <span>Leaves > Approval History</span>
        </div>

        <div id="datatable-Emp-info" class="container">


            <button type="button" class="add">
                <i class="fa-solid fa-plus fa-sm" style="color: white;"></i>
            </button>
        </div>

        <table id="Approvedleave-historyTable">
            <thead>
                <tr>

                    <th id="LogTime">Log Time</th>
                    <th id="Reference">Reference</th>
                    <th id="Date">Date</th>
                    <th id="Name">Employee</th>
                    <th id="Description">Description</th>
                    <th id="Remark">Remarks</th>
                    <th id="Status">Status</th>
                    <th id="Action">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>02/25/2024
                        10:51 pm
                    </td>
                    <td>John Doe</td>
                    <td>26/02/2024</td>
                    <td>Austin Hodges</td>
                    <td>Nulla Varlus,sapien</td>
                    <td>Morbi sit amet nulla..</td>
                    <td> <button type="button" class="btn" id="ApprovedBtn"
                            style="color: green; font-size: 14px;">Approved</button></td>
                    <td><i class="fa-solid fa-ellipsis-vertical fa-sm" style="color: #000000;"></i></td>
                </tr>
                <tr>
                    <td>02/25/2024
                        10:51 pm
                    </td>
                    <td>John Doe</td>
                    <td>26/02/2024</td>
                    <td>Austin Hodges</td>
                    <td>Nulla Varlus,sapien</td>
                    <td>Morbi sit amet nulla..</td>
                    <td> <button type="button" class="btn" id="ApprovedBtn"
                            style="color: green; font-size: 14px;">Approved</button></td>
                    <td><i class="fa-solid fa-ellipsis-vertical fa-sm" style="color: #000000;"></i></td>
                </tr>
                <tr>
                    <td>02/25/2024
                        10:51 pm
                    </td>
                    <td>John Doe</td>
                    <td>26/02/2024</td>
                    <td>Austin Hodges</td>
                    <td>Nulla Varlus,sapien</td>
                    <td>Morbi sit amet nulla..</td>
                    <td> <button type="button" class="btn" id="PendingBtn"
                            style="color: rgb(33, 214, 255); font-size: 14px;">Pending</button></td>
                    <td><i class="fa-solid fa-ellipsis-vertical fa-sm" style="color: #000000;"></i></td>
                </tr>
                <tr>
                    <td>02/25/2024
                        10:51 pm
                    </td>
                    <td>John Doe</td>
                    <td>26/02/2024</td>
                    <td>Austin Hodges</td>
                    <td>Nulla Varlus,sapien</td>
                    <td>Morbi sit amet nulla..</td>
                    <td> <button type="button" class="btn" id="RejectedBtn"
                            style="color: rgb(255, 9, 9); font-size: 14px;">Rejected</button></td>
                    <td><i class="fa-solid fa-ellipsis-vertical fa-sm" style="color: #000000;"></i></td>
                </tr>
                <tr>
                    <td>02/25/2024
                        10:51 pm
                    </td>
                    <td>John Doe</td>
                    <td>26/02/2024</td>
                    <td>Austin Hodges</td>
                    <td>Nulla Varlus,sapien</td>
                    <td>Morbi sit amet nulla..</td>
                    <td> <button type="button" class="btn" id="RejectedBtn"
                            style="color: rgb(255, 9, 9); font-size: 14px;">Rejected</button></td>
                    <td><i class="fa-solid fa-ellipsis-vertical fa-sm" style="color: #000000;"></i></td>
                </tr>
                <tr>
                    <td>02/25/2024
                        10:51 pm
                    </td>
                    <td>John Doe</td>
                    <td>26/02/2024</td>
                    <td>Austin Hodges</td>
                    <td>Nulla Varlus,sapien</td>
                    <td>Morbi sit amet nulla..</td>
                    <td> <button type="button" class="btn" id="RejectedBtn"
                            style="color: rgb(255, 9, 9); font-size: 14px;">Rejected</button></td>
                    <td><i class="fa-solid fa-ellipsis-vertical fa-sm" style="color: #000000;"></i></td>
                </tr>
                <tr>
                    <td>02/25/2024
                        10:51 pm
                    </td>
                    <td>John Doe</td>
                    <td>26/02/2024</td>
                    <td>Austin Hodges</td>
                    <td>Nulla Varlus,sapien</td>
                    <td>Morbi sit amet nulla..</td>
                    <td> <button type="button" class="btn" id="RejectedBtn"
                            style="color: rgb(255, 9, 9); font-size: 14px;">Rejected</button></td>
                    <td><i class="fa-solid fa-ellipsis-vertical fa-sm" style="color: #000000;"></i></td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script setup>

import { ref, onMounted } from 'vue';
// import '@/assets/css/ApprovalHistory.css'


onMounted(() => {
    // Create a script element
    const script = document.createElement('script');
    script.src = '../../resources/js/ApporvalHistory.js';

    // Append the script element to the document's head
    document.head.appendChild(script);
});

</script>