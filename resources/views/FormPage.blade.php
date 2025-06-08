@extends('layouts.master')
@section('content')
    <form id="RegisterForm" action="{{ route('accounts.store') }}" method="post" >
            @csrf
            <div class="form">
                <label><i class="fas fa-user-tag"></i> Full Name</label>
                <input type="text" name="full_name" required placeholder="John Doe">
                 <span id="error-full_name" class="invalid-feedback"></span>
            </div>
            
            <div class="form">
                <label><i class="fas fa-user-circle"></i> Username</label>
                <input type="text" name="username" required placeholder="johndoe123">
                <span id="error-username" class="invalid-feedback"></span>
            </div>
            
            <div class="form">
                <label><i class="fas fa-mobile-alt"></i> Phone Number</label>
                <input type="tel" name="phone" required placeholder="010 234 567 89">
                <span id="error-phone"></span>
            </div>
            
            <div class="form">
                <label><i class="fab fa-whatsapp"></i> WhatsApp Number</label>
                <input type="tel" name="whatsapp_number" id="whatsapp_number" placeholder="010 234 567 89">
                <input type="button" value="check" onclick="validateWhatsNumber()" id="check_whatsapp_number" dusk="whatsapp-check-button">
                <span id="error-whatsapp_number" ></span>
                <div id="isCheck"></div>
            </div>
            <div class="form">
                <label><i class="fas fa-map-marker-alt"></i> Address</label>
                <input type="text" name="address" required placeholder="123 Main Street">
            </div>
            <div class="form">
                <label><i class="fas fa-envelope"></i> E-mail</label>
                <input type="email" name="email" required placeholder="john@example.com">
                <span id="error-email" class="invalid-feedback"></span>
            </div>
            <div class="form">
                <label><i class="fas fa-lock"></i> Password</label>
                <input type="password" name="password" required placeholder="••••••••">
                <span id="error-password" ></span>
                <div class="password-notice">
                    <ul>
                        <li>at least 8 characters with at least 1 number literal and 1 special
                        character</li>
                    </ul>
                </div>
            </div>
            <div class="form">
                <label><i class="fas fa-lock"></i> Confirm Password</label>
                <input type="password" name="confirm_password" required placeholder="••••••••">  
                <span id="error-confirm_password" ></span>             
            </div>
            <div class="mb-3">
                <label for="formFileSm" class="form-label">
                <i class="bi bi-camera-fill"></i> Personal Photo</label>
                <input class="form-control form-control-sm" id="formFileSm" name="photo" type="file">
            </div>
            <div class="form">
                <button type="button" name="Submit" onclick="register()">
                    <i class="fas fa-rocket"></i> Launch Your Account
                </button>
            </div>
        </form>
@endsection