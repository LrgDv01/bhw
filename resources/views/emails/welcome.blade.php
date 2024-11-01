<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to E-Bisita</title>
</head>
<body>
    <h1>Welcome to E-Bisita</h1>
    <p>Dear {{ $fullname }},</p>
    <p>Welcome to E-Bisita! Your account has been successfully created.</p>
    <p>Your login credentials are:</p>
    <ul>
        <li><strong>Email:</strong> {{ $email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>
    <p>For your authenticated code use : <b>{{ $qr }}</b> </p>
    
    <p>Please keep your password secure and do not share it with anyone.</p>
    <p>If you have any questions or need assistance, feel free to contact us.</p>
    <p>Thank you for joining us!</p>
    <p>Sincerely,</p>
    <p>The E-Bisita Team</p>
</body>
</html>
