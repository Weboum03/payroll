<template>
    <canvas id="payrolldata-chart"></canvas>
</template>


<script setup>
import 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js';
import { onMounted, defineProps, ref } from 'vue';

const props = defineProps({
    data: Object,
    totalEmployee:Number
});

let totalEmployee = 0;
const data = [253, 5];
let payrollchartData = {
    labels: [`Payroll Processed ${data[0]}`, `Payroll Generated ${data[1]}`],
    data: data,
};

onMounted(async () => {
    totalEmployee = props?.totalEmployee
    payrollchartData = props.data;
    loadChart();
});


const loadChart = () => {
    const counter3 = {
        id: "counter",
        beforeDraw(chart, args, options) {
            const { ctx, chartArea: { top, right, bottom, left, width, height } } = chart;
            ctx.save()
            const yCenter = (height / 2) + top + 15;
            ctx.font = '15px monospace'
            ctx.fillStyle = 'black'
            ctx.fillText(totalEmployee, '61', yCenter)
        }
    }
    const counter4 = {
        id: "counter",
        beforeDraw(chart, args, options) {
            const { ctx, chartArea: { top, right, bottom, left, width, height } } = chart;
            ctx.save()
            const yCenter = (height / 2) + top - 7;
            ctx.font = '11px monospace'
            ctx.fillStyle = 'black'
            ctx.fillText('Total Employees', '28', yCenter)
        }
    }

    const payrollChart = document.querySelector("#payrolldata-chart");

    new Chart(payrollChart, {
        type: "doughnut",
        data: {
            labels: payrollchartData.labels,
            datasets: [
                {
                    data: payrollchartData.data,
                    backgroundColor: [     // Set background color for each label
                        '#0492F5',   // Background color for "5 days absence"
                        '#DAE1F3'    // Background color for "900 working days"
                    ],
                    cutout: '70%',
                },

            ],

        },
        options: {
            borderRadius: 2,
            hoverBorderWidth: 0,
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return context.label; // Display only the label, without associated data
                        }
                    }
                }
            },
            rotation: 90,
        },
        plugins: [counter4, counter3]
    });

}

</script>