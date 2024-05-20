$(document).ready(function(){
    $('#login-form').submit(function(event){
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '/login',
            type: 'POST',
            data: formData,
            success: function(response){
                if(response.status === 'success'){
                    showAlert("Login Successfully!", 'success'); 
                    window.location.href = 'home';
                } else {
                    showAlert("Invalid username or password.", 'danger');
                }
            },
            error: function(xhr, textStatus, errorThrown){
                if(xhr.status == 429){
                    $('#message').html('Too many login attempts. Please try again after 60 seconds.');
                }else{
                    $('#message').html('An error occurred. Please try again later.');
                }
            }
        });
    });
});

function showAlert(message, type) {
    var alertHtml = '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
                    message +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    '</div>';
    $('#form-message').html(alertHtml).show();
}






// $(document).ready(function(){
//     $('#login-form').submit(function(event){
//         event.preventDefault();
//         var formData = $(this).serialize();
//         $.ajax({
//             url: $(this).attr('action'),
//             type: 'POST',
//             data: formData,
//             success: function(response){
//                 $('#form-message').text(response.message);
//                 if (response.message === 'Login successful') {
//                     window.location.href = '/home';
//                 } 
//             },
//             error: function(xhr, status, error){
//                 var errors = xhr.responseJSON.errors;
//                 if (errors){
//                     if (errors.email){
//                         $('#email-error').html('<strong>' + errors.email[0] + '</strong>').show();
//                     } else {
//                         $('#email-error').hide();
//                     }
//                     if (errors.password) {
//                         $('#password-error').html('<strong>' + errors.password[0] + '</strong>').show();
//                     } else {
//                         $('#password-error').hide();
//                     }
//                 }
//             }
//         });
//     });
// });


// $(document).ready(function(){
//     $('#login-form').submit(function(event){
//         event.preventDefault();
//         var formData = $(this).serialize();
//         $.ajax({
//             url: $(this).attr('action'),
//             type: 'POST',
//             data: formData,
//             success: function(response){
//                 if(response.status === 'success'){
//                     alert("Login Successfully!");
//                     window.location.href = 'home';
//                 }else{
//                     alert(response.message);
//                 }
//             },
//             error: function(xhr, status, error){
//                 var errors = xhr.responseJSON.errors;
//                 $.each(errors, function(key, value){
//                     // $("#" + key + "-error").html('<strong>' + value + '</strong>').show();
//                 });
//             }
//         });
//     });
// });


// $(document).ready(function(){
//     $('#login-form').submit(function(event){
//         event.preventDefault();
//         var formData = $(this).serialize();
//         $.ajax({
//             url: $(this).attr('action'),
//             type: 'POST',
//             data: formData,
//             success: function(response){
//                 if(response.status === 'success'){
//                     alert("Login Successfully!");
//                     window.location.href = 'home';
//                 }else{
//                     alert(response.message);
//                 }
//             },
//             error: function(xhr, status, error){
//                 var errors = xhr.responseJSON.errors;
//                 $.each(errors, function(key, value){
//                     // $("#" + key + "-error").html('<strong>' + value + '</strong>').show();
//                 });

//                 $('#form-message').html('<div class="alert alert-danger" role="alert">' + xhr.responseJSON.message + '</div>').show();
//             }
//         });
//     });
// });

// $(document).ready(function(){
//     $('#login-form').submit(function(event){
//         event.preventDefault();
//         var formData = $(this).serialize();
//         $.ajax({
//             url: '/login',
//             type: 'POST',
//             data: formData,
//             success: function(response){
//                 if(response.status === 'success'){
//                     alert("Login Successfully!");
//                     window.location.href = 'home';
//                 }else{
//                     alert("Invalid user password");
//                 }
//             },
//             error: function(xhr, textStatus, errorThrown){
//                 if(xhr.status == 429){
//                     $('#form-message').html('Too many login attempts. Please try again after 60 seconds.');
//                 }else{
//                     $('#form-message').html('An error occured. Please try again later.');
//                 }
//             }
//         });
//     });
// });
















// function decodeJwtResponse(token){
//     let base64URL = token.split('.')[1]
//     let base64 = base64URL.replace(/-/g, '+').replace(/_/g, '/');
//     let jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c){
//         return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
//     }).join(''));
//     return JSON.parse(jsonPayload)
// }
// $.ajaxSetup({
//     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
// });

// window.onSignIn = googleUser =>{
//     var user = decodeJwtResponse(googleUser.credential);
//     if(user){
//         $.ajax({
//             url: 'google/login',
//             method: 'post',
//             data: {email : user.email},
//             beforeSend:function(){},
//             success:function(response){
//                 alert("Success!");
//                 window.location.href = '/home';
//             },
//             error:function(xhr, status, error){
//                 alert(xhr.responseJSON.message);
//             }
//         });

//     }else{
//         $('#message').text('An error occured. Please try again later.');
//     }
// }


