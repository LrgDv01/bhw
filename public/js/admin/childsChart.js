$(document).ready(function() {
    const currentYear = new Date().getFullYear();
    const yearSelect = document.getElementById('yearSelect');
    if (yearSelect) {
        for (let year = 1990; year <= currentYear; year++) {
            const option = document.createElement("option");
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
        }
      
        const options = Array.from(yearSelect.options).slice(1);
        yearSelect.innerHTML = ""; 
        options.reverse().forEach((option) => yearSelect.appendChild(option)); 
        displayChildChart(yearSelect, currentYear);
    }
   
   
});

let childs_chart; 

function displayChildChart(yearSelector, year = null) { 
    const currentYear = new Date().getFullYear();
    let sendYear = year == null ? currentYear : year ;

    $.ajax({
        // url: "/admin/dashboard/get-children-data",
        method: "GET",
        data: { year: sendYear },
        success: function (data) {

    }});

    
    const labels = [
        "Adia |", "Bagong Pook |", "Bagumbayan |", "Bubucal |", "Cabooan |", "Calangay |", 
        "Cambuja |", "Coralan |", "Cueva |", "Inayapan |", "Jose P. Laurel, Sr. |", 
        "Jose Rizal |", "Juan Santiago |", "Kayhacat |", "Macasipac |", "Masinao |", 
        "Matalinting |", "Pao-o |", "Parang ng Buho |", "Poblacion Uno |", 
        "Poblacion Dos |", "Poblacion Tres |", "Poblacion Quatro |", "Talangka |", 
        "Tungkod"
    ];
    
    const backgroundColors = [
        "rgba(230, 25, 75, 0.6)",    // Red
        "rgba(60, 180, 75, 0.6)",    // Green
        "rgba(255, 225, 25, 0.6)",   // Yellow
        "rgba(0, 130, 200, 0.6)",    // Blue
        "rgba(245, 130, 48, 0.6)",   // Orange
        "rgba(145, 30, 180, 0.6)",   // Purple
        "rgba(70, 240, 240, 0.6)",   // Cyan
        "rgba(240, 50, 230, 0.6)",   // Magenta
        "rgba(210, 245, 60, 0.6)",   // Lime
        "rgba(250, 190, 212, 0.6)",  // Pink
        "rgba(0, 128, 128, 0.6)",    // Teal
        "rgba(220, 190, 255, 0.6)",  // Lavender
        "rgba(170, 110, 40, 0.6)",   // Brown
        "rgba(255, 250, 200, 0.6)",  // Beige
        "rgba(128, 0, 0, 0.6)",      // Maroon
        "rgba(170, 255, 195, 0.6)",  // Mint
        "rgba(128, 128, 0, 0.6)",    // Olive
        "rgba(255, 215, 180, 0.6)",  // Apricot
        "rgba(0, 0, 128, 0.6)",      // Navy
        "rgba(128, 128, 128, 0.6)",  // Grey
        "rgba(255, 0, 0, 0.6)",      // Bright Red
        "rgba(0, 255, 0, 0.6)",      // Bright Green
        "rgba(0, 0, 255, 0.6)",      // Bright Blue
        "rgba(255, 255, 0, 0.6)",    // Bright Yellow
        "rgba(255, 165, 0, 0.6)"     // Bright Orange
    ];
    
    // Generate random data function
    const generateRandomData = (length) => Array.from({ length }, () => Math.floor(Math.random() * 100));
    
    const dataByYear = {};
  
    for (let year = 1990; year <= currentYear; year++) {
        dataByYear[year] = labels.map(() => generateRandomData(12));
    }

    // Initialize the chart
    let childs_chart;
    Chart.register(ChartZoom);
    const ctx = document.getElementById("childs_chart").getContext("2d");

  
    const createChart = (year) => {
        const datasets = labels.map((label, index) => ({
            label: label,
            data: dataByYear[year][index], 
            backgroundColor: backgroundColors[index % backgroundColors.length],
        }));

        if (childs_chart) childs_chart.destroy(); 


        childs_chart = new Chart(ctx, {
            type: 'bar',
            data: {
            labels: [
                '7-y', '6-y', '5-y', '4-y', '3-y','2-y', '1-y', 
            ], 
            datasets: datasets
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
                        text: `Deworming Beneficiaries by Ages (${year})`,
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
    };

     createChart(currentYear);
     yearSelector.addEventListener("change", (e) => {
         const selectedYear = e.target.value;
         createChart(selectedYear);
     });

     document.getElementById("resetZoomBtn2").addEventListener("click", function() {
        childs_chart.resetZoom();
    });

}

 
 