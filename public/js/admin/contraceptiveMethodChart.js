import { yearFilter } from "./utils/filter.js";

function displayWomenChart(year = null) {
    const currentYear = new Date().getFullYear();
    let sendYear = year == null ? currentYear : year;
    const backgroundColors = {
        "10-14": "#00cadc",
        "15-19": "#49c3fb",
        "20-49": "#65a6fa",
        "10-14": "#7e80e7",
        "15-19": "#9b57cc"
 
    };
    let contraceptive_chart;
    Chart.register(ChartZoom);
    const ctx = document.getElementById("contraceptive_chart").getContext("2d");

    const createChart = (year, yearData, ageRanges) => {
        if (!year && (!yearData || yearData.length === 0)) {
            console.log("No data available for the selected year.");
            return;
        } else{
            const monthOrder = [
                "Adia", "Bagong Pook", "Bagumbayan", "Bubucal", "Cabuoan", "Cambuja",
                "Coralan", "Cueva", "Inayapan", "Jose P. Laurel, Sr.", "Jose Rizal", 
                "Juan Santiago", "Kayhacat", "Macasipac", "Masinao", "Matalinting",
                "Pao-o", "Parang ng Buho", "Poblacion Dos", "Poblacion Quatro", "Poblacion Tres",
                "Poblacion Uno", "Talangka", "Tungkod"
            ];
            const datasets = Object.keys(ageRanges).map((ageGroup) => {
                const monthlyCounts = monthOrder.map((month) => {
                    return ageRanges[ageGroup].filter(item => item.month === month).length;
                });
                return {
                    // label: ageGroup + ' Y/O',
                    label: 'IUD',
                    data: monthlyCounts,
                    backgroundColor: backgroundColors[ageGroup],
                };
            });

            const chartHeight = Math.max(400, yearData.length * 40);
            document.getElementById("contraceptive_chart").height = chartHeight;
            if (contraceptive_chart) contraceptive_chart.destroy();
            contraceptive_chart = new Chart(ctx, {
                type: 'bar',
                data: { labels: monthOrder, datasets: datasets },
                options: {
                    indexAxis: 'x', responsive: true, maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' },
                        title: {
                            display: true,
                            text: `Client per Contraceptive Method per Barangay (${year})`,
                            font: { size: 24 },
                            color: 'black'
                        },
                        zoom: {
                            pan: { enabled: true, mode: 'xy' },
                            zoom: { wheel: { enabled: true }, pinch: { enabled: true }, mode: 'x' },
                        },
                    },
                    scales: {
                        x: { title: { display: true, text: 'Barangay', font: { size: 16 } }, stacked: true },
                        y: { title: { display: true, text: 'Count per Contraceptive Method', font: { size: 16 } }, beginAtZero: true, stacked: true }
                    },
                },
            });
        }
    };

    let url = window.userType === '0' ? '/admin/get_dashboard_info' 
            : window.userType === '1' ? '/admin-midwife/get_dashboard_info' 
            : '/bhw/get_dashboard_info';
    function reqData(selectedYear) {
        $.ajax({
            url: url,
            method: "GET",
            data: { year: selectedYear },
            success: function (res) {
                createChart(selectedYear, res.yearDataWithMonth, res.womenAgeRanges);
            }
        });
    }
    reqData(currentYear);
    sendYear.addEventListener("change", (e) => {
        const selectedYear = e.target.value;
        reqData(selectedYear);
    });
    document.getElementById("contraceptiveResetZoomBtn").addEventListener("click", function () {
        if (contraceptive_chart) contraceptive_chart.resetZoom();
    });
}

$(document).ready(function() {
    const yearSelect = new yearFilter();
    displayWomenChart(yearSelect);
});

