import { yearFilter } from "../utils/filter.js";

function displayChildChart(year = null) {
    const currentYear = new Date().getFullYear();
    let sendYear = year == null ? currentYear : year;
    const chartContainer = document.getElementById("dewormingBeneficiaries");
    const insightContainer = document.getElementById("insight_container"); 
    const forecastContainer = document.getElementById("forecast_chart");
    const forecastInsightContainer = document.getElementById("forecast_insight_container"); 
    if (!chartContainer || !insightContainer || !forecastContainer) {
        console.error("Some container not found.");
        return;
    }
   

    // function generateForecastInsights(responseData) {
    //     if (!responseData || typeof responseData !== 'object' || Object.keys(responseData).length === 0) {
    //         forecastInsightContainer.innerHTML = "<br>No data available for forecasting.";
    //         return;
    //     }
    
    //     let historicalData = responseData.historicalDewormingData || {};
    //     let forecastData = responseData.forecastedDewormingData || {};
    
    //     if (Object.keys(historicalData).length === 0) {
    //         forecastInsightContainer.innerHTML = "<br>No historical data for insights.";
    //         return;
    //     }
    
    //     let currentDate = new Date();
    //     let currentYearMonth = `${currentDate.getFullYear()}-${currentDate.getMonth() < 6 ? "01" : "07"}`;
    //     let allMonths = [...Object.keys(historicalData), ...Object.keys(forecastData)].sort();
    //     let lastHistoricalMonth = allMonths.filter(month => month <= currentYearMonth).pop() || allMonths[0];
    //     let nextForecastMonth = allMonths.find(month => month > currentYearMonth) || allMonths[allMonths.length - 1];
    
    //     let ageGroups = ["12-23 months", "24-59 months", "5-9 years", "10-19 years"];
    //     let lastHistoricalTotals = historicalData[lastHistoricalMonth] || {};
    //     let forecastTotals = forecastData[nextForecastMonth] || {};
    
    //     // Calculate overall historical and forecast totals
    //     let historicalTotal = Object.values(lastHistoricalTotals).reduce((sum, count) => sum + (count || 0), 0);
    //     let forecastTotal = Object.values(forecastTotals).reduce((sum, count) => sum + (count || 0), 0);
    
    //     // Determine trend (based on last historical vs. previous)
    //     let previousHistoricalMonth = allMonths.filter(month => month < lastHistoricalMonth).pop() || null;
    //     let prevHistoricalTotal = previousHistoricalMonth ? Object.values(historicalData[previousHistoricalMonth] || {}).reduce((sum, count) => sum + (count || 0), 0) : 0;
    //     let trend = historicalTotal > prevHistoricalTotal ? "growth" : historicalTotal < prevHistoricalTotal ? "decline" : "stable";
    
    //     // Identify top age group historically and in forecast
    //     let topHistoricalGroup = Object.entries(lastHistoricalTotals).sort((a, b) => (b[1] || 0) - (a[1] || 0))[0]?.[0] || "None";
    //     let topForecastGroup = Object.entries(forecastTotals).sort((a, b) => (b[1] || 0) - (a[1] || 0))[0]?.[0] || "None";
    
    //     // Forecast change for each age group
    //     let forecastChanges = ageGroups.map(group => {
    //         let historicalAvg = Object.values(historicalData).reduce((sum, data) => sum + (data[group] || 0), 0) / Object.keys(historicalData).length || 0;
    //         let forecastValue = forecastTotals[group] || 0;
    //         return { group, change: forecastValue - historicalAvg };
    //     }).sort((a, b) => b.change - a.change);
    
    //     let strongestGrowth = forecastChanges[0].group;
    //     let weakestGrowth = forecastChanges[forecastChanges.length - 1].group;
    
    //     // Generate concise insight
    //     let insightText = `
    //         <strong>Key Insights (${lastHistoricalMonth}):</strong><br>
    //         - Total deworming beneficiaries: <strong>${historicalTotal}</strong> (previously <strong>${prevHistoricalTotal}</strong>, showing ${trend}).<br>
    //         - Top age group historically: <strong>${topHistoricalGroup}</strong>.<br>
    //         - Forecast for <strong>${nextForecastMonth}</strong>: Expected <strong>${forecastTotal}</strong> beneficiaries.<br>
    //         - Strongest forecasted growth: <strong>${strongestGrowth}</strong>. Weakest: <strong>${weakestGrowth}</strong>.<br>
    //         - Chart shows solid lines for past data (<strong>${lastHistoricalMonth}</strong>) and dashed for future (<strong>${nextForecastMonth}</strong>). Focus on <strong>${topForecastGroup}</strong> for upcoming efforts.
    //     `;
    
    //     forecastInsightContainer.innerHTML = insightText;
    // }

    // function generateForecastInsights(responseData) {
    //     // Validate input
    //     if (!responseData || typeof responseData !== 'object' || Object.keys(responseData).length === 0) {
    //         forecastInsightContainer.innerHTML = "<br>No data available for forecasting.";
    //         return;
    //     }
    
    //     if (!forecastInsightContainer) {
    //         console.error("forecastInsightContainer is not defined.");
    //         return;
    //     }
    
    //     // Extract historical and forecast data
    //     let historicalData = responseData.historicalDewormingData || {};
    //     let forecastData = responseData.forecastedDewormingData || {};
    
    //     if (Object.keys(historicalData).length === 0) {
    //         forecastInsightContainer.innerHTML = "<br>No historical data for insights.";
    //         return;
    //     }
    
    //     if (Object.keys(forecastData).length === 0) {
    //         console.warn("No forecast data available.");
    //     }
    
    //     // Get current period (YYYY-MM)
    //     let currentDate = new Date();
    //     let currentYearMonth = `${currentDate.getFullYear()}-${String(currentDate.getMonth() + 1).padStart(2, "0") < "07" ? "01" : "07"}`;
    
    //     // Get all valid periods and sort them
    //     const isValidPeriod = (period) => /^\d{4}-\d{2}$/.test(period);
    //     let allMonths = [...Object.keys(historicalData), ...Object.keys(forecastData)]
    //         .filter(isValidPeriod)
    //         .sort();
    
    //     // Determine last historical and next forecast periods
    //     let lastHistoricalMonth = allMonths.filter(month => month <= currentYearMonth).pop() || allMonths[0];
    //     let nextForecastMonth = allMonths.find(month => month > currentYearMonth) || allMonths[allMonths.length - 1];
    
    //     // Dynamically extract age groups
    //     const ageGroups = [...new Set([
    //         ...Object.values(historicalData).flatMap(data => Object.keys(data)),
    //         ...Object.values(forecastData).flatMap(data => Object.keys(data))
    //     ])].sort();
    
    //     // Get totals for last historical and next forecast periods
    //     let lastHistoricalTotals = historicalData[lastHistoricalMonth] || {};
    //     let forecastTotals = forecastData[nextForecastMonth] || {};
    
    //     let historicalTotal = Object.values(lastHistoricalTotals).reduce((sum, count) => sum + (count || 0), 0);
    //     let forecastTotal = Object.values(forecastTotals).reduce((sum, count) => sum + (count || 0), 0);
    
    //     // Determine trend
    //     let previousHistoricalMonth = allMonths.filter(month => month < lastHistoricalMonth).pop() || null;
    //     let prevHistoricalTotal = previousHistoricalMonth ? Object.values(historicalData[previousHistoricalMonth] || {}).reduce((sum, count) => sum + (count || 0), 0) : 0;
    //     let trend = historicalTotal > prevHistoricalTotal ? "growth" : historicalTotal < prevHistoricalTotal ? "decline" : "stable";
    
    //     // Identify top age groups
    //     let topHistoricalGroup = Object.entries(lastHistoricalTotals).sort((a, b) => (b[1] || 0) - (a[1] || 0))[0]?.[0] || "None";
    //     let topForecastGroup = Object.entries(forecastTotals).sort((a, b) => (b[1] || 0) - (a[1] || 0))[0]?.[0] || "None";
    
    //     // Calculate forecast changes for each age group
    //     let forecastChanges = ageGroups.map(group => {
    //         let historicalAvg = Object.values(historicalData).reduce((sum, data) => sum + (data[group] || 0), 0) / Object.keys(historicalData).length || 0;
    //         let forecastValue = forecastTotals[group] || 0;
    //         return { group, change: forecastValue - historicalAvg };
    //     }).sort((a, b) => b.change - a.change);
    
    //     let strongestGrowth = forecastChanges.length > 0 ? forecastChanges[0].group : "None";
    //     let weakestGrowth = forecastChanges.length > 0 ? forecastChanges[forecastChanges.length - 1].group : "None";
    
    //     // Generate insight text
    //     let insightText = `
    //         <strong>Key Insights (${lastHistoricalMonth}):</strong><br>
    //         - Total deworming beneficiaries: <strong>${historicalTotal}</strong> (previously <strong>${prevHistoricalTotal}</strong>, showing ${trend}).<br>
    //         - Top age group historically: <strong>${topHistoricalGroup}</strong>.<br>
    //         - Forecast for <strong>${nextForecastMonth}</strong>: Expected <strong>${forecastTotal}</strong> beneficiaries.<br>
    //         - Strongest forecasted growth: <strong>${strongestGrowth}</strong>. Weakest: <strong>${weakestGrowth}</strong>.<br>
    //         - Chart shows solid lines for past data (<strong>${lastHistoricalMonth}</strong>) and dashed for future (<strong>${nextForecastMonth}</strong>). Focus on <strong>${topForecastGroup}</strong> for upcoming efforts.
    //     `;
    
    //     forecastInsightContainer.innerHTML = insightText;
    // }

    function generateForecastInsights(responseData) {
        if (!responseData || typeof responseData !== 'object' || Object.keys(responseData).length === 0) {
            forecastInsightContainer.innerHTML = "<br><strong>No data available for forecasting.</strong>";
            return;
        }
        if (!forecastInsightContainer) {
            console.error("forecastInsightContainer is not defined.");
            return;
        }
        let historicalData = responseData.historicalDewormingData || {};
        let forecastData = responseData.forecastedDewormingData || {};
        if (Object.keys(historicalData).length === 0) {
            forecastInsightContainer.innerHTML = "<br><strong>No historical data available for insights.</strong>";
            return;
        }
        let currentDate = new Date();
        let currentYearMonth = `${currentDate.getFullYear()}-${currentDate.getMonth() + 1 <= 6 ? "01" : "07"}`;
        const isValidPeriod = (period) => /^\d{4}-\d{2}$/.test(period);
        let allMonths = [...Object.keys(historicalData), ...Object.keys(forecastData)]
            .filter(isValidPeriod)
            .sort();
        let lastHistoricalMonth = allMonths.filter(month => month <= currentYearMonth).pop() || allMonths[0];
        let nextForecastMonth = allMonths.find(month => month > currentYearMonth) || allMonths[allMonths.length - 1];
        let lastHistoricalTotals = historicalData[lastHistoricalMonth] || {};
        let forecastTotals = forecastData[nextForecastMonth] || {};
        let historicalTotal = Object.values(lastHistoricalTotals).reduce((sum, count) => sum + (count || 0), 0);
        let prevHistoricalMonth = allMonths.filter(month => month < lastHistoricalMonth).pop() || null;
        let prevHistoricalTotal = prevHistoricalMonth ? 
            Object.values(historicalData[prevHistoricalMonth] || {}).reduce((sum, count) => sum + (count || 0), 0) : 0;
        let lastThreePeriods = allMonths.slice(-3);
        let avgHistoricalTotal = lastThreePeriods.reduce((sum, period) => 
            sum + (Object.values(historicalData[period] || {}).reduce((a, b) => a + b, 0)), 0) / Math.max(1, lastThreePeriods.length);
        let trend = historicalTotal > avgHistoricalTotal ? "focus" :
                    historicalTotal < avgHistoricalTotal ? "decline" : "stable";
        let forecastChanges = Object.keys(forecastTotals).map(group => {
            let historicalAvg = Object.values(historicalData)
                .reduce((sum, data) => sum + (data[group] || 0), 0) / Math.max(1, Object.keys(historicalData).length);
            let forecastValue = forecastTotals[group] || 0;
            let percentageChange = historicalAvg > 0 ? (((forecastValue - historicalAvg) / historicalAvg * 1000) / 100) .toFixed(2) : "N/A";
            return { group, change: forecastValue - historicalAvg, forecastValue, percentageChange };
        }).sort((a, b) => b.change - a.change);
    
        // let sortedHistoricalGroups = Object.entries(lastHistoricalTotals)
        //     .filter(([_, count]) => count > 0)
        //     .sort((a, b) => b[1] - a[1]);
    
        // let sortedForecastGroups = Object.entries(forecastTotals)
        //     .filter(([_, count]) => count > 0)
        //     .sort((a, b) => b[1] - a[1]);
    
        // let topHistoricalGroup = sortedHistoricalGroups.length > 0 ? sortedHistoricalGroups[0][0] : "No data";
        // let topForecastGroup = sortedForecastGroups.length > 0 ? sortedForecastGroups[0][0] : "No data";

        // - Forecast for <strong>${nextForecastMonth}</strong>: Expected <strong>${forecastChanges[0]?.forecastValue}</strong> deworming service.<br>
    
        let insightText = `
            <strong>Key Insights (${lastHistoricalMonth}):</strong><br>
            - Total current deworming beneficiaries: <strong>${historicalTotal}</strong> (previously <strong>${prevHistoricalTotal}</strong>, showing <span style="color:${trend === "focus" ? "green" : trend === "decline" ? "red" : "gray"};">${trend}</span>).<br>
            - Top historical age group: <strong>${forecastChanges[0]?.group || "N/A"}</strong>.<br>
            - Forecast for <strong>${nextForecastMonth}</strong>: Expected <strong>${Object.values(forecastTotals).reduce((sum, count) => sum + (count || 0), 0)}</strong> deworming service.<br>
            - Strongest service: <strong>${forecastChanges[0]?.group || "N/A"}</strong> (<span style="color:green;">${forecastChanges[0]?.percentageChange || "N/A"}%</span>).<br>
            - Weakest service: <strong>${forecastChanges[forecastChanges.length - 1]?.group || "N/A"}</strong> (<span style="color:red;">${forecastChanges[forecastChanges.length - 1]?.percentageChange || "N/A"}%</span>).<br>
            - <em>Upcoming focus should be on <strong>${forecastChanges[forecastChanges.length - 1]?.group || "N/A"}</strong> for better deworming planning.</em>
        `;
        forecastInsightContainer.innerHTML = insightText;
    }
    
    function createForecastChart(historicalDewormingData, forecastedDewormingData) {
        let ageGroups = ["12-23 months", "24-59 months", "5-9 years", "10-19 years"];
        let dataSeries = {};
        let currentYear = new Date().getFullYear();
        let currentYearMonth = `${currentYear}-${new Date().getMonth() < 6 ? "01" : "07"}`;
        let startYear = 2023;
        let endYear = 2027;
        let months = [];
        for (let year = startYear; year <= endYear; year++) {
            months.push(`${year}-01`, `${year}-07`);
        }
        ageGroups.forEach(group => {
            let seriesData = [];
            months.forEach(month => {
                let isForecast = month >= currentYearMonth;
                let value = historicalDewormingData[month]?.[group] || forecastedDewormingData[month]?.[group] || 0;
                // Estimate missing forecast values using previous data
                if (isForecast && value === 0) {
                    let prevValues = Object.values(historicalDewormingData)
                        .map(data => data[group])
                        .filter(v => v !== null && v !== undefined);
    
                    if (prevValues.length > 0) {
                        let avgValue = prevValues.reduce((a, b) => a + b, 0) / prevValues.length;
                        value = Math.round(avgValue * (0.9 + Math.random() * 0.2)); // Adds slight smoothing variation
                    }
                }
                seriesData.push({
                    label: month,
                    y: value,
                    lineDashType: isForecast ? "dash" : "solid",
                    indexLabelFontSize: 12,
                    indexLabelFontWeight: "bold",
                    indexLabelPlacement: "outside"
                });
            });
            dataSeries[group] = seriesData;
        });
    
        let chart = new CanvasJS.Chart("forecast_chart", {
            animationEnabled: true,
            theme: "light2",
            title: { text: "Deworming Forecast" },
            axisX: {
                title: "Month-Year",
                labelAngle: -45,
                interval: 1,
                labelFormatter: function (e) {
                    return e.label;
                }
            },
            axisY: { title: "Count", minimum: 0 },
            toolTip: { shared: true },
            legend: { cursor: "pointer" },
            data: ageGroups.map(group => ({
                type: "line",
                showInLegend: true,
                name: group,
                markerSize: 5,
                dataPoints: dataSeries[group]
            }))
        });
    
        chart.render();
    }

    const createInsight = (dataPoints) => {
        if (!dataPoints || dataPoints.length === 0) {
            insightContainer.innerHTML = `<p>No data available for the selected filter.</p>`;
            return;
        }
        const sortedData = [...dataPoints].sort((a, b) => b.y - a.y);
        const highestValue = sortedData[0].y;
        const lowestValue = sortedData[sortedData.length - 1].y;
        const highestGroups = sortedData.filter(dp => dp.y === highestValue);
        const lowestGroups = sortedData.filter(dp => dp.y === lowestValue);
        const highestText = highestGroups.map(g => g.label).join(" and ");
        const lowestText = lowestGroups.map(g => g.label).join(" and ");

        let insightText = "";
        if (highestValue === 0 || highestValue <= 0.01) {
            insightText = "No significant data available for the selected year.";
        }
        else if (highestGroups.length === 1 && lowestGroups.length === 1) {
            insightText = `
                The age group <b>${highestText}</b> has the highest percentage of deworming beneficiaries at <b>${highestValue}%</b>, 
                while <b>${lowestText}</b> has the lowest at <b>${lowestValue}%</b>. 
                This suggests that deworming efforts are focused more on <b>${highestText}</b>.
            `;
        }
        else if (highestGroups.length > 1 && lowestGroups.length === 1) {
            insightText = `
                The age groups <b>${highestText}</b> all have the highest percentage of deworming beneficiaries at <b>${highestValue}%</b>. 
                Meanwhile, the <b>${lowestText}</b> age group has the lowest at <b>${lowestValue}%</b>.
            `;
        }
        else if (highestGroups.length === 1 && lowestGroups.length > 1) {
            insightText = `
                The age group <b>${highestText}</b> has the highest percentage of deworming beneficiaries at <b>${highestValue}%</b>. 
                Meanwhile, the age groups <b>${lowestText}</b> all have the lowest percentage at <b>${lowestValue}%</b>.
            `;
        }
        else if (highestGroups.length > 1 && lowestGroups.length > 1) {
            insightText = `
                The age groups <b>${highestText}</b> have the highest percentage of deworming beneficiaries at <b>${highestValue}%</b>. 
                At the same time, the age groups <b>${lowestText}</b> have the lowest percentage at <b>${lowestValue}%</b>.
            `;
        }
        insightContainer.innerHTML = `<p>${insightText}</p>`;
    };

    const createChart = (year, dewormingAgeRanges) => {
        if (!dewormingAgeRanges || Object.keys(dewormingAgeRanges).length === 0) {
            console.log("No data available for the selected year.");
            insightContainer.innerHTML = `<p>No data available for the selected year.</p>`;
            return;
        }

        const sliceColors = ["#2f5f98", "#2d8bba", "#41b8d5", "#6ce5e8"];
        const noDataColor = '#7b7b7b';
        let totalPopulation = Object.values(dewormingAgeRanges).reduce((sum, count) => sum + count, 0);

        const dataPoints = Object.keys(dewormingAgeRanges).map((ageRange, index) => {
            let count = parseFloat(dewormingAgeRanges[ageRange]);
            let percentage = totalPopulation > 0 ? ((count / totalPopulation) * 100).toFixed(2) : 0;

            return {
                label: ageRange,
                y: count > 0 ? parseFloat(percentage) : 0.01,
                color: count == 0 ? noDataColor : sliceColors[index % sliceColors.length]
            };
        });

        createInsight(dataPoints);

        const chart = new CanvasJS.Chart("dewormingBeneficiaries", {
            animationEnabled: true,
            title: { text: `Deworming Beneficiaries by Age` },
            toolTip: { enabled: true, shared: true, content: "{label}: {y}%" },
            data: [{
                type: "pie",
                startAngle: 240,
                yValueFormatString: "##0.00\"%\"",
                indexLabel: "{label} old : {y}",
                dataPoints: dataPoints
            }]
        });

        chart.render();
      
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
                createChart(selectedYear, res.dewormingAgeRanges);
                createForecastChart(res.historicalDewormingData, res.forecastedDewormingData);
                generateForecastInsights(res);
            },
            error: function () {
                console.error("Failed to fetch data.");
                insightContainer.innerHTML = `<p>Error loading data. Please try again later.</p>`;
                forecastInsightContainer.innerHTML = `<p>Error loading data. Please try again later.</p>`;  
            }
        });
    }

    reqData(currentYear);
    sendYear.addEventListener("change", (e) => reqData(e.target.value));
}

$(document).ready(function () {
    const yearSelect = new yearFilter();
    displayChildChart(yearSelect);
});


