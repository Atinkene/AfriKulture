<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $titre;
    protected $message;
    protected $link;
    public function __construct($titre, $message, $link, $url)
    {
        $this->titre = $titre;
        $this->message = $message;
        $this->link = $link;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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

   

    public function toDatabase($notifiable)
    {
        return [
            'titre' => $this->titre,
            'message' => $this->message,
            'link' => $this->link,
            'date' => now()->format('D d M y H:i:s'),
            'url'=> $this->url,
        ];
    }
}
