@extends('layouts.master')
@section('content')
    <form id="RegisterForm" action="" method="post">
            <div class="form">
                <label><i class="fas fa-user-tag"></i> {{ __('formpage.label_full_name') }}</label>
                <input type="text" name="full_name" required placeholder="{{ __('formpage.placeholder_full_name') }}">
            </div>
            
            <div class="form">
                <label><i class="fas fa-user-circle"></i> {{ __('formpage.label_username') }}</label>
                <input type="text" name="username" required placeholder="{{ __('formpage.placeholder_username') }}">
            </div>
            
            <div class="form">
                <label><i class="fas fa-mobile-alt"></i> {{ __('formpage.label_phone') }}</label>
                <input type="tel" name="phone" required placeholder="{{ __('formpage.placeholder_phone') }}">
                <span id="error-phone"></span>
            </div>
            
            <div class="form">
                <label><i class="fab fa-whatsapp"></i> {{ __('formpage.label_whatsapp') }}</label>
                <input type="tel" name="whatsapp_number" id="whatsapp_number" placeholder="{{ __('formpage.placeholder_whatsapp') }}">
                <input type="button" value="{{ __('formpage.button_check_whatsapp') }}" onclick="validateWhatsNumber()">
                <span id="error-whatsapp_number" ></span>
                <div id="isCheck"></div>
            </div>

            <div class="form">
                <label><i class="fas fa-map-marker-alt"></i> {{ __('formpage.label_address') }}</label>
                <input type="text" name="address" required placeholder="{{ __('formpage.placeholder_address') }}">
            </div>

            <div class="form">
                <label><i class="fas fa-envelope"></i> {{ __('formpage.label_email') }}</label>
                <input type="email" name="email" required placeholder="{{ __('formpage.placeholder_email') }}">
                <span id="error-email"></span>
            </div>

            <div class="form">
                <label><i class="fas fa-lock"></i> {{ __('formpage.label_password') }}</label>
                <input type="password" name="password" required placeholder="{{ __('formpage.placeholder_password') }}">
                <span id="error-password" ></span>
                <div class="password-notice">
                    <ul>
                        <li>{{ __('formpage.password_notice') }}</li>
                    </ul>
                </div>
            </div>

            <div class="form">
                <label><i class="fas fa-lock"></i> {{ __('formpage.label_confirm_password') }}</label>
                <input type="password" name="confirm_password" required placeholder="{{ __('formpage.placeholder_confirm_password') }}">  
                <span id="error-confirm_password" ></span>             
            </div>

            <div class="mb-3">
                <label for="formFileSm" class="form-label">
                <i class="bi bi-camera-fill"></i> {{ __('formpage.label_personal_photo') }}</label>
                <input class="form-control form-control-sm" id="formFileSm" name="photo" type="file">
            </div>

            <div class="form">
                <button type="button" onclick="register()">
                    <i class="fas fa-rocket"></i> {{ __('formpage.button_launch_account') }}
                </button>
            </div>
            
        </form>
@endsection