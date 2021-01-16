$('document').ready(function () {

    $('#loginForm').submit(function () {
        $.ajax({
            type: "POST",
            url: "utilities.php",
            data: $(this).serialize(),
            beforeSend: function (){
                $('#submitButton').empty();
                $('#submitButton').append(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`)
            },
            success: function (response) {
                response = jQuery.parseJSON(response);
                if (response.responseCode === 0) {
                    $(location).attr('href', 'home/');
                } else if (response.responseCode === 15){
                    $('#responseMessage').empty();
                    $('#responseMessage').append(`
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" id="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Welcome!</h5>
                        ${response.responseMessage}
                    </div>
                    `);
                    $('#responseMessage').slideDown('slow');
                    $('#btn-control').empty().append(`<a href="change_password/" type="button" class="btn btn-block btn-success btn-sm">Reset Password</a>`);
                    localStorage.setItem('email', response.email);
                }else {
                    $('#responseMessage').empty();
                    $('#responseMessage').append(`
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" id="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        ${response.responseMessage}
                    </div>
                    `);
                    $('#submitButton').empty();
                    $('#submitButton').text('Sign In');
                    $('#responseMessage').slideDown('slow');
                }
            }
        });
    });

    $('#addNurse').on('submit', function (e){
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "utilities.php",
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function (){
                $('#addNurseButton').empty();
                $('#addNurseButton').append(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Please wait ...`)
            },
            success: function (response) {
                response = JSON.parse(response);
                if (response.responseCode === 0){
                    $('#smartwizard').prepend(
                        `<div class="alert alert-success text-center font-weight-bold " role="alert">
                            ${response.responseMessage}
                        </div>`
                    );
                    $('#addNurse').trigger('reset');
                    setTimeout(() => {
                        location.reload();
                    }, 3000)
                }else {
                    // $('#smartwizard').find('.alert-danger').remove();
                    $('#smartwizard').prepend(
                        `<div class="alert alert-danger text-center font-weight-bold " role="alert">
                            ${response.responseMessage}
                        </div>`
                    );
                }
            }
        });
    });

    $('#resetPasswordForm').submit(function (){
        $('#email').val(localStorage.getItem('email'));
        $.ajax({
            type: "POST",
            url: "utilities.php",
            data: $(this).serialize(),
            beforeSend: function (){
                $('#resetPassword').empty();
                $('#resetPassword').append(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`);
            },
            success: function (response) {
                response = JSON.parse(response);
                if (response.responseCode === 0){
                    $('#responseMessage').empty();
                    $('#responseMessage').append(`
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" id="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Success!</h5>
                        ${response.responseMessage}
                    </div>
                    `);
                    $('#resetPassword').empty();
                    $('#resetPassword').text('Reset');
                    $('#responseMessage').slideDown('slow');
                    localStorage.removeItem('email');
                    setTimeout(() => {
                        window.location.href = 'index/';
                    }, 3000)
                }else {
                    $('#responseMessage').empty();
                    $('#responseMessage').append(`
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" id="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        ${response.responseMessage}
                    </div>
                    `);
                    $('#resetPassword').empty();
                    $('#resetPassword').text('Reset');
                    $('#responseMessage').slideDown('slow');
                }
            }
        });
    });

    $('#personalInfo').submit(function (e){
        e.preventDefault();
        const form = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "utilities.php",
            data: form,
            dataType: 'json',
            beforeSend: function (){
                $('#submit1').empty();
                $('#submit1').append(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please wait ...`)
            },
            success: function (response) {
                // console.log(response);
                // response = jQuery.parseJSON(response);
                $('#submit1').empty();
                $('#submit1').append('<i class="fa fa-save"></i><span>SUBMIT</span>');
                if (response.responseCode === 0){
                    $('#responseMessage').append();
                    $('#responseMessage').append(`
                        <div class="alert alert-success text-center font-weight-bolds" role="alert">
                            ${response.responseMessage}
                        </div>`);
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }else {
                    // $('#smartwizard').find('.alert-danger').remove();
                    $('#responseMessage').empty();
                    $('#responseMessage').append(
                        `<div class="alert alert-danger text-center font-weight-bold " role="alert">
                            ${response.responseMessage}
                        </div>`
                    );
                }
            }
        });
    });

    $('#academicQualificationForm').on('submit', function (e){
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "utilities.php",
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function (){
                $('#submit2').empty();
                $('#submit2').append(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Please wait ...`)
            },
            success: function (response) {
                // response = JSON.parse(response);
                $('#responseMessage').empty();
                $('#submit2').empty();
                $('#submit2').append('<i class="fa fa-save"></i><span>SUBMIT</span>');
                if (response.responseCode === 0){
                    $('#responseMessage').append(
                        `<div class="alert alert-success text-center font-weight-bold " role="alert">
                            ${response.responseMessage}
                        </div>`
                    );
                    setTimeout(() => {
                        location.reload();
                    }, 2000)
                }else {
                    // $('#smartwizard').find('.alert-danger').remove();
                    $('#responseMessage').append(
                        `<div class="alert alert-danger text-center font-weight-bold " role="alert">
                            ${response.responseMessage}
                        </div>`
                    );
                }
            }
        });
    });
    $('#jobInfoForm').on('submit', function (e){
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "utilities.php",
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function (){
                $('#submit3').empty();
                $('#submit3').append(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please wait ...`)
            },
            success: function (response) {
                // response = JSON.parse(response);
                $('#responseMessage').empty();
                $('#submit3').empty();
                $('#submit3').append('<i class="fa fa-save"></i><span>SUBMIT</span>');
                if (response.responseCode === 0){
                    $('#responseMessage').append(
                        `<div class="alert alert-success text-center font-weight-bold " role="alert">
                            ${response.responseMessage}
                        </div>`
                    );
                    setTimeout(() => {
                        location.reload();
                    }, 2000)
                }else {
                    // $('#smartwizard').find('.alert-danger').remove();
                    $('#responseMessage').append(
                        `<div class="alert alert-danger text-center font-weight-bold " role="alert">
                            ${response.responseMessage}
                        </div>`
                    );
                }
            }
        });
    });

    $('#bankDetails').submit(function (e){
        e.preventDefault();
        const form = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "utilities.php",
            data: form,
            dataType: 'json',
            beforeSend: function (){
                $('#submit4').empty();
                $('#submit4').append(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please wait ...`)
            },
            success: function (response) {
                // console.log(response);
                // response = jQuery.parseJSON(response);
                $('#submit4').empty();
                $('#submit4').append('<i class="fa fa-save"></i><span>SUBMIT</span>');
                if (response.responseCode === 0){
                    $('#responseMessage').append();
                    $('#responseMessage').append(`
                        <div class="alert alert-success text-center font-weight-bolds" role="alert">
                            ${response.responseMessage}
                        </div>`);
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }else {
                    // $('#smartwizard').find('.alert-danger').remove();
                    $('#responseMessage').empty();
                    $('#responseMessage').append(
                        `<div class="alert alert-danger text-center font-weight-bold " role="alert">
                            ${response.responseMessage}
                        </div>`
                    );
                }
            }
        });
    });
   
});