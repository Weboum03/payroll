<template>
    <!-- -----nav-dashboard-table start----- -->


    <div id="dashboard-table" class="container">
        <div id="dashboard-table-info">
            <span>De-board</span>
            <span>Employees > De-board</span>
        </div>

        <div id="form-info" class="container" style="margin-bottom: 2rem;">
            <div class="form">
                <div class=" d-flex flex-column">
                    <div class="Add-emp-div">De-board Employee</div>
                    <div class="div-emp-rem">Follow these steps to update the system when an employee leaves (or is
                        preparing to leave) employment with the company. </div>
                </div>
                <!-- Progress bar -->
                <div class="progressbar container">
                    <div class="progress" :style="{ width: boxWidth + '%' }"></div>

                    <div class="progress-step progress-step-active" data-title="Personal Details"></div>
                    <div class="progress-step" :class="{ 'progress-step-active': currentStep >= 1 }"
                        data-title="Employment"></div>
                    <div class="progress-step" :class="{ 'progress-step-active': currentStep >= 2 }"
                        data-title="Entitlement"></div>
                    <div class="progress-step" :class="{ 'progress-step-active': currentStep >= 3 }" data-title="Tasks">
                    </div>
                    <div class="progress-step" :class="{ 'progress-step-active': currentStep >= 4 }"
                        data-title="Complete">
                    </div>
                </div>

                <Form @submit="nextStep" keep-values :validation-schema="currentSchema" @invalid-submit="onInvalidSubmit"
                    v-slot="{ handleSubmit, values, errors }">
                    <!-- Steps -->
                    <template v-if="currentStep === 0">
                        <div class="form-step form-step-active">
                            <div class="personal-infor">

                                <div class="row">
                                    <div class="col input-group-fname">
                                        <Field required name="reason" as="select" class="form-control input"
                                            autocomplete="off" style="color: #7e7e7e;">
                                            <option value="" disabled selected>Reason for De-boarding*</option>
                                            <option value="Resignation (Voluntary)">Resignation (Voluntary)</option>
                                            <option value="Termination (Involuntary)">Termination (Involuntary)</option>
                                            <option value="End of Contract">End of Contract</option>
                                            <option value="Retirement">Retirement</option>
                                            <option value="Layoff">Layoff</option>
                                            <option value="Relocation">Relocation</option>
                                            <option value="Career Change">Career Change</option>
                                            <option value="Personal Reasons">Personal Reasons</option>
                                            <option value="Health Reasons">Health Reasons</option>
                                            <option value="Family Reasons">Family Reasons</option>
                                        </Field>
                                        <label for="reason" class="user-label">Reason for De-boarding*</label>
                                        <ErrorMessage name="reason" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field required name="notice_period" as="select" class="form-control input"
                                            autocomplete="off" style="color: #7e7e7e;">
                                            <option value="" disabled selected>Notice Period*</option>
                                            <option value="1 Week">1 Week</option>
                                            <option value="2 Weeks">2 Weeks</option>
                                            <option value="3 Weeks">3 Weeks</option>
                                            <option value="1 Month">1 Month</option>
                                            <option value="2 Months">2 Months</option>
                                            <option value="3 Months">3 Months</option>
                                            <option value="Immediate">Immediate</option>
                                        </Field>
                                        <label for="notice_period" class="user-label">Notice Period*</label>
                                        <ErrorMessage name="notice_period" class="text-danger mt-1" />
                                    </div>
                                </div>
                                <div class="row d-flex">

                                    <div class="col input-group-fname">
                                        <Field type="text" as="textarea" name="comment"
                                            :class="{ 'is-invalid': errors.comment }" placeholder="Additional Comments"
                                            class="input1" id="additionalComment" autocomplete="off" />
                                        <label for="comment" class="user-label">Additional Comments</label>
                                        <ErrorMessage name="comment" class="text-danger mt-1" />
                                    </div>
                                </div>
                                <div class="row justify-content-start align-items-start">
                                    <div class="col input-group-fname">

                                        <Field required type="text" name="start_date" class="input"
                                            onfocus="(this.type='date')" autocomplete="off"
                                            placeholder="De-Boarding Date*"
                                            :class="{ 'is-invalid': errors.start_date }" />
                                        <label for="html" class="user-label ">De-Boarding Date*</label>
                                        <ErrorMessage name="start_date" class="text-danger mt-1" />

                                    </div>

                                    <div class="col input-group-fname">
                                        <label class="custom-checkbox d-flex justify-content-center align-items-center"
                                            style="gap: .5rem;">
                                            <span class="checkmark"></span>
                                            <input name="dummy" type="checkbox"> Make a Leaver Immediately?
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col input-group-fname">
                                        <Field required type="text" name="final_employment_date" class="input"
                                            onfocus="(this.type='date')" autocomplete="off"
                                            placeholder="Final Employment Date*"
                                            :class="{ 'is-invalid': errors.final_employment_date }" />
                                        <label for="html" class="user-label ">Final Employment Date*</label>
                                        <ErrorMessage name="final_employment_date" class="text-danger mt-1" />
                                    </div>

                                    <div class="col input-group-fname">
                                        <Field required type="text" name="final_working_date" class="input"
                                            onfocus="(this.type='date')" autocomplete="off"
                                            placeholder="Final Working Date*"
                                            :class="{ 'is-invalid': errors.final_working_date }" />
                                        <label for="html" class="user-label ">Final Working Date*</label>
                                        <ErrorMessage name="final_working_date" class="text-danger mt-1" />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </template>
                    <template v-if="currentStep === 1">
                        <div class="form-step form-step-active" style="padding: 20px; gap: 1.5rem;">
                            <div class="profile d-flex">
                                <div class="icon_wrap d-flex align-items-center" style="gap: .5rem;">
                                    <img v-if="user?.user_profile_picture" :src="user?.user_profile_picture"
                                        alt="profile_pic">
                                    <img v-else
                                        :src="apiPath + '/resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'"
                                        alt="profile_pic">
                                    <span class="name">{{ user?.first_name }} {{ user?.last_name }}</span>
                                </div>
                            </div>

                            <div class="row d-flex">
                                <div class="col input-group-fname">
                                    <Field required name="report_to" as="select" class="form-control input"
                                        autocomplete="off" style="color: #7e7e7e;">
                                        <option value="" disabled selected>Re-Assign Direct Reports to*</option>
                                        <option v-for="user in users?.data" :value="user.id">{{ user.name }}</option>
                                    </Field>
                                    <label for="report_to" class="user-label">Re-Assign Direct Reports to*</label>
                                    <ErrorMessage name="report_to" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row d-flex">
                                <div class="col input-group-fname">
                                    <Field type="text" as="textarea" name="support_comment"
                                        :class="{ 'is-invalid': errors.support_comment }"
                                        placeholder="Supporting Comments" class="input1" id="supportingComments"
                                        autocomplete="off" />
                                    <label for="support_comment" class="user-label">Supporting Comments</label>
                                    <ErrorMessage name="support_comment" class="text-danger mt-1" />
                                </div>
                            </div>


                            <div style=" font-size: x-small; font-weight: 500;">Re-employable*</div>
                            <div class="d-flex align-items-center" style="gap: 1rem;margin-top: -15px;">
                                <div class="d-flex" style="gap: .5rem;">
                                    <input type="radio" checked name="re_employable" id="radioYes" value="Yes" required
                                        style="width: 13px;">
                                    <label for="radioYes"
                                        style="font-size: 14px;font-weight: 500;margin-top: 3px;margin-bottom: 0px;">Yes</label>
                                </div>
                                <div class="d-flex" style="gap: .5rem;">
                                    <input type="radio" name="re_employable" id="radioNo" value="No" required
                                        style="width: 13px;">
                                    <label for="radioNo"
                                        style="font-size: 14px;font-weight: 500;margin-top: 1px;margin-bottom: 0px;">No</label>
                                </div>
                            </div>
                        </div>
                    </template>

                    <template v-if="currentStep === 2">
                        <div class="form-step form-step-active" style="gap: 2rem;padding: 15px;">
                            <div class="profile d-flex">
                                <div class="icon_wrap d-flex align-items-center" style="gap: .5rem;">
                                    <img v-if="user?.user_profile_picture" :src="user?.user_profile_picture"
                                        alt="profile_pic">
                                    <img v-else
                                        :src="apiPath + '/resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'"
                                        alt="profile_pic">
                                    <span class="name">{{ user?.first_name }} {{ user?.last_name }}</span>
                                </div>
                            </div>
                            <div class="row d-flex">
                                <div class="col input-group-fname">
                                    <Field required type="number" name="remaining_pl_year" class="input"
                                        autocomplete="off" placeholder="Remaining Earned Leaves This Year*"
                                        :class="{ 'is-invalid': errors.remaining_pl_year }" />
                                    <label for="html" class="user-label ">Remaining Earned Leaves This Year*</label>
                                    <ErrorMessage name="remaining_pl_year" class="text-danger mt-1" />
                                </div>
                            </div>
                            <div class="row d-flex">
                                <div class="col input-group-fname">
                                    <Field required type="number" name="remaining_pl_leave" class="input"
                                        id="proRataLeavingDate" autocomplete="off"
                                        placeholder="Remaining Earned Leaves (Pro-Rata based on leaving date)"
                                        :class="{ 'is-invalid': errors.remaining_pl_leave }" />
                                    <label for="html" class="user-label ">Remaining Earned Leaves (Pro-Rata based on
                                        leaving date)</label>
                                    <ErrorMessage name="remaining_pl_leave" class="text-danger mt-1" />
                                </div>
                            </div>
                        </div>
                    </template>

                    <template v-if="currentStep === 3">
                        <div class="form-step form-step-active" style="gap: 2rem;">
                            <div class="profile1 d-flex">
                                <div class="icon_wrap d-flex align-items-center" style="gap: .5rem;">
                                    <img v-if="user?.user_profile_picture" :src="user?.user_profile_picture"
                                        alt="profile_pic">
                                    <img v-else
                                        :src="apiPath + '/resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'"
                                        alt="profile_pic">
                                    <span class="name">{{ user?.first_name }} {{ user?.last_name }}</span>
                                </div>
                                <div class="d-flex">
                                    <div class="showalltask-div">
                                        <input type="checkbox" name="" id="">
                                        <div class="p1">Show all tasks</div>
                                    </div>

                                </div>
                            </div>

                            <div class="container p3">Basic information is completed, and you are almost done. Below are
                                suggestion you may with to your task list. Simply select the tasks you'd like to add, or
                                create
                                your own. </div>


                            <div class="container d-flex flex-column" style="gap: 1.1rem;">

                                <div class="row ">
                                    <DeboardDoc v-for="component in uploadComponent" :is="component" :key="component.id" @delete-input="deleteInput(component.id)" @update-ref="updateDocRefValue"></DeboardDoc>
                                    <div class="col-sm-4">
                                        <div class="card  card2">
                                            <div class="card-body d-flex justify-content-center align-items-center">
                                                <div class="showalltask-card d-flex flex-column">
                                                    <a id="myAnchor" href="#" class="btn btn-primary removeTask1"
                                                        data-toggle="modal" data-target="#AddDocModal"
                                                        @click="openModal">Add Task</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </template>

                    <template v-if="currentStep === 4">
                        <div class="form-step form-step-active">

                            <div class="container d-flex flex-column" style="gap: 2rem;">

                                <div class="d-flex justify-content-center align-items-center" style="gap: 1rem;">
                                    <div class="done-task d-flex flex-column justify-content-center align-items-center"
                                        style="gap: 1rem;">
                                        <div class="d-flex align-items-center" style="gap: 1rem;"><i
                                                class="fa-solid fa-circle-check fa-xl" style="color: #1B8A5A;"></i>
                                            <div style="font-size: 14px;font-weight: 600;">Done! <span
                                                    style="color: #2DB9F8;font-weight: bold;font-size: 13px;"> {{ user?.first_name }} {{ user?.last_name }}</span> is successfully deboarded from the system.
                                            </div>
                                        </div>
                                        <div style="font-size: 13px;font-weight: 500">Unique employee ID was <span
                                                style="color: #2DB9F8;">{{ user?.employee_id }}</span></div>
                                        <div class="div-emp-rem"> What would you like to do next?</div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column justify-content-center align-items-center"
                                    style="gap: 1rem;">
                                    <a href="/admin/EmpProfile" class="btn btn-primary btn1">Finish and visit
                                        employee's
                                        profile</a>
                                    <a href="/admin/dashboard" class="btn btn-primary btn1">Finish and exit</a>
                                </div>

                            </div>


                        </div>
                    </template>

                    <div v-if="currentStep < 4" class="form-step form-step-active">
                        <div class="personal-infor">
                            <div class="btns-save-cancle" style="margin-top: -9px;">
                                <button class="btn btn-next btn-primary savenext">Save & Next</button>
                                <a href="javascript:;" v-if="currentStep !== 0" @click="prevStep"
                                    class="btn btn-outline-light cancle">Back</a>
                            </div>
                        </div>
                    </div>
                    <template>
                        <div v-if="valErrors = errors"></div>
                    </template>
                </Form>
            </div>
        </div>
    </div>

    <div v-if="isModalOpened" class="modal-mask" id="AddDocModal" tabindex="-1" aria-labelledby="AddDocModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddDocModalLabel">Add Document</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" @click="closeModal">
                        <span aria-hidden="true"><i class="fa-solid fa-circle-xmark fa-2xl"
                                style="color: #2DB9F8"></i></span>
                    </button>
                </div>
                <Form @submit="submitDocForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col input-group-fname">
                                <Field placeholder="Document name*" required type="text" name="docName" autocomplete="off"
                                    class="input" id="Doc-name" style="width: 310px;" />
                                <label class="user-label">Document name*</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn  btn-primary save">Save</button>
                        <a href="javascript:;" class="btn btn-outline-light cancle" @click="closeModal">Cancel</a>
                    </div>
                </Form>

            </div>
        </div>
    </div>
</template>
<script setup>
import { Form, Field, ErrorMessage, useForm } from 'vee-validate';
import * as yup from 'yup';
import { ref, onMounted, reactive, computed, inject, watch } from 'vue';
import useUsers from "@/composables/users";
import { useRoute, useRouter } from "vue-router";
import DeboardDoc from "../../../components/DeboardDoc.vue";
const { users, user, getUser, getReportingUsers, storeUser, validationErrors, validationMessage, isLoading, deleteUser } = useUsers();
const route = useRoute()
const router = useRouter();
const swal = inject('$swal')
const currentStep = ref(0);
const boxWidth = ref(0); // Initial width
const valErrors = ref({});

const uploadComponent = ref([
    {
        id : Math.random().toString(36).substring(7),
        title:'Equipment',
        type:'equipment',
        edit:true
    },
    {
        id : Math.random().toString(36).substring(7),
        title:'Exit Interview',
        type:'exit_interview',
        edit:false
    },
    {
        id : Math.random().toString(36).substring(7),
        title:'Internal Update',
        type:'internal_update',
        edit:true
    },
    {
        id : Math.random().toString(36).substring(7),
        title:'Relieving letter',
        type:'relieving_letter',
        edit:true
    }
]);

function capitalize(s)
{
    return s[0].toUpperCase() + s.slice(1);
}

function onInvalidSubmit({ values, errors, results }) {
    let current = valErrors.value;
    if (Object.keys(current).length > 0) {
        swal({
            icon: "error",
            title: capitalize(Object.values(current)[0]),
        });
    }
}

const updateDocRefValue = (newValue) => {
    filesToUpload.value[newValue.name] = newValue.path;
    console.log('Rahul',newValue);
    console.log(filesToUpload.value);
}

const deleteInput = (id) => {
    uploadComponent.value.splice(uploadComponent.value.findIndex(component => component.id === id), 1);
};

const schemas = [
    yup.object({
        reason: yup.string().required('Reason is required'),
        notice_period: yup.string().required("Notice Period is required!"),
        start_date: yup.string().required("De-Boarding Date is required!"),
        final_employment_date: yup.string().required("Final Employment Date is required!")
        .test('is-greater', 'Final Employment date should be greater than De-Boarding date', function(value) {
        const { start_date } = this.parent;
        const date = new Date(value);
        // Get year, month, and day part from the date
        var year = date.toLocaleString("default", { year: "numeric" });
        var month = date.toLocaleString("default", { month: "2-digit" });
        var day = date.toLocaleString("default", { day: "2-digit" });
        var formattedDate = year + "-" + month + "-" + day;
        return !start_date || !value || formattedDate > start_date;
        }),
        final_working_date: yup.date().required('End date is required')
        .test('is-greater', 'Final Working date should be greater than De-Boarding date', function(value) {
        const { start_date } = this.parent;
        const date = new Date(value);
        // Get year, month, and day part from the date
        var year = date.toLocaleString("default", { year: "numeric" });
        var month = date.toLocaleString("default", { month: "2-digit" });
        var day = date.toLocaleString("default", { day: "2-digit" });
        var formattedDate = year + "-" + month + "-" + day;
        return !start_date || !value || formattedDate > start_date;
        }),
    }),
    yup.object({
        report_to: yup.string().required("Report To Required!"),
        // support_comment: yup.string().required("Required!"),
        // re_employable: yup.string().required("Required!"),
    }),
    yup.object({
        remaining_pl_year: yup.string().required("Remaining Earned Leaves this year is required!"),
        remaining_pl_leave: yup.string().required("Remaining Earned Leaves is required!!"),
    }),
];

onMounted(async () => {
    getUser(route.params.id)
    getReportingUsers()
});

const currentSchema = computed(() => {
    return schemas[currentStep.value];
});

const submitDocForm = (values) => {
    uploadComponent.value.push({
        id: Math.random().toString(36).substring(7),
        title: values.docName,
        edit:true
    });
    closeModal();
}

async function submitForm(user) {
    await deleteUser(route.params.id, user);
}

async function nextStep(values, user) {
    if (currentStep.value === 3) {
        return submitForm(values).then(response => { currentStep.value++; boxWidth.value = '72'; }).catch(error => { return });
    }
    currentStep.value++;
    boxWidth.value = currentStep.value == 1 ? '18' : currentStep.value == 2 ? '36' : currentStep.value == 3 ? '54' : currentStep.value == 4 ? '72' : '0';
}

function cancel() {
    router.push({ name: 'admin.onBoard' })
}
function prevStep() {
    if (currentStep.value <= 0) {
        return;
    }
    currentStep.value--;
    boxWidth.value = currentStep.value == 1 ? '18' : currentStep.value == 2 ? '36' : currentStep.value == 3 ? '54' : currentStep.value == 4 ? '72' : '0';
}

const isModalOpened = ref(false);
const openModal = () => {
    isModalOpened.value = true;
};
const closeModal = () => {
    isModalOpened.value = false;
};
</script>


<style>
@import '@/assets/css/de-board.css';

.modal-mask {
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, .2);
    border-radius: .3rem;
    outline: 0;
    width: 100% !important;
}
</style>