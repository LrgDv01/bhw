$(document).ready(function () {
  $('#feedback_table').DataTable({
    processing: true,
    ajax: '/admin/getfeedback', // Your route for fetching feedback data
    columns: [
        { data: 'users.name', name: 'users.name' },  // Assuming feedback model has 'users' relation
        { data: 'reaction', name: 'reaction', render: function(data) { 
                return data === 'happy' ? '😊 Happy' : data === 'neutral' ? '😐 Neutral' : '😞 Sad'; 
            } 
        },
        { data: 'comment', name: 'comment' },
        { data: 'created_at', name: 'created_at', render: function(data) {
                return new Date(data).toLocaleDateString(); // Format as date
            } 
        },
        { data: 'created_at', name: 'created_at', render: function(data) {
                return new Date(data).toLocaleTimeString(); // Format as time
            } 
        }
    ]
});
});