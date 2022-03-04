<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPasswordMailable extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var array
     */
    public $user;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'noreply@buckhill.com';
        $subject = 'Password Reset';
        $name = 'Buck Hill';

        return $this->view('emails.passwordReset')
            ->from($address, $name)
            ->subject($subject);
    }
}
