<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Quote Request</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        h2 { color: #1f7a1f; border-bottom: 1px solid #eee; padding-bottom: 8px; }
        .field { margin-bottom: 12px; }
        .label { font-weight: bold; display: inline-block; min-width: 120px; }
        .value { margin-left: 8px; }
        .message-box { background: #f9f9f9; border: 1px solid #ddd; padding: 12px; border-radius: 4px; margin-top: 8px; }
    </style>
</head>
<body>
    <h2>New Quote Request</h2>
    <p>You have received a new quote request from the {{ config('site.name', 'Prime Field and Course Solutions LLC') }} website:</p>

    <div class="field"><span class="label">Name:</span><span class="value">{{ $contact['full_name'] ?? $contact['name'] ?? trim(($contact['first_name'] ?? '') . ' ' . ($contact['last_name'] ?? '')) }}</span></div>
    <div class="field"><span class="label">Email:</span><span class="value">{{ $contact['email'] }}</span></div>
    <div class="field"><span class="label">Phone:</span><span class="value">{{ $contact['phone'] ?: '—' }}</span></div>
    @if(!empty($contact['project_type']))
    <div class="field"><span class="label">Project Type:</span><span class="value">{{ $contact['project_type'] }}</span></div>
    @elseif(!empty($contact['venue_event']))
    <div class="field"><span class="label">Venue/Event:</span><span class="value">{{ $contact['venue_event'] }}</span></div>
    @endif
    @if(!empty($contact['message']))
    <div class="field">
        <span class="label">Message:</span>
        <div class="message-box">{{ $contact['message'] }}</div>
    </div>
    @endif

    <p style="margin-top: 24px; font-size: 12px; color: #666;">Sent from {{ config('site.name', 'Prime Field and Course Solutions LLC') }} contact form.</p>
</body>
</html>
