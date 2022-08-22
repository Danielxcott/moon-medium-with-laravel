import Chart from 'chart.js/auto';

let dateArr=["jul 21","jul 20","jul 19","jul 18","jul 17","jul 16","jul 15","jul 14","jul 13","jul 12","jul 11"];
let orderCounterArr=[7,5,6,4,6,4,8,6,8,9,6];
let viewcounter = [13,12,15,14,20,17,19,16,23,33,16];

let ctx = document.getElementById('ov').getContext('2d');
$(function() {
let myChart = new Chart(ctx, {
type: 'line',
data: {
    labels: dateArr,
    datasets: [{
            label: 'Viewers',
            data: orderCounterArr,
            backgroundColor: [
                " #94B49F",
            ],
            borderColor: [
                "#94B49F",
            ],
            borderWidth: 2,
            tension: 0,
            fill: false,
            borderColor: '#94B49F',
            
        },
        {
            label: 'Posts',
            data: viewcounter,
            backgroundColor: [
                " #ECB390",
            ],
            borderColor: [
                "#ECB390",
            ],
            borderWidth: 1,
            tension: 0,
            fill: false,
            borderColor: '#ECB390',
        }
    ]
},
options: {
    scales: {
        y:{
            grid:{
                display: false,
                drawBorder : false,
            },
            ticks:{
                display: false,
            }
        },
        x: {
        grid: {
        display: false,
        drawBorder : false,
        },
            ticks:{
                display: false,
                borderColor: "#fff",
            }
        }

    },
    legend: {
        labels: {
            usePointStyle: true,
        }
    },


},
});

})