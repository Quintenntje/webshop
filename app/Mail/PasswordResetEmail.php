<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetEmail extends Mailable
{
    use Queueable, SerializesModels;

    public int $code;
    public string $resetUrl;

    public function __construct(int $code)
    {
        $this->code = $code;
        $this->resetUrl = url('/reset-password') . '?token=' . urlencode((string) $code);
    }

    public function build(): self
    {
        return $this
            ->subject('Reset your password')
            ->view('emails.password-reset')
            ->with([
                'code' => $this->code,
                'resetUrl' => $this->resetUrl,
            ]);
    }
}


