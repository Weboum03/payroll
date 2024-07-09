<template>
    <!-- -----nav-dashboard-table start----- -->
    <div id="dashboard-table-info">
                <span>Import Data</span>
                <span> More > Import Data</span>
            </div>
            <div id="dashboard-table">
               

                    <div id="ImportDataDragDrop" class="d-flex flex-column" style="padding: 20px 25px; gap: 1rem;">
                        <div class="section d-flex justify-content-between align-items">
                            <div class="d-flex flex-column" style="gap: 1rem;">
                                <p>Import data from file</p>
                                <p>Import employee data from another system or file. First row will be considered as
                                    headers</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn  DownSampFile">Download Sample File</button>
                            </div>
                        </div>

                        <div id="fileUpload" class="file-container">
                            <label for="fileUpload-1" class="file-upload">
                                <div>
                                    <p>Drag & Drop Files Here</p>
                                    <span>OR</span>
                                    <div>Browse Files</div>
                                </div>
                                <input type="file" id="fileUpload-area" name="[]" multiple hidden>
                            </label>
                        </div>
                       
                    </div>
            </div>
</template>

<style>
@import '@/assets/css/ImportDragDrop.css';
</style>