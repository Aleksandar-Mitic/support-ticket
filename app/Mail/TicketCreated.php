<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Ticket;

class TicketCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $ticket_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
        $this->ticket_id = $ticket->ticket_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.ticket-created',[
            'ticket_link' => route('ticket.show', ['ticket_id' => $this->ticket_id])
        ]);
        
    }
}
