<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendFeedbackRequest;
use App\Mail\FeedbackReceived;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendFeedbackController extends Controller
{
    public function sendFeedback(SendFeedbackRequest $request)
    {
        try {
            $feedbackData = $request->validated();

            return DB::transaction(function () use ($feedbackData) {
                // Save to database
                $feedback = new Feedback();
                $feedback->name = data_get($feedbackData, 'name');
                $feedback->email = data_get($feedbackData, 'email');
                $feedback->message = data_get($feedbackData, 'message');

                // Process optional JSON fields
                $this->processOptionalFields($feedback, $feedbackData);

                $feedback->public_id = $this->makePublicId();
                $feedback->save();

                // Send email notifications
                $this->sendNotificationEmails($feedbackData);

                return response()->json([
                    'message' => 'Feedback sent successfully!',
                    'reference' => $feedback->public_id
                ], 200);
            });
        } catch (\Exception $e) {
            Log::error('Failed to process feedback: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to process feedback. Please try again later.'], 500);
        }
    }

    /**
     * Process optional JSON fields for the feedback
     *
     * @param Feedback $feedback
     * @param array $feedbackData
     * @return void
     */
    private function processOptionalFields(Feedback $feedback, array $feedbackData): void
    {
        $jsonFields = ['app_info', 'device_info', 'additional_info'];

        foreach ($jsonFields as $field) {
            if (isset($feedbackData[$field])) {
                $feedback->$field = json_encode($feedbackData[$field]);
            }
        }
    }

    /**
     * Send notification emails to user and admin
     *
     * @param array $feedbackData
     * @return void
     */
    private function sendNotificationEmails(array $feedbackData): void
    {
        $mailInstance = new FeedbackReceived($feedbackData);

        if (data_get($feedbackData, 'email')) {
            Mail::to($feedbackData['email'])
                ->bcc(config('tenant.email'))
                ->send($mailInstance);
        } else {
            // If the sender's email is not available or invalid, just notify admin
            Mail::to(config('tenant.email'))
                ->send($mailInstance);
        }
    }

    /**
     * Generate a random string
     *
     * @param int $id
     * @return string
     */
    private function makePublicId()
    {
        // Generate a random alphanumeric uppercase string of length 5
        $randomString = strtoupper(\Illuminate\Support\Str::random(5));
        return "MPT-{$randomString}";
    }
}
