<template>
    <div class="modal-mask" id="Compare">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="CompareLabel">Compare Employee Data</h5>
                        <button type="button" class="close" @click="closeModalCompare">
                            <span aria-hidden="true"><i class="fa-solid fa-circle-xmark fa-2xl"
                                    style="color: #2DB9F8;opacity: 1;"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <Form :key="tableKey" @submit="onSubmit" :validation-schema="currentSchema" @invalid-submit="onInvalidSubmit" :initial-values="formValues"
                    v-slot="{ handleSubmit, values, errors, validate, handleReset  }">
                                <div class="container d-flex flex-column" id="Compare-Date-Format" style="gap: 1rem;">
                                    <div id="Compare-Date-Type" class="d-flex">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <Field type="radio" name="date_type" v-model="CompareDateType" id="Financial-Year" value="FinancialYear"
                                                style="width: 25px;" @click="() => { currentStep = 1;  setToggle('FinancialYear'); handleReset(); }" />
                                            <label for="Financial-Year" style="font-size: 16px;width:145px;margin-bottom: 0px;font-weight: 500; font-family: sans-serif;">By
                                                Financial
                                                Year</label>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <Field type="radio" name="date_type" id="ByYear" value="ByYear" v-model="CompareDateType" 
                                                style="width: 25px;"@click="() => { currentStep = 2; setToggle('ByYear'); handleReset(); }" />
                                            <label for="ByYear" style="font-size: 16px;width: 145px;margin-bottom: 0px;font-weight: 500;font-family: sans-serif;">By Calender
                                                Year</label>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <Field type="radio" name="date_type" id="ByMonth" value="ByMonth" v-model="CompareDateType" 
                                                style="width: 25px;" @click="() => { currentStep = 3; setToggle('ByMonth'); handleReset(); }" />
                                            <label for="ByMonth" style="font-size: 16px;width: 145px;margin-bottom: 0px;font-weight: 500;font-family: sans-serif;">By
                                                Month</label>
                                        </div>
                                    </div>
                                    <div id="Compare-Data-Input">
                                        
                                        <template v-if="currentStep === 1">
                                            
                                        <div id="Compare-Data-FinanInput" class="d-flex flex-column "
                                            style="gap: 1rem;">
                                            <div class="row d-flex">
                                                <div class="col input-group-fname">
                                                    <Field  v-slot="{ field, handleChange }" required name="year_one" as="select" class="form-control input"
                                                        autocomplete="off" style="color: black;height: 50px;width:529px;">
                                                        <option value="" disabled selected>Financial Year-1*</option>
                                                        <option v-for="year in financialYears" :value="year.value">{{year.name}}</option>
                                                    </Field>
                                                    <label class="user-label">Financial Year-1*</label>
                                                </div>
                                            </div>

                                            <div class="row d-flex">
                                                <div class="col input-group-fname">
                                                    <Field required name="year_two" as="select" class="form-control input"
                                                        autocomplete="off" style="color: black;height: 50px;width:529px;">
                                                        <option value="" disabled selected>Financial Year-2*</option>
                                                        <option v-for="year in financialYears" :value="year.value">{{year.name}}</option>
                                                    </Field>
                                                    <label class="user-label">Financial Year-2*</label>
                                                </div>
                                            </div>

                                            <div class="row d-flex">
                                                <div class="col input-group-fname">
                                                    <Field required name="year_three" as="select" class="form-control input"
                                                        autocomplete="off" style="color: black;height: 50px;width:529px;">
                                                        <option value="" disabled selected>Financial Year-3*</option>
                                                        <option v-for="year in financialYears" :value="year.value">{{year.name}}</option>
                                                    </Field>
                                                    <label class="user-label1">Financial Year-3</label>
                                                </div>
                                            </div>

                                            <div class="modal-footer" style="padding-top: 0px;">
                                                <button type="submit" id="Compare-Data-Financi-Year"
                                                    class="btn btn-primary"
                                                    style="background-color: #2DB9F8;border: none;width: 113px;height: 50px;font-size: 16px;font-weight: 500;font-family: poppins,sans-serif;">Compare</button>
                                            </div>
                                        
                                        </div>
                                        </template>
                                        <template v-if="currentStep === 2">
                                        <div id="Compare-Data-YearInput" class="d-flex flex-column " style="gap: 1rem;">
                                            <div class="row d-flex">
                                                <div class="col input-group-fname">
                                                    <Field required name="year_one" as="select" class="form-control input"
                                                        autocomplete="off" style="color: black;height: 50px;width:529px;">
                                                        <option value="" disabled selected>Select Year-1*</option>
                                                        <option v-for="year in calenderYears" :value="year.value">{{year.name}}</option>
                                                    </Field>
                                                    <label class="user-label">Select Year-1*</label>
                                                </div>
                                            </div>


                                            <div class="row d-flex">
                                                <div class="col input-group-fname">
                                                    <Field required name="year_two" as="select" class="form-control input"
                                                        autocomplete="off" style="color: black;height: 50px;width:529px;">
                                                        <option value="" disabled selected>Select Year-2*</option>
                                                        <option v-for="year in calenderYears" :value="year.value">{{year.name}}</option>
                                                    </Field>
                                                    <label class="user-label">Select Year-2*</label>
                                                </div>
                                            </div>


                                            <div class="row d-flex">
                                                <div class="col input-group-fname">
                                                    <Field required name="year_three" as="select" class="form-control input"
                                                        autocomplete="off" style="color: black;height: 50px;width:529px;">
                                                        <option value="" disabled selected>Select Year-3*</option>
                                                        <option v-for="year in calenderYears" :value="year.value">{{year.name}}</option>
                                                    </Field>
                                                    <label class="user-label1">Select Year-3</label>
                                                </div>
                                            </div>

                                            <div class="modal-footer" style="padding-top: 0px;">
                                                <button type="submit" id="Compare-Data-Years" class="btn btn-primary"
                                                    style="background-color: #2DB9F8;border: none;width: 113px;height: 50px;font-size: 16px;font-weight: 500;font-family: poppins,sans-serif;">Compare</button>
                                            </div>
                                        </div>
                                        </template>
                                        <template v-if="currentStep === 3">
                                        <div id="Compare-Data-MonthInput" class="d-flex flex-column "
                                            style="gap: 1rem;">
                                            <div class="row d-flex">
                                                <div class="col input-group-fname">
                                                    <Field required name="month_one" as="select" class="form-control input3"
                                                        autocomplete="off" style="color: black;height: 50px;width: 240px;;">
                                                        <option value="" disabled selected>Select Month-1*</option>
                                                        <option v-for="month in months" :value="month.value">{{month.name}}</option>
                                                    </Field>
                                                    <label class="user-label">Select Month-1*</label>
                                                </div>
                                                <div class="col input-group-fname">
                                                    <Field required name="year_one" as="select" class="form-control input3"
                                                        autocomplete="off" style="color: black;height: 50px;width: 240px;">
                                                        <option value="" disabled selected>Select Year-1*</option>
                                                        <option v-for="year in years" :value="year">{{year}}</option>
                                                    </Field>
                                                    <label class="user-label">Select Year-1*</label>
                                                </div>
                                            </div>
                                            <div class="row d-flex">
                                                <div class="col input-group-fname">
                                                    <Field required name="month_two" as="select" class="form-control input3"
                                                        autocomplete="off" style="color: black;height: 50px;width: 240px;;">
                                                        <option value="" disabled selected>Select Month-2*</option>
                                                        <option v-for="month in months" :value="month.value">{{month.name}}</option>
                                                    </Field>
                                                    <label class="user-label">Select Month-2*</label>
                                                </div>
                                                <div class="col input-group-fname">
                                                    <Field required name="year_two" as="select" class="form-control input3"
                                                        autocomplete="off" style="color: black;height: 50px;width: 240px;">
                                                        <option value="" disabled selected>Select Year-2*</option>
                                                        <option v-for="year in years" :value="year">{{year}}</option>
                                                    </Field>
                                                    <label class="user-label">Select Year-2*</label>
                                                </div>
                                            </div>
                                            <div class="row d-flex">
                                                <div class="col input-group-fname">
                                                    <Field required name="month_three" as="select" class="form-control input3"
                                                        autocomplete="off" style="color: black;height: 50px;width: 240px;;">
                                                        <option value="" disabled selected>Select Month-3*</option>
                                                        <option v-for="month in months" :value="month.value">{{month.name}}</option>
                                                    </Field>
                                                    <label class="user-label">Select Month-3*</label>
                                                </div>
                                                <div class="col input-group-fname">
                                                    <Field required name="year_three" as="select" class="form-control input3"
                                                        autocomplete="off" style="color: black;height: 50px;width: 240px;">
                                                        <option value="" disabled selected>Select Year-3*</option>
                                                        <option v-for="year in years" :value="year">{{year}}</option>
                                                    </Field>
                                                    <label class="user-label">Select Year-3*</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="padding-top: 0px;">
                                                <button type="submit" id="Compare-Data-Months-Year"
                                                    class="btn btn-primary"
                                                    style="background-color: #2DB9F8;border: none;width: 113px;height: 50px;font-size: 16px;font-weight: 500;font-family: poppins,sans-serif;">Compare</button>
                                            </div>
                                        </div>
                                        </template>
                                        <template>
                        <div v-if="valErrors = errors"></div>
                    </template>
                                    
                                    
                                    </div>
                                </div>
                            </Form>
                            </div>
                </div>
            </div>
        </div>
</template>

<script setup>
import { ref, onMounted, watch, computed, inject } from 'vue';
import { useRouter, useRoute } from "vue-router";
// import { useForm, Form, Field } from 'vee-validate';
import { Form, Field, ErrorMessage, useForm } from 'vee-validate';
import useDashboard from "@/composables/useDashboard";
const { getDashboardCompare, loading } = useDashboard();
import * as yup from 'yup';
const swal = inject('$swal')
const currentStep = ref(1);
const formValues = ref(null);
const valErrors = ref({});
const compareData = ref(null)
const CompareDateType = ref('FinancialYear');
const emit = defineEmits(['close']);
const router = useRouter();
const route = useRoute();
const tableKey = ref(0)
const { errors, resetForm, handleSubmit } = useForm({
  validationSchema: yup.object({}),
});

function capitalize(s)
{
    return s[0].toUpperCase() + s.slice(1);
}

const schemas = [
  yup.object({
    year_one: yup.string().required('Financial Years-1 is required'),
    year_two: yup.string().required('Financial Years-2 is required'),
    year_three: yup.string().required('Financial Years-3 is required'),
  }),
  yup.object({
    year_one: yup.string().required('Calender Years-1 is required'),
    year_two: yup.string().required('Calender Years-2 is required'),
    year_three: yup.string().required('Calender Years-3 is required'),
  }),
  yup.object({
    year_one: yup.string().required('Years-1 is required'),
    year_two: yup.string().required('Years-2 is required'),
    year_three: yup.string().required('Years-3 is required'),
    month_one: yup.string().required('Month-1 is required'),
    month_two: yup.string().required('Month-2 is required'),
    month_three: yup.string().required('Month-3 is required'),
  }),
];

const setToggle = (value) => {
    CompareDateType.value = value;
    formValues.value = {};
    tableKey.value++;
}
const currentSchema = computed(() => {
  return schemas[currentStep.value - 1];
}); 

const { validate } = useForm({ validationSchema: currentSchema });

watch(formValues, () => {
    tableKey.value++;
})


// Creates a submission handler
// It validate all fields and doesn't call your function unless all fields are valid
// const onSubmit = handleSubmit(values => {
//     console.log('values',values);
//     alert('rfsg');
//   alert(JSON.stringify(values, null, 2));
// });
function onInvalidSubmit({ values, errors, results }) {
    let current = valErrors.value;
    if (Object.keys(current).length > 0) {
        swal({
            icon: "error",
            title: capitalize(Object.values(current)[0]),
        });
    }
}

const onSubmit = async (values) => {
    let params = {};
    if(values.date_type == 'ByMonth') {
        params = {
            date_type: values.date_type,
            year_one: `${values.year_one}-${values.month_one}`,
            year_two: `${values.year_two}-${values.month_two}`,
            year_three: `${values.year_three}-${values.month_three}`,
        }
    } else {
        params = values;
    }
    emit('close');
    router.push({name:'admin.FinancialYearCompareTable', query: params })
}


onMounted(() => {
    let queryParams = route.query;
    if(Object.keys(queryParams).length > 0) {
        console.log('queryParams',queryParams);
        CompareDateType.value = queryParams.date_type;
        if(queryParams.date_type == 'ByYear') { currentStep.value = 2; }
        if(queryParams.date_type == 'ByMonth') {
            currentStep.value = 3;
            let custom_one = queryParams.year_one.split('-');
            let custom_two = queryParams.year_two.split('-');
            let custom_three = queryParams.year_three.split('-');
            let defaultSelect = {
                year_one : custom_one[0],
                month_one: custom_one[1],
                year_two : custom_two[0],
                month_two: custom_two[1],
                year_three : custom_three[0],
                month_three: custom_three[1],
            }
            formValues.value = defaultSelect;
        } else {
            formValues.value = queryParams;
        }
    }
    
})

const closeModalCompare = () => {
    emit('close');
}

const months = [
    {name: 'January', value: '01'},
    {name: 'February', value: '02'},
    {name: 'March', value: '03'},
    {name: 'April', value: '04'},
    {name: 'May', value: '05'},
    {name: 'June', value: '06'},
    {name: 'July', value: '07'},
    {name: 'August', value: '08'},
    {name: 'September', value: '09'},
    {name: 'October', value: '10'},
    {name: 'November', value: '11'},
    {name: 'December', value: '12'},
];

const financialYears = [
    {name: 'April, 2022 to March, 2023', value: '2022-04-01,2023-03-31'},
    {name: 'April, 2023 to March, 2024', value: '2023-04-01,2024-03-31'},
    {name: 'April, 2024 to March, 2025', value: '2024-04-01,2025-03-31'},
];

const calenderYears = [
    {name: 'Jan, 2022 to Dec, 2022', value: '2022-01-01,2022-12-31'},
    {name: 'Jan, 2023 to Dec, 2023', value: '2023-01-01,2023-12-31'},
    {name: 'Jan, 2024 to Dec, 2024', value: '2024-01-01,2024-12-31'},
];

const years = [2024, 2023, 2022, 2021, 2020, 2019, 2018, 2017, 2016, 2015];

const comparePage = () => {
    router.push({name:'admin.FinancialYearCompareTable'})
}
</script>

<style scoped>
@import '@/assets/css/Home.css';

</style>