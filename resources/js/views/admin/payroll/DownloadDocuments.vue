<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table-info">
            <span>Download Documents</span>
            <span>Payroll > Download Documents</span>
    </div> 
     <div class="d-flex justify-content-start align-items-center" style="background-color: white;gap: 33%;height: 85px;">
                <router-link :to="{ name: 'admin.payroll' }" custom v-slot="{ navigate }">
                    <button @click="navigate" role="link" type="button" class="close1 " data-dismiss="modal"
                        aria-label="Close"
                        style="border:none; background:none;">
                        <span><i class="fa-solid fa-arrow-right fa-flip-horizontal fa-sm"
                                style="color: #000000;"> </i> </span>
                        <span style="cursor: pointer;"> Back</span>
                    </button>
                </router-link>
       </div>
</template>