$(document).ready(function () {
  let url = '';
  if (window.userType === '0') {
      url = '/admin/get_dashboard_info';
  } 
  else if (window.userType === '1') {
      url = '/admin-midwife/get_dashboard_info';
  }
  $.ajax({
    method: "GET",
    url: url,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (res) {
      brgyData(res); 
    }
  });

});

async function brgyData(res) {
  const brgys = [...res.brgys];
  function totalSum(){
    $('#total_population').text(res.residents.population);
    $('#total_maternal').text(res.residents.women);
    $('#total_deworming').text(res.residents.child);
  }
  totalSum();
  document.getElementById("location").addEventListener("change", (event) => {
      const selectedName = event.target.value; 
      const foundBrgy = brgys.find(brgy => brgy.name === selectedName);
      if (selectedName === 'All Barangays') {
        totalSum();
      }
      else if (selectedName) {
        if (foundBrgy.name === selectedName) {
          $('#total_population').text(foundBrgy.population);
          $('#total_maternal').text(foundBrgy.women);
          $('#total_deworming').text(foundBrgy.child);
        }
      }
  });
}







