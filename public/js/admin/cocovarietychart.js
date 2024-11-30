$(document).ready(function() {
    //   const currentYear = new Date().getFullYear();
    //   const startYear = currentYear - 10; // Change this value to adjust the range
    //   const $yearSelect = $('#yearSelect');
    
    //   for (let year = currentYear; year >= startYear; year--) {
    //       $yearSelect.append(new Option(year, year));
    //   }
    //   // Check element 
    // //   let graph = $("#monthlyChart1");
    
    //   if(graph.length > 0) {
    //     // Optionally, you can add an event listener to handle the year selection
    //     $yearSelect.on('change', function() {
    //         const selectedYear = $(this).val();
    //         displayMonthlyGraph(selectedYear);
    //         // Fetch and update the chart data based on the selected year
    //     });
    //     displayMonthlyGraph(currentYear)
    //   }
    
    const currentYear = new Date().getFullYear();

    // const startYear = currentYear + 4; // Change this value to adjust the range
    // const $cocoYearSelect = $('#cocoYearSelect');
    // for (let year = currentYear; year >= startYear; year--) {
    //     $cocoYearSelect.prepend(new Option(year, year));
    // }

    const cocoYearSelect = document.getElementById('cocoYearSelect');
    if (cocoYearSelect) {
        for (let year = 2020; year <= currentYear; year++) {

            const option = document.createElement("option");
            option.value = year;
            option.textContent = year;
            cocoYearSelect.appendChild(option);
        }
        // Reverse the order of options
        const options = Array.from(cocoYearSelect.options).slice(1);
        cocoYearSelect.innerHTML = ""; 
        options.reverse().forEach((option) => cocoYearSelect.appendChild(option)); // Append in reverse order
        displayCocoChart(currentYear)
    }
    
});

let coconut_chart; 
    // let monthlyChart; // Declare a variable to store the chart instance
function displayCocoChart(year = null) { 
    const currentYear = new Date().getFullYear();
    let sendYear = year == null ? currentYear : year ;
    $.ajax({
        // url: "/admin/dashboard/get_monthly_counts",
        method: "GET",
        data: { year: sendYear },
        success: function (data) {
            // const labels = [];
            // const approvedCounts = [];
            // const pendingCounts = [];
            // const rejectedCounts = [];
    
            // const sample = [
            //     { year: 2010, month: 1, approved_count: 12, rejected_count: 3 },
            //     { year: 2024, month: 2, approved_count: 15, rejected_count: 5 },
            //     { year: 2024, month: 3, approved_count: 20, rejected_count: 2 },
            //     { year: 2024, month: 4, approved_count: 18, rejected_count: 4 },
            //     { year: 2024, month: 5, approved_count: 25, rejected_count: 6 },
            //     { year: 2024, month: 6, approved_count: 30, rejected_count: 7 },
            // ];
    
            // data.forEach((item) => {
            //     labels.push(
            //         `${item.year}-${String(item.month).padStart(2, "0")}`
            //     );
            //     approvedCounts.push(item.approved_count);
            //     rejectedCounts.push(item.rejected_count);
            // });
    
    
            // monthlyChart = new Chart(ctx1, {
            //     type: "line",
            //     data: {
            //         labels: labels, // X-axis labels
            //         datasets: [
            //             {
            //                 label: "Approved",
            //                 data: approvedCounts,
            //                 backgroundColor: "rgba(75, 192, 192, 0.2)", // Area under the line
            //                 borderColor: "rgba(75, 192, 192, 1)", // Line color
            //                 borderWidth: 2,
            //                 tension: 0.3, // Smoothing of the line
            //                 fill: true, // Fill the area under the line
            //             },
            //             {
            //                 label: "Rejected",
            //                 data: rejectedCounts,
            //                 backgroundColor: "rgba(255, 99, 132, 0.2)", // Area under the line
            //                 borderColor: "rgba(255, 99, 132, 1)", // Line color
            //                 borderWidth: 2,
            //                 tension: 0.3, // Smoothing of the line
            //                 fill: true, // Fill the area under the line
            //             },
            //         ],
            //     },
            //     options: {
            //         responsive: true, // Responsive design
            //         plugins: {
            //             legend: {
            //                 position: "top", // Position of the legend
            //             },
            //             tooltip: {
            //                 enabled: true, // Enable tooltips
            //             },
            //         },
            //         scales: {
            //             x: {
            //                 beginAtZero: false, // Don't force x-axis to start at 0
            //             },
            //             y: {
            //                 beginAtZero: true, // Start y-axis at 0
            //             },
            //         },
            //     },
            // });
    
        
        const generateFullDistrictData = (startYear, endYear) => {
            // const years = [2020, 2021, 2022];
            const districts = ["District 3", "District 4"];
            const fullDistrictData = [];
        
            // years.forEach((year) => {
            for (let year = startYear; year <= endYear; year++) {
                for (let month = 1; month <= 12; month++) {
                    districts.forEach((district) => {
                        fullDistrictData.push({
                            year: year,
                            month: month,
                            district: district,
                            laguna_tall: Math.floor(Math.random() * 21), // Random value between 0–20
                            dwarf_coconut: Math.floor(Math.random() * 11),    // Random value between 0–10
                            hybrid: Math.floor(Math.random() * 16), // Random value between 0–15
                        });
                    });
                }
            }
            // });
        
            return fullDistrictData;
        };

        const districtData = generateFullDistrictData(2020, currentYear);
        const district3Checkbox = document.getElementById("district3Filter");
        const district4Checkbox = document.getElementById("district4Filter");
              
        function generateCocoData(startYear, endYear) {
            const data = [];
            for (let year = startYear; year <= endYear; year++) {
                for (let month = 1; month <= 12; month++) {
                    data.push({
                        year: year,
                        month: month,
                        laguna_tall: Math.floor(Math.random() * 50) + 1, // Random value between 1-50
                        dwarf_coconut: Math.floor(Math.random() * 30) + 1, // Random value between 1-30
                        hybrid: Math.floor(Math.random() * 40) + 1, // Random value between 1-40
                    });
                }
            }
            return data;
        }
            
        const sample_data = generateCocoData(2020, currentYear);
        // console.log(sample_data);

        function getYearlyData(data) {
            const yearlyData = [];
            const yearlyTotals = {};
    
            // Sum all monthly values for each year
            data.forEach((item) => {
                if (!yearlyTotals[item.year]) {
                    yearlyTotals[item.year] = { laguna_tall: 0, dwarf_coconut: 0, hybrid: 0 };
                }
                yearlyTotals[item.year].laguna_tall += item.laguna_tall;
                yearlyTotals[item.year].dwarf_coconut += item.dwarf_coconut;
                yearlyTotals[item.year].hybrid += item.hybrid;
            });
    
            for (const year in yearlyTotals) {
                yearlyData.push({
                    year: parseInt(year),
                    laguna_tall: yearlyTotals[year].laguna_tall,
                    dwarf_coconut: yearlyTotals[year].dwarf_coconut,
                    hybrid: yearlyTotals[year].hybrid,
                });
            }
    
            return yearlyData;
        } 

        // // Populate the dropdown with years (2010 to 2024)
        // const cocoYearSelect = document.getElementById('cocoYearSelect');
        // for (let year = 2020; year <= 2024; year++) {
        //     const option = document.createElement("option");
        //     option.value = year;
        //     option.textContent = year;
        //     cocoYearSelect.appendChild(option);
        // }


        // // Reverse the order of options
        // const options = Array.from(cocoYearSelect.options).slice(1);
        // cocoYearSelect.innerHTML = ""; 
        // options.reverse().forEach((option) => cocoYearSelect.appendChild(option)); // Append in reverse order

    
        function updateChart(displayYearly, displayMonthly, selectedYear) {

            let labels = [];
            let lagunaTallData = [];
            let dwarfCoconutData = [];
            let hybridData = [];

            const filteredAll = selectedYear === "all" 
            ? sample_data 
            : sample_data.filter(item => item.year === parseInt(selectedYear));
           
            let fildis = selectedYear === "all"
                ? districtData
                : districtData.filter((item) => item.year === parseInt(selectedYear)); // Use the integer value for comparison
            
            const filteredDistrict = fildis.filter((item) => {
                const isDistrict3Checked = district3Checkbox.checked && item.district === "District 3";
                const isDistrict4Checked = district4Checkbox.checked && item.district === "District 4";
            
                return isDistrict3Checked || isDistrict4Checked;
            });


            if (displayYearly) {
                const yearlyData = getYearlyData(filteredAll);
                yearlyData.forEach((item) => {
                    labels.push(item.year.toString()); 
                    lagunaTallData.push(item.laguna_tall);
                    dwarfCoconutData.push(item.dwarf_coconut);
                    hybridData.push(item.hybrid);
                });

                if ($("#district3Filter").is(":checked") || $("#district4Filter").is(":checked") ) {

                    const yrs = [...new Set(filteredDistrict.map((item) => item.year))];
                    labels = [...yrs];
                    lagunaTallData = yrs.map((year) =>
                        filteredDistrict 
                            .filter((item) => item.year === year)
                            .reduce((sum, item) => sum + item.laguna_tall, 0)
                    );
                    dwarfCoconutData = yrs.map((year) =>
                        filteredDistrict
                            .filter((item) => item.year === year)
                            .reduce((sum, item) => sum + item.dwarf_coconut, 0)
                    );
                    hybridData = yrs.map((year) =>
                        filteredDistrict
                            .filter((item) => item.year === year)
                            .reduce((sum, item) => sum + item.hybrid, 0)
                    );

               }
            }

            if (displayMonthly) {
                filteredAll.slice(0, 12).forEach((item) => {
                    labels.push(`${item.year}-${String(item.month).padStart(2, "0")}`);
                    lagunaTallData.push(item.laguna_tall);
                    dwarfCoconutData.push(item.dwarf_coconut);
                    hybridData.push(item.hybrid);
                });

                if ($("#district3Filter").is(":checked") || $("#district4Filter").is(":checked") ) { 
                 
                    const uniqueMonths = [...new Set(filteredDistrict.map((item) => `${item.year}-${String(item.month).padStart(2, "0")}`))].slice(0, 12);
                    labels = [...uniqueMonths];
            
                    lagunaTallData = uniqueMonths.map((label) => {
                        const [year, month] = label.split("-");
                        return filteredDistrict
                            .filter((item) => item.year == year && item.month == month)
                            .reduce((sum, item) => sum + item.laguna_tall, 0);
                    });
            
                    dwarfCoconutData = uniqueMonths.map((label) => {
                        const [year, month] = label.split("-");
                        return filteredDistrict
                            .filter((item) => item.year == year && item.month == month)
                            .reduce((sum, item) => sum + item.dwarf_coconut, 0);
                    });
            
                    hybridData = uniqueMonths.map((label) => {
                        const [year, month] = label.split("-");
                        return filteredDistrict
                            .filter((item) => item.year == year && item.month == month)
                            .reduce((sum, item) => sum + item.hybrid, 0);
                    });
                }


            }
            if (coconut_chart) {
                coconut_chart.destroy();
            }
            const ctx = $("#coconut_chart")[0].getContext("2d");
            coconut_chart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: labels, // X-axis labels
                    datasets: [
                        {
                            label: "Laguna Tall",
                            data: lagunaTallData,
                            backgroundColor: "rgba(255, 206, 86, 0.6)",
                            borderColor: "rgba(255, 206, 86, 1)",
                            borderWidth: 2,
                            tension: 0.3, // Smoothing of the line
                            fill: false, // Fill the area under the line
                        },
                        {
                            label: "Dwarf Coconut",
                            data: dwarfCoconutData,
                            backgroundColor: "rgba(75, 192, 192, 0.6)",
                            borderColor: "rgba(75, 192, 192, 1)",
                            borderWidth: 2,
                            tension: 0.3, // Smoothing of the line
                            fill: false, // Fill the area under the line
                        },
                        {
                            label: "Hybrid",
                            data: hybridData,
                            backgroundColor: "rgba(153, 102, 255, 0.6)",
                            borderColor: "rgba(153, 102, 255, 1)",
                            borderWidth: 2,
                            tension: 0.3, // Smoothing of the line
                            fill: false, // Fill the area under the line
                        },
                    ],
                },
                options: {
                    responsive: true, // Responsive design
                    plugins: {
                        legend: {
                            position: "top", // Position of the legend
                        },
                        tooltip: {
                            enabled: true, // Enable tooltips
                        },
                    },
                    scales: {
                        x: {
                            beginAtZero: false, // Don't force x-axis to start at 0
                        },
                        y: {
                            beginAtZero: true, // Start y-axis at 0
                        },
                    },
                },
            });

        }


        // Initial chart render with all data
        updateChart(true, true, 'all');

        
        // Event Listener for Year Selection
        document.getElementById("cocoYearSelect").addEventListener("change", (event) => {
            const selectedYear = event.target.value; // Get the selected year from dropdown
            if ($("#monthlyFilter").prop("checked", true)) {
                $("#yearlyFilter").prop("checked", false)
                updateChart(false, true, selectedYear);
            }  
        });

    
        // Event Listeners for Checkboxes
        document.getElementById("monthlyFilter").addEventListener("change", (event) => {
            if (event.target.checked) {
                $("#yearlyFilter").prop("checked", false);   
                updateChart(false, true, $("#cocoYearSelect").val());
            } 
            else {
                $("#district3Filter").prop("checked", false);
                $("#district4Filter").prop("checked", false);
                updateChart(true, true, 'all'); 
            }
        });

        document.getElementById("yearlyFilter").addEventListener("change", (event) => {
            if (event.target.checked) {
                $("#monthlyFilter").prop("checked", false); 
                updateChart(true, false, 'all'); 
            } 
            else {
                $("#district3Filter").prop("checked", false);
                $("#district4Filter").prop("checked", false);
                updateChart(true, true, 'all'); 
            }
        });

             // For Districts Filter
        // Add event listeners to checkboxes
        district3Checkbox.addEventListener("change", (event) => {
            $("#district4Filter").prop("checked", false); 
            if (event.target.checked && $("#yearlyFilter").is(":checked")) {  
                updateChart(true, false, 'all'); 
            }
            if (event.target.checked &&  $("#monthlyFilter").is(":checked")) {
                updateChart(false, true, $("#cocoYearSelect").val()); 
            }else {
                if ($("#yearlyFilter").is(":checked")) {
                    updateChart(true, false, 'all'); 
                }
                else if ($("#monthlyFilter").is(":checked")) {
                    updateChart(false, true, $("#cocoYearSelect").val()); 
                }
              
            }

        });

        district4Checkbox.addEventListener("change", (event) => {
            $("#district3Filter").prop("checked", false); 
            if (event.target.checked && $("#yearlyFilter").is(":checked")) {  
                updateChart(true, false, 'all'); 
            }
            if (event.target.checked &&  $("#monthlyFilter").is(":checked")) {
                updateChart(false, true, $("#cocoYearSelect").val()); 
            }else {
                if ($("#yearlyFilter").is(":checked")) {
                    updateChart(true, false, 'all'); 
                }
                else if ($("#monthlyFilter").is(":checked")) {
                    updateChart(false, true, $("#cocoYearSelect").val()); 
                }
              
            }
            
        });
  


    },});
}

 
 