$(document).ready(function() {
   
    displayChildChart()
});

let childs_chart; 

function displayChildChart() { 

            if (childs_chart) {
                childs_chart.destroy();
            }
            const ctx = $("#childs_chart")[0].getContext("2d");
            childs_chart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: [
                        '7-y', '6-y', '5-y', '4-y', '3-y','2-y', '1-y', 
                    ], 
                    datasets: [
                        {
                            label: "Cambuja",
                            data: [20, 35, 50, 30, 40, 25, 35, 45, 55, 65, 75, 85], 
                            backgroundColor: "rgb(230, 232, 121)",
                        },
                        {
                            label: "Dos",
                            data: [20, 35, 50, 30, 40, 25, 35, 45, 55, 65, 75, 85], 
                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        },
                        {
                            label: "Tres",
                            data: [20, 35, 50, 30, 40, 25, 35, 45, 55, 65, 75, 85], 
                            backgroundColor: "rgba(153, 102, 255, 0.6)",
                        },
                        {
                            label: "J. Rizal",
                            data: [30, 45, 60, 20, 50, 70, 40, 30, 50, 60, 45, 35], 
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        },
                        {
                            label: "J. Santiago",
                            data: [30, 30, 40, 60, 70, 30, 20, 40, 70, 55, 65, 75], 
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        },
                    ],
                },
                options: {
                    indexAxis: "y",
                    responsive: true,
                    plugins: {
                        legend: {
                            position: "top",
                        },
                        tooltip: {
                            enabled: true,
                        },
                        title: {
                            display: true,
                            text: 'Deworming Beneficiaries by Ages',
                            font: {
                                size: 24,  
                            },
                        },
                        zoom: {
                            pan: {
                                enabled: true,
                                mode: 'xy',
                            },
                            zoom: {
                                wheel: {
                                    enabled: true,
                                },
                                pinch: {
                                    enabled: true,
                                },
                                mode: 'y',
                            },
                        },
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Count of Child',  
                                font: {
                                    style: 'italic', 
                                    size: 16, 
                                },
                            },
                            beginAtZero: true, 
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Ages',  
                                font: {
                                    style: 'italic',  
                                    size: 16, 
                                },
                            },
                            beginAtZero: true, 
                        },
                    },
                },
            });

}

 
 