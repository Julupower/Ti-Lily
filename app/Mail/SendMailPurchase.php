<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailPurchase extends Mailable
{
    use Queueable, SerializesModels;
    public $paymentInfo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($paymentInfo)
    {
        //initialize the payment info data
        $this->$paymentInfo = $paymentInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->from('sales@tiandlily.com')
                ->view('mail.purchase')->with([
                    'paymentInfo' => $this->paymentInfo
                ]);
    }
}
