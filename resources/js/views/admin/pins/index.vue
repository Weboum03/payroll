<template>
    <div class="row justify-content-center my-2">
        <div class="col-md-12">
            <div class="card border-0">
                <div class="card-header bg-transparent">
                    <h5 class="float-start">Pins</h5>
                    <router-link v-if="can('user-list')" :to="{ name: 'users.create' }" class="btn btn-primary btn-sm float-end">
                        Add New
                    </router-link>
                </div>
                <div class="card-body shadow-sm">
                    <div class="mb-4">
                        <input v-model="search_global" type="text" placeholder="Search..."
                               class="form-control w-25">
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 text-start">
                                    <div class="flex flex-row"
                                         @click="updateOrdering('id')">
                                        <div class="font-medium text-uppercase"
                                             :class="{ 'font-bold text-blue-600': orderColumn === 'id' }">
                                            ID
                                        </div>
                                        <div class="select-none">
                                <span :class="{
                                  'text-blue-600': orderDirection === 'asc' && orderColumn === 'id',
                                  'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'id',
                                }">&uarr;</span>
                                            <span :class="{
                                  'text-blue-600': orderDirection === 'desc' && orderColumn === 'id',
                                  'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'id',
                                }">&darr;</span>
                                        </div>
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left">
                                    <div class="flex flex-row"
                                         @click="updateOrdering('title')">
                                        <div class="font-medium text-uppercase"
                                             :class="{ 'font-bold text-blue-600': orderColumn === 'title' }">
                                             pinid
                                        </div>
                                        <div class="select-none">
                                <span :class="{
                                  'text-blue-600': orderDirection === 'asc' && orderColumn === 'title',
                                  'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'title',
                                }">&uarr;</span>
                                            <span :class="{
                                  'text-blue-600': orderDirection === 'desc' && orderColumn === 'title',
                                  'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'title',
                                }">&darr;</span>
                                        </div>
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left">
                                    <div class="flex flex-row"
                                         @click="updateOrdering('amount')">
                                        <div class="font-medium text-uppercase"
                                             :class="{ 'font-bold text-blue-600': orderColumn === 'amount' }">
                                             amount
                                        </div>
                                        <div class="select-none">
                                <span :class="{
                                  'text-blue-600': orderDirection === 'asc' && orderColumn === 'amount',
                                  'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'amount',
                                }">&uarr;</span>
                                            <span :class="{
                                  'text-blue-600': orderDirection === 'desc' && orderColumn === 'amount',
                                  'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'amount',
                                }">&darr;</span>
                                        </div>
                                    </div>
                                </th>

                                <th class="px-6 py-3 text-left">
                                    <div class="flex flex-row"
                                         @click="updateOrdering('email')">
                                        <div class="font-medium text-uppercase"
                                             :class="{ 'font-bold text-blue-600': orderColumn === 'email' }">
                                             status
                                        </div>
                                        <div class="select-none">
                                <span :class="{
                                  'text-blue-600': orderDirection === 'asc' && orderColumn === 'email',
                                  'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'email',
                                }">&uarr;</span>
                                            <span :class="{
                                  'text-blue-600': orderDirection === 'desc' && orderColumn === 'email',
                                  'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'email',
                                }">&darr;</span>
                                        </div>
                                    </div>
                                </th>

                                <th class="px-6 py-3 text-left">
                                    <div class="flex flex-row"
                                         @click="updateOrdering('created_by_user')">
                                        <div class="font-medium text-uppercase"
                                             :class="{ 'font-bold text-blue-600': orderColumn === 'created_by_user' }">
                                             created_by_user
                                        </div>
                                        <div class="select-none">
                                <span :class="{
                                  'text-blue-600': orderDirection === 'asc' && orderColumn === 'created_by_user',
                                  'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'created_by_user',
                                }">&uarr;</span>
                                            <span :class="{
                                  'text-blue-600': orderDirection === 'desc' && orderColumn === 'created_by_user',
                                  'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'created_by_user',
                                }">&darr;</span>
                                        </div>
                                    </div>
                                </th>

                                <th class="px-6 py-3 text-left">
                                    <div class="flex flex-row"
                                         @click="updateOrdering('assign_to')">
                                        <div class="font-medium text-uppercase"
                                             :class="{ 'font-bold text-blue-600': orderColumn === 'assign_to' }">
                                             assign_to
                                        </div>
                                        <div class="select-none">
                                <span :class="{
                                  'text-blue-600': orderDirection === 'asc' && orderColumn === 'assign_to',
                                  'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'assign_to',
                                }">&uarr;</span>
                                            <span :class="{
                                  'text-blue-600': orderDirection === 'desc' && orderColumn === 'assign_to',
                                  'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'assign_to',
                                }">&darr;</span>
                                        </div>
                                    </div>
                                </th>

                                <th class="px-6 py-3 text-left">
                                    <div class="flex flex-row"
                                         @click="updateOrdering('used_by')">
                                        <div class="font-medium text-uppercase"
                                             :class="{ 'font-bold text-blue-600': orderColumn === 'used_by' }">
                                             used_by
                                        </div>
                                        <div class="select-none">
                                <span :class="{
                                  'text-blue-600': orderDirection === 'asc' && orderColumn === 'used_by',
                                  'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'used_by',
                                }">&uarr;</span>
                                            <span :class="{
                                  'text-blue-600': orderDirection === 'desc' && orderColumn === 'used_by',
                                  'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'used_by',
                                }">&darr;</span>
                                        </div>
                                    </div>
                                </th>

                                <th class="px-6 py-3 text-left">
                                    <div class="flex flex-row"
                                         @click="updateOrdering('used_on')">
                                        <div class="font-medium text-uppercase"
                                             :class="{ 'font-bold text-blue-600': orderColumn === 'used_on' }">
                                             used_on
                                        </div>
                                        <div class="select-none">
                                <span :class="{
                                  'text-blue-600': orderDirection === 'asc' && orderColumn === 'used_on',
                                  'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'used_on',
                                }">&uarr;</span>
                                            <span :class="{
                                  'text-blue-600': orderDirection === 'desc' && orderColumn === 'used_on',
                                  'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'used_on',
                                }">&darr;</span>
                                        </div>
                                    </div>
                                </th>
                                
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in pins.data" :key="item.id">
                                <td class="px-6 py-4 text-sm">
                                    {{ item.id }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    {{ item.pinid }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    {{ item.amount }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    {{ item.status }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    {{ item.created_by_user }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    {{ item.assign_to }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    {{ item.used_by }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    {{ item.used_on }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <router-link v-if="can('user-edit')"
                                                 :to="{ name: 'pins.edit', params: { id: item.id } }"
                                                 class="badge bg-primary">Edit
                                    </router-link>
                                    <a href="#" v-if="can('user-delete')" @click.prevent="deleteUser(item.id)"
                                       class="ms-2 badge bg-danger">Delete</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <Pagination :data="pins" :limit="3"
                                @pagination-change-page="page => getPins(page, search_id, search_title, search_global, orderColumn, orderDirection)"
                                class="mt-4"/>
                </div>
            </div>
        </div>
    </div>
</template>


<style setup>
/* @import '@/adminAssets/assets/css/style.css'; */
@import '@/adminAssets/assets/css/vendors/datatables.css';

@import 'bootstrap';
@import 'datatables.net-bs5';
@import 'bootstrap/dist/css/bootstrap.min.css';
</style>

<script setup>

import {ref, onMounted, watch} from "vue";
import usePins from "../../../composables/pins";
import {useAbility} from '@casl/vue'
import $ from 'jquery';
import "datatables.net-bs5";
import "datatables.net-responsive-bs5";
import 'datatables.net';


const search_id = ref('')
const search_title = ref('')
const search_global = ref('')
const orderColumn = ref('created_at')
const orderDirection = ref('desc')
const {pins, getPins, deletePin} = usePins()
const {can} = useAbility()
onMounted(() => {
    getPins()
})
const updateOrdering = (column) => {
    orderColumn.value = column;
    orderDirection.value = (orderDirection.value === 'asc') ? 'desc' : 'asc';
    getPins(
        1,
        search_id.value,
        search_title.value,
        search_global.value,
        orderColumn.value,
        orderDirection.value
    );
}
watch(search_id, (current, previous) => {
    getPins(
        1,
        current,
        search_title.value,
        search_global.value
    )
})
watch(search_title, (current, previous) => {
    getPins(
        1,
        search_id.value,
        current,
        search_global.value
    )
})
watch(search_global, _.debounce((current, previous) => {
    getPins(
        1,
        search_id.value,
        search_title.value,
        current
    )
}, 200))
</script>