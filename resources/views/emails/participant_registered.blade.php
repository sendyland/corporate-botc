<!DOCTYPE html>
<html>

<head>
    <title>Course Registration</title>
</head>

<body>
    <h1>You have been registered for a course</h1>
    <p>Dear {{ $participant->name }},</p>
    <p>You have been registered for the course <strong>{{ $course->title }}</strong>. Here are the details:</p>
    <ul>
        <li>Course: {{ $course->title }}</li>
        <li>Price: {{ formatRupiah($course->price) }}</li>
        <li>Company: {{ $course->courseRegistration->user->name }}</li>
        <li>PIC: {{ $course->courseRegistration->user->namepic }}</li>
        <li>Created At: {{ $course->courseRegistration->created_at }}</li>
    </ul>
    <p>Thank you for your participation.</p>
</body>

</html>
