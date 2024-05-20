@extends('layouts.app', [
    'class' => 'login-page',
    'backgroundImagePath' => 'img/registerbg.jpg'
])

@section('content')
    <div class="content">
        <div class="container">
            <div class="col-lg-4 col-md-6 ml-auto mr-auto">
            <form id="login-form" class="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card card-login">
                        <div class="card-header ">
                            <div class="card-header ">
                                <h3 class="header text-center">{{ __('Login') }}</h3>
                            </div>
                        </div>
                        <div class="card-body ">

                        <div id="g_id_onload"
                                    data-client_id="{{env('GOOGLE_CLIENT_ID')}}"
                                    data-callback="onSignIn">
                                </div>
                                <div class="g_id_signin form-control" data-type="standard"></div>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-single-02"></i>
                                    </span>
                                </div>

                                <input id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required autofocus>
                                
                                <div id="email-error" class="invalid-feedback" style="display: none;" role="alert">
                                    <strong></strong>
                                </div>
                            </div>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-single-02"></i>
                                    </span>
                                </div>
                                <input id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password" required>
                                
                                
                                <div id="password-error" class="invalid-feedback" style="display: none;" role="alert">
                                    <strong></strong>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                     <label class="form-check-label">
                                        <input class="form-check-input" name="remember" type="checkbox" value="" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="form-check-sign"></span>
                                        {{ __('Remember me') }}
                                    </label>
                                </div>
                            </div>

                            <div id="form-message" style="display: none;"></div>
                        </div>

                        <div class="card-footer">
                            <div class="text-center">
                                <button type="submit" id="SignBtn" class="btn btn-warning btn-round mb-3">{{ __('Sign in') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
                <a href="{{ route('password.request') }}" class="btn btn-link">
                    {{ __('Forgot password') }}
                </a>
                <a href="{{ route('register') }}" class="btn btn-link float-right">
                    {{ __('Create Account') }}
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('public/paper/js/login.js') }}"></script>
@endpush

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script src="{{ asset('paper/js/login.js') }}"></script> -->
<script src="https://accounts.google.com/gsi/client" async defer></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>



<script>
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
    function decodeJwtResponse(token){
        let base64URL = token.split('.')[1]
        let base64 = base64URL.replace(/-/g, '+').replace(/_/g, '/');
        let jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c){
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
        return JSON.parse(jsonPayload)
    }

    window.onSignIn = googleUser =>{
        var user = decodeJwtResponse(googleUser.credential);
        if(user){
            $.ajax({
                url: 'google/login',
                method: 'post',
                data: {email : user.email},
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                beforeSend:function(){
                    $("#SignBtn").text("Redirecting...");
                    $("#SignBtn").prop("disabled", true);
                },
                success:function(response){
                    $("#SignBtn").text("Sign In");
                    $("#SignBtn").prop("disabled", false);

                    if(response.status === 'success'){
                        window.location.href = 'home';
                    }else{
                        showAlert(response.message, 'danger');
                    }
                },
                error:function(xhr, status, error){
                    showAlert(xhr.responseJSON.message, 'danger');
                }
            });

        }else{
            $('#message').text('An error occured. Please try again later.');
        }
    }

    $(document).ready(function(){
    $('#login-form').submit(function(event){
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            beforeSend:function(){
                $("#SignBtn").text("Signing in...");
                $("#SignBtn").prop("disabled", true);    
            },
            success:function(response){
                $("#SignBtn").text("Sign In");
                $("#SignBtn").prop("disabled", false);

                if(response.status === 'success'){
                    window.location.href = response.redirect_url;
                } else {
                    showAlert(response.message, 'danger');
                }
            },
            error: function(xhr, status, error){
                $("#SignBtn").text("Sign In");
                $("#SignBtn").prop("disabled", false);

                if (xhr.status === 429) {
                    var retryAfter = xhr.responseJSON.retry_after;
                    showAlert('Too many login attempts. Please try again in ' + retryAfter + ' seconds.', 'danger');
                } else {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value){
                        $("#" + key + "-error").html('<strong>' + value + '</strong>').show();
                    });

                    showAlert(xhr.responseJSON.message, 'danger');
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



</script>