<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserBookingEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $dataEmail;

    /**
     * Create a new message instance.
     */
    public function __construct($dataEmail)
    {
        $this->dataEmail = $dataEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->dataEmail['email_type'] == 'oneway_flight'){
            return $this->from('support@9yards.ae', 'Syriatra Email')
                        ->subject('Flight Payment')
                        ->view('Front_End.mails.mailflightoneway')
                        ->with($this->dataEmail);
        }elseif($this->dataEmail['email_type'] == 'return_flight'){
            return $this->from('support@9yards.ae', 'Syriatra Email')
                        ->subject('Flight Payment')
                        ->view('Front_End.mails.mailflightreturn')
                        ->with($this->dataEmail);
        }elseif($this->dataEmail['email_type'] == 'packages'){
            return $this->from('support@9yards.ae', 'Syriatra Email')
                        ->subject('Package Payment')
                        ->view('Front_End.mails.mailpackage')
                        ->with($this->dataEmail);
        }else{
            return $this->from('support@9yards.ae', 'Syriatra Email')
            ->subject('Hotel Payment')
            ->view('Front_End.mails.mailhotel')
            ->with($this->dataEmail);
        }
    }
}
