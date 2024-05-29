$(document).ready(function () {

    $('#editasset').validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            category: {
                required: true,
              
               
            },
            model: {
                required: true,
                maxlength: 40
            },
          
        },
        messages: {
            name: {
                required: 'The category name field is required.',
                maxlength: 'The name may not be greater than 255 characters.'
            },
            category: {
                required: 'The category field is required.',
               
            },
            model: {
                required: 'The model NO is required.',
                maxlength: 'The model number may not be greater than 40 characters.'
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
          

            var form_data = new FormData($('#editasset')[0]);

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
                        sessionStorage.setItem('success', message);
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
                    $('#message').text('something error');
                }
            })

        }
    });

    $('.btn-close').click(function (){
        $('#customAlert').addClass('d-none');
    });
});