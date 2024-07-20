<template>
    <div class="row flex-column">
        <div class="col-md-6 col-sm-12" style="width: 100%; max-width: 100%;">
            <div class="demo-calendar" id="Month1"></div>
        </div>

        <div class="col-md-6 col-sm-12" style="width: 100%; max-width: 100%;padding-left: 40px;">
            <div class="row row-cols-5">
                <div class="d-flex align-items-start">
                    <div class="col ernLeaves-div commonLable"></div>
                    <div class="col ernLeaves">Earned Leaves</div>
                </div>
                <div class="d-flex align-items-start">
                    <div class="col PubHoly-div commonLable"></div>
                    <div class="col PubHoly">Public Holidays</div>
                </div>
                <div class="d-flex align-items-start">
                    <div class="col manity-div commonLable"></div>
                    <div class="col manity">Maternity</div>
                </div>
                <div class="d-flex align-items-start">
                    <div class="col vesElemtum-div commonLable"></div>
                    <div class="col vesElemtum">Vestibulum elementum</div>
                </div>
                <div class="d-flex align-items-start">
                    <div class="col donAliq-div commonLable"></div>
                    <div class="col donAliq">Donec aliquet</div>
                </div>
            </div>

        </div>

    </div>
</template>

<script setup>
import $ from 'jquery';
window.$ = window.jQuery = $;
import { onMounted } from 'vue';

const props = defineProps({
    data: Object,
});

onMounted(() => {

    const script = document.createElement("script");
    script.src = "../../resources/js/zabuto_calendar.min.js";
    document.head.appendChild(script);
    script.onload = () => {
        loadCalender();
    };
})

const loadCalender = () => {
    $("#Month1").zabuto_calendar({
        classname: 'table',
        year: props.data.year,
        month: props.data.month,
        navigation_prev: false,
        navigation_next: false,
        events: [
            {
                "date": "2024-02-01",
                "markup": "<div class=\"badge rounded-pill badge-pill commonMark ernLeaves-div\">[day]</div>"
            },
            {
                "date": "2024-02-05",
                "markup": "<div class=\"badge rounded-pill badge-pill commonMark PubHoly-div\">[day]</div>"
            },
            {
                "date": "2024-02-25",
                "markup": "<div class=\"badge rounded-pill badge-pill commonMark manity-div\">[day]</div>"
            },
            {
                "date": "2024-02-20",
                "markup": "<div class=\"badge rounded-pill badge-pill commonMark vesElemtum-div\">[day]</div>"
            },
            {
                "date": "2024-02-30",
                "markup": "<div class=\"badge rounded-pill badge-pill commonMark donAliq-div\">[day]</div>"
            },
            {
                "date": "2024-02-28",
                "markup": "<div class=\"badge rounded-pill badge-pill commonMark donAliq-div\">[day]</div>"
            },
        ]
    });
}
</script>

<style scoped>
@import '@/assets/css/planner.css';
@import '@/assets/css/onBoard.css';
@import '@/assets/css/zabuto_calendar.min.css';

.form-row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -5px;
    margin-left: -5px;
}
</style>