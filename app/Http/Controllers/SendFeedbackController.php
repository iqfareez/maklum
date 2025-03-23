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

        // Save to database
        $feedback = new Feedback();
        $feedback->public_id = $this->makePublicId($feedback->id);
        $feedback->name = data_get($feedbackData, 'name');
        $feedback->email = data_get($feedbackData, 'email');
        $feedback->message = data_get($feedbackData, 'message');
        $feedback->app_info = data_get($feedbackData, 'app_info');
        $feedback->device_info = data_get($feedbackData, 'device_info');
        $feedback->additional_info = data_get($feedbackData, 'additional_info');
        $feedback->save();

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

    /**
     * Generate a random string
     *
     * @param int $id
     * @return string
     */
    private function makePublicId($id)
    {
        // Generate a random alphanumeric uppercase string of length 5
        $randomString = strtoupper(\Illuminate\Support\Str::random(5));
        return "MPT-{$randomString}";
    }
}
