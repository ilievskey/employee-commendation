$('#commendationForm').on('submit', function (e){
    e.preventDefault();

    $.ajax({
        url: 'vote_logic.php',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (response){
            if(response.success){
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                }).then(() => {
                    window.location.href = 'index.php';
                });
            } else{
                Swal.fire({
                    icon: 'error',
                    title: 'Whoops!',
                    text: response.message,
                });
            }
        },
        error: function (){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Catastrophic error. Try again later',
            });
        }
    });
});

$('#loginForm').on('submit', function (e) {
    e.preventDefault();

    $('#formError').text('');

    $.ajax({
        url: 'login_logic.php',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                window.location.href = 'index.php';
            } else {
                $('#formError').text(response.message);
            }
        },
        error: function () {
            $('#formError').text('Form error. Please try again later.');
        }
    });
});