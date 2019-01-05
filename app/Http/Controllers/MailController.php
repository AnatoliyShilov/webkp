<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailController extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $order;
    protected $basket;

    /**
     * Create a new message instance.
     * 
     * @return void
     */
    public function __construct($user, $order, $basket)
    {
        $this->user = $user;
        $this->order = $order;
        $this->basket = $basket;
    }

    /** 
     * Build the message.
     * 
     * @return $this
    */
    public function build()
    {
        return $this->view('email.toadmin')
                    ->with([
                        'user' => $this->user,
                        'order' => $this->order
                    ]);
    }
}
