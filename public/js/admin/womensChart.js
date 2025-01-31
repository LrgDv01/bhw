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
        displayWomenChart(yearSelect, currentYear);
    }
   
});


function displayWomenChart(yearSelector, year = null) { 
    const currentYear = new Date().getFullYear();
    let sendYear = year == null ? currentYear : year ;

    $.ajax({
         // url: "/admin/dashboard/get-womens-data",
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
    
    const generateRandomData = (length) => Array.from({ length }, () => Math.floor(Math.random() * 100));
    console.log("generateRandomData ", generateRandomData(12));
    
    const dataByYear = {};
  
    for (let year = 1990; year <= currentYear; year++) {
        dataByYear[year] = labels.map(() => generateRandomData(12));
    }


    // Initialize the chart
    let womens_chart;
    Chart.register(ChartZoom);
    const ctx = document.getElementById("womens_chart").getContext("2d");

    const createChart = (year) => {
        const datasets = labels.map((label, index) => ({
            label: label,
            data: dataByYear[year][index], 
            backgroundColor: backgroundColors[index % backgroundColors.length],
        }));

        if (womens_chart) womens_chart.destroy(); 

        womens_chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'December', 'November', 'October', 'September',
                    'August', 'July', 'June', 'May',
                    'April', ' March', 'February', 'January'
                ],
                datasets: datasets,
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: {
                        display: true,
                        text: `Women in Reproductive Ages by Month (${year})`,
                        font: { size: 24 },
                    },
                    zoom: {
                        pan: { enabled: true, mode: 'x' },
                        zoom: {
                            wheel: { enabled: true },
                            pinch: { enabled: true },
                            mode: 'x',
                        },
                    },
                },
                scales: {
                    x: {
                        title: { display: true, text: 'Count of Women', font: { style: 'italic', size: 16 } },
                        stacked: true,
                    },
                    y: {
                        title: { display: true, text: 'Months', font: { style: 'italic', size: 16 } },
                        beginAtZero: true,
                        stacked: true,
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

    document.getElementById("resetZoomBtn1").addEventListener("click", function () {
        if (womens_chart) womens_chart.resetZoom();
    });
}