<?php

namespace App\Notifications;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewClientNotification extends Notification
{
    use Queueable;
    protected $client;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $body = sprintf('
        %s sending a request for discount %s' ,
        $this->client->name,
        $this->client->Detials,
    );

        return (new MailMessage)
                    ->subject('New Request')
                    ->from('narin@localhost', 'NAREEN Notification')
                    ->greeting('Hello ' . $this->client->name . 'Thank you for sending your request')
                    ->line($body)
                    ->action('Notification Action', route('dashboard'/*, $this->proposal->project_id*/))
                    ->line('Thank you for using our NARIN Website!');
    }

      /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        $body = sprintf('
            %s Request for discount %s' ,
            $this->client->name, $this->client->Details,
            );

        return [
            'title' => 'New Request',
            'body' => $body,
            'icon' => 'fas fa-envelope mr-2',
            'url' => route('dashboard'),
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
