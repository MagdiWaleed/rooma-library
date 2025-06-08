<!DOCTYPE html>
<html>
<head>
    <title>{{ $data['subject'] ?? 'New Account' }}</title>
</head>
<body>
    <h1>New Account Created</h1>
    
    <p>Hello Admin,</p>
    
    <p>New account has been successfully created with the following details:</p>
    
    <ul>
        <li>Username: {{ $data['username'] }}</li>
        <li>Email: {{ $data['email'] }}</li>
    </ul>
    
    <p>Thank you for Helping!</p>
    
    <p>Best regards,<br>
    {{ config('app.name') }}</p>
</body>
</html>