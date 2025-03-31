<x-mail::message>

# Feedback Received

Dear {{ isset($feedback->email) ? '' : 'Anonymous' }} user, thank you for submitting your valuable feedback. 

<x-mail::panel>
    {{ $feedback['message'] }}
</x-mail::panel>

<sub>This automated message lets you know that we have received your feedback and will review it shortly. </sub>

Thanks,<br>
{{ config('tenant.admin') }}
</x-mail::message>
