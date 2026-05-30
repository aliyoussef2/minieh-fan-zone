<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;

class TicketConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public Reservation $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🎟️ Your Minieh Fan Zone Ticket — ' . $this->reservation->booking_code,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ticket',
        );
    }
}