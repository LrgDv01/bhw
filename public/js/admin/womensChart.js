$(document).ready(function() {
    const currentYear = new Date().getFullYear();
    const yearSelect = document.getElementById('yearSelect');
    // for (let year = 2020; year <= 2024; year++) {
    if (yearSelect) {
        for (let year = 2020; year <= currentYear; year++) {
            const option = document.createElement("option");
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
        }
        // Reverse the order of options
        const options = Array.from(yearSelect.options).slice(1);
        yearSelect.innerHTML = ""; 
        options.reverse().forEach((option) => yearSelect.appendChild(option)); // Append in reverse order
     
    }
    displayWomenChart();
});
let womens_chart; 

function displayWomenChart() { 

    if (womens_chart) {
        womens_chart.destroy();
    }

    const ctx = $("#womens_chart")[0].getContext("2d");
    womens_chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                'December', 'November', 'October', 'September', 
                'August', 'July', 'June', 'May', 
                'April', ' March', 'February', 'January'
            ], // 12 months
            datasets: [
                {
                    label: "Cambuja",
                    data: [20, 35, 50, 30, 40, 25, 35, 45, 55, 65, 75, 85], // Counts for Address C
                    backgroundColor: "rgb(230, 232, 121)",
                },
                {
                    label: "Dos",
                    data: [20, 35, 50, 30, 40, 25, 35, 45, 55, 65, 75, 85], // Counts for Address C
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                },
                {
                    label: "Tres",
                    data: [20, 35, 50, 30, 40, 25, 35, 45, 55, 65, 75, 85], // Counts for Address C
                    backgroundColor: "rgba(153, 102, 255, 0.6)",
                },
                {
                    label: "J. Rizal",
                    data: [30, 45, 60, 20, 50, 70, 40, 30, 50, 60, 45, 35], // Counts for Address A
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                },
                {
                    label: "J. Santiago",
                    data: [30, 30, 40, 60, 70, 30, 20, 40, 70, 55, 65, 75], // Counts for Address B
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                },
            ],
        },
        options: {
            indexAxis: 'y', // Horizontal bar chart
            responsive: true,
            plugins: {
                legend: {
                    position: 'top', // Legend position
                },
                title: {
                    display: true,
                    text: 'Women in Reproductive Ages by Month',
                    font: {
                        size: 24,  // Increase this value to make the text larger
                    },
                },
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Count of Women',  // Label for the X-axis
                        font: {
                            style: 'italic',  // Italicize X-axis label
                            size: 16,  // Adjust size as needed
                        },
                    },
                    stacked: true, // Enable stacking for X-axis
                },
                y: {
                    title: {
                        display: true,
                        text: 'Months',  // Label for the X-axis
                        font: {
                            style: 'italic',  // Italicize X-axis label
                            size: 16,  // Adjust size as needed
                        },
                    },
                    beginAtZero: true, // Start at 0
                    stacked: true, // Enable stacking for Y-axis
                },
            },
        },
    });
   
}