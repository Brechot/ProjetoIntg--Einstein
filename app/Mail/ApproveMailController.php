<?php

namespace App\Mail;

use App\Models\Reserve;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApproveMailController extends Mailable
{
    use Queueable, SerializesModels;

    public reserve $approve;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($approve)
    {
        $this->approve = $approve;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $approve = $this->approve;

        if($this->approve->status == 2){
            $acp_dec = 'aceito';
        }elseif($this->approve->status == 3){
            $acp_dec = 'recusado';
        }

        $title = 'A Reserva '.$this->approve->id.' foi '.$acp_dec;

        return $this->markdown('email.approveMail', compact('approve','acp_dec'))->subject($title);
    }
}
