
<template>
    <div>
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-3xl">Advanced</h2>
            <a target="_blank" href="https://github.com/bhaveshpatel200/vue3-datatable-document/blob/main/pages/advanced.vue" class="btn">
                
                View Source
            </a>
        </div>

        <vue3-datatable
            :rows="rows"
            :columns="cols"
            :loading="loading"
            :totalRows="total_rows"
            :isServerMode="true"
            :pageSize="params.pagesize"
            :sortable="true"
            :sortColumn="params.sort_column"
            :sortDirection="params.sort_direction"
            class="display container-fluid"
            @change="changeServer"
        >
            <template #id="data">
                {{ data.value.first_name }}
            </template>

            <template #employee_id="data">
                {{ data.value.employee_id }}
            </template>

            <template #email="data">
                {{ data.value.email }}
            </template>

            <template #phone="data">
                {{ data.value.phone }}
            </template>

            <template #role="data">
                {{ data.value.role }}
            </template>
            
            <template #status>
                <span class="badge" :class="[randomStatusColor()]">{{ randomStatus() }}</span>
            </template>
        </vue3-datatable>
    </div>
</template>

<script setup>
import apiClient from "../../../composables/apiClient";
import { ref, onMounted, reactive ,computed  } from 'vue';
    import Vue3Datatable from '@bhplugin/vue3-datatable';
    import '@bhplugin/vue3-datatable/dist/style.css';
    // const config = useRuntimeConfig();
    import useUsers from "../../../composables/users";
    const { users, deleteUser } = useUsers()

    onMounted(() => {
        getUsers();
    });

    const loading = ref(true);
    const total_rows = ref(0);
    const params = reactive({
        current_page: 1,
        pagesize: 10,
        sort_column: 'id',
        sort_direction: 'asc',
    });
    const rows = ref(null);

        //         rows.value = data?.data;
    //         total_rows.value = data?.meta?.total;
    const cols =
        ref([
            { field: 'first_name', title: 'Name' },
            { field: 'employee_id', title: 'Employee ID' },
            { field: 'email', title: 'Email' },
            { field: 'phone', title: 'Mobile' },
            { field: 'role', title: 'Role' },
        ]) || [];

    const getUsers = async () => {
       
        try {
            loading.value = true;

            const response = await apiClient.get('/admin/users')
            .then(response => {
                rows.value = response?.data?.data;
                total_rows.value = response?.data?.recordsTotal;
            });
        } catch(error) {
            alert(error)
        }

        loading.value = false;
    };
    const changeServer = (data) => {
        params.current_page = data.current_page;
        params.pagesize = data.pagesize;
        params.sort_column = data.sort_column;
        params.sort_direction = data.sort_direction;

        getUsers();
    };


    const chart_options = computed(() => {
        let option = {
            chart: { sparkline: { enabled: true } },
            stroke: { curve: 'smooth', width: 2 },
            markers: { size: [4, 7], strokeWidth: 0 },
            colors: [randomColor()],
            grid: { padding: { top: 5, bottom: 5 } },
            tooltip: {
                x: { show: false },
                y: {
                    title: {
                        formatter: () => {
                            return '';
                        },
                    },
                },
            },
        };
        return option;
    });

    const randomColor = () => {
        const color = ['#5367ff', '#0dcaf0', '#00d09c', '#ff585d', '#ffb61b', '#1da1f2'];
        const random = Math.floor(Math.random() * color.length);
        return color[random];
    };

    const randomStatusColor = () => {
        const color = ['primary', 'secondary', 'success', 'danger', 'warning', 'info'];
        const random = Math.floor(Math.random() * color.length);
        return color[random];
    };
    const randomStatus = () => {
        const status = ['PAID', 'APPROVED', 'FAILED', 'CANCEL', 'SUCCESS', 'PENDING', 'COMPLETE'];
        const random = Math.floor(Math.random() * status.length);
        return status[random];
    };
    const getRandomNumber = (min, max) => {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    };

    const getCountry = () => {
        const random = Math.floor(Math.random() * countryList.length);
        return countryList[random];
    };
</script>

<style>
@import '@/assets/css/onBoard.css';
@import 'datatables.net-dt';

table.dataTable thead th,
table.dataTable thead td,
table.dataTable tfoot th,
table.dataTable tfoot td {
    text-align: left;
}

table.dataTable tbody tr td {
    text-align: left;
}

.dt-search {
    display: none;
}
</style>