<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table-info">
        <span>Import Data</span>
        <span> More > Import Data</span>
    </div>
    <div id="dashboard-table">
        <div id="ImportDataDragDrop" class="d-flex flex-column" style="padding: 20px 25px; gap: 1rem;">
            <div class="section d-flex justify-content-between align-items">
                <div class="d-flex" style="gap: 1rem;">
                    <div class="back-div">
                               <router-link :to="{ name: 'admin.dashboard' }">
                               <span><i class="fa-solid fa-arrow-right fa-flip-horizontal fa-sm"
                                style="color: #000000;"></i></span>
                                <span style="cursor: pointer; padding-left:5px;" >Back</span>  
                                </router-link>
                    </div>
                    <div class="back-div-content" style="padding-left:40px;">
                    <p>Import data from file</p>
                    <p>Import employee data from another system or file. First row will be considered as
                        headers.<br>
                        Date format must be in DD-MM-YYYY <br>
                        
                    </p>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <button type="button" @click="downloadFileBatch" class="btn  DownSampFile">Download Sample
                        File</button>
                </div>
            </div>

            <div id="fileUpload" class="file-container">
                <label for="fileUpload-1" @click="file.click()" class="file-upload">
                    <div>
                        <p>Drag & Drop Files Here</p>
                        <span>OR</span>
                        <div>Browse Files </div> {{ fileText }}
                    </div>
                    <input type="file" ref="file" @change="handleFileSelect" id="fileUpload-area" name="[]" multiple
                        hidden>
                </label>
                <div v-if="selectedFile" class="d-flex flex-column justify-content-center align-items-center"
                    style="margin-top: 30px;"> <a :disable="!selectedFile" @click="uploadFile"
                        href="javascript:;"><button type="button" class="UP">{{ text }}</button></a></div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { inject, ref } from 'vue';
import useUsers from "@/composables/users";
const { importUser, exportUser, isLoading, success } = useUsers();

const swal = inject('$swal')
const file = ref(null)
const selectedFile = ref(null)
const fileText = ref('')
const text = ref('Upload')

const handleFileSelect = (event) => {
    const file = event.target.files[0];
    if (file) {
        fileText.value = file.name
        selectedFile.value = file;
    }

    console.log('selectedFile', selectedFile)
}

const uploadFile = async (event) => {
    text.value = 'Processing';
    await setTimeout(async () => {
        if (!selectedFile.value) {
            alert("Please select a file first!");
            return;
        }
        text.value = 'Upload';
        let response = await importUser({ attachment: selectedFile.value });
        text.value = 'Upload';
        if (success.value) {
            selectedFile.value = '';
            fileText.value = 'Browse Files...';
            swal({
                icon: "success",
                title: "Sync Successfully",
            });
        }
    }, 1000);
}

const downloadFileBatch = async () => {
    let response = await exportUser();
    downloadFile(response)
}

const downloadFile = async (response) => {
    const url = response.data;
    const link = document.createElement('a');
    link.href = url;
    let fileName = `Employee_${(new Date().toJSON().slice(0,10))}.xlsx`
    link.setAttribute('download', fileName);
    document.body.appendChild(link);
    link.click();
    swal({
        icon: "success",
        title: "Export successfully",
    });
}

</script>

<style>
@import '@/assets/css/ImportDragDrop.css';
</style>