<?php

namespace App\Notifications;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketAssignedNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $ticket;
    protected $requestor;

    /**
     * Create a new notification instance.
     */

    public function __construct($ticket, $user, $requestor)
    {
        $this->ticket = $ticket;
        $this->user = $user;
        $this->requestor = $requestor;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'ticket_id' => $this->ticket,
            'message' => 'A new ticket has been assigned.',
            'icon' => 'fas fa-file-alt',
            'action_url' => url("/show/ticket/{$this->ticket->id}"),
        ];
    }
    public function toMail($notifiable)
    {
            return (new MailMessage)       
            ->view('emails.assignedTicket', [
                'user' => $this->user,
                'ticket' => $this->ticket,
                'requestor' => $this->requestor,
                'action_url' => url("/show/ticket/{$this->ticket->id}"),
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
