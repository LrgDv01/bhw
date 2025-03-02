
export function yearFilter() {
    const currentYear = new Date().getFullYear();
    const yearSelect = document.getElementById('yearSelect');
    if (yearSelect) {
        yearSelect.innerHTML = "";
        for (let year = currentYear; year >= 1990; year--) {
            const option = document.createElement("option");
            option.value = year;
            option.textContent = year;
            if (year === currentYear) {
                option.selected = true; 
            }
            yearSelect.appendChild(option);
        }
    }
    return yearSelect;
}

