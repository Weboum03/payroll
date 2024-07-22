<template>
    <div class="row flex-column">
        <div class="col-md-6 col-sm-12" style="width: 100%; max-width: 100%;">
            <div class="demo-calendar" :id="data.selector"></div>
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
import { ref } from 'vue';
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
    console.log('props.data.selector', props.data.selector);
    console.log('props.data.month', props.data.month)
    $('#'+props.data.selector).zabuto_calendar({
        classname: 'table',
        year: props.data.year,
        month: props.data.month,
        navigation_prev: false,
        navigation_next: false,
        events: [
            {
                "date": `2024-07-01`,
                "markup": "<div class=\"badge rounded-pill badge-pill commonMark ernLeaves-div\">[day]</div>"
            },
            {
                "date": `2024-07-05`,
                "markup": "<div class=\"badge rounded-pill badge-pill commonMark PubHoly-div\">[day]</div>"
            },
            {
                "date": `2024-07-25`,
                "markup": "<div class=\"badge rounded-pill badge-pill commonMark manity-div\">[day]</div>"
            },
            {
                "date": `2024-07-20`,
                "markup": "<div class=\"badge rounded-pill badge-pill commonMark vesElemtum-div\">[day]</div>"
            },
            {
                "date": `2024-07-30`,
                "markup": "<div class=\"badge rounded-pill badge-pill commonMark donAliq-div\">[day]</div>"
            },
            {
                "date": `2024-07-28`,
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

<style>
/* calendar demo */
.demo-calendar {
	min-height: 246px;
	background-color: #fff;
	padding: 10px;
	border-radius: 4px;
	font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
	font-size: 14px;
	line-height: 1.42857143;
}

.demo-calendar.basic {
	min-height: 190px;
}

.zabuto-calendar__navigation{
	display: none;
}

.ernLeaves-div{
	background-color: red;
}

.PubHoly-div{
	background-color: orange;
}
.manity-div{
	background-color: green;
}
.vesElemtum-div{
	background-color: rgb(175, 119, 228);
}
.donAliq-div{
	background-color: rgb(119, 192, 228);
}

.ernLeaves,.PubHoly,.manity,.vesElemtum,.donAliq{
	font-size: 14px;
	font-weight: 500;
}

.commonLable{
	width: 25px;
	height: 25px;
	border-radius: 8px;
  flex-grow: 0 !important;
}

.commonMark{
	width: 35px;
	height: 25px;
	border-radius: 8px;
}


.zabuto-calendar {
	width: 100%;
	margin: 0;
	padding: 0;
}

.zabuto-calendar__navigation__item--prev,
.zabuto-calendar__navigation__item--next {
	text-align: center;
	cursor: pointer;
}

.zabuto-calendar__navigation__item--header {
	text-align: center;
}

.zabuto-calendar__navigation__item--header__title {
	cursor: pointer;
	font-weight: bolder;
}

.zabuto-calendar__days-of-week__item {
	text-align: center;
}

.zabuto-calendar__day {
	text-align: center;
}

.zabuto-calendar__day--today {
	text-align: center;
}

/* Bootstrap overrides */
.zabuto-calendar.table td, .zabuto-calendar.table th {
	vertical-align: middle;
}

.zabuto-calendar.table thead td {
	padding-top: 14px;
	padding-bottom: 14px;
	background-color: #fafafa;
}

.zabuto-calendar.table-bordered thead td {
	border: 0;
}

.zabuto-calendar.table thead th {
	background-color: #f0f0f0;
}

.zabuto-calendar.table > thead:first-child > tr:first-child > td {
	border-top: 1px solid #ddd;
}

.zabuto-calendar.table > thead > tr > th {
	border-bottom: 2px solid #ddd;
}

.zabuto-calendar.table > tbody td {
	width: calc(100% / 7);
}

.zabuto-calendar.table > tbody > tr:last-child > td {
	border-bottom: 1px solid #ddd;
}

.zabuto-calendar.table > tbody td .badge {
	font-size: 100%;
}

/* Clickable */
.zabuto-calendar.clickable > tbody td {
	cursor: pointer;
}

.zabuto-calendar.table.clickable > tbody td:hover {
	background-color: #f0f0f0;
}
</style>