$(document).ready(function () {

    $('#signup').validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            email: {
                required: true,
                email: true,
               
            },
            phone: {
                required: true,
                maxlength: 20
            },
            password: {
                required: true,
                minlength: 8
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
            phone: {
                required: 'The phone field is required.',
                maxlength: 'The phone number may not be greater than 20 characters.'
            },
            password: {
                required: 'The password field is required.',
                minlength: 'The password must be at least 8 characters.'
            }
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
          

            var form_data = new FormData($('#signup')[0]);

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
                    $('#message').text('Email Id cant be unique');
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
            $(document).Toasts('create', {
                title: 'Success',
                subtitle: 'Email sent',
                body: sessionMessage,
                autohide: false,
                class: 'bg-success',
                delay: 10000
            });
            // Clear session message after displaying it
            sessionStorage.removeItem('message');
        });
    }

});