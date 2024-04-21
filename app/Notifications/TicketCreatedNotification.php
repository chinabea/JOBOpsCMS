<?php

namespace App\Notifications;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketCreatedNotification extends Notification
{
    use Queueable;

    public $user;
    public $ticket;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user, Ticket $ticket)
    {
        $this->user = $user;
        $this->ticket = $ticket;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the array representation for database storage.
     */
    public function toDatabase($notifiable)
    {
        return [
            'ticket_id' => $this->ticket->id,
            'user_id' => $this->user->id,
            'message' => 'A new ticket has been created.',
            'icon' => 'fas fa-file-alt', 
            'action_url' => url("/tickets/{$this->ticket->id}"),

            
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    // ->subject('New Ticket Created')
                    // ->greeting('Hello ' . $this->user->first_name . '!')
                    // ->line('A new ticket has been created on your account. Ticket ID: ' . $this->ticket->id)
                    // ->line('Ticket Title: ' . $this->ticket->title)
                    // ->action('View Ticket', url("/tickets/{$this->ticket->id}"))
                    // ->line('Thank you for using our application!');

                    
        ->view('emails.ticketCreation', [
            'user' => $this->user,
            'ticket' => $this->ticket
        ]);
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            // Additional data can be added here if needed.
        ];
    }
}
