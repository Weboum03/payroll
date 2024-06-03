<template>
    <div v-if="props.user" class="modal-mask" id="leaveModal" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="leaveModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="height: 500px;">
                <div class="modal-header">
                    <div id="Leave-approve-profile">
                        <nav class="navbar navbar-light ">
                            <img :src="apiPath + '/resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'"
                                id="admin-image" class="d-inline-block align-top" alt="">
                            <div class="admin-Leave-approve-profile d-flex flex-column">
                                <p class="admin-Leave-approve-name">{{ leave.user.name }}</p>
                                <p class="admin-Leave-approve-role">Supervisor</p>
                            </div>
                        </nav>
                    </div>
                    <button type="button" class="close" @click="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <Form @submit="submitForm" :validation-schema="schema" v-slot="{ validate, errors }" ref="form" >
                <div class="modal-body">
                    <div class="leavedetails-popupModal" >
                        <div class="form-row">
                            <div class="col d-flex flex-column">
                                <label for="Leavename" class="Leave-Type">Leave type</label>
                                <span id="Leavename" class="leave-type">{{ leave.type.type }}</span>
                            </div>
                            <div class="col d-flex flex-column">
                                <label for="LeaveAppliedon" class="Leave-Appliedon">Applied on</label>
                                <span id="LeaveAppliedon" class="leave-appliedon">{{ leave.created_at }}</span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col d-flex flex-column">
                                <label for="LeaveFrom" class="Leave-From">From</label>
                                <span id="LeaveFrom" class="leave-from">{{ leave.from }}</span>
                            </div>
                            <div class="col d-flex flex-column">
                                <label for="Leave-To" class="Leave-To">To</label>
                                <span id="Leave-To" class="leave-to">{{ leave.to }}</span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col d-flex flex-column">
                                <label for="Leave-Days" class="Leave-Days">Leave Days</label>
                                <span id="Leave Days" class="leave-days">{{ leave.duration }} Days</span>
                            </div>
                            <div class="col d-flex flex-column">
                                <label for="Leave-Balance" class="Leave-Balance">Leave Balance</label>
                                <span id="Leave-Balance" class="leave-balance">5</span>
                            </div>
                        </div>

                        <button type="button" @click="viewHistory = true" id="View-employee-leave-history"
                            data-toggle="modal" data-target="#modalLeave-list">
                            View employee leave history
                        </button>

                        <div class="row">
                            <div class="col input-group-leaveStatus">
                                <Field name="status" as="select" class="form-control input"
                                            :class="{ 'is-invalid': errors.status }" v-model="statusData.status"
                                            autocomplete="off" style="color: #7e7e7e;" required>
                                            <option value="" disabled selected>Select</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Rejected">Rejected</option>
                                            <option value="Approved">Approved</option>
                                        </Field>
                                <label class="user-leaveStatus">Leave Status</label>
                                <ErrorMessage name="status" class="text-danger mt-1" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col input-group-remarks">
                                <Field placeholder="Remarks" required="" type="text" name="remarks" v-model="statusData.remarks" autocomplete="off"
                                    class="input" />
                                <label class="user-remarks">Remarks</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-dismiss="modal" id="save">Save</button>
                </div>
            </Form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, defineProps, defineEmits, inject } from 'vue';
import { Form, Field, ErrorMessage } from "vee-validate";
import * as yup from 'yup';
import useLeaves from "@/composables/leaves";
const { updateLeave, validationErrors, isLoading } = useLeaves();
const emit = defineEmits(['close']);
const props = defineProps({
    user: Object,
});


const leave = ref(props.user);
const statusData = ref({
    id : leave.value.id,
    status : leave.value.status,
    remarks: leave.value.remarks
});
// Define a validation schema
const schema =
    yup.object({
        status: yup.string().required("Please enter the required field"),
    });

function submitForm(values, actions) {
    Object.assign(values, statusData.value);
    return updateLeave(values).then( (response) => {
        Object.assign(leave.value, statusData.value);
        emit('close');
    });
}

const closeModal = () => {
    emit('close');
};
</script>

<style scoped>
p {
    margin: 0;
    padding: 5px 0;
}
</style>