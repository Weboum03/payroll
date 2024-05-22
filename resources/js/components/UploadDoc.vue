<template>
    <div class="col-sm-4">
        <div class="card  card1">
            <div class="card-body">
                <div class="showalltask-card d-flex flex-column">
                    <div class="d-flex" style="gap: .5rem;">
                        <input type="checkbox" id="">
                        <div class="p4">{{ props.is.title }} <span></span></div>
                    </div>

                    <div class="d-flex justify-content-center align-items-center" style="gap: 24px;">
                        <button type="button" class="btn btn-primary updoc" @click="onClick">Upload
                            Document</button>
                        <input type="file" ref="fileInput" @change="choosFile" hidden />
                        <div v-if="props.is.edit" @click="deleteInput" class="removeTask"><i
                                class="fa-solid fa-square-minus fa-lg " style="color: #ffffff;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref, defineProps, defineEmits } from 'vue';
const emit = defineEmits(['change', 'delete-input', 'update-ref'])

const props = defineProps({
    id: String,
    title: String,
    is: Object,
});

const fileInput = ref();
const onClick = () => {
    fileInput.value.click();
}

const choosFile = async (event) => {
    // Handle the uploaded file here
    const file = event.target.files[0];
    const formData = new FormData();
    formData.append('image', file);
    try {
        const response = await axios.post('/api/tempfile', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
        const tempPath = response.data.temporary_path;
        emit('update-ref', {name: props.is.type, path:tempPath});
        // userData.value.user_profile_picture = tempPath;
        // preview.value = URL.createObjectURL(file);
        alert('File uploaded temporarily');
    } catch (error) {
        console.error(error);
        alert('Failed to upload file');
    }
}

const deleteInput = () => {
    emit('delete-input')
};
</script>
