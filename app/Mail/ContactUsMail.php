<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */


    public $name, $email, $subject, $messageBody, $files;


    public function __construct($name, $email, $subject, $messageBody, $files)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->messageBody = $messageBody;
        $this->files = $files;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('mail.contact-us-mail', ['name' => $this->name, 'email' => $this->email, 'subject' => $this->subject, 'messageBody' => $this->messageBody]);

        foreach ($this->files as $file) {
            $email->attach($file->getRealPath(),
                [
                    'as' => $file->getClientOriginalName(),
                    'mime' => $file->getClientMimeType(),
                ]);;
        }

        return $email;
    }
}
