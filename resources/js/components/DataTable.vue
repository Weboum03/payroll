<template>
    <div id="leavesEmpTable_wrapper" class="dt-container dt-empty-footer">
        <div class="dt-layout-row">
            <div class="dt-layout-cell dt-start"></div>
            <div class="dt-layout-cell dt-end">
                <div class="dt-search">
                    <label for="dt-search-0">Search:</label><input type="search" class="dt-input" id="dt-search-0"
                        placeholder="" aria-controls="leavesEmpTable" />
                </div>
            </div>
        </div>
        <div class="dt-layout-row dt-layout-table">
            <div class="dt-layout-cell">
                <div id="leavesEmpTable_processing" class="dt-processing" role="status" style="display: none">
                    <div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <table class="table text-center dataTable">
                    <thead>
                        <tr>
                            <th v-for="(header, index) in headers" :key="index" class="text-center"
                                :class="sortIcon(header)" @click="sortBy(header)">
                                <span class="dt-column-title">
                                    {{ header.label }}
                                </span>
                                <span class="dt-column-order"></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="rowsData.length > 0" v-for="(row, rowIndex) in paginatedRows" :key="rowIndex" @click="rowclick(row)">
                            <td v-for="(header, colIndex) in headers" :key="colIndex" class="text-center">
                                <slot :name="`cell-${header.key}`" :row="row">
                                    {{ row[header.key] }}
                                </slot>
                            </td>
                        </tr>
                        <tr v-else>
                            <td :colspan="Object.keys(headers).length" class="text-center">
                                No Record Found
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="dt-layout-row">
            <div class="dt-layout-cell dt-start">
                <div class="dt-info" aria-live="polite" id="leavesEmpTable_info" role="status">
                    Showing {{ fromNumber() }} to {{ ((currentPage*pageLength) > totalRecords.value)?totalRecords:(currentPage) * pageLength }} of
                    {{ totalRecords }} entry
                </div>
            </div>
            <div class="dt-layout-cell dt-end">
                <div class="dt-paging paging_full_numbers">
                    <button @click="currentPage = 1" class="dt-paging-button first"
                        :class="{ 'disabled': currentPage === 1 }" :disabled="currentPage === 1" role="link"
                        type="button" aria-controls="DataTables_Table_0" aria-label="First" data-dt-idx="first"
                        tabindex="0">
                        «</button>

                    <button @click="prevPage" :class="{ 'disabled': currentPage === 1 }" :disabled="currentPage === 1"
                        class="dt-paging-button previous" role="link" type="button" aria-controls="DataTables_Table_0"
                        aria-label="Previous" data-dt-idx="previous" tabindex="0">
                        ‹</button>

                    <button @click="prevPage" v-if="currentPage > 1" class="dt-paging-button" role="link" type="button"
                        aria-controls="DataTables_Table_0" aria-current="page" data-dt-idx="1" tabindex="0">
                        {{ currentPage - 1 }}</button>

                    <button class="dt-paging-button current" role="link" type="button"
                        aria-controls="DataTables_Table_0" aria-current="page" data-dt-idx="1" tabindex="0">
                        {{ currentPage }}</button>

                    <button @click="nextPage" v-if="currentPage < totalPages" class="dt-paging-button" role="link"
                        type="button" aria-controls="DataTables_Table_0" aria-current="page" data-dt-idx="1"
                        tabindex="0">
                        {{ currentPage + 1 }}</button>

                    <button @click="nextPage" :class="{ 'disabled': currentPage === totalPages }"
                        :disabled="currentPage === totalPages" class="dt-paging-button next" role="link" type="button"
                        aria-controls="DataTables_Table_0" aria-label="Next" data-dt-idx="next" tabindex="0">
                        ›</button>

                    <button @click="currentPage = totalPages" :class="{ 'disabled': currentPage === totalPages }"
                        :disabled="currentPage === totalPages" class="dt-paging-button last" role="link" type="button"
                        aria-controls="DataTables_Table_0" aria-label="Last" data-dt-idx="last" tabindex="0">
                        »
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {
    ref,
    defineProps,
    defineEmits,
    defineExpose,
    watch,
    computed,
    watchEffect,
} from "vue";

const currentPage = ref(1);
const pageLength = ref(10);
const sortedColumn = ref("");
const sortOrder = ref("asc");
const filterData = ref({
    page: currentPage.value,
    filter: [],
    sorting: {},
});

const fromNumber = () => {
    if(totalRecords.value.value == 0) { return 0 }
    return (currentPage.value - 1) * pageLength.value + 1
}

const sortIcon = (header) => {
    if (header.sorting) {
        if (sortedColumn.value === header.key) {
            return sortOrder.value === "asc" ? "dt-orderable-asc dt-orderable-desc dt-ordering-desc" : "dt-orderable-asc dt-orderable-desc dt-ordering-asc"
        } else {
            return 'dt-orderable-asc dt-orderable-desc';
        }
    }
}
const emit = defineEmits(["filter", "rowclick"]);

const rowclick = (param = {}) => {
    emit('rowclick', param);
}

const props = defineProps({
    headers: {
        type: Array,
        required: true,
    },
    rows: {
        type: Object,
        required: true,
    },
    pageLengths: {
        type: Array,
        default: () => [10, 20, 50, 100],
    },
});

const rowsData = ref(props.rows.data);
const totalRecords = ref(0);
totalRecords.value = ref(props.rows.totalRecords);
console.log('totalRecords.value.value', totalRecords.value.value);
const totalPages = computed(() => {
    return Math.ceil(totalRecords.value.value / pageLength.value);
});

watch(rowsData, (current, previous) => {
    console.log('totalRecords.value.value', props.rows.totalRecords);
    totalRecords.value = ref(props.rows.totalRecords);
});

watchEffect(() => {
    console.log('totalRecords.value.value', totalRecords.value.value);
})
const paginatedRows = computed(() => {
    const start = (currentPage.value - 1) * pageLength.value;
    const end = start + pageLength.value;
    return sortedRows(start, end);
});

const sortedRows = (a, b) => {
    return rowsData.value.sort((a, b) => {
        if (sortedColumn.value) {
            const modifier = sortOrder.value === "asc" ? 1 : -1;
            if (a[sortedColumn.value] < b[sortedColumn.value])
                return -1 * modifier;
            if (a[sortedColumn.value] > b[sortedColumn.value])
                return 1 * modifier;
            return 0;
        }
        return sortedColumn;
    });
};

const nextPage = () => {
    if (currentPage.value < totalPages.value) {
        currentPage.value++;
        filterData.value.page = currentPage.value;
        filterPayload();
    }
};
const prevPage = () => {
    if (currentPage.value > 1) {
        currentPage.value--;
        filterData.value.page = currentPage.value;
        filterPayload();
    }
};

const filterPayload = () => {
    let queryFilter =
        "?page=" + currentPage.value + "&limit=" + pageLength.value;
    if (filterData && filterData.value.filter.length > 0) {
        filterData.value.filter.forEach((element) => {
            queryFilter = queryFilter + "&" + element.key + "=" + element.value;
        });
    }
    emit("filter", queryFilter);
}

const sortBy = (column) => {
    if (column.sorting) {
        if (sortedColumn.value === column.key) {
            sortOrder.value = sortOrder.value === "asc" ? "desc" : "asc";
        } else {
            sortOrder.value = "asc";
            sortedColumn.value = column.key;
        }
    }
};

const resetTable = () => {
    filterData.value = {
        page: currentPage.value,
        filter: [],
        sorting: {},
        search:''
    }
}

watch(
    () => props.rows,
    () => {
        rowsData.value = props.rows.data;
    }
)

defineExpose({
    currentPage,
    filterData,
    filterPayload,
    pageLength,
});
</script>

<style scoped>
.datatable-container {
    overflow-x: auto;
    margin: 20px 0;
}

.search-bar {
    margin-bottom: 10px;
    padding: 5px;
    width: 100%;
    box-sizing: border-box;
}

.datatable {
    width: 100%;
    border-collapse: collapse;
}

.datatable-header {
    background-color: #f2f2f2;
    padding: 10px;
    border-bottom: 2px solid #ddd;
    text-align: left;
    cursor: pointer;
}

.datatable-header span {
    font-size: 0.8em;
}

.datatable-cell {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}

.pagination-controls {
    margin-top: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
}
</style>

<style scoped>
@import "@/assets/css/Approvals.css";
@import "@/assets/css/onBoard.css";
@import "datatables.net-dt";

table.dataTable thead th,
table.dataTable thead td,
table.dataTable tfoot th,
table.dataTable tfoot td {
    text-align: center;
}

.text-center {
    text-align: center !important;
}

table.dataTable tbody tr td {
    text-align: center;
}

.dataTables_filter input {
    border: 1px solid #aaa;
    border-radius: 3px;
    padding: 5px;
    background-color: transparent;
    margin-left: 3px;
}

#leavesEmpTable_filter {
    margin-bottom: -5px;
}

#leavesEmpTable_info {
    padding: 15px;;
}

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
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 0.3rem;
    outline: 0;
    width: 100% !important;
}

.dt-search {
    display: none;
}
</style>
