<template>
    <div class="col-sm-4">
        <div class="card  card1">
            <div class="card-body">
                <div class="showalltask-card d-flex flex-column">
                    <div class="d-flex" style="gap: .5rem;">
                        <input type="checkbox" id="" v-model="checked">
                        <div class="p4">{{ props.is.title }} <span></span></div>
                    </div>

                    <div class="d-flex justify-content-center align-items-center" style="gap: 24px;">
                        <button type="button" class="btn btn-primary updoc" @click="onClick">{{ text }}</button>
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
import { ref, defineProps, defineEmits, inject } from 'vue';
const emit = defineEmits(['change', 'delete-input', 'update-ref'])
const swal = inject("$swal");
const props = defineProps({
    id: String,
    title: String,
    is: Object,
});

const text = ref('Upload Document');
const fileInput = ref();
const checked = ref(false)
const onClick = () => {
    fileInput.value.click();
}

const choosFile = (event) => {
    text.value = 'Processing';
    setTimeout(() => {
        // Handle the uploaded file here
        const file = event.target.files[0];
        if (file.size > 1024 * 1024 * 10) {
            text.value = 'Re-Upload';
            swal({
                icon: "error",
                title: "File too big! Maximum file size is 10MB.",
            });
            return;
        }
        const formData = new FormData();
        formData.append('image', file);
        axios.post('/api/tempfile', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then((response) => {
            const tempPath = response.data.temporary_path;
            emit('update-ref', { title: props.is.title,type: props.is.type, path: tempPath });
            text.value = 'Re-Upload';
            // userData.value.user_profile_picture = tempPath;
            // preview.value = URL.createObjectURL(file);
            swal({
                icon: "success",
                title: "File uploaded temporarily",
            });
        })
            .catch((error) => {
                console.error(error);
                swal({
                    icon: "error",
                    title: "Failed to upload file",
                });
            })
            .finally(() => (text.value = 'Re-Upload'));
    }, 1000);


}

const deleteInput = () => {
    emit('delete-input')
};
</script>
