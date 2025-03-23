<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendFeedbackRequest;
use App\Mail\FeedbackReceived;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendFeedbackController extends Controller
{
    public function sendFeedback(SendFeedbackRequest $request)
    {
        // Validate the request data
        $feedbackData = $request->validated();

        // Check is feedbackData 'email' is valid email and not null, send email
        if (isset($feedbackData['email'])) {
            Mail::to($feedbackData['email'])
                ->bcc('mptwaktusolat@gmail.com')
                ->send(new FeedbackReceived($feedbackData));
        } else {
            // If the sender's email is not available or invalid, just let the admin know
            Mail::bcc('mptwaktusolat@gmail.com')
                ->send(new FeedbackReceived($feedbackData));
        }

        // Process the feedback (e.g., save to database, send email, etc.)
        // For demonstration purposes, we'll just return a success response
        return response()->json(['message' => 'Feedback sent successfully!'], 200);
    }
}
