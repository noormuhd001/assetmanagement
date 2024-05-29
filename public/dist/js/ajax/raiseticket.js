$(document).ready(function () {

    $('#raiseticket').validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            email: {
                required: true,
                email: true,
               
            },
            message: {
                required: true,
             
            },
            product: {
                required: true,
             
            },
        },
        messages: {
            name: {
                required: 'The name field is required.',
                maxlength: 'The name may not be greater than 255 characters.'
            },
            email: {
                required: 'The email field is required.',
                email: 'The email must be a valid email address.',
                remote: 'The email has already been taken.'
            },
            message: {
                required: 'The message field is required.',
               
            },
          product :{
            required: 'product field iss required',
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
          

            var form_data = new FormData($('#raiseticket')[0]);

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