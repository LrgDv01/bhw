import { yearFilter } from "../utils/filter.js";

function displayWomenChart1(year = null) {
    const currentYear = new Date().getFullYear();
    let sendYear = year == null ? currentYear : year;
    const backgroundColors = {
        "10-14": "#2d8bba",
    };
    let familyPlanningMethod;
    Chart.register(ChartZoom);
    const ctx = document.getElementById("familyPlanningMethod").getContext("2d");

    const createChart = (year, yearData, ageRanges) => {
        if (!year && (!yearData || yearData.length === 0)) {
            console.log("No data available for the selected year.");
            return;
        } else{
            const monthOrder = [
                "", 
            ];
            const datasets = Object.keys(ageRanges).map((ageGroup) => {
                const monthlyCounts = monthOrder.map((month) => {
                    return ageRanges[ageGroup].filter(item => item.month === month).length;
                });
                return {
                    // label: ageGroup + ' Y/O',
                    data: monthlyCounts,
                    backgroundColor: backgroundColors[ageGroup],
                };
            });

            const chartHeight = Math.max(400, yearData.length * 40);
            document.getElementById("familyPlanningMethod").height = chartHeight;
            if (familyPlanningMethod) familyPlanningMethod.destroy();
            familyPlanningMethod = new Chart(ctx, {
                type: 'bar',
                data: { labels: monthOrder, datasets: datasets },
                options: {
                    indexAxis: 'x', responsive: true, maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' },
                        title: {
                            display: true,
                            text: `Family Planning Methods Usage`,
                            font: { size: 24 },
                            color: 'black'
                        },
                        zoom: {
                            pan: { enabled: true, mode: 'xy' },
                            zoom: { wheel: { enabled: true }, pinch: { enabled: true }, mode: 'x' },
                        },
                    },
                    scales: {
                        x: { title: { display: true, text: 'Contraceptive Method', font: { size: 16 } }, stacked: false },
                        y: { title: { display: true, text: 'Count per Contraceptive Method', font: { size: 16 } }, beginAtZero: true, stacked: false }
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

    document.getElementById("familyPlanningMethodResetZoomBtn").addEventListener("click", function () {
        if (familyPlanningMethod) familyPlanningMethod.resetZoom();
    });
}

function displayWomenChart2(year = null) {
    const currentYear = new Date().getFullYear();
    let sendYear = year == null ? currentYear : year;
    const backgroundColors = {
        "10-14": "#2d8bba",
    };
    let ageGroupDistribution;
    Chart.register(ChartZoom);
    const ctx = document.getElementById("ageGroupDistribution").getContext("2d");

    const createChart = (year, yearData, ageRanges) => {
        if (!year && (!yearData || yearData.length === 0)) {
            console.log("No data available for the selected year.");
            return;
        } else{
            const monthOrder = [
                "10-14 Y/O", "15-19 Y/O", "20-40 Y/O"
            ];
            const datasets = Object.keys(ageRanges).map((ageGroup) => {
                const monthlyCounts = monthOrder.map((month) => {
                    return ageRanges[ageGroup].filter(item => item.month === month).length;
                });
                return {
                    // label: ageGroup + ' Y/O',
                    data: monthlyCounts,
                    backgroundColor: backgroundColors[ageGroup],
                };
            });

            const chartHeight = Math.max(400, yearData.length * 40);
            document.getElementById("ageGroupDistribution").height = chartHeight;
            if (ageGroupDistribution) ageGroupDistribution.destroy();
            ageGroupDistribution = new Chart(ctx, {
                type: 'bar',
                data: { labels: monthOrder, datasets: datasets },
                options: {
                    indexAxis: 'x', responsive: true, maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' },
                        title: {
                            display: true,
                            text: `Age Group Distribution of Family Planning`,
                            font: { size: 24 },
                            color: 'black'
                        },
                        zoom: {
                            pan: { enabled: true, mode: 'xy' },
                            zoom: { wheel: { enabled: true }, pinch: { enabled: true }, mode: 'x' },
                        },
                    },
                    scales: {
                        x: { title: { display: true, text: 'Age Group', font: { size: 16 } }, stacked: false },
                        y: { title: { display: true, text: 'Number of Clients', font: { size: 16 } }, beginAtZero: true, stacked: false }
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

    document.getElementById("ageGroupDistributionResetZoomBtn").addEventListener("click", function () {
        if (ageGroupDistribution) ageGroupDistribution.resetZoom();
    });
}

function displayWomenChart3(year = null) {
    const currentYear = new Date().getFullYear();
    let sendYear = year == null ? currentYear : year;
    const backgroundColors = {
        "10-14": "#2d8bba",
    };
    let familyPlanningVisits;
    Chart.register(ChartZoom);
    const ctx = document.getElementById("familyPlanningVisits").getContext("2d");

    const createChart = (year, yearData, ageRanges) => {
        if (!year && (!yearData || yearData.length === 0)) {
            console.log("No data available for the selected year.");
            return;
        } else{
            const monthOrder = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];
            const datasets = Object.keys(ageRanges).map((ageGroup) => {
                const monthlyCounts = monthOrder.map((month) => {
                    return ageRanges[ageGroup].filter(item => item.month === month).length;
                });
                return {
                    // label: ageGroup + ' Y/O',
                    data: monthlyCounts,
                    backgroundColor: backgroundColors[ageGroup],
                };
            });

            const chartHeight = Math.max(400, yearData.length * 40);
            document.getElementById("familyPlanningVisits").height = chartHeight;
            if (familyPlanningVisits) familyPlanningVisits.destroy();
            familyPlanningVisits = new Chart(ctx, {
                type: 'bar',
                data: { labels: monthOrder, datasets: datasets },
                options: {
                    indexAxis: 'x', responsive: true, maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' },
                        title: {
                            display: true,
                            text: `Family Planning Visits`,
                            font: { size: 24 },
                            color: 'black'
                        },
                        zoom: {
                            pan: { enabled: true, mode: 'xy' },
                            zoom: { wheel: { enabled: true }, pinch: { enabled: true }, mode: 'x' },
                        },
                    },
                    scales: {
                        x: { title: { display: true, text: 'Month', font: { size: 16 } }, stacked: false },
                        y: { title: { display: true, text: 'Number of Visits', font: { size: 16 } }, beginAtZero: true, stacked: false }
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

    document.getElementById("familyPlanningVisitsResetZoomBtn").addEventListener("click", function () {
        if (familyPlanningVisits) familyPlanningVisits.resetZoom();
    });
}

function displayWomenChart4(year = null) {
    const currentYear = new Date().getFullYear();
    let sendYear = year == null ? currentYear : year;
    const backgroundColors = {
        "10-14": "#2d8bba",
    };
    let totalClientsEnrolled;
    Chart.register(ChartZoom);
    const ctx = document.getElementById("totalClientsEnrolled").getContext("2d");

    const createChart = (year, yearData, ageRanges) => {
        if (!year && (!yearData || yearData.length === 0)) {
            console.log("No data available for the selected year.");
            return;
        } else{
            const monthOrder = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];
            const datasets = Object.keys(ageRanges).map((ageGroup) => {
                const monthlyCounts = monthOrder.map((month) => {
                    return ageRanges[ageGroup].filter(item => item.month === month).length;
                });
                return {
                    // label: ageGroup + ' Y/O',
                    data: monthlyCounts,
                    backgroundColor: backgroundColors[ageGroup],
                };
            });

            const chartHeight = Math.max(400, yearData.length * 40);
            document.getElementById("totalClientsEnrolled").height = chartHeight;
            if (totalClientsEnrolled) totalClientsEnrolled.destroy();
            totalClientsEnrolled = new Chart(ctx, {
                type: 'line',
                data: { labels: monthOrder, datasets: datasets },
                options: {
                    indexAxis: 'x', responsive: true, maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' },
                        title: {
                            display: true,
                            text: `Total Clients Enrolled in Family Planning Services`,
                            font: { size: 24 },
                            color: 'black'
                        },
                        zoom: {
                            pan: { enabled: true, mode: 'xy' },
                            zoom: { wheel: { enabled: true }, pinch: { enabled: true }, mode: 'x' },
                        },
                    },
                    scales: {
                        x: { title: { display: true, text: 'Month', font: { size: 16 } }, stacked: false },
                        y: { title: { display: true, text: 'Total Clients Enrolled', font: { size: 16 } }, beginAtZero: true, stacked: false }
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

    document.getElementById("totalClientsEnrolledResetZoomBtn").addEventListener("click", function () {
        if (totalClientsEnrolled) totalClientsEnrolled.resetZoom();
    });
}


$(document).ready(function() {
    const yearSelect = new yearFilter();
    displayWomenChart1(yearSelect);
    displayWomenChart2(yearSelect);
    displayWomenChart3(yearSelect);
    displayWomenChart4(yearSelect);
});

