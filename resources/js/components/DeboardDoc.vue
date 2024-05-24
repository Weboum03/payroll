<template>
    <div class="col-sm-4">
        <div class="card  card1">
            <div class="card-body">
                <div class="showalltask-card d-flex flex-column">
                    <div class="d-flex" style="gap: .5rem;">
                        <input type="checkbox" id="">
                        <div class="p4">{{ props.is.title }} <span></span></div>
                    </div>
                    <a id="myAnchor" @click="deleteInput" href="javascript:;" class="btn btn-primary removeTask">Remove
                        Task</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref, defineProps, defineEmits, inject } from 'vue';
const emit = defineEmits(['change', 'delete-input', 'update-ref'])
const swal = inject("$swal");
const props = defineProps({
    id: String,
    title: String,
    is: Object,
});

const fileInput = ref();
const onClick = () => {
    fileInput.value.click();
}
const deleteInput = () => {
    emit('delete-input')
};
</script>
