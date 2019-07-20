<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class ContactUs extends Mailable
{
    public $name;
    public $email;
    public $contact_number;
    public $content;
    
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $contact_number, $content)
    {
        $this->name = $name;
        $this->email = $email;
        $this->contact_number = $contact_number;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = $this->name;
        $email = $this->email;
        $contact_number = $this->contact_number;
        $content = $this->content;
        $dateTime = Carbon::now()->format('D d M Y H:i');
        
        return $this->view('email.contactUs', compact('name', 'email', 'contact_number', 'content', 'dateTime'));
    }
}
