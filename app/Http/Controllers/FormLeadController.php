<?php

namespace App\Http\Controllers;

use App\Mail\FormSubmissionMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class FormLeadController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'message' => ['nullable', 'string', 'max:2000'],
            'form_type' => ['nullable', 'string', Rule::in(['premium', 'newsletter', 'contact'])],
            'form_source' => ['nullable', 'string', Rule::in(['premium', 'newsletter', 'footer', 'contact'])],
        ]);

        $source = $data['form_source'] ?? ($data['form_type'] ?? 'contact');

        // Only include fields that were actually filled on the form.
        $fields = ['Email' => $data['email']];

        foreach (['name' => 'Name', 'phone' => 'Phone', 'message' => 'Message'] as $key => $label) {
            $value = trim((string) ($data[$key] ?? ''));
            if ($value !== '') {
                $fields[$label] = $value;
            }
        }

        $payload = [
            'email' => $data['email'],
            'fields' => $fields,
            'form_type' => $data['form_type'] ?? 'contact',
            'form_source' => $source,
            'submitted_at' => now()->toDateTimeString(),
        ];

        $recipients = config('mail.form_recipients', []);

        if ($recipients === []) {
            Log::error('Form submission email skipped: no FORM_FORWARD_EMAILS configured');

            return back()
                ->withInput()
                ->with('form_source', $source)
                ->with('form_error', 'Something went wrong. Please try again in a moment.');
        }

        try {
            foreach ($recipients as $recipient) {
                Mail::to($recipient)->send(new FormSubmissionMail($payload));
            }
            Log::info('Form submission email sent', [
                'email' => $payload['email'],
                'form_type' => $payload['form_type'],
                'fields' => array_keys($fields),
                'recipients' => $recipients,
            ]);
        } catch (\Throwable $exception) {
            Log::error('Form submission email failed', [
                'message' => $exception->getMessage(),
                'email' => $payload['email'],
                'recipients' => $recipients,
            ]);

            return back()
                ->withInput()
                ->with('form_source', $source)
                ->with('form_error', 'Something went wrong. Please try again in a moment.');
        }

        return back()
            ->with('form_source', $source)
            ->with('form_success', 'Thanks! We received your request and will be in touch soon.');
    }
}
