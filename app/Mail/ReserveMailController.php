<?php

namespace App\Mail;

use App\Models\Reserve;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReserveMailController extends Mailable
{
    public reserve $reserve;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reserve)
    {
        $this->reserve = $reserve;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $reserve = $this->reserve;

        $title = 'A Reserva '.$this->reserve->id.' foi Solicitada';

        return $this->markdown('email.reserveMail', compact('reserve'))->subject($title);
    }
}
