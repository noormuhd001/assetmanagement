$(document).ready(function () {

    $('#adminreply').validate({
        rules: {
          
            message: {
                required: true,
             
            },
       
        },
        messages: {
        
            message: {
                required: 'The message field is required.',
               
            },
       
        },
        errorClass: "is-invalid text-danger",
        errorPlacement: function (error, element) {
            error.appendTo(element.closest(".form-group"));
        },

        ignore: ' ',
        submitHandler: function (form) {

            var submitBtn = $('#submitBtn');
            submitBtn.prop('disabled', true);
            submitBtn.addClass('d-none');
          

            var form_data = new FormData($('#adminreply')[0]);

            $.ajax({
                type: "POST",
                url: LOGIN_ROUTE,
                dataType: 'JSON',
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    if (result.data == true) {
                       
                        var message = result.message;
                        // Set session message
                        sessionStorage.setItem('message', message);
                        location.href =  result.route;
                    } else {
                        $('#customAlert').removeClass('d-none');
                        $('#message').text('error');
                    }
                },
                error: function (xhr, status, error) {
                    submitBtn.prop('disabled', false);
                    $('#loginSpinner').addClass('d-none');
                    // submitBtn.text('Login');
                    submitBtn.removeClass('d-none');

                    $('#customAlert').removeClass('d-none');
                    $('#messageerror').text('error found');
                }
            })

        }
    });

    $('.btn-close').click(function (){
        $('#customAlert').addClass('d-none');
    });

    var sessionMessage = sessionStorage.getItem('message');
    if (sessionMessage) {
        $(document).ready(function() {
            Swal.fire({
                title: 'Success',
                text: sessionMessage,
                icon: 'success',
                confirmButtonText: 'OK'
            });
            // Clear session message after displaying it
            sessionStorage.removeItem('message');
        });
    }

});