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
function displayChildChart(year = null) { 
    const currentYear = new Date().getFullYear();
    let sendYear = year == null ? currentYear : year ;
    const backgroundColors = [
        "rgba(230, 25, 75, 0.6)",    // Red
        "rgba(60, 180, 75, 0.6)",    // Green
        "rgba(255, 225, 25, 0.6)",   // Yellow
    ];
    let childs_chart;
    Chart.register(ChartZoom);
    const ctx = document.getElementById("childs_chart").getContext("2d");

    const createChart = (year, yearData) => {
        if (!yearData || yearData.length === 0) {
            console.log("No data available for the selected year.");
            return;
        }
        const barangayNames = [...new Set(yearData.map(item => item.name))];
        const groupedData = {};
        yearData.forEach(item => {
            if (!groupedData[item.ages]) {
                groupedData[item.ages] = {};
            }
            groupedData[item.ages][item.name] = item.population;
        });

        const categorizeAge = (age) => {
            if (age >= 1 && age <= 4) {
                return "1-4 years old";
            } else if (age >= 5 && age <= 9) {
                return "5-9 years old";
            } else if (age >= 10 && age <= 19) {
                return "10-19 years old";
            } else {
                return "Other"; 
            }
        };
        
        const groupedByAgeRange = {};
        Object.keys(groupedData).forEach(age => {
            const ageRange = categorizeAge(parseInt(age)); 
            if (!groupedByAgeRange[ageRange]) {
                groupedByAgeRange[ageRange] = {}; 
            }
            Object.keys(groupedData[age]).forEach(barangay => {
                if (!groupedByAgeRange[ageRange][barangay]) {
                    groupedByAgeRange[ageRange][barangay] = 0;
                }
                groupedByAgeRange[ageRange][barangay] += groupedData[age][barangay]; 
            });
        });
        
        const datasets = Object.keys(groupedByAgeRange).map((ageRange, index) => ({
            label: ageRange,
            data: barangayNames.map(name => groupedByAgeRange[ageRange][name] || 0), 
            backgroundColor: backgroundColors[index % backgroundColors.length],
        }));
        
        const chartHeight = Math.max(400, yearData.length * 40); 
        document.getElementById("childs_chart").height = chartHeight;
        if (childs_chart) childs_chart.destroy(); 
        childs_chart = new Chart(ctx, {
            type: 'bar',
            data: { labels: barangayNames, datasets: datasets, },
            options: { indexAxis: "y", responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: {position: "top",},
                    tooltip: {enabled: true,},
                    title: {display: true, text: `Deworming Beneficiaries by Ages (${year})`,
                        font: { size: 24,  },},
                    zoom: { pan: { enabled: true, mode: 'xy'},
                        zoom: {wheel: { enabled: true,},pinch: { enabled: true,},mode: 'y',
                        },
                    },
                },
                scales: {
                    x: { title: { display: true, text: 'Barangays',  font: { style: 'italic', size: 16,  },
                        },  beginAtZero: true, },
                    y: { title: {    display: true, text: 'Counts',  font: { style: 'italic',  size: 16, },
                        }, beginAtZero: true, },
                },
            },
        });
    };

    let url = window.userType === '0' ? '/admin/get_dashboard_info' : '/admin-midwife/get_dashboard_info';
    function reqData(selectedYear) {
        $.ajax({
            url: url,
            method: "GET",
            data: { year: selectedYear},
            success: function (res) {
                createChart(selectedYear, res.yearData); 
            }
        });
    }
    reqData(currentYear);
    sendYear.addEventListener("change", (e) => {
        const selectedYear = e.target.value;
        reqData(selectedYear);
    });

     document.getElementById("resetZoomBtn2").addEventListener("click", function() {
        childs_chart.resetZoom();
    });
}

 
 