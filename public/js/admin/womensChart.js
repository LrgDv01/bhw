import { yearFilter } from "./utils/filter.js";

function displayWomenChart(year = null) {
    const currentYear = new Date().getFullYear();
    let sendYear = year == null ? currentYear : year;
    const backgroundColors = {
        "10-14": "rgba(230, 25, 75, 0.6)",
        "15-19": "rgba(60, 180, 75, 0.6)",
        "20-49": "rgba(255, 225, 25, 0.6)"
    };
    let womens_chart;
    Chart.register(ChartZoom);
    const ctx = document.getElementById("womens_chart").getContext("2d");

    const createChart = (year, yearData, ageRanges) => {
        if (!yearData || yearData.length === 0) {
            console.log("No data available for the selected year.");
            return;
        }
        const monthOrder = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        const datasets = Object.keys(ageRanges).map((ageGroup) => {
            const monthlyCounts = monthOrder.map((month) => {
                return ageRanges[ageGroup].filter(item => item.month === month).length;
            });
            return {
                label: ageGroup + ' Y/O',
                data: monthlyCounts,
                backgroundColor: backgroundColors[ageGroup],
            };
        });

        const chartHeight = Math.max(400, yearData.length * 40);
        document.getElementById("womens_chart").height = chartHeight;
        if (womens_chart) womens_chart.destroy();
        womens_chart = new Chart(ctx, {
            type: 'bar',
            data: { labels: monthOrder, datasets: datasets },
            options: {
                indexAxis: 'x', responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' },
                    title: {
                        display: true,
                        text: `Women in Reproductive Ages by Year (${year})`,
                        font: { size: 24 },
                    },
                    zoom: {
                        pan: { enabled: true, mode: 'xy' },
                        zoom: { wheel: { enabled: true }, pinch: { enabled: true }, mode: 'x' },
                    },
                },
                scales: {
                    x: { title: { display: true, text: 'Months', font: { size: 16 } }, stacked: false },
                    y: { title: { display: true, text: 'Counts', font: { size: 16 } }, beginAtZero: true, stacked: false }
                },
            },
        });
    };

    let url = window.userType === '0' ? '/admin/get_dashboard_info' : '/admin-midwife/get_dashboard_info';
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

    document.getElementById("resetZoomBtn1").addEventListener("click", function () {
        if (womens_chart) womens_chart.resetZoom();
    });
}

$(document).ready(function() {
    const yearSelect = new yearFilter();
    displayWomenChart(yearSelect);
});

