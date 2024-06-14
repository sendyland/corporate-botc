<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\CourseRegistrationApproved;
use App\Mail\ParticipantRegisteredAccount;
use App\Models\Employed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TestEmailController extends Controller
{
    public function sendTestEmail()
    {
        $dummyData = (object) [
            'user' => (object) [
                'name' => 'Test User',
                'namepic' => 'PIC Name',
                'email' => 'test@example.com'
            ],
            'created_at' => now(),
            'totalPrice' => 100000,
            'items' => [
                (object) [
                    'employed' => (object) ['name' => 'Employee 1'],
                    'course' => (object) ['title' => 'Course 1'],
                    'price' => 50000
                ],
                (object) [
                    'employed' => (object) ['name' => 'Employee 2'],
                    'course' => (object) ['title' => 'Course 2'],
                    'price' => 50000
                ]
            ]
        ];

        Mail::to('sendymaulana54@gmail.com')->send(new CourseRegistrationApproved($dummyData));

        return 'Email sent!';
    }

    public function testEmail()
    {
        // Dummy data for testing
        $employed = new Employed();
        $employed->name = 'John Doe';
        $employed->email = 'sendymaulana54@gmail.com';

        $password = Str::random(18);
        $websiteUrl = env('LEARNING_WEBSITE_URL', 'https://example.com');

        // Send test email
        Mail::to($employed->email)->send(new ParticipantRegisteredAccount($employed, $password));

        return 'Test email has been sent to ' . $employed->email;
    }
}
