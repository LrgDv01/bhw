$(document).on('click', '#confirmHireButton', function () {
    // const technicianName = $('#hire').text();
    const technicianId = $('#technicianId').val();
    $.ajax({
        url: '/user/hire-technician',
        method: 'POST',
        data: {
            technician_id: technicianId,
            // technician_name: technicianName
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        success: function (response) {
            console.log("response >>>", response);
            if (response.success) {
                $('#hireTechnicianModal').modal('hide');
                $('.modal-backdrop').remove(); 
                $('body').removeClass('modal-open'); 
                location.reload();
            }
        },
        error: function (xhr, status, error) {
            const response = JSON.parse(xhr.responseText);
            console.error('Error:', response);
            alert('Failed to hire the technician. Please try again.');
        }
    });
});


