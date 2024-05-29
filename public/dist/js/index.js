$(document).ready(function () {

    $('#login').validate({
        rules: {
            email: {
                required: true,
            },
            password: {
                required: true,
            }
        },
        messages: {
            email: {
                required: "Please enter your Email ID",
            },
            password: {
                required: "Please enter your password.",
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
          

            var form_data = new FormData($('#login')[0]);

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
                        location.href =  result.route;
                    } else {
                        $('#customAlert').removeClass('d-none');
                        $('#message').text('Invalid email or password.');
                    }
                },
                error: function (xhr, status, error) {
                    submitBtn.prop('disabled', false);
                    $('#loginSpinner').addClass('d-none');
                    // submitBtn.text('Login');
                    submitBtn.removeClass('d-none');

                    $('#customAlert').removeClass('d-none');
                    $('#message').text('Invalid email or password.');
                }
            })

        }
    });

    $('.btn-close').click(function (){
        $('#customAlert').addClass('d-none');
    });

});