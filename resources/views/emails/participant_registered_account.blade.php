<!DOCTYPE html>
<html>

<head>
    <title>Welcome to the Learning BOTC</title>
</head>

<body>
    <h1>Welcome to the Learning Website</h1>
    <p>Dear {{ $employed->name }},</p>
    <p>You have been registered to our learning website. Here are your login details:</p>
    <ul>
        <li>Email: {{ $employed->email }}</li>
        <li>Password: {{ $password }}</li>
    </ul>
    <p>You can login at <a href="{{ env('LEARNING_WEBSITE_URL') }}">{{ env('LEARNING_WEBSITE_URL') }}</a>.</p>
    <p>Thank you for joining us!</p>
</body>

</html>
