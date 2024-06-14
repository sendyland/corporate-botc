<!DOCTYPE html>
<html>

<head>
    <title>Course Registration Approved</title>
</head>

<body>
    <h1>Course Registration Approved</h1>
    <p>Dear {{ $courseRegistration->user->name }},</p>
    <p>Your course registration has been approved. Here are the details:</p>
    <ul>
        <li>Company: {{ $courseRegistration->user->name }}</li>
        <li>PIC: {{ $courseRegistration->user->namepic }}</li>
        <li>Created At: {{ $courseRegistration->created_at }}</li>
        <li>Total Price: {{ formatRupiah($courseRegistration->totalPrice) }}</li>
    </ul>
    <h2>Participant List:</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Course Program</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courseRegistration->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->employed->name }}</td>
                    <td>{{ $item->course->title }}</td>
                    <td>{{ formatRupiah($item->price) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>Thank you for your registration.</p>
</body>

</html>
