$(document).ready(function() {
    
    // Optional: simple front-end validation
    $('#loginForm').on('submit', function(e) {
        var email = $('input[name="email"]').val().trim();
        var pass = $('input[name="password"]').val().trim();
        if(email === '' || pass === '') {
            alert('Please fill all fields');
            e.preventDefault();
        }
    });
});