<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FormSubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $payload)
    {
    }

    public function envelope(): Envelope
    {
        $type = (string) ($this->payload['form_type'] ?? 'contact');
        $label = $this->formLabel($type);
        $leadEmail = (string) ($this->payload['email'] ?? '');

        return new Envelope(
            subject: "New {$label} — {$leadEmail}",
            replyTo: $leadEmail !== '' ? [new Address($leadEmail)] : [],
        );
    }

    public function content(): Content
    {
        $type = (string) ($this->payload['form_type'] ?? 'contact');
        $email = (string) ($this->payload['email'] ?? '');
        $submittedAt = (string) ($this->payload['submitted_at'] ?? now()->toDateTimeString());

        $fields = $this->payload['fields'] ?? [];
        if (! is_array($fields) || $fields === []) {
            $fields = array_filter([
                'Email' => $email,
                'Name' => trim((string) ($this->payload['name'] ?? '')),
                'Phone' => trim((string) ($this->payload['phone'] ?? '')),
                'Message' => trim((string) ($this->payload['message'] ?? '')),
            ], fn ($value) => $value !== null && trim((string) $value) !== '');
        }

        $rows = [];
        $rows['Form type'] = e($this->formLabel($type));

        foreach ($fields as $label => $value) {
            // Email already highlighted in the lead box — skip duplicate row.
            if (strtolower((string) $label) === 'email') {
                continue;
            }
            $rows[$label] = nl2br(e((string) $value));
        }

        $rows['Submitted'] = e($submittedAt);

        return new Content(
            view: 'emails.form-submission',
            with: [
                'siteName' => config('app.name', 'PinShot'),
                'formLabel' => $this->formLabel($type),
                'email' => $email,
                'rows' => $rows,
            ],
        );
    }

    private function formLabel(string $type): string
    {
        return match ($type) {
            'premium' => 'Free Trial signup',
            'newsletter' => 'Newsletter signup',
            'contact' => 'Contact form',
            default => ucfirst($type).' form',
        };
    }
}
