<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateAccountUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName ,$mail, $password)
    {
        $this->userName = $userName;
        $this->email = $mail;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $titleMail = "Notice of completion of management screen account creation";
        return $this->view('email.createUser',  ['userName' => $this->userName, 'email' => $this->email, 'password' => $this->password])->to($this->email)->subject($titleMail);
    }
}
